<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $same_products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        return view('product.details', [
            'product' => $product,
            'same_products' => $same_products
        ]);
    }
}
