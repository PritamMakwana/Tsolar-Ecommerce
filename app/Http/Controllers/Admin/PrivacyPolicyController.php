<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PrivacyPolicyController extends Controller
{

    public function editPagePrivacyPolicy()
    {
        $fetch = PrivacyPolicy::where('id', '=', 1)->first();
        return view('backend.privacypolicy.privacy-policy', compact('fetch'));
    }

    public function editPrivacyPolicy(Request $request)
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
            return redirect()->route('privacy-policy.show')->with($notification)->withErrors($validator)
                ->withInput();
            ;
        }


        $update = PrivacyPolicy::where('id', '=', 1)->first();
        $update->title = $request->title;
        $update->description = $request->description;
        $status = $update->save();

        if ($status) {
            $notification = array(
                'message' => 'Privacy Policy Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('privacy-policy.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('privacy-policy.show')->with($notification);
        }
    }
}
