@extends('layout.app')
{{-- title --}}
@section('title', "Cart Item all products")

@section('main-content')
<section class="main-content w-full bg-white">
    <div class="px-16 mt-10">
        <h2 class="p-3 bg-green-600 text-white border rounded ">
            All Cart Item
        </h2>
        <div class="block mt-5">
            <div class="w-2/3 m-auto mt-5 flex item p-3 border border-gray-600 rounded ">
                <div class="mr-3" >
                    <img style="height:120px;" class="object-fit overflow-hidden" src="{{ asset('storage/product/beauty.jpg') }}" alt="beauty"/>
                </div>
                <div class="detial">
                    <h1 class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, ut?</h1>
                    <p class="text-gray-800">
                       <span>Size: M</span> |
                       <span>Color: Red</span> | 
                        <span>Quantity: 1 (pcs)</span>
                    </p>
                    <p>
                        Price: $15.00 
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection