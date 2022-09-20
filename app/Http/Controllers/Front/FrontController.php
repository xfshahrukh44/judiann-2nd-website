<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSession;
use App\Models\LatestUpdate;
use App\Models\Settings;
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
        $latest_updates = LatestUpdate::orderBy('created_at', 'DESC')->get();

        return view('front.home', compact('latest_updates'));
    }

    public function schedule(Request $request)
    {
        $courses = Course::all();
        $latest_updates = LatestUpdate::orderBy('created_at', 'DESC')->get();

        return view('front.schedule', compact('courses', 'latest_updates'));
    }

    public function schedule_class(Request $request)
    {
        $this->validate($request, array(
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'class_type' => 'required',
            'course_id' => 'required',
            'physical_class_type' => 'sometimes',
        ));

        //check if user already exists on basis of email
        $user_check = User::where('email', $request->email)->where('role_id', '=', 2)->get();
        $password = $this->generateRandomString(8);
        if(count($user_check) == 0) {
            $user = User::create([
                'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => hash::make($password),
                'role_id' => 2
            ]);
        } else {
            $user = $user_check[0];
            $user->password = hash::make($password);
            $user->save();
        }

        $course_session_array = [
            'user_id' => $user->id,
            'course_id' => $request->input('course_id'),
            'class_type' => $request->input('class_type'),
            'physical_class_type' => $request->input('physical_class_type'),
        ];

        session()->put('user', $user);
        session()->put('course_session_array', $course_session_array);
        session()->put('password', $password);
        $course = Course::find($course_session_array['course_id']);
        session()->put('course_fees', $course->fees);

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

        $stripe = [
            "secret_key" => env("SECRET_KEY", "sk_test_lUp78O7PgN08WC9UgNRhOCnr"),
            "publishable_key" => env("PUBLISHABLE_KEY", "pk_test_0rY5rGJ7GN1xEhCB40mAcWjg"),
        ];

        $user = session()->get('user');
        $course_session_array = session()->get('course_session_array');
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
                    CourseSession::create($course_session_array);

                    //send mail to customer
                    $data = [];
                    $course = Course::find($course_session_array['course_id']);
                    $data['name'] = $user->name;
                    $data['course_name'] = $course->name;
                    $data['email'] = $user->email;
                    $data['password'] = $password;
                    $data['customer_portal_link'] = route('customer.dashboard');
                    $this->send_mail($data);

                    //delete session variables
                    session()->remove('user');
                    session()->remove('course_session_array');
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
            $message .= 'Thank you for booking our '.$course_name.' course. Your system generated login details are below:' . "<br /><br />";
            $message .= 'Email: ' . $email . "<br />";
            $message .= 'Password: ' . $password . "<br />";
            $message .= 'Customer Portal Link: <a href="'.$customer_portal_link.'">'.$customer_portal_link.'</a>' . "<br /><br />";
            $message .= 'Regards,' . "<br />";
            $message .= 'Judiann';

            Mail::send([], [], function ($msg) use ($email, $message) {
                $msg->to($email)
                    ->subject('New order placed')
                    ->setBody($message, 'text/html');
            });

            return 1;
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors', $exception->getMessage());
        }
    }

    public function generateRandomString($length = 10) {
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

//            Mail::send([], [], function ($msg) use ($email, $message) {
//                $msg->to($email)
//                    ->subject('Contact Request From Website')
//                    ->setBody($message);
//            });

            return redirect()->route('front.home')->with('success', 'Email sent successfully!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors', $exception->getMessage());
        }
    }
}
