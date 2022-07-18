<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required|string',
            'category' => 'required',
            'unitPrice' => 'required',
            'stock' => 'required',
            'image' => 'required',
        ]);
        $imageName = '';
        if ($request->file('image')->isValid()) {
            $imageName = rand() . '.' . $request->image->extension();
            $request->image->storeAs('product', $imageName);
        }
        $product = new Product;
        $product->productName = $request->productName;
        $product->user_id = auth()->user()->id;
        $product->category_id = $request->category;
        $product->unitPrice = $request->unitPrice;
        $product->image = $imageName;
        $product->unitStock = $request->stock;
        $product->unitWeight = $request->weight;
        $product->availableSize = $request->size;
        $product->availableColor = $request->color;
        $product->product_sort_desc = $request->sortDesc;
        $product->product_long_desc = $request->longDesc;
        $product->save();
        return back()->with('status', 'Product Create Successfully!');
    }

    public function show(Request $request)
    {
        $categories = Category::all();
        $product = Product::find($request->id);
        // dd($product->category->id, $product->category_id);
        return view('admin.product.show', compact('product', 'categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'productName' => 'required|string',
            'category' => 'required',
            'unitPrice' => 'required',
            'stock' => 'required',
        ]);

        $product = Product::find($request->id);

        $product->productName = $request->productName;
        $product->user_id = auth()->user()->id;
        $product->category_id = $request->category;
        $product->unitPrice = $request->unitPrice;
        if ($request->hasFile('image')) {
            Storage::delete('product/' . $product->image);
            $imageName = '';
            $imageName = rand() . '.' . $request->image->extension();
            $request->image->storeAs('product', $imageName);
            $product->image = $imageName;
        }
        $product->unitStock = $request->stock;
        $product->unitWeight = $request->weight;
        $product->availableSize = $request->size;
        $product->availableColor = $request->color;
        $product->product_sort_desc = $request->sortDesc;
        $product->product_long_desc = $request->longDesc;
        $product->save();
        return back()->with('status', 'Product Updated Successfully!');
    }

    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        return back()->with('status', 'Product Deleted Successfully!');
    }

    // product print 
    public function print($id)
    {
        $product = Product::find($id);
        return view('admin.product.print', compact('product'));
    }
}
