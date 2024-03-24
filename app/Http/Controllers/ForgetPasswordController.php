<?php

namespace App\Http\Controllers;

use App\Models\EmailOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;

class ForgetPasswordController extends Controller
{
    public function emailVerifyPage()
    {
        return view('auth.forget-password.email-verify');
    }

    public function emailVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);


        $email = $request->input('email');

        // Check if the email exists using the User model
        $emailExists = User::where('email', '=', $email)->first();

        if ($emailExists) {
            $this->GenrateOtp($emailExists);
            return redirect('/send-otp/' . $emailExists->id);
        } else {
            return redirect('/email-verify-page')->with('message', 'Email does not exist.');
        }
    }

    public function GenrateOtp($user)
    {
        $otp = rand(100000, 999999);
        $time = time();

        EmailOtp::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'otp' => $otp,
                'created_at' => $time
            ]
        );

        $data['email'] = $user->email;
        $data['title'] = 'OTP Verification';

        $data['body'] = 'Your OTP is:- ' . $otp;

        Mail::send('auth.forget-password.forget-pwd-otp-mail', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });
    }


    public function sendOtp($id)
    {
        $userdata = User::findOrfail($id);
        $email = $userdata->email;
        return view('auth.forget-password.send-otp', compact('email'));
    }


    public function sendOtpData(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailOtp::where('otp', $request->otp)->first();
        if (!$otpData) {
            return response()->json(['success' => false, 'msg' => 'You entered wrong OTP']);
        } else {

            $currentTime = time();
            $time = $otpData->created_at;

            if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 seconds
                // User::where('id', $user->id)->update([
                //     'is_verified' => 1
                // ]);
                return response()->json(['success' => true, 'msg' => 'OTP has been verified', 'url' => route('forget-pwd-page', ['id' => $user->id ])]);

                // return redirect()->route('forget-pwd-page', ['id' => $user->id ])->with('success', 'OTP has been verified');


            } else {
                return response()->json(['success' => false, 'msg' => 'Your OTP has been Expired']);
            }

        }
    }


    public function resendOtpData(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailOtp::where('email', $request->email)->first();

        $currentTime = time();
        $time = $otpData->created_at;

        if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 seconds
            return response()->json(['success' => false, 'msg' => 'Please try after some time']);
        } else {

            $this->GenrateOtp($user); //OTP SEND
            return response()->json(['success' => true, 'msg' => 'OTP has been sent']);
        }

    }

    public function forgetPwdPage($id)
    {
        return view('auth.forget-password.forget-pwd-page',compact('id'));
    }


    public function forgetPwdData(Request $request)
    {
        // Validate the request data
    $request->validate([
        'id' => 'required',
        'password' => 'required|min:8',
        'confirm_password' => 'required|same:password',
    ]);

    $user = User::find($request->id);


    $user->password = Hash::make($request->password);
    $user->save();

    $notification = array(
        'message' => 'Password updated successfully.',
        'alert-type' => 'success'
    );

    return redirect()->route('login')->with($notification);

    }
}
