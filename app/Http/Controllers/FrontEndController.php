<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Enquiry;
use App\Models\Category;
use App\Models\HomePageBanner;
use App\Models\ImageGallery;
use App\Models\Newsletter;
use App\Models\Products;
use App\Models\ContactUs;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Mail\Enquiry as EnquiryMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Mail\ContactUs as ContactUsMail;
use Illuminate\Support\Facades\Validator;



class FrontEndController extends Controller
{
    public function homePage()
    {
        $category = Category::all();
        $product = Products::all();
        $banner = HomePageBanner::all();
        $testimonial = Testimonial::all();
        $blog = Blog::all();
        return view('frontend.home', compact('category', 'product', 'banner', 'testimonial', 'blog'));
    }

    public function contactUs(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|size:10',
            'address' => 'required|string',
            'message' => 'required|string',
            'privacyPolicy' => 'required',
        ], [
            'firstname.required' => 'Please enter your first name.',
            'lastname.required' => 'Please enter your last name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'phone.size' => 'Phone number must be 10 digits long.',
            'address.required' => 'Please enter your address.',
            'message.required' => 'Please enter your message.',
            'privacyPolicy.required' => 'You must accept the privacy policy to proceed.',
        ]);

        $admin_mail = config('mail.from.address');

        Mail::to($admin_mail)->send(new ContactUsMail($request->email));

        ContactUs::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'message' => $request->message,
        ]);


        return redirect()->route('homepage')->with('successContact', 'Your response was recorded successfully.');

    }

    public function enquiryPage()
    {
        $gallery = ImageGallery::all();
        return view('frontend.enquiry', compact('gallery'));
    }

    public function enquiryData(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|size:10',
            'address' => 'required|string',
            'message' => 'required|string',
            'privacyPolicy' => 'required',
        ], [
            'firstname.required' => 'Please enter your first name.',
            'lastname.required' => 'Please enter your last name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'phone.size' => 'Phone number must be 10 digits long.',
            'address.required' => 'Please enter your address.',
            'message.required' => 'Please enter your message.',
            'privacyPolicy.required' => 'You must accept the privacy policy to proceed.',
        ]);

        $admin_mail = config('mail.from.address');

        Mail::to($admin_mail)->send(new EnquiryMail($request->email));

        Enquiry::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'message' => $request->message,
        ]);

        return redirect()->route('enquiry-page')->with('successEnquiry', 'Your response was recorded successfully.');
    }

    public function product($id)
    {
        $product = Products::where('product_id', '=', $id)->first();
        // dd($product);
        return view('product.details', compact('product'));
    }


    //news letter
    public function newsLetterData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'emailn' => 'required|email|unique:newsletters,email',
            // Add more validation rules for other fields if needed
        ], [
            'emailn.required' => 'Please enter your email address.',
            'emailn.email' => 'Please enter a valid email address.',
            'emailn.unique' => 'This email is already registered.',
            // Add custom messages for other validation rules if needed
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('homepage')->with($notification)->withErrors($validator)
                ->withInput();
            ;
        }
        // dd($request->all());

        $newsLetters = Newsletter::create(
            ['email' => $request['emailn']],
        );

        if ($newsLetters) {
            $notification = array(
                'message' => 'Your response was recorded successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('homepage')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('homepage')->with($notification);
        }

    }

    public function getIntouch()
    {
        return redirect()->route('homepage')->with('getIntouch', 'Your response was recorded successfully.');
    }




    //     public function search(Request $request)
// {
//     $query = $request->input('query');
//     $products = Products::where('name', 'like', "%$query%")->get();
//     return view('suggestions', ['products' => $products]);
// }


}
