<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->country = $request->country;
        $order->district = $request->district;
        $order->shipAdreess = $request->address;
        $order->orderQuantity = $request->totalQuantity;
        $order->orderPrice = $request->orderPrice;
        $order->shipmentCost = $request->shipingCost;
        $order->totalPrice = $request->totalPrice;
        $order->paymentMethod = $request->paymentmethod;
        $order->date = Carbon::now();
        $order->save();

        // save order details

        $carts = Cart::getContent();

        // save product details
        foreach ($carts as $cart) {
            $order_detail = new Order_Detail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $cart->id;
            $order_detail->productName = $cart->name;
            $order_detail->image = $cart->attributes->image;
            $order_detail->price = $cart->price;
            $order_detail->discount = $cart->associatedModel->discount != null ? $cart->associatedModel->discount : null;
            $order_detail->salePrice = $cart->price - ($cart->price * $cart->associatedModel->discount / 100);
            $order_detail->quantity = $cart->quantity;
            $order_detail->size = $cart->attributes->size != null ? $cart->attributes->size : null;
            $order_detail->color = $cart->attributes->color != null ? $cart->attributes->color : null;
            $order_detail->save();
        }

        // clear cart
        Cart::clear();
        return view('product.place', [
            'message' => 'Thanks! Your Order Placed Successfully!'
        ]);
    }
}
