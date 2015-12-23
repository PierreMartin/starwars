<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Order;
use Form;
use \Carbon\Carbon;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::orderBy('commanded_at', 'desc')->with('customer', 'products')->paginate(10);

        return view('back.orders.index', compact('orders'));
    }

    public function unpaid() {
        $orders = Order::where('status', false)->orderBy('commanded_at', 'desc')->with('customer', 'products')->paginate(10);

        return view('back.orders.unpaid', compact('orders'));
    }

}
