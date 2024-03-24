<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    public function editPageAboutUs()
    {
        $fetch = AboutUs::where('id', '=', 1)->first();
        return view('backend.about-us.about-us', compact('fetch'));
    }

    public function editAboutUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ], [
            'title.required' => 'Please provide a Title and Description.',
            'description.required' => 'Please provide a Title and Description.'
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Please provide a Title and Description.',
                'alert-type' => 'error'
            );
            return redirect()->route('about-us.show')->with($notification)->withErrors($validator)
                ->withInput();
            ;
        }


        $update = AboutUs::where('id', '=', 1)->first();
        $update->title = $request->title;
        $update->description = $request->description;
        $status = $update->save();

        if ($status) {
            $notification = array(
                'message' => 'About Us Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('about-us.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('about-us.show')->with($notification);
        }
    }
}
