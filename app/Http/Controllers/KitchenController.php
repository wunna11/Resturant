<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class KitchenController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $raw_result = config('res.order_status');
        $status = array_flip($raw_result);
        // dd($status);
        // show order_status new,processing in order page  && where => show first index, whereIn => show all index
        $orders = Order::whereIn('status', [1,2])->get();
        return view('kitchen.order', compact('orders', 'status'));
    }

    public function approve(Order $order)
    {
        $order->status = config('res.order_status.processing');
        $order->save();
        return back()->with('message', 'Order is approved!');
    }

    public function ready(Order $order)
    {
        if ($order->status == 2) {
            $order->status = config('res.order_status.ready');
            $order->save();
            return back()->with('message', 'Order is ready!');
        } 
        else {
            return back()->with('message', 'Please to enter approve button!');
        } 
    }

    public function cancel(Order $order)
    {
        $order->status = config('res.order_status.cancel');
        $order->delete();
        return back()->with('message', 'Order is canceled!');
    }
}
