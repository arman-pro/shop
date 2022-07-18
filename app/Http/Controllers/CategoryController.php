<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // show product 
    public function index(Request $request)
    {
        $category_name  = Category::select('name')->where('id', $request->id)->get();
        $total_product  = Product::where('category_id', $request->id)->count();
        $products       = Product::where('category_id', $request->id)->paginate(9);

        return view('product.category', [
            'category_name' => $category_name[0]->name,
            'total_product' => $total_product,
            'products'      => $products
        ]);
    }
}
