<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function cashier()
    {
        $tables = Table::all();
        $orders = Order::all();
        return view('kitchen.cashier', compact('orders', 'tables'));
    }
}
