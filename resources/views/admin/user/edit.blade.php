@extends('admin.layout.admin')
@section('title', 'User edit')

@section('content')
<div class="w-full px-2  py-1">
    
    <form class="text-xs" action="{{ route('user.save', ['id'=>$user->id]) }}" method="POST">
        @if (session('status'))
            <div class="px-5 py-2 mb-2 bg-green-600 text-white rounded border-none">
                {{session('status')}}
            </div>
        @endif
        @csrf
        @method('PUT')
        <div class="px-5 py-2 mb-2">
            Edit User Information
        </div>
        <div class="px-5 py-2">
            <input type="text" name="fName" class="px-5 py-2 w-full border border-gray-600 rounded outline-none focus:border-blue-600" placeholder='First Name*' value="{{$user->fName}}" />
        </div>
        <div class="px-5 py-2">
            <input type="text" name="lName" class="px-5 py-2 w-full border border-gray-600 rounded outline-none focus:border-blue-600" placeholder='Last Name*' value="{{$user->lName}}" />
        </div>
        <div class="px-5 py-2">
            <input type="email" name="email" class="px-5 py-2 w-full border border-gray-600 rounded outline-none focus:border-blue-600" placeholder='E-mail*' value="{{$user->email}}" />
        </div>
        <div class="px-5 py-2">
            <input type="text" name="phone" class="px-5 py-2 w-full border border-gray-600 rounded outline-none focus:border-blue-600" placeholder='Phone' value="{{$user->phone}}" />
        </div>
        <div class="px-5 py-2">
            <input type="date" name="dof" class="px-5 py-2 w-full border border-gray-600 rounded outline-none focus:border-blue-600" placeholder='Date of Birth' value="{{$user->dof}}" />
        </div>
        <div class="px-5 py-2">
            <select name="gender" id="gender" class="px-5 py-2 w-full border border-gray-600 rounded outline-none focus:border-blue-600">
                <option value="" hidden>Select Gender</option>
                <option {{ $user->gender == 'male' ? 'selected' : ''}} value="male">Male</option>
                <option {{ $user->gender == 'female' ? 'selected' : ''}} value="female">Female</option>
            </select>
        </div>
        <div class="px-5 py-2">
            <select name="role" id="role" class="px-5 py-2 w-full border border-gray-600 rounded outline-none focus:border-blue-600">
                <option value="" hidden>Select Role</option>
                <option {{$user->role == 'admin' ? 'selected' : ''}} value="admin">Administrator</option>
                <option {{ $user->role == 'customer' ? 'selected' : ''}} value="customer">Customer</option>
            </select>
        </div>
        <div class="px-5 py-2 clear-both mt-3">
            <span >
                <button type="submit" class="px-5 py-2 rounded font-bold border border-green-600 text-white bg-green-600 hover:bg-white hover:text-green-600">Save</button>
            </span>
            <span class="float-right">
                @if ($preId!=null)
                    <a href="{{ route('user.edit', ['id'=>$preId]) }}" class="px-5 py-2 rounded font-bold border border-blue-600 text-white bg-blue-600 hover:bg-white hover:text-blue-600">Previous</a>
                @endif
                @if ($nextId !=null)
                    <a href="{{ route('user.edit', ['id'=>$nextId]) }}" class="px-5 py-2 rounded font-bold border border-blue-600 text-white bg-blue-600 hover:bg-white hover:text-blue-600">Next</a>
                @endif
                
            </span>
        </div>
    </form>
</div>
@endsection