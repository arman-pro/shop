@extends('layout.app')
{{-- title --}}
@section('title', 'Checkout Order')

@section('main-content')
<section class="w-full bg-gray-50">
    <div class="px-16 bg-white p-5">
        <div class="p-5">
            <div class="text-center block">
                <img class="m-auto" src="{{ asset('storage/BDSHOP-BDSP-LOGO.webp') }}" style="width:150px;height:auto;" alt="Pradise Logo">
            </div>
            <h1 class="text-xl text-center text-bold text-2xl mt-3">Checkout Shoping</h1>
            <form action="{{ route('order.store') }}" method="POST" class="mt-3">
                @csrf
            @auth
            <div class="w-full px-5 py-2 border border-current rounded relative">
                <h1 class="text-xl">User Info</h1>
                <p class="text-gray-400">
                    <span>
                        {{auth()->user()->fName . ' ' . auth()->user()->lName}},{{auth()->user()->email}}
                    </span>
                    
                </p>
                <button type="button" class=" absolute right-2 top-3 block p-1 border rounded bg-gray-100 text-gray-600 outline-none text-semibold hover:bg-gray-100 hover:text-gray-600 hover:border-gray-600 ">Change <i class="fa fa-pencil"></i> </button>
            </div>
            <div class=" px-5 py-2 w-full  border border-current rounded mt-5">
                <div class="block">
                    <span class="float-left text-xl">Delivery Address <small class="text-red-400"></small></span>
                        <span class="float-right">
                    <a class="p-1 px-3 text-semibold block rounded border border-red-600 text-red-600 hover:bg-red-600 hover:text-white " href="./index.html">
                        Continue Shopping <i class="fa fa-shopping-cart"></i>
                        </a>
                    </span>
                </div>
                
                <div class="w-full flex justify-between ">
                    <!-- left box -->
                    <div class="w-1/2 m-2 ">
                        <div class="w-full">
                            <label class="cursor-pointer" for="name">Full Name</label>
                            <input type="text" name="fullname" id="name" class="px-5 py-2 mt-2 mb-2 w-full border border-gray-600 outline-none rounded " value="{{auth()->user()->fName. ' '.auth()->user()->lName}}" placeholder="Jone Doe" />
                        </div>
                        <div class="w-full">
                            <label class="cursor-pointer" for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="px-5 py-2 mt-2 mb-2 w-full border border-gray-600 outline-none rounded " value="{{auth()->user()->email}}" placeholder="example@any.com" />
                        </div>
                        <div class="w-full">
                            <label class="cursor-pointer" for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="px-5 py-2 mt-2 mb-2 w-full border border-gray-600 outline-none rounded " value="{{auth()->user()->phone}}" placeholder="+88017......" />
                        </div>
                    </div>

                    <!-- middle box -->
                    <div class="w-1/2 m-2">
                        <div class="w-full">
                            <label class="cursor-pointer" for="country">Country</label>
                            <select name="country" id="contry" class="px-5 py-2 mt-2 mb-2 w-full border border-gray-600 outline-none rounded " >
                                <option value="" hidden>Country</option>
                                <option value="bd">Bangladesh</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label class="cursor-pointer" for="">District</label>
                            <select name="district" id="district" class="px-5 py-2 mt-2 mb-2 w-full border border-gray-600 outline-none rounded " >
                                <option value="" hidden>District</option>
                                <option value="dinajpur">Dinajpur</option>
                                <option value="rangpur">Rangpur</option>
                                <option value="thakurgaon">Thakurgaon</option>
                                <option value="dhaka">Dhaka</option>
                                <option value="comilla">Comilla</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <label class="cursor-pointer" for="address">Home Address</label>
                            <textarea name="address" id="address" cols="30" class="px-5 py-2 mt-2 mb-2 w-full border border-gray-600 outline-none rounded " rows="1"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            @endauth
            @guest
            <div class="w-full px-5 py-2 border border-current rounded relative">
                <p class="text-center">
                    Please <a class="underline text-blue-600" href="{{ route('user.login') }}">Login</a>
                </p>
            </div>
            @endguest
            <div class="px-5 py-2 w-full  border border-current rounded mt-5">
                <div class="w-full" >
                    <span class="float-left text-xl">Order List <small class="text-red-400">({{$cartItem->count()}} items)</small></span>
                        <span class="float-right">
                    <a class="p-1 px-3 text-semibold block rounded border border-red-600 text-red-600 hover:bg-red-600 hover:text-white " href="./index.html">
                        Continue Shopping <i class="fa fa-shopping-cart"></i>
                        </a>
                    </span>
                </div>
                
                <div class="w-full flex justify-between ">
                    <div class="flex-grow w-2/3 m-2">
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach ($cartItem as $item)
                        <?php
                            $totalPrice+= $item->price*$item->quantity;
                        ?>
                        <div class="flex justify-between p-5 rounded border border-current mt-3">
                            <div class="w-1/3 overflow-hidden">
                                <img class="object-cover rounded m-auto" style="height:100px" src="{{ asset('storage/product') }}/{{$item->attributes->image}}" alt="{{$item->attributes->image}}">
                            </div>
                            <div class="w-2/3 px-3" >
                                <h1><a href="#" class="text-xl">{{$item->name}}</a></h1>
                                <p>Price: <span class="text-2xl">${{$item->price * $item->quantity}}</span></p>
                                <label for="quantity">Quantity</label>
                                <input type="number" min="1" class="px-5 py-1 border border-gray-600 rounded focus:outline-none" value="{{$item->quantity}}" placeholder="Quantity" />
                                <p>
                                   @if ($item->attributes->color !== null)
                                       <span>Color: {{$item->attributes->color}}</span> 
                                       &nbsp;|&nbsp;
                                   @endif
                                   @if ($item->attributes->size !== null)
                                        <span>Size: {{$item->attributes->size}}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                        
                    </div>
                    <div class="flex-grow w-1/3 m-2">
                        <div class="p-5 rounded border border-current mt-3">
                            <h1 class="text-xl">Price Details</h1>
                            <hr class="my-2 border-yellow-200" />
                            <p>Total Price(4 items) : <span class="float-right">${{$totalPrice}}</span> </p>
                            <input type="hidden" name="totalQuantity" value="{{$cartItem->count()}}" />
                            <input type="hidden" name="orderPrice" value="{{$totalPrice}}"/>
                            {{-- it will be change and get ship cost from database --}}
                            <input type="hidden" name="shipingCost" value="5" />
                            <p>Shiping Cost : <span class="float-right">$5.00</span> </p>
                            <hr class="my-2 border-yellow-200" />
                            <p>Total Cost: <span class="float-right">${{$totalPrice + 5.00}}</span></p>
                            <input type="hidden" name="totalPrice" value="{{$totalPrice + 5.00}}"/>
                        </div>
                        <div class="p-5 rounded border border-current mt-3">
                            <h1 class="text-xl">Payment Method</h1>
                            <hr class="my-2 border-yellow-200" />
                            <label class="cursor-pointer" for="">Payment Method</label>
                            <select name="paymentmethod" id="paymentmethod" class="px-5 py-2 mt-2 mb-2 w-full border border-gray-600 outline-none rounded " >
                                <option value="" hidden>Payement Method</option>
                                <option value="cod">Cash On Delivery(COD)</option>
                                <option value="bkash">bKash</option>
                                <option value="roket">Roket</option>
                            </select>
                        </div>
                        <div class="p-5 mt-3 text-center">
                            <button type="submit" class="px-5 py-3 m-auto bg-red-600 text-white text-semibold rounded border border-red-600 outline-none hover:shadow-2xl">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
@endsection
    
