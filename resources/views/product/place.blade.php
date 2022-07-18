@extends('layout.app')
{{-- title --}}
@section('title', 'Checkout Order')

@section('main-content')
<section class="w-full bg-gray-50">
    <div class="px-16 bg-white p-5">
        <div class="p-5">
            <div class="p-5 radius border-none bg-green-600 text-white">
                {{$message}}
            </div>
        </div>
    </div>
</section>

@endsection