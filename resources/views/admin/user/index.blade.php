@extends('admin.layout.admin')
@section('title', 'Users List')

@section('content')
<div class="w-full px-2  py-1">
    <div class="px-5 py-2 mb-2">
        All Users List
    </div>
    <div class="px-5 py-2">
        <table class="table-collapse border border-gray-400 w-full text-xs">
            <thead class="bg-gray-100">
                <tr class="border border-gray-400">
                    <th class="p-2 border border-gray-400">
                        <input type="checkbox" id="checkAll" onclick="checkAll(this)" />
                    </th>
                    <th class="p-2 border border-gray-400">#</th>
                    <th class="p-2 border border-gray-400">U. Id</th>
                    <th class="p-2 border border-gray-400">F. Name</th>
                    <th class="p-2 border border-gray-400">E-mail</th>
                    <th class="p-2 border border-gray-400">Role</th>
                    <th class="p-2 border border-gray-400">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border border-gray-400">
                    <td class="p-2 border border-gray-400 text-center">
                        <input type="checkbox" name="product" id="user" class="uesr" />
                    </td>
                    <td class="p-2 border border-gray-400 text-center">
                        {{$loop->iteration}}
                    </td>
                    <td class="p-2 border border-gray-400 text-center">
                        #{{$user->id}}
                    </td>
                    <td class="p-2 border border-gray-400 text-center">
                        {{$user->fName . ' ' . $user->lName}}
                    </td>
                    <td  class="p-2 border border-gray-400 text-center">
                        {{$user->email}}
                    </td>
                    <td class="p-2 border border-gray-400 text-center">
                        @if ($user->role=='admin')
                        <span class="text-red-600 font-bold">Administrator</span>
                        @else
                        <span class="text-green-600 font-bold">Customer</span>
                        @endif
                        
                    </td>
                    
                    <td class="p-2 border border-gray-400 text-center">
                        <a href="{{ route('user.show', ['id'=>$user->id]) }}" type="button" class="inline-block px-2 py-1 border border-gray-400 rounded">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('user.edit', ['id'=>$user->id]) }}" class="inline-block px-2 py-1 border border-gray-400 rounded">
                            <i class="fa fa-edit"></i>
                        </a>
                        @if ($user->role!='admin')
                        <button type="button" class="inline-block px-2 py-1 border border-gray-400 rounded">
                            <i class="fa fa-trash"></i>
                        </button>
                        @endif
                        <button type="button" class="inline-block px-2 py-1 border border-gray-400 rounded">
                            <i class="fa fa-print"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection