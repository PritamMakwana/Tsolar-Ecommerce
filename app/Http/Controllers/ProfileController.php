<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function profilePage($id)
    {
        $profile = Customers::findOrfail($id);
        // dd($profile);
        return view('frontend.profile', compact('profile'));
    }


    public function profileData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|regex:/^[0-9]{10}$/',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,gif,svg|dimensions:max_width=800,max_height=400|max:2048',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.regex' => 'The phone field must be a 10-digit number.',
            'address.string' => 'The address field must be a string.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be in PNG, JPG, GIF, or SVG format.',
            'image.dimensions' => 'The image dimensions must not exceed 800x400 pixels.',
            'image.max' => 'The image file size must not exceed 2MB.',
        ]);

        // dd($request);

        $id = $request->id;

        $update = Customers::where('id', '=', $id)->first();





        if (isset($request->image)) {

            if ($update->image && file_exists(public_path('Profile_images/' . $update->image))) {
                unlink(public_path('Profile_images/' . $update->image));
            }

            // Upload Image to folder
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('Profile_images'), $imageName);
            $update->image = $imageName;
        }


        $update->name = $request->name;
        $update->email = $request->email;
        $update->phone = $request->phone;
        $update->address = $request->address;
        $update->save();

        return redirect()->route('profile', ['id' => $id])->with('successProfile', 'Profile successfully update');

    }

    public function resetPasswordData(Request $request)
    {
        $user = Customers::where('id', '=', $request->id)->first();

        if (session()->has('resetPassword')) {

            $this->validate($request, [
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            // Update the user's password
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            session()->forget('resetPassword');
            return redirect()->route('profile', ['id' => $request->id])->with('successPassword', 'Password changed successfully.');

        } else {

            $this->validate($request, [
                'currentPassword' => 'required',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            // Check if the current password is correct
            if (Hash::check($request->currentPassword, $user->password)) {
                // Update the user's password
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);

                return redirect()->route('profile', ['id' => $request->id])->with('successPassword', 'Password changed successfully.');
            } else {
                // If the current password is incorrect, show an error message
                return back()->withErrors(['currentPassword' => 'Incorrect current password.']);
            }

        }

    }
}
