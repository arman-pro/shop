<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::getContent();
        echo "Count: " . $items->count() . '<br/>';
        foreach ($items as $item) {
            dd($item, $item->associatedModel->discount);
        }
    }

    // cart checkout
    public function checkout()
    {
        $cartItem = Cart::getContent();
        return view('product.checkout', [
            'cartItem' => $cartItem
        ]);
    }


    // add proudct into cart
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if (Cart::get($request->id) == null) {
            Cart::add(array(
                'id'            => $product->id,
                'name'          => $product->productName,
                'price'         => $product->unitPrice,
                'quantity'      => isset($request->quantity) ? $request->quantity : 1,
                'attributes'    => array(
                    'image' => $product->image,
                    'color' => isset($request->color) ? $request->color : null,
                    'size' => isset($request->size) ? $request->size : null
                ),
                'associatedModel' => $product
            ));
        } else {
            Cart::update($request->id, array(
                'quantity' => isset($request->quantity) ? $request->quantity : 1,
                'attributes' => array(
                    'color' => isset($request->color) ? $request->color : null,
                    'size' => isset($request->size) ? $request->size : null
                )
            ));
        }
        return redirect()->back()->with('message', 'Successfully added to Cart!');
    }

    // remove a item
    public function remove($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }

    // cart clear
    public function clear()
    {
        Cart::clear();
        return redirect()->back()->with('message', 'Cart item cleared!');
    }
}
