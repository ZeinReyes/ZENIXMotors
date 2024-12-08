<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function orders() {
        $orders = Order::all();
        return view('admin.orders.orders', compact('orders'));
    }
}
