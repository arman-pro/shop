@extends('admin.layout.admin')
@section('title', $order->user->fName.'\'s'.' order details')

@section('content')
<div class="w-full px-2  py-1">
    @if (session('message'))
    <div class="px-5 py-2 mb-2 bg-green-800 text-white text-xs">{{session('message')}}</div>
    @endif
    <div class="px-5 py-2 mb-2">
        Order Details
    </div>
    <div class="px-5 py-2">
        <table class="table-collapse border border-gray-400 w-full text-xs">
            <thead class="bg-gray-100 text-left">
                <tr class="border border-gray-400">
                    <th class="p-2 border border-gray-400">Order Id</th>
                    <td class="p-2 border border-gray-400">#{{$order->id}}</td>   
                    <th class="p-2 border border-gray-400">Customer Name</th>   
                    <td class="p-2 border border-gray-400">{{$order->user->fName.' '.$order->user->lName}}</td>
                    <th class="p-2 border border-gray-400">E-mail</th>
                    <td colspan="2" class="p-2 border border-gray-400">{{$order->email}}</td>
                </tr>
                <tr class="border border-gray-400">
                    <th class="p-2 border border-gray-400">Phone</th>
                    <td class="p-2 border border-gray-400">{{$order->phone}}</td>
                    <th class="p-2 border border-gray-400">Country</th>
                    <td class="p-2 border border-gray-400">{{$order->country}}</td>
                    <th class="p-2 border border-gray-400">District</th>
                    <td colspan="2" class="p-2 border border-gray-400">{{$order->district}}</td>
                </tr>
                <tr class="border border-gray-400">
                    <th class="p-2 border border-gray-400">Ship Address</th>
                    <td class="p-2 border border-gray-400">{{$order->shipAdreess}}</td>
                    <th class="p-2 border border-gray-400">Order Q.</th>
                    <td class="p-2 border border-gray-400">{{$order->orderQuantity}}Pcs</td>
                    <th class="p-2 border border-gray-400">Order Price</th>
                    <td colspan="2" class="p-2 border border-gray-400">${{$order->orderPrice}}</td>
                </tr>
                <tr class="border border-gray-400">
                    <th class="p-2 border border-gray-400">Total Price</th>
                    <td class="p-2 border border-gray-400">${{$order->totalPrice}}</td>
                    <th class="p-2 border border-gray-400">Payment Method</th>
                    <td class="p-2 border border-gray-400">{{$order->paymentMethod}}</td>
                    <th class="p-2 border border-gray-400">Status</th>
                    <td colspan="2" class="p-2 border border-gray-400">
                        @if ($order->status==0)
                        <span class="p-1 border-none rounded text-white bg-red-600">Processing</span>
                        @elseif($order->status==1)
                        <span class="p-1 border-none rounded text-white bg-yellow-600">Shiping</span>
                        @elseif($order->status==2)
                        <span class="p-1 border-none rounded text-white bg-blue-600">Delivering</span>
                        @elseif($order->status==3)
                        <span class="p-1 border-none rounded text-white bg-blue-800">Delivered</span>
                        @elseif($order->status==4)
                        <span class="p-1 border-none rounded text-white bg-green-800">Complete</span>
                        @endif

                        @if ($order->status != 4)
                        <form action="{{ route('admin.order.status', ['id'=>$order->id]) }}" class="inline-block" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="p-2 rounded border border-blue-600">
                                <option value="" hidden>Status</option>
                                <option value="0">Processsing</option>
                                <option value="1">Shiping</option>
                                <option value="2">Delivering</option>
                                <option value="3">Delivered</option>
                                <option value="4">Complete</option>
                            </select>
                            <button type="submit" class="p-2 rounded border border-blue-600 hover:bg-gray-200">Save</button>
                        </form>
                        @endif
                        
                    </td>
                </tr>
                <tr class="border border-gray-400">
                    <th class="p-2 border border-gray-400">Date</th>
                    <td colspan="6" class="p-2 border border-gray-400">{{$order->date}}</td>
                </tr>
                <tr class="border border-gray-400">
                    <th class="p-2 border border-gray-400">Product Name</th>
                    <th class="p-2 border border-gray-400">Size</th>
                    <th class="p-2 border border-gray-400">Color</th>
                    <th class="p-2 border border-gray-400">Quantity</th>
                    <th class="p-2 border border-gray-400">Price</th>
                    <th class="p-2 border border-gray-400">Discount</th>
                    <th class="p-2 border border-gray-400">Sale Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPcs = 0;
                    $totalPrice = 0;
                    $totalSale = 0;
                @endphp
                @foreach ($order->products as $order_item)
                    @php
                        $totalPcs += $order_item->quantity;
                        $totalPrice += $order_item->price;
                        $totalSale += $order_item->salePrice;
                    @endphp
                    <tr class="border border-gray-400">
                        <td class="p-2 border border-gray-400">{{$order_item->productName}}</td>
                        <td class="p-2 border border-gray-400">{{$order_item->size!=null ? $order_item->size : 'N/A'}}</td>
                        <td class="p-2 border border-gray-400">{{$order_item->color!=null ? $order_item->size : 'N/A'}}</td>
                        <td class="p-2 border border-gray-400">{{$order_item->quantity}}Pcs</td>
                        <td class="p-2 border border-gray-400">${{$order_item->price}}</td>
                        <td class="p-2 border border-gray-400">{{$order_item->discount!=null?$order_item->discount .'%' : 'N/A'}}</td>
                        <td class="p-2 border border-gray-400">${{$order_item->salePrice}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="border bg-gray-100 border-gray-400">
                    <td colspan="3" class="p-2 border border-gray-400">Total</td>
                    <td class="p-2 border border-gray-400">{{$totalPcs}}Pcs</td>
                    <td class="p-2 border border-gray-400">${{$totalPrice}}</td>
                    <td class="p-2 border border-gray-400">&nbsp;</td>
                    <td class="p-2 border border-gray-400">${{$totalSale}}</td>
                </tr>
            </tfoot>
        </table>
        <p class="text-right mt-1 text-xs">
            @if ($preId!=null)
            <a href="{{ route('admin.order.show', ['id'=>$preId]) }}" class="px-3 py-2 rounded bg-blue-800 text-white inline-block">Previous</a>
            @endif
            @if ($nextId!=null)
            <a href="{{ route('admin.order.show', ['id'=>$nextId]) }}" class="px-3 py-2 rounded bg-blue-800 text-white inline-block">Next</a>
            @endif
              
        </p>
    </div>
</div>

@endsection