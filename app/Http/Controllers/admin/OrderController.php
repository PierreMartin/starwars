<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
use Form;
use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     *  authentification
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $orders = Order::orderBy('commanded_at', 'desc')->with('customer', 'products')->paginate(10);

        return view('back.orders.index', compact('orders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unpaid() {
        $orders = Order::where('status', false)->orderBy('commanded_at', 'desc')->with('customer', 'products')->paginate(10);

        return view('back.orders.unpaid', compact('orders'));
    }

}
