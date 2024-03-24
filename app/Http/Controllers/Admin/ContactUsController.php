<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index()
    {
        $ContactUs = ContactUs::paginate(10);
        return view('backend.contactus.index', compact('ContactUs'));
    }
}
