<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $products = Product::active()
            ->with('images')
            ->when($category, fn($query) => $query->where('category', $category))
            ->orderBy('sort_order')
            ->paginate(9);

        $categories = Product::active()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('products.index', compact('products', 'categories', 'category'));
    }

    public function show(string $slug)
    {
        $product = Product::active()
            ->with('images')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Product::active()
            ->where('id', '!=', $product->id)
            ->where('category', $product->category)
            ->with('images')
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
