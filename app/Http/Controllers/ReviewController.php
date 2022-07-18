<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // review save
    public function store(Request $request)
    {
        $product = Product::find($request->productid);
        $product->reviews()->create([
            'user_id' => $request->user()->id,
            'rating' => $request->rating,
            'description' => $request->review
        ]);
        return redirect()->back()->with('review', 'Thanks for review');
    }
}
