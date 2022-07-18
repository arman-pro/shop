<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') -Paradise Shop</title>
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    {{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html, body {
            margin: 0;
        }
        * {
            box-sizing: border-box;
        }

        .cart-box {
            width: 0;
            transition: 1s;
        }
    </style>
</head>
<body class="m-0 bg-gray-50">
    <nav class=" h-auto py-2 px-16 md:flex md:justify-between bg-gray-700 uppercase text-white font-thin text-xs item-center md:h-8">
        <div class="md:m-0 sm:m-auto">
            <ul class="list-none m-0 p-0 inline-block">
                <li class="inline-block px-1">
                    <a href="#"><i class="fa fa-facebook"></i>&nbsp;J&nbsp;OIN WITH US</a>
                </li>
                <li class="inline-block px-1"><i class="fa fa-phone"></i>&nbsp;&nbsp; +8801307035688</li>
                <li class="inline-block px-1">
                    <i class="fa fa-envelope"></i>&nbsp;&nbsp;<span class="lowercase">help.paradise@paradiseshop.com</span>
                </li>
            </ul>
        </div>
        <div class="md:block sm:hidden">
            <ul class="list-none m-0 p-0 inline-block">
                <li class="inline-block px-1"><a href="#">Hot Deals</a></li>
                <li class="inline-block px-1"><a href="#">Friday Offer</a></li>
                <li class="inline-block px-1"><a href="#">Track My Order</a></li>
                <li class="inline-block px-1"><a href="#">Register/Login</a></li>
                <li class="inline-block px-1"><a href="#">Language</a></li>
            </ul>
        </div>
    </nav>
    <header class="md:flex space-x-4 flex-nowrap md:justify-between bg-gray-100 py-5 px-16">
        <div class="md:flex-none border-black">
            <a href="{{route('/')}}"><img class="sm:m-auto" width="150" src={{ asset('storage/BDSHOP-BDSP-LOGO.webp') }} alt="Logo"></a>
        </div>
        <div class="sm:mt-2 sm:mb-5 md:flex-grow text-center">
            <form action="{{ route('search') }}" method="GET" role="serach" class="w-full justify-center block">
                <input class="w-7/12 border border-r-0 rounded rounded-r-none border-current py-2 px-5 outline-none" type="text" name="searchQuery" placeholder="I'm looking for..."/>
                <button style="margin-left: -5px;height:42px;" type="submit" class="border border-blue-600 btn btn-primary ml-0 rounded-l-none px-5 focus:outline-none" > <i class="fa fa-search"></i> </button>
            </form>
        </div>
        <div class="sm:text-center md:flex-none">
            <span id="more-option-bar" class="md:hidden cursor-pointer p-2"><i class="text-black font-bold fa fa-bars" style="font-size:24px;color:black;"></i></span>
            <span class="cursor-pointer p-2"><i class="text-black font-bold fa fa-heart-o" style="font-size:24px;color:red;"></i></span>
            <span id="cart-box-open" class="cursor-pointer p-2"><i class="text-black font-bold fa fa-shopping-cart" style="font-size:24px;color:gray;"></i> <span >{{$cartCount}}</span> </span>
            @auth
                <button class="btn border border-current rounded-full text-black font-bold outline-none hover:bg-green-600 hover:text-white focus:outline-none ">
                    {{auth()->user()->fName}}
                </button>
                <button class="btn border border-current rounded-full text-black font-bold hover:bg-green-600 hover:text-white ">
                    <a href={{ route('user.logout') }}>Logout</a>
                </button>
            @endauth
            @guest
                <button class="btn border border-current rounded-full text-black font-bold hover:bg-green-600 hover:text-white "><a href={{ route('user.login') }}>Sign In</a></button>
            @endguest
        </div>
    </header>
    <nav class="bg-gray-100 pb-5 font-semibold sm:hidden md:block">
        <ul class="list-none m-0 p-0 flex justify-center">
            @php
                $i = 0;
                foreach ($categories as $item) {
                    $i++;
                    if($i <= 8) {
                    echo "<li>
                            <a href='/category/$item->id/$item->slug' class='px-2 py-3' >".$item->name."</a>
                        </li>";
                    } else {
                        break;
                    }                    
                }
            @endphp
           
                <li><a class="px-2 py-3 cursor-pointer" id="more-option-show" >More</a></li>
        </ul>
    </nav>
    <!-- more option -->
    <div style="display:none;transition: 1s;;" id="more-option" class="more-option bg-gray-600 w-80 absolute top-0 left-0 h-full z-10 text-white overflow-y-scroll">
        <p class="text-right m-o pt-3 pr-3 pb-0">
            <span id="more-option-cancel" class="cursor-pointer hover:text-red-600"><i class="fa fa-close hover:text-red" style="font-size:25px"></i></span>
        </p>
        <div class="text-center">
            <img class="m-auto" src={{ asset('storage/BDSHOP-BDSP-LOGO.webp') }} style="width:200px;height:auto;" alt="Pradise Logo">
        </div>
        <ul class="list-none m-0 px-5 py-5 block pt-0">
            <li><a class="p-1 block" href="/">Home</a></li>
            @foreach ($categories as $item)
            <li><a class="p-1 block" href="{{ route('category.show', ['id'=>$item->id, 'name' => $item->name]) }}">{{$item->name}}</a></li>
            @endforeach
            
            
        </ul>
    </div>


    <!-- cart box -->
    <div class="cart-box overflow-x-hidden top-0 right-0 bottom-0 text-black h-auto z-20 fixed" id="cart-box">
        <div class="p-5 bg-gray-100 overflow-y-scroll min-h-screen block shadow-2xl">
            <p style="width:420px;" class="text-right m-o pt-3 pr-3 pb-0 block">
                <span id="cart-box-close" class="cursor-pointer hover:text-red-600 text-semibold"><i class="fa fa-close hover:text-red" style="font-size:18px"></i></span>
            </p>
            @php
                $totalPrice = 0;
            @endphp
            @if ($cartItems->count() > 0)
            <div style="width:420px;" class="text-center block">
                <img class="m-auto" src={{ asset('storage/BDSHOP-BDSP-LOGO.webp')}} style="width:150px;height:auto;" alt="Pradise Logo">
            </div>
            <h2 style="width:420px;" class="text-center">Cart Item</h2>
            <hr class="mt-5 mb-5" />
           
                @foreach ($cartItems as $cartItem)           
                    @php
                        $totalPrice += $cartItem->price * $cartItem->quantity;
                    @endphp
                <div style="width:420px;" class="border border-black p-2 rounded relative mt-5 overflow-hidden h-28 hover:shadow-2xl">
                    <span class="absolute top-0 right-2 block font-bold cursor-pointer hover:text-red-600" >
                        <a href="{{ route('cart.remove', ['id'=>$cartItem->id]) }}"><i class="fa fa-trash" ></i></a>
                    </span>
                    <div class="flex justify-between">
                        <div style="width:150px;height:80px;" class="flex-none overflow-hidden">
                            <a href="#">
                                <img class="object-cover rounded " style="height:80px;width:100%;" src="{{ asset('storage/product')."/".$cartItem->attributes->image}}" alt="{{$cartItem->attributes->image}}">
                            </a>
                        </div>
                        <div class="flex-grow items-center pl-5">
                            <h1>
                                <a href="#">
                                    {{$cartItem->name}}
                                </a>
                            </h1>
                            <hr/>
                            <p>
                                <span>Quantity: {{$cartItem->quantity}} Pc</span>
                                <span class="float-right">Price(USD): {{$cartItem->price * $cartItem->quantity}}/-</span>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach             

            <hr class="mt-5 mb-5 border-black" />
            <div style="width:420px" class="text-right m-0">
                Total($): {{$totalPrice}}/-
            </div>  
            
            <div style="width:420px;" class="text-center mt-5">
                <a href="{{ route('destroy.cart') }}" class="py-2 px-5 mr-2 border border-red-600 rounded text-semibold uppercase bg-red-600 text-white outline-none foucus:outline-none hover:text-black hover:bg-white hover:border-red-600 ">
                    Clear Cart
                </a>
                <a href="{{ route('checkout') }}" class="py-2 px-5 border border-green-600 rounded text-semibold uppercase bg-green-600 text-white outline-none foucus:outline-none hover:text-black hover:bg-white hover:border-green-600 ">
                    Check Out
                </a>
            </div>
            @else 
            <p style="width:420px" class="text-center">No Cart Item</p>
            @endif

        </div>
    </div>

@yield('main-content')
{{-- main content --}}

<footer style="min-height: 250px;" class="w-full bg-gray-600 px-16 pb-3 py-16 mt-16">
    <div class="flex justify-between text-white">
        <div>
            <h2 class="text-xl">Customer Care</h2>
            <ul class="mt-3" >
                <li><a href="#">Help Center</a></li>
                <li><a href="#">How to Buy</a></li>
                <li><a href="#">Take Your Order</a></li>
                <li><a href="#">Returns & Refunds</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div>
            <h2 class="text-xl">Top Categories</h2>
            <ul class="mt-3">
                <li><a href="#">Home</a></li>
                <li><a href="#">House Porduct</a></li>
                <li><a href="#">Electroonic & Consumer</a></li>
                <li><a href="#">Women's Fashion</a></li>
                <li><a href="#">Men's Fashion</a></li>
                <li><a href="#">Sport & Outdoor</a></li>
            </ul>
        </div>
        <div>
            <h2 class="text-xl">Paradise Shop</h2>
            <ul class="mt-3">
                <li><a href="#">Paradise Blog</a></li>
                <li><a href="#">Login/Register</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Privacy & Policy</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
        <div>
            <h2 class="text-xl">Payment Methods</h2>
            <img class="mt-3 object-cover rounded" style="width:80px;height:50px;" src={{ asset('./storage/payment/american-express.png') }} alt="american-express">
            <img class="mt-3 object-cover rounded" style="width:80px;height:50px;" src={{ asset('./storage/payment/mastercard.png') }} alt="master Card">
            <img class="mt-3 object-cover rounded" style="width:80px;height:50px;" src={{ asset('./storage/payment/PayPalCard.png') }} alt="Paypal Card">
            <img class="mt-3 object-cover rounded" style="width:80px;height:50px;" src={{ asset('./storage/payment/visa-logo.png') }} alt="Visa Logo">
        </div>
    </div>
    <p class="text-center text-xs">
        Copyright@Your Shop | Developed By - <a href="https://www.facebook.com/mohammadarman.ali.79">Mohammad Arman Ali</a>
    </p>
</footer>
<script src={{ asset('js/app.js') }}></script>
</body>
</html>