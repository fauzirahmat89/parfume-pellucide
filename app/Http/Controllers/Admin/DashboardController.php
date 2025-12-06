<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $hotProducts = Product::where('is_hot', true)->count();
        $activeProducts = Product::where('is_active', true)->count();

        return view('admin.dashboard', compact('totalProducts', 'hotProducts', 'activeProducts'));
    }
}
