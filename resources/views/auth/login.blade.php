@extends('layout.app')
{{-- title --}}
@section('title', 'Paradise Shop Login')

@section('main-content')
<section class="main-content w-full bg-white">
    <div class="px-28"> 
        @if (session('invaild'))
        <div class="px-5 py-3 mt-3 bg-red-600 text-white font-semibold rounded border-0">
            {{session('invaild')}}  
        </div> 
        @endif
        @if (session('pswInvalid'))
        <div class="px-5 py-3 mt-3 bg-red-600 text-white font-semibold rounded border-0">
            {{session('pswInvalid')}}  
        </div> 
        @endif           
        @if (session('wrong'))
        <div class="px-5 py-3 mt-3 bg-red-600 text-white font-semibold rounded border-0">
            {{session('wrong')}}  
        </div> 
        @endif           
        <form action="{{route('user.login')}}" method="POST" class="mt-10 p-3 bg-blue-100 shadow-2xl rounded">
            @csrf
            <h1 class="p-3 text-semibold text-xl uppercase ">
                Welcome to Paradise Shop! Please login
                <span class="float-right text-xs">Create New Account <u class="text-blue-600"><a href={{ route('user.registration') }}>Register</a></u></span>
            </h1>
            <div class="text-center">
                <img class="m-auto" src={{ asset('/storage/BDSHOP-BDSP-LOGO.webp') }} style="width:150px;height:auto;" alt="Pradise Logo">
            </div>
            <div class="w-full flex justify-between">
                <div class="w-2/4 p-3" > 
                    <div class="p-2">
                        <label for="email">E-Mail*</label>
                        <input type="text" name="email" id="email" class="px-5 py-3 border border-current rounded w-full outline-none mt-2 @error('email') border-red-600 @enderror" placeholder="example@anyone.com" value="{{old('email')}}" />
                        @error('email')
                            <p><small class="text-red-600">{{$message}}</small></p>
                        @enderror
                    </div>
                    <div class="p-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="px-5 py-3 border border-current rounded w-full outline-none mt-2 @error('password') border-red-600 @enderror" placeholder="####" />
                        @error('password')
                            <p><small class="text-red-600">{{$message}}</small></p>
                        @enderror
                    </div>
                </div>                    
                <div class="w-2/4 p-3 divide-y divide-yellow-500" > 
                    <div class="p-2">
                        <label for="">&nbsp;</label>
                        <button type="submit" class="mt-1 p-3 rounded border border-cureent bg-green-600 text-white font-semibold uppercase w-full outline-none focus:outline-none hover:border-green-600 hover:bg-white hover:text-green-600" >Login</button>
                    </div>
                    <p class="text-gray-600 text-center">
                        OR, LOGIN WITH
                    </p>
                    <div class="p-2 flex justify-between">
                        <div>
                            <a type="button" class=" p-3 rounded border border-cureent bg-blue-600 text-white font-semibold uppercase w-full outline-none focus:outline-none hover:border-blue-600 hover:bg-white hover:text-blue-600" ><i class="fa fa-facebook"></i>&nbsp;&nbsp;&nbsp;&nbsp;  Login With Facebook  </a>
                        </div>
                        <div>
                            <a type="button" class=" p-3 rounded border border-cureent bg-yellow-600 text-white font-semibold uppercase w-full outline-none focus:outline-none hover:border-yellow-600 hover:bg-white hover:text-yellow-600" ><i class="fa fa-google"></i>&nbsp;&nbsp;&nbsp;&nbsp; Login With Google</a>
                        </div>
                    </div>
                    
                </div>                    
            </div>
        <div class="p-2 text-center">
            
        </div>
    </form>
    </div>
</section>
@endsection
    
