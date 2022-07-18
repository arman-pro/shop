@extends('layout.app')
{{-- title --}}
@section('title', "$category_name's all products")

@section('main-content')
<section class="main-content w-full bg-gray-50">
    <div class="px-16 mt-10">
        <div class="flex justify-between">
            <div class="flex-none divide-y divide-yellow-500 pb-5 pr-5 ">
                <div class="pb-5 pr-5">
                    <h2>Related Categories</h2>
                    <p class="text-red-600">{{$category_name}}</p>
                </div>
                <div class="pb-5 pr-5 pt-3">
                    <h1>Brand</h1>
                    <ul>
                        <li>
                        
                            <input type="checkbox" name="brand" id="cmart" value="cosmicMart" /> 
                            <label class="cursor-pointer" for="cmart">Cosmic Mart</label>
                        </li>
                        <li>
                            <input type="checkbox" name="brand" id="infastion" value="incentive" /> 
                            <label class="cursor-pointer" for="infastion">Incentive Fasion</label>
                        </li>
                    </ul>
                </div>
                <div class="pb-5 pr-5 pt-3">
                    <h1>Service</h1>
                    <ul>
                        <li>
                            <input type="checkbox" name="brand" id="cd" /> 
                            <label class="cursor-pointer" for="Card">Cash On Delivery</label>
                        </li>
                        <li>
                            <input type="checkbox" name="brand" id="cback" /> 
                            <label class="cursor-pointer" for="cback">Cashback</label>
                        </li>
                    </ul>
                </div>
                <div class="pb-5 pr-5 pt-3">
                    <h1>Location</h1>
                    <ul>
                        <li>
                            <input type="checkbox" name="brand" id="bd" /> 
                            <label class="cursor-pointer" for="bd">Bangladesh</label>
                        </li>
                    </ul>
                </div>
                <div class="pb-5 pr-5 pt-3">
                    <h1>Price</h1>
                    <ul>
                        <li>
                            <form action="">
                                <input type="number" class="p-1 px-3 rounded border border-current outline-none w-20" name="brand" placeholder="00" /> 
                                <input type="number" class="p-1 px-3 rounded border border-current outline-none w-28" name="brand" placeholder="00" /> 
                                <button class="w-9 p-1 px-3 border-none rounded bg-green-600 text-white">
                                    <i class="fa fa-caret-right"></i>
                                </button>
                            </form>                                
                        </li>
                    </ul>
                </div>
                <div class="pb-5 pr-5 pt-3">
                    <h1>Color</h1>
                    <ul>
                        <li>
                            <input type="checkbox" name="brand" id="white" /> 
                            <label class="cursor-pointer" for="white">White</label>
                        </li>
                        <li>
                            <input type="checkbox" name="brand" id="black" /> 
                            <label class="cursor-pointer" for="black">Black</label>
                        </li>
                        <li>
                            <input type="checkbox" name="brand" id="red" /> 
                            <label class="cursor-pointer" for="red">Red</label>
                        </li>
                        <li>
                            <input type="checkbox" name="brand" id="purple" /> 
                            <label class="cursor-pointer" for="purple">Purple</label>
                        </li>
                        <li>
                            <input type="checkbox" name="brand" id="coral" /> 
                            <label class="cursor-pointer" for="coral">Coral</label>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- product box/left box -->
            <div class="flex-grow pl-8r">
                <div class="flex justify-between  items-cente">
                    <div>
                        <h1>{{$category_name}}</h1>
                        <p class="text-gray-600">{{$total_product}} items found in {{$category_name}}</p>
                    </div>
                    <div>
                        Sort By - <select class="px-5 py-3 rounded border border-gray-600 " name="sort" id="">
                            <option value="" hidden>Best Match</option>
                            <option class="px-5 py-3" value="low">Price low to high</option>
                            <option class="px-5 py-3" value="low">Price high to low</option>
                        </select>
                    </div>
                </div>
                <hr class="mt-5" />
                <!-- category product box -->
                <div class="product-box flex flex-wrap">
                    <!-- product box -->
                
                    @foreach ($products as $product)
                    <div class="product-card w-1/3 p-3">
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
                                    <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span>(4.5)</span>
                                    </span>
                                    <a href="{{ route('cart.store', ['id'=>$product->id]) }}" class="min-w-2 p-2 text-red font-semibold border border-current text-sm rounded-full hover:text-white hover:bg-red-600">
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
        </div>

        

    </div>
</section>
@endsection
    
