<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Products;

class DashboardController extends Controller
{
    public function index() {
        $CategoryCount = Category::count();
        $ProductCount = Products::count();
        $CustomerCount = Customers::count();
        $UsersCount = User::where('role_id', '!=', '1')->count();;

        return view('backend.layouts.dashboard', compact('CategoryCount', 'ProductCount', 'CustomerCount', 'UsersCount'));
    }
}
