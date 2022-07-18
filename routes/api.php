<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/products', function (Request $request) {
    $action = $request->action;
    $products_id = $request->selectId;
    if ($action == 'delete') {
        foreach ($products_id as $id) {
            $product = Product::find($id);
            $product->delete();
        }
        return response()->json([
            'message' => 'Delete Successfully!'
        ]);
    } elseif ($action == 'active') {
        foreach ($products_id as $id) {
            $product = Product::find($id);
            $product->status = 1;
            $product->save();
        }
        return response()->json([
            'message' => 'Product Active Successfully!'
        ]);
    } elseif ($action == 'deactive') {
        foreach ($products_id as $id) {
            $product = Product::find($id);
            $product->status = 0;
            $product->save();
        }
        return response()->json([
            'message' => 'Product Deactive Successfully!'
        ]);
    } else {
        echo json_encode(['error' => 'Unknown action!']);
        http_response_code(404);
    }
});
// product show by id
Route::get('/products/{id}', function ($id) {
    $product = Product::find($id);
    // $nextId = DB::select('SELECT MIN(id) FROM products WHERE id < $product->id ')
    return response()->json([
        'id' => $product->id,
        'productName' => $product->productName,
        'unitPrice' => $product->unitPrice,
        'category_name' => $product->category->name,
        'image' => asset('./storage/product') . '/' . $product->image,
        'availableSize' => $product->availableSize,
        'availableColor' => $product->availableColor,
        'discount' => $product->discount,
        'unitWeight' => $product->unitWeight,
        'unitStock' => $product->unitStock,
        'product_sotr_desc' => $product->product_sort_desc,
        'product_long_desc' => $product->product_long_desc,
        'rank' => $product->rank,
        'status' => $product->status,
    ]);
});
