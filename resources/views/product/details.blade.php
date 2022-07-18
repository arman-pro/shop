<?php
use Illuminate\Support\Str;
?>
@extends('layout.app')
{{-- title --}}
@php
    $title = $product->productName;
@endphp
@section('title', $title)

@section('main-content')
<section class="w-full">
    <div class="px-16 pt-10">
        @if (session('message'))
        <div class="p-2 bg-green-600 text-white font-semibold">
            {{session('message')}}
        </div>
        @endif
       
        <form action="{{ route('cart.store', ['id'=>$product->id]) }}" method="GET">
            <div class="flex justify-between bg-white rounded p-5">
                <div class="p-5 m-1 w-2/4 overflow-hidden">
                    <img class="object-fit" src="{{ asset('./storage/product') }}/{{$product->image}}" alt="Product Image">
                </div>
                <div class="p-5 w-2/4 m-1">
                    <h2 class="text-bold text-2xl m-0">
                        {{Str::title($product->productName)}}
                    </h2>
                    @if($product->reviews->count() > 0)
                        <div class="p-0 py-1">
                            <span class="text-red-600">
                                @for ($i = 0; $i < $product->avgReview(); $i++)
                                <i class="fa fa-star"></i>
                                @endfor
                                <span>({{$product->avgReview()}})</span>
                            </span>
                        </div>
                    @endif
                    <hr class="border-gray-400 mt-5 mb-5" />
                    <div class='items-center'>                   
                        @if ($product->discount)
                            <span class="text-3xl text-green-600">
                                ${{$product->unitPrice-$product->discount}}
                            </span>
                            (<span class="text-xl text-red-60">
                                <del>${{$product->unitPrice}} </del>
                            </span>)
                        @else
                            <span class="text-3xl text-green-600">
                            ${{$product->unitPrice}}   
                            </span> 
                        @endif

                        @if ($product->discount)
                            |
                            <span class="text-red-600">
                                <del>${{$product->discount}}</del>
                            </span>
                            |
                            <span class="text-red-600">
                                {{number_format(($product->discount/$product->unitPrice) * 100, 0)}}% Off
                            </span>
                        @endif
                        
                    </div>
                    <hr class="border-gray-400 mt-5 mb-5" />
                    {{-- available color --}}
                    @if ($product->availableColor)
                        <div class="py-1 flex justify-between">
                            <div class="flex-none w-1/4 text-gray-600">Color :</div>
                            <div class="flex-grow font-semibold">
                                @php
                                    $colors = explode(',', $product->availableColor);

                                    foreach($colors as $color) {
                                        echo '<input type="checkbox" name="color" id="'.$color.'" value="'.$color.'" /> <label for="'.$color.'">'.Str::ucfirst($color).'</label> <br/>';
                                    }
                                @endphp
                            </div>
                        </div>
                    @endif

                    {{-- available size --}}
                    @if ($product->availableSize)
                        <div class="py-1 flex justify-between">
                            <div class="flex-none w-1/4 text-gray-600">Size :</div>
                            <div class="flex-grow font-semibold">
                                @php
                                    $sizes = explode(',', $product->availableSize);

                                    foreach($sizes as $size) {
                                        echo '<input type="checkbox" name="size" id="'.$size.'" value="'.$size.'" /> <label for="'.$size.'">'.Str::ucfirst($size).'</label> <br/>';
                                    }
                                @endphp
                            </div>
                        </div>
                    @endif    
                    
                    <div class="py-2 flex justify-between">
                        <div class="flex-none w-1/4 text-gray-600">Quantity :</div>
                        <div class="flex-grow font-semibold">
                            <input type="number" name="quantity" class="px-5 py-2 border border-gray-400 rounded outline-none " min="1" value="1" placeholder="00" />
                        </div>
                    </div>
                    <hr class="border-gray-400 mt-5 mb-5" />
                    <div class="p-0 py-1">
                        <button type="submit" class="px-5 py-2 border border-red-600 bg-red-600 text-semibold text-white rounded-full outline-none hover:text-red-600 hover:bg-white hover:shadow-2xl " > <i class="fa fa-shopping-cart"></i> Add To Cart </button>
                        <button type="submit" class="px-5 py-2 border border-green-600 bg-green-600 text-semibold text-white rounded-full outline-none hover:text-green-600 hover:bg-white hover:shadow-2xl " > <i class="fa fa-heart-o"></i> Add To Wish List </button>
                    </div>
                    <hr class="border-gray-400 mt-5 mb-5" />
                    <div class="py-1 flex justify-between">
                        <div class="flex-none w-1/4 text-gray-600">Payment Method</div>
                        <div class="flex-grow font-semibold flex flex-start">
                            <img class="object-cover m-1 rounded-full" style="width:50px;height:30px;" src={{ asset('/storage/payment/american-express.png') }} alt="american-express">
                            <img class="object-cover m-1 rounded-full" style="width:50px;height:30px;" src={{ asset('./storage/payment/mastercard.png') }} alt="american-express">
                            <img class="object-cover m-1 rounded-full" style="width:50px;height:30px;" src={{ asset('./storage/payment/PayPalCard.png') }} alt="american-express">
                            <img class="object-cover m-1 rounded-full" style="width:50px;height:30px;" src={{ asset('./storage/payment/american-express.png') }} alt="american-express">

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>

<!-- product details  -->
<section class="w-full" >
    <div class="px-16 pt-10">
        <div class="flex justify-between">
            <div class="flex-grow w-3/4 p-2 mr-1 bg-white ">
            <h2 class="text-2xl py-1">
                Product Details
            </h2>
            <hr class="border-gray-400 mt-5 mb-5" />
                @if ($product->product_long_desc)
                    {{$product->product_long_desc}}
                @else
                    <p>No Details Found!</p>
                @endif
            </div>
            <div class="w-1/4 p-2 ml-1 bg-white">
                <h2 class="text-2xl py-1" >Same Products</h2>
                <hr class="border-gray-400 mt-5 mb-5" />
                @foreach ($same_products as $same_pro)
                    <div class="p-3 border border-gray-400 rounded overflow-hidden mt-2 hover:shadow-2xl" >
                        <a href="{{ route('product.show', ['id'=>$same_pro->id, 'slug' => Str::slug($same_pro->productName, '-')]) }}">
                            <img class="object-fit rounded" src="{{ asset('./storage/product') }}/{{$same_pro->image}}" alt="{{$same_pro->image}}">
                        </a>
                        <h1>
                            <a href="{{ route('product.show', ['id'=>$same_pro->id, 'slug' => Str::slug($same_pro->productName, '-')]) }}">
                                {{$same_pro->productName}}
                            </a>
                        </h1>
                        <div>
                            @if ($same_pro->discount) 
                                <span class="text-red-600">${{$same_pro->unitPrice - $same_pro->discount}}(</span>  
                                <span class="text-gray-500"><del>${{$same_pro->unitPrice}}</del></span> )                                  
                            @else
                                ${{$same_pro->unitPrice}} 
                            @endif
                            @if ($same_pro->discount)
                                <span class="text-gray-500"><del>${{$same_pro->discount}}</del></span>
                                <span class="off-card text-red-600">
                                    {{number_format(($same_pro->discount/$same_pro->unitPrice) * 100, 0)}}% Off
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach                
            </div>
        </div>
    </div>
</section>
<section class="w-full" >
    <div class="px-16 pt-10">
        <div class="flex justify-between">
            <div class="flex-grow w-3/4 p-2 mr-1 bg-white ">
                Rating & Review
                <div class="mt-2 mb-2">
                    @if ($product->reviews->count() > 0)
                        @foreach ($product->reviews as $review)
                        <div class="mt-3 border border-gray-600 rounded p-2 hover:shadow-xl" >
                            {{$review->user->fName}}
                            <p>
                                @for ($i = 1; $i <= $review->rating; $i++)
                                  <i class="fa fa-star text-red-600"></i>  
                                @endfor
                            </p>
                            <p class="text-gray-600">{{$review->description}}</p>
                        </div>
                        @endforeach
                    @else
                        <div class="border border-red-600 rounded text-red-600 text-center p-2 hover:shadow" >
                            No Rating Found!
                        </div>
                    @endif
                </div>
                @auth
                    @if (session('review'))
                    <div class="p-2 bg-green-600 text-white font-semibold">
                        {{session('review')}}
                    </div>
                    @endif
                    <form class="m-auto w-1/2" action="{{ route('review.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="productid" value="{{$product->id}}" />
                        <div class="p-2">
                            <input type="number" min="0" max="5" name="rating" class="px-5 py-2 border border-gray-600 w-full rounded" placeholder="Rating"/>
                        </div>
                        <div class="p-2">
                            <textarea name="review" id="reivew" cols="30" rows="10" class="px-5 py-2 border border-gray-600 w-full rounded" placeholder="Review"></textarea>
                        </div>
                        <div class="p-2">
                            <button type="submit" class="px-5 border py-2 border-green-600 bg-green-600 text-white rounded">Save Review</button>
                        </div>
                    </form>
                @endauth
                @guest
                    <p class="text-black p-3 text-center border border-red-600 mt-3">Please <a href="{{route('user.login')}}" class="text-red-600">login</a> for Review and Rating </p>
                @endguest
            </div>
            <div class="w-1/4 p-2 ml-1 bg-white">&nbsp; </div>
        </div>
        
    </div>
</section>

@endsection
    
