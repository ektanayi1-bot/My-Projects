<?php
namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function home()
    {
        $featured = Product::latest()->take(4)->get();
        return view('home', compact('featured'));
    }

    public function index()
    {
        $products = Product::latest()->paginate(12);
        return view('shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}