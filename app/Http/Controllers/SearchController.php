<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->searchQuery;
        // search product query
        $products = Product::where('productName', 'LIKE', '%' . $query . '%')->paginate(8);
        return view('product.search', [
            'products' => $products
        ]);
    }
}
