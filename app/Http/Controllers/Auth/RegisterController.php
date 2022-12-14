<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Traits\PHPCustomMail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, PHPCustomMail;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/customer/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //create user
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'] ?? null,
        ]);

        //send mail to customer
        $this->send_registration_mail($data);

        return $user;
    }

    public function send_registration_mail($data)
    {
        try {
            $name = $data['first_name'] . ' ' . $data['last_name'];
            $email = $data['email'];

            $message = 'Hello: ' . $name . ',' . "<br />";
            $message .= 'Your account has been successfully created on Judiann Fashion Design Studios' . "<br />";

            $this->customMail('info@judiannsfashiondesignstudios.com', $email, 'Registration Successful', $message);

//            return redirect()->route('front.home')->with('success', 'Email sent successfully!');
            return 1;
        } catch (\Exception $exception) {
//            return redirect()->back()->with('errors', $exception->getMessage());
            return 0;
        }
    }
}
