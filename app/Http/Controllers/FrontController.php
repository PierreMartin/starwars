<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Image;

class FrontController extends Controller
{
    //////////////////////////////// INDEX ////////////////////////////////
    public function index()
    {
        //$products = Product::where('status', true)->orderBy('published_at', 'desc')->with('category', 'tags', 'image')->paginate(10);
        $products = Product::where('status', true)->orderBy('published_at', 'desc')->with('category', 'tags', 'image')->paginate(10);

        return view('front.products.index', compact('products'));
    }
}
