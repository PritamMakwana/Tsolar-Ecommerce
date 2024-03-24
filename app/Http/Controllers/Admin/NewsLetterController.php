<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsLetterController extends Controller
{
    public function show()
    {
        $Newsletter = Newsletter::paginate(10);
        return view('backend.newsLetters.show', compact('Newsletter'));
    }
}
