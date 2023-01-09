<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchSession;
use App\Models\Course;
use App\Models\CourseSession;
use App\Models\LatestUpdate;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\ProductImage;
use App\Models\Services;
use App\Models\Settings;
use App\Models\Student;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $students = Student::all();
        $services = Services::paginate(10);
        $sort_portfolio = Portfolio::orderBy('image_order', 'asc')->paginate(6);
        $home = Page::where('name', 'Home')->first();
        if ($home) {
            $data = json_decode($home->content);
            return view('front.home', compact('data', 'batches', 'students', 'services', 'home', 'sort_portfolio'));
        }
        return view('front.home', compact('batches', 'students', 'services', 'home', 'sort_portfolio'));
    }

    public function schedule(Request $request)
    {
        $online_batches = Batch::where('is_online', 1)->where('has_ended', 0)->get();
        $physical_batches = Batch::where('is_physical', 1)->where('has_ended', 0)->get();

        $online_events = [];
        $physical_events = $online_events;
        $online_colors = [
            'black',
            'red',
            'purple',
            'purple',
            'fuchsia',
            'green',
            'lime',
            'yellow',
            'teal',
            'aqua',
            'blueviolet',
            'coral',
            'cornflowerblue',
            'cyan',
            'crimson',
            'darkorange',
            'gold',
            'goldenrod',
            'greenyellow',
            'indianred',
            'mediumvioletred',
            'orangered',
        ];
        $physical_colors = $online_colors;

        foreach ($online_batches as $batchKey => $batch) {
            $random_index = array_rand($online_colors);

            if(is_null($batch->date_range)) {
                foreach ($batch->batch_dates as $batch_date) {
                    $online_events[] = [
                        'title' => $batch->course->name . ' ('.$batch->name.')',
                        'date' => $batch_date->date,
                        'time' => $batch_date->time_from . ' to ' . $batch_date->time_to,
                        'color' => $online_colors[$random_index],
                        'description' => $batch->course->description,
                        'img_src' => $batch->course->get_course_image(),
                        'batch_id' => $batch->id,
                        'class_type' => 'online',
                        'physical_class_type' => $batch->physical_class_type,
                        'batch_is_full' => batch_is_full($batch),
                        'already_bought' => is_in_batch($batch->id),
                        'fees' => $batch->course->fees ?? 0.0
                    ];
                }
            } else {
                $current_date = Carbon::parse($batch->date_range_from);
                while ($current_date <= Carbon::parse($batch->date_range_to)) {
                    $online_events[] = [
                        'title' => $batch->course->name . ' ('.$batch->name.')',
                        'date' => $current_date,
                        'time' => $batch->time_from . ' to ' . $batch->time_to,
                        'color' => $online_colors[$random_index],
                        'description' => $batch->course->description,
                        'img_src' => $batch->course->get_course_image(),
                        'batch_id' => $batch->id,
                        'class_type' => 'online',
                        'physical_class_type' => $batch->physical_class_type,
                        'batch_is_full' => batch_is_full($batch),
                        'already_bought' => is_in_batch($batch->id),
                        'fees' => $batch->course->fees ?? 0.0
                    ];
                    $current_date = Carbon::parse($current_date)->addDay();
                }
            }

            unset($online_colors[$random_index]);
        }
        foreach ($physical_batches as $batch) {
            $random_index = array_rand($physical_colors);

            if(is_null($batch->date_range)) {
                foreach ($batch->batch_dates as $batch_date) {
                    $physical_events[] = [
                        'title' => $batch->course->name . ' ('.$batch->name.')',
                        'date' => $batch_date->date,
                        'time' => $batch_date->time_from . ' to ' . $batch_date->time_to,
                        'color' => $physical_colors[$random_index],
                        'description' => $batch->course->description,
                        'img_src' => $batch->course->get_course_image(),
                        'batch_id' => $batch->id,
                        'class_type' => 'physical',
                        'physical_class_type' => $batch->physical_class_type,
                        'batch_is_full' => batch_is_full($batch),
                        'already_bought' => is_in_batch($batch->id),
                        'fees' => $batch->course->fees ?? 0.0
                    ];
                }
            } else {
                $current_date = Carbon::parse($batch->date_range_from);
                while ($current_date <= Carbon::parse($batch->date_range_to)) {
                    $physical_events[] = [
                        'title' => $batch->course->name . ' ('.$batch->name.')',
                        'date' => $current_date,
                        'time' => $batch->time_from . ' to ' . $batch->time_to,
                        'color' => $physical_colors[$random_index],
                        'description' => $batch->course->description,
                        'img_src' => $batch->course->get_course_image(),
                        'batch_id' => $batch->id,
                        'class_type' => 'physical',
                        'physical_class_type' => $batch->physical_class_type,
                        'batch_is_full' => batch_is_full($batch),
                        'already_bought' => is_in_batch($batch->id),
                        'fees' => $batch->course->fees ?? 0.0
                    ];
                    $current_date = Carbon::parse($current_date)->addDay();
                }
            }

            unset($physical_colors[$random_index]);
        }

        $schedule = Page::where('name', 'Schedule')->first();
        $data = null;

        if ($schedule) {
            $data = json_decode($schedule->content);
        }

        return view('front.schedule', compact('online_batches', 'physical_batches', 'online_events', 'physical_events', 'schedule', 'data'));
    }

    public function schedule_class(Request $request)
    {
        $this->validate($request, array(
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'class_type' => 'sometimes',
            'physical_class_type' => 'sometimes',
            'batch_ids' => 'required',
        ));

        $user = Auth::user();
        $batch_session_arrays = [];
        foreach ($request->batch_ids as $key => $batch_id) {
            if(!is_in_batch($batch_id)) {
                $batch_session_arrays []= [
                    'user_id' => $user->id,
                    'batch_id' => $batch_id,
                    'class_type' => $request->class_types[$key],
                    'physical_class_type' => $request->physical_class_types[$key] == 'null' ? null : $request->physical_class_types[$key],
                    'fees' => floatval($request->fees[$key]),
                ];
            }
        }

        session()->put('user', $user);
        session()->put('batch_session_arrays', $batch_session_arrays);

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

        $stripe = get_payment_keys();

        $user = session()->get('user');
        $batch_session_arrays = session()->get('batch_session_arrays');

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

                foreach ($batch_session_arrays as $batch_session_array) {
                    $charge = \Stripe\Charge::create([
                        'amount' => intval(floatval($batch_session_array['fees']) * 100),
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
                        $data['customer_portal_link'] = route('customer.dashboard');
                        $this->send_mail($data);

                    }

                }

                //delete session variables
                session()->remove('user');
                session()->remove('batch_session_arrays');

                return [
                    "status" => true,
                    "errors" => [],
                    "message" => "Successfully added"
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

            $this->customMail('info@judiannsfashiondesignstudios.com', $email, 'Course Booked', $message);

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

            $this->customMail('info@judiannsfashiondesignstudios.com', $email, 'Contact Request From Website', $message);

            return redirect()->route('front.home')->with('success', 'Email sent successfully!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors', $exception->getMessage());
        }
    }

    public function studentsWork(Request $request)
    {
        $student_work = Page::where('name', 'Students Work')->first();
        $students = Student::all();
        if ($student_work) {
            $data = json_decode($student_work->content);
            return view('front.students-work', compact('data', 'student_work', 'students'));
        }
        return view('front.students-work', compact('students', 'student_work'));
    }

    public function individualStudentsWork(Request $request, $student_id)
    {
        $student = Student::find($student_id);

        return view('front.individual-students-work', compact('student'));
    }

    public function testimonial(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'rating' => 'required',
                'title' => 'required',
                'review' => 'required',
                'name' => 'required',
                'email' => 'required',
            ]);

            $testimonial = Testimonial::create($request->except('is_genuine'));
            if ($request->has('is_genuine')) {
                $testimonial->is_genuine = true;
                $testimonial->save();
            }

            return redirect()->route('front.testimonial')->with('success', 'Testimonial submitted for approval!');

        } else {
            $testimonials = Testimonial::where('is_approved', true)->orderBy('created_at', 'DESC')->get();

            return view('front.testimonial', compact('testimonials'));
        }
    }
}
