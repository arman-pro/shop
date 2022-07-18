<?php
use Illuminate\Support\Str;
?>
@extends('layout.app')
{{-- title --}}
@section('title', 'Largest online shoping')

@section('main-content')
<section class="w-full bg-gray-50">
    <div class="px-16">
        <!-- heading -->
        <h1 class="p-3 text-semibold text-xl uppercase ">
            <u>All Category</u>
        </h1>
        <!-- wrapping box -->
        <div class="flex flex-wrap">
            <!-- category -->
            <div class="category-card w-1/3 p-3" >
                <div style="height:200px;" class="bg-white p-3 shadow-xl rounded relative hover:shadow-2xl" >
                    <img class="rounded object-cover" style="width:100%;height:100%" src="{{asset('/storage/product/camera-lens.jpg')}}" alt="Electronic Category">
                    <!-- description -->
                    <div class="description absolute inset-0 bg-transparent z-10 text-white p-3 text-center">
                        <div style="position: absolute; top:50%;left:50%;transform:translate(-50%, -50%);width:70%;">
                            <h1 class="text-lg">All Electronic Product</h1>
                            <p>Super Sale with <span class="text-red-600">30%</span> Discount</p>
                            <button class="p-2 rounded-full border-2 border-red-600 text-white text-xs bg-red-600 font-semibold hover:border-red-600 hover:bg-transparent hover:text-red-600">Shop Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-card w-1/3 p-3" >
                <div style="height:200px;" class="bg-white p-3 shadow-xl rounded relative hover:shadow-2xl" >
                    <img class="rounded object-cover" style="width:100%;height:100%" src="{{asset('/storage/product/camera-lens.jpg')}}" alt="Electronic Category">
                    <!-- description -->
                    <div class="description absolute inset-0 bg-transparent z-10 text-white p-3 text-center">
                        <div style="position: absolute; top:50%;left:50%;transform:translate(-50%, -50%);width:70%;">
                            <h1 class="text-lg">All Home & Beauty Product</h1>
                            <p>Dhamal Sale with <span class="text-red-600">15%</span> Discount</p>
                            <button class="p-2 rounded-full border-2 border-red-600 text-white text-xs bg-red-600 font-semibold hover:border-red-600 hover:bg-transparent hover:text-red-600">Shop Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-card w-1/3 p-3" >
                <div style="height:200px;" class="bg-white p-3 shadow-xl rounded relative hover:shadow-2xl" >
                    <img class="rounded object-cover" style="width:100%;height:100%" src="{{asset('/storage/product/camera-lens.jpg')}}" alt="Electronic Category">
                    <!-- description -->
                    <div class="description absolute inset-0 bg-transparent z-10 text-white p-3 text-center">
                        <div style="position: absolute; top:50%;left:50%;transform:translate(-50%, -50%);width:70%;">
                            <h1 class="text-lg">Lorem ipsum dolor sit amet.</h1>
                            <p>Super Sale with <span class="text-red-600">30%</span> Discount</p>
                            <button class="p-2 rounded-full border-2 border-red-600 text-white text-xs bg-red-600 font-semibold hover:border-red-600 hover:bg-transparent hover:text-red-600">Shop Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- all product list --}}
<section class="main-content w-full bg-gray-50">
    <div class="px-16">
        <!-- heading -->
        <div class="p-3 w-full flex justify-between">
            <span class="uppercase text-xl text-semibold"><u>All Product</u></span>
            <span>
                Filter By- <select onchange="filterFunc()" name="filter" class="p-2 rounded border border-gray-600" id="filter">
                    <option value="" hidden>Select Filter</option>
                    <option value="highLow">High to Low Price</option>
                    <option value="lowHight">Low to High Price</option>
                </select>
            </span>
        </div>

        {{-- cart added message --}}
        @if (session('message'))
            <p class="px-5 py-2 bg-green-600 text-white rounded " >{{session('message')}}</p>
        @endif

        <!-- wraping box -->
        <div class="product-box flex flex-wrap">
            @foreach ($products as $product)
                 <!-- proudct card -->
            <div class="product-card w-3/12 p-3">
                <!-- product inner details box -->
                <div class="bg-white p-3 shadow-xl rounded hover:shadow-2xl">
                    <a href="{{ route('product.show', ['id'=>$product->id, 'slug' => $product->productName]) }}">
                        <div class="overflow-hidden min-h-img">
                            <img class="object-cover" style="width:100%;height:100%;" src="{{ asset('/storage/product/')}}/{{$product->image}}" alt="{{$product->image}}" />
                        </div>
                    </a>
                    <div class="description m-0">
                        <!-- product title -->
                        <a href="{{ route('product.show', ['id'=>$product->id, 'slug' => Str::slug($product->productName, '-')]) }}">
                        <h6 class="m-0 mt-2 leading-5 text-justify text-gray-800 font-bold">
                            {{$product->productName}}
                        </h6>
                        </a>
                        <!-- product price, offer etc -->
                        <p class="price-tag font-semibold flex justify-between mt-3">
                            <span>
                                @if ($product->discount) 
                                    ${{$product->unitPrice - $product->discount}} | 
                                    <span class="text-gray-500"><del>${{$product->unitPrice}}</del></span>                                   
                                @else
                                    ${{$product->unitPrice}} 
                                @endif
                            </span>
                            @if ($product->discount)
                                <span class="text-gray-500"><del>${{$product->discount}}</del></span>
                                <span class="off-card text-red-600">
                                    {{number_format(($product->discount/$product->unitPrice) * 100, 0)}}% Off
                                </span>
                            @endif
                            
                        </p>
                        <!-- product rating and add to cart btn -->
                        <p class="m-0 mt-2 rating text-red-600 flex justify-between items-center" >
                            @if ($product->avgReview() > 0)
                            <span>
                                @for ($i = 0; $i < $product->avgReview(); $i++)
                                <i class="fa fa-star"></i> 
                                @endfor
                                <span>{{($product->avgReview())}}</span>
                            </span>
                            @endif
                            <a href="{{ route('cart.store', ['id'=>$product->id]) }}" class="min-w-2 p-2 text-red font-semibold border border-current text-sm rounded hover:text-white hover:bg-red-600">
                                <i class="fa fa-shopping-cart"></i> Add
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach           
        </div>
        <!-- load more button -->
        <div class="p-3 text-center">
            {{-- <button class="p-3 w-52 rounded-full bg-green-600 text-white font-semibold hover:bg-green-800" > More Product </button> --}}
            {{ $products->links() }}
        </div>
    </div>
</section>
<script>
    function filterFunc() {
        var filter = document.querySelector('#filter').value;
        if(window.location.search=="") {
            window.location.href =`?filter=${filter}`;
        } else {
            window.location.href =`&filter=${filter}`;
        }
    }
</script>
    
@endsection
    
