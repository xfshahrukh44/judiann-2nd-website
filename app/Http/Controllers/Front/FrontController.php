<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchSession;
use App\Models\Course;
use App\Models\CourseSession;
use App\Models\LatestUpdate;
use App\Models\Page;
use App\Models\PortfolioImage;
use App\Models\ProductImage;
use App\Models\Settings;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Traits\PHPCustomMail;

class FrontController extends Controller
{
    use PHPCustomMail;

    public function home(Request $request)
    {
        $batches = Batch::all();
//        $latest_updates = LatestUpdate::with('course')->whereHas('course')->orderBy('created_at', 'DESC')->get();
        $students = Student::all();

        return view('front.home', compact('batches', 'students'));
    }

    public function schedule(Request $request)
    {
        $online_batches = Batch::where('is_online', 1)->get();
        $physical_batches = Batch::where('is_physical', 1)->get();

        $schedule = Page::where('name', 'Schedule')->first();
        if ($schedule) {
            $data = json_decode($schedule->content);
            return view('front.schedule', compact('schedule', 'data', 'online_batches', 'physical_batches'));
        }
        return view('front.schedule', compact('schedule', 'online_batches', 'physical_batches'));

//        $courses = Course::all();
//        $latest_updates = LatestUpdate::with('course')->orderBy('created_at', 'DESC')->get();

//        return view('front.schedule', compact('online_batches', 'physical_batches'));
    }

    public function schedule_class(Request $request)
    {
        $this->validate($request, array(
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'class_type' => 'required',
            'physical_class_type' => 'sometimes',
        ));

        //check if user already exists on basis of email
        $user_check = User::where('email', $request->email)->where('role_id', '=', 2)->get();
        $password = $this->generateRandomString(8);
        if (count($user_check) == 0) {
            $user = User::create([
                'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => hash::make($password),
                'role_id' => 2
            ]);
        } else {
            $user = $user_check[0];

            //check if user already registered on course
            $course = Course::find($request->input('course_id'));
            $batch_check = BatchSession::where('user_id', $user->id)->where('batch_id', $request->input('batch_id'))->first();
            if ($batch_check) {
                return back()->withErrors(['You have already registered in the batch.']);
            }

            //if user has already not yet registered a course (should generate password only then)
            if (count($user->batch_sessions) == 0) {
                $user->password = hash::make($password);
                $user->save();
            }
        }

        $batch = Batch::find($request->input('batch_id'));
        $batch_session_array = [
            'user_id' => $user->id,
            'batch_id' => $batch->id,
            'class_type' => $request->input('class_type'),
            'physical_class_type' => $request->input('physical_class_type'),
        ];

        session()->put('user', $user);
        session()->put('batch_session_array', $batch_session_array);
        session()->put('password', (count($user->batch_sessions) == 0) ? $password : null);
        session()->put('course_fees', $batch->course->fees);

        return view('front.payment');
    }

    public function process_payment(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'card_no' => 'required',
            'exp_mon' => 'required',
            'exp_year' => 'required',
            'cvv' => 'required'
        ]);

        if ($validator->fails()) {
            return [
                "status" => false,
                "data" => [],
                "errors" => $validator->messages(),
                "message" => "Unexpected Error occured."
            ];
        }

//        $stripe = [
//            "secret_key" => env("SECRET_KEY", "sk_test_lUp78O7PgN08WC9UgNRhOCnr"),
//            "publishable_key" => env("PUBLISHABLE_KEY", "pk_test_0rY5rGJ7GN1xEhCB40mAcWjg"),
//        ];

        $stripe = get_payment_keys();

        $user = session()->get('user');
        $batch_session_array = session()->get('batch_session_array');
        $password = session()->get('password');

        try {

            $cardStripe = \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $cardStripe = \Stripe\Token::create(array(
                "card" => array(
                    "number" => $request['card_no'],
                    "exp_month" => $request['exp_mon'],
                    "exp_year" => $request['exp_year'],
                    "cvc" => $request['cvv']
                )
            ));

            if (!empty($cardStripe)) {

                $customer = new \Stripe\StripeClient(
                    $stripe['secret_key']
                );
                $abc = $customer->customers->create([
                    'description' => 'Shopping',
                    'email' => $user->email,
                    'source' => $cardStripe['id'],
                ]);

                $charge = \Stripe\Stripe::setApiKey($stripe['secret_key']);

                $charge = \Stripe\Charge::create([
                    'amount' => intval(session()->get('course_fees') * 100),
                    'currency' => 'usd',
                    'customer' => $abc
                ]);

                if ($charge['status'] === 'succeeded') {

                    //create course session
                    $batch_session = BatchSession::create($batch_session_array);

                    //send mail to customer
                    $data = [];
                    $data['name'] = $user->name;
                    $data['course_name'] = $batch_session->batch->course->name;
                    $data['email'] = $user->email;
                    $data['password'] = $password;
                    $data['customer_portal_link'] = route('customer.dashboard');
                    $this->send_mail($data);

                    //delete session variables
                    session()->remove('user');
                    session()->remove('batch_session_array');
                    session()->remove('password');
                    session()->remove('course_fees');

                    return [
                        "status" => true,
                        "errors" => [],
                        "message" => "Successfully added"
                    ];

                }

                return [
                    "status" => false,
                    "errors" => [],
                    "message" => "Payment failed. Try again."
                ];

            }
        } catch (\Exception $e) {

            return [
                "status" => false,
                "errors" => [],
                "message" => $e->getMessage()
            ];
//            throw $e;
        }
    }

    public function send_mail($data)
    {
        try {
            $name = $data['name'];
            $course_name = $data['course_name'];
            $email = $data['email'];
            $password = $data['password'];
            $customer_portal_link = $data['customer_portal_link'];

            $message = 'Dear ' . $name . "<br /><br />";
            $message .= 'Thank you for booking our ' . $course_name . ' course. Your system generated login details are below:' . "<br /><br />";
            $message .= 'Email: ' . $email . "<br />";
            $message .= (!is_null($password)) ? 'Password: ' . $password . "<br />" : '';
            $message .= 'Customer Portal Link: <a href="' . $customer_portal_link . '">' . $customer_portal_link . '</a>' . "<br /><br />";
            $message .= 'Regards,' . "<br />";
            $message .= 'Judiann';

            $this->customMail('admin@judiann.com', $email, 'Course Booked', $message);

            return 1;
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors', $exception->getMessage());
        }
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function send_front_mail(Request $request)
    {
        try {
            $name = $request['name'];
            $email = $request['email'];
            $phone = $request['phone'];
            $msg = $request['msg'];
            $message = 'Name: ' . $name . "<br />";
            $message .= 'Email: ' . $email . "<br />";
            $message .= 'Phone: ' . $phone . "<br />";
            $message .= 'Message: ' . $msg . "<br />";

            $email = (Settings::find(1))->email;

//            \mail($email,"Contact Request From Website",$message);

            $this->customMail('admin@judiann.com', $email, 'Contact Request From Website', $message);

            return redirect()->route('front.home')->with('success', 'Email sent successfully!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors', $exception->getMessage());
        }
    }

    public function studentsWork(Request $request)
    {
        $portfolio_images = PortfolioImage::all();
        $student_work = Page::where('name', 'Students Work')->first();
        if ($student_work) {
            $data = json_decode($student_work->content);
            return view('front.students-work', compact('data', 'student_work', 'portfolio_images'));
        }
        return view('front.students-work', compact('portfolio_images', 'student_work'));
    }

    public function individualStudentsWork(Request $request, $student_id)
    {
        $student = Student::find($student_id);

        return view('front.individual-students-work', compact('student'));
    }
}
