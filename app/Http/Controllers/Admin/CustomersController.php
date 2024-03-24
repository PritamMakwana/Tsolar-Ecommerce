<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function showCustomers()
    {
        $data = Customers::paginate(10);
        return view('backend.customers.customer-list', compact('data'));
    }
}
