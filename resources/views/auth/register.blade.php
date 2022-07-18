@extends('layout.app')
{{-- title --}}
@section('title', 'Largest online shoping')

@section('main-content')
<section class="main-content w-full bg-white">
    <div class="px-28"> 
        @if (session('status'))
        <div class="px-5 py-3 mt-3 bg-green-600 text-white font-semibold rounded border-0">
            {{session('status')}}  
        </div> 
        @endif
               
        <form action={{route('user.registration')}} method="POST" class="mt-10 p-3 bg-blue-100 shadow-2xl rounded">
            @csrf
            <h1 class="p-3 text-semibold text-xl uppercase ">
                Create Your Paradise Account
            </h1>
            <div class="text-center">
                <img class="m-auto" src={{ asset('./storage/BDSHOP-BDSP-LOGO.webp') }} style="width:150px;height:auto;" alt="Pradise Logo">
            </div>
            <div class="w-full flex justify-between">
                <div class="w-2/4 p-3" > 
                    <div class="p-2">
                        <label class="cursor-pointer" for="fName">First Name *</label>
                        <input type="text" name="fName" id="fName" class="px-5 py-3 border border-current rounded w-full outline-none mt-2 @error('fName') border-red-600 @enderror " value="{{old('fName')}}" placeholder="Jhone"  />                       
                    </div>
                    <div class="p-2">
                        <label for="lName">Last Name *</label>
                        <input type="text" name="lName" id="lName" class="px-5 py-3 border border-current rounded w-full outline-none mt-2 @error('lName') border-red-600 @enderror " value="{{old('lName')}}" placeholder="Doe" />
                    </div>
                    <div class="p-2">
                        <label for="email">E-Mail*</label>
                        <input type="text" name="email" id="email" class="px-5 py-3 border border-current rounded w-full outline-none mt-2 @error('email') border-red-600 @enderror  " value="{{old('email')}}" placeholder="example@anyone.com"  />
                    </div>
                    <div class="p-2">
                        <p><input type="checkbox" name="accept" /> I want to receive exclusive offers and promotions from Paradise.</p>
                    </div>
                </div>                    
                <div class="w-2/4 p-3" > 
                    <div class="p-2">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="px-5 py-3 border border-current rounded w-full outline-none mt-2 @error('phone') border-red-600 @enderror  " value="{{old('phone')}}" placeholder="+88017....." />
                        @error('phone')
                            <p><small class="text-red-600">{{$message}}</small></p>
                        @enderror
                    </div>
                    <div class="p-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="px-5 py-3 border border-current rounded w-full outline-none mt-2 @error('password') border-red-600 @enderror  " placeholder="####"  />
                        @error('password')
                            <p><small class="text-red-600">{{$message}}</small></p>
                        @enderror
                    </div>
                    <div class="p-2">
                        <label for="birthYear">Birthday*</label> <br/>
                        <select name="birthYear" id="birthYear" class="px-5 py-3 border border-current rounded outline-none mt-2 w-1/4 @error('birthYear') border-red-600 @enderror" >
                            <option value="" hidden>Year</option>
                            <?php
                                for($i = 0; $i < 10; $i++) {
                                    $year = $i + 2000;
                                    $selected = old('birthYear') == $year ? 'selected' : null;
                                    echo "<option $selected  value='$year' >$year</option>";
                                }
                            ?>
                        </select>
                        <select name="birthMonth" id="birthMonth" class="px-5 py-3 border border-current rounded outline-none mt-2 w-1/4 @error('birthMonth') border-red-600 @enderror" >
                            <option value="" hidden>Month</option>
                            @php
                                $month = ['January', 'February', 'March', 'April', 'May', 'Jun', 'July', 'August', 'Semptember', 'October','November', 'December'];
                                for($i=0; $i <= 11; $i++) {
                                    $m = $i + 1;
                                    $selected = old('birthMonth') == $m ? 'selected' : null;
                                    echo "<option $selected value='$m' >".$month[$i]."</option>";
                                }
                            @endphp
                        </select>
                        <select name="birthDay" id="birthDay" class="px-5 py-3 border border-current rounded outline-none mt-2 w-1/4 @error('birthDay') border-red-600 @enderror" >
                            <option value="" hidden>Date</option>
                           @php
                               for($i=1; $i <=31; $i++) {
                                $selected = old('birthDay') == $i ? 'selected' : null;
                                   echo "<option $selected value='$i' >$i</option>";
                               }
                           @endphp
                        </select>
                        
                    </div>

                    <div class="p-2">
                        <label for="gender">Gender*</label>
                        <select name="gender" id="gender" class="px-5 py-3 border border-current rounded outline-none mt-2 w-full @error('gender') border-red-600 @enderror" >
                            <option value="" hidden>Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>                    
            </div>
        <div class="p-2 text-center">
            <button type="submit" class="p-3 rounded-full border border-cureent bg-blue-600 text-white font-semibold uppercase w-80 outline-none focus:outline-none hover:border-blue-600 hover:bg-white hover:text-blue-600" >Sign Up</button>
        </div>
    </form>
    </div>
</section>
@endsection
    
