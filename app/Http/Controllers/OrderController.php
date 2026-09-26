<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function index() {
        $orders = Order::orderBy('id')->get();
        return view('order.index',compact('orders'));
    }
}
