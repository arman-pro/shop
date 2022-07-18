@extends('admin.layout.admin')
@section('title', 'All Orders List')

@section('content')
<div class="w-full px-2  py-1">
    <div class="px-5 py-2 mb-2">
        All Orders List
    </div>
    <div class="px-5 py-2">
        <table class="table-collapse border border-gray-400 w-full text-xs">
            <thead class="bg-gray-100">
                <tr class="border border-gray-400">
                    <th class="p-2 border border-gray-400">#</th>
                    <th class="p-2 border border-gray-400">O. Id</th>   
                    <th class="p-2 border border-gray-400">Name</th>   
                    <th class="p-2 border border-gray-400">Shipment Add.</th>
                    <th class="p-2 border border-gray-400">Order Qnt.</th>
                    <th class="p-2 border border-gray-400">Order Prc.</th>
                    <th class="p-2 border border-gray-400">Ship Cost.</th>
                    <th class="p-2 border border-gray-400">Total Prc.</th>
                    <th class="p-2 border border-gray-400">Pay Method </th>
                    <th class="p-2 border border-gray-400">Status </th>
                    <th class="p-2 border border-gray-400">Order Date </th>
                    <th class="p-2 border border-gray-400">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->count()>0)
                @foreach ($orders as $order)
                <tr class="border border-gray-400">
                    <td class="p-2 border border-gray-400">{{$loop->iteration}}</td>
                    <td class="p-2 border border-gray-400">#{{$order->id}}</td>
                    <td class="p-2 border border-gray-400">{{$order->user->fName}}</td>
                    <td class="p-2 border border-gray-400">{{$order->shipAdreess}}</td>
                    <td class="p-2 border border-gray-400 text-center">{{$order->orderQuantity}}Pcs</td>
                    <td class="p-2 border border-gray-400 text-center">${{$order->orderPrice}}</td>
                    <td class="p-2 border border-gray-400 text-center">${{$order->shipmentCost}}</td>
                    <td class="p-2 border border-gray-400 text-center">${{$order->totalPrice}}</td>
                    <td class="p-2 border border-gray-400 text-center">{{$order->paymentMethod}}</td>
                    <td class="p-2 border border-gray-400 text-center">
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
                    </td>
                    <td class="p-2 border border-gray-400 text-center">{{$order->date}}</td>
                    <td class="p-2 border border-gray-400">
                        <a href="{{ route('admin.order.show', ['id'=>$order->id]) }}" class="inline-block px-2 py-1 border border-gray-400 rounded">
                            <i class="fa fa-eye"></i>
                        </a>
                        <button type="button" class="inline-block px-2 py-1 border border-gray-400 rounded">
                            <i class="fa fa-print"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border border-gray-400">
                    <td colspan="12" class="p-2 border border-gray-400 text-center text-gray-600">No Data Found!</td>
                </tr>
                @endif
                
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
</div>

@endsection