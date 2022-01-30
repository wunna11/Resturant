<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $raw_result = config('res.order_status');
        $status = array_flip($raw_result);
        // dd($status);
        // show order_status ready in order page  && where => show first index, whereIn => show all index
        $orders = Order::where('status', [4])->get();
        $tables = Table::all();
        $dishes = Dish::orderBy('id','desc')->get();
        return view('waiter.order', compact('dishes', 'tables', 'orders', 'status'));
    }

    public function submit(Request $request) 
    {
        // dd(array_filter($request->except('_token')));
        $data = array_filter($request->except('_token', 'table'));
        $orderId = rand();
        // $request->table = (int)($request->table);
        // loop order name and order count
        foreach ($data as $key => $value) {
            if ($value > 1) {
                for ($i = 1; $i <= $value; $i++) {
                   $this->saveOrder($orderId, $key, $request);
                }
            }
            else {
                $this->saveOrder($orderId, $key, $request);
            }
        }
        return redirect()->route('order.index')->with('message', 'Order is completed!');
    }

    public function saveOrder($orderId, $key, $request)
    {
        $order = new Order();
        $order->order_id = $orderId;
        $order->dish_id = $key;   // $key == $dish_id
        $order->table_id = request('table');
        $order->status = config('res.order_status.new');

        $order->save();
    }

    public function serve(Order $order)
    {
        $order->status = config('res.order_status.done');
        $order->save();
        return back()->with('message', 'Order is serve to customer!');
    }
}
