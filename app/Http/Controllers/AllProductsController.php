<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllProductsController extends Controller
{
    public function allProductsPage()
    {
        return view('frontend.all-products');
    }
}
