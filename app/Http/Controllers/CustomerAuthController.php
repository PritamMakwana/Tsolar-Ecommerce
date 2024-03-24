<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\EmailOtp;

class CustomerAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function demo()
    {
        return view('customer.demo');
    }

    public function loginPage()
    {
        return view('customer.customer-login');
    }

    public function signup()
    {
        return view('customer.customer-signup');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    /**
     * Handle customer registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'required' => 'The :attribute field is required.',
            'min' => 'The :attribute must be at least :min characters.',
            'email' => 'The :attribute must be a valid email address.',
            'confirmed' => 'The :attribute confirmation does not match.',
            'unique' => 'The :attribute is already taken.',
        ]);

        // Get the last customer ID from the database
        $lastCustomer = Customers::orderBy('id', 'desc')->first();

        // Calculate the next customer ID
        $nextID = $lastCustomer ? $lastCustomer->id + 1 : 1;
        $customerID = 'CS-' . str_pad($nextID, 3, '0', STR_PAD_LEFT);

        // Create a new customer record
        $customer = Customers::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'customer_id' => $customerID
        ]);

        // Send email verification link
        Mail::to($customer->email)->send(new VerifyEmail($customer));

        // Log in the customer after successful registration
        Auth::guard('customer')->login($customer);

        return redirect()->route('homepage');
    }

    public function verifyEmail($id)
    {

        $id = decrypt($id);

        $customer = Customers::find($id);

        if ($customer) {
            $customer->email_verified_at = now();
            $customer->save();
            Session::flash('message', 'Email verified successfully');
            return redirect()->route('customer-login');
        } else {
            Session::flash('message', 'Invalid verification link');
            return redirect()->route('customer-login');
        }

    }

    // Logout the customer
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('homepage'); // Redirect to the desired page after logout
    }

    public function forget_password(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:customers,email',
        ], [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute must be a valid email address.',
            'exists' => 'The :attribute is not registered with us.',
        ]);

        $customer = Customers::where('email', $request->email)->first();

        $otp = rand(100000, 999999);
        $time = time();

        EmailOtp::updateOrCreate(
            ['email' => $customer->email],
            [
                'email' => $customer->email,
                'otp' => $otp,
                'created_at' => $time
            ]
        );

        $data['email'] = $customer->email;
        $data['title'] = 'OTP Verification';

        $data['body'] = 'Your OTP is:- ' . $otp;

        // send email
        Mail::send('auth.forget-password.forget-pwd-otp-mail', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });

        # redirect to opt page

        $notification = array(
            'message' => 'OTP sent to your email.',
            'alert-type' => 'success'
        );

        session()->put('forgot_email', $customer->email);

        return redirect()->route('verify-otp')->with($notification);

    }

    public function otp_page()
    {
        // dd(session()->all());
        if (session()->has('forgot_email')) {
            return view('customer.verify-otp');
        } else {
            return redirect()->route('customer-login');
        }
    }

    public function verify_otp(Request $request)
    {

        $request->validate([
            'otp1' => 'required|numeric',
            'otp2' => 'required|numeric',
            'otp3' => 'required|numeric',
            'otp4' => 'required|numeric',
            'otp5' => 'required|numeric',
            'otp6' => 'required|numeric',
        ], [
            'required' => 'Please enter a valid OTP.',
            'numeric' => 'Please enter a valid OTP.',
        ]);

        $otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4 . $request->otp5 . $request->otp6;

        $emailOtp = EmailOtp::where('otp', $otp)->first();

        if ($emailOtp) {

            $customer = Customers::where('email', $emailOtp->email)->first();

            if ($customer) {

                Auth::guard('customer')->login($customer);

                session()->forget('forgot_email');

                $notification = array(
                    'message' => 'Email verified successfully.',
                    'alert-type' => 'success'
                );
                session()->put('resetPassword', 'resetPassword');
                return redirect()->route('profile', Auth::guard('customer')->id())->with($notification);

            } else {

                $notification = array(
                    'message' => 'Invalid OTP.',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);

            }
        } else {

            $notification = array(
                'message' => 'Invalid OTP.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }

    }

}
