<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function show(Request $request)
    {
        $order = Order::find($request->id);
        $nSql = "SELECT MIN(id) as nextId FROM orders WHERE id > $request->id";
        $nextId = DB::select($nSql)[0]->nextId;
        $pSql = "SELECT MAX(id) as preId FROM orders WHERE id < $request->id";
        $preId = DB::select($pSql)[0]->preId;
        return view('admin.order.show', compact('order', 'preId', 'nextId'));
    }

    public function saveStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->save();
        return back()->with('message', 'Status updated successfully!');
    }
}
