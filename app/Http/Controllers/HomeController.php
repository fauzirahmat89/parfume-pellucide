<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $hotProducts = Product::active()
            ->hot()
            ->with('images')
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $products = Product::active()
            ->with('images')
            ->orderBy('sort_order')
            ->get();

        $categories = Product::active()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('home', compact('hotProducts', 'products', 'categories'));
    }
}
