@extends('admin.layout.admin')
@section('title', $user->fName )

@section('content')
<div class="w-full px-2  py-1">
    <div class="px-5 py-2 mb-2">
        User Details
    </div>
    <div class="px-5 py-2">
        <table class="table-collapse border border-gray-400 w-full text-xs">
            <tbody>
                <tr class="border border-gray-400">
                    <td class="p-2 border border-gray-400">
                        <b>First Name: </b> {{$user->fName}}
                    </td>
                    <td class="p-2 border border-gray-400">
                        <b>Last Name: </b> {{$user->lName}}
                    </td>
                </tr>  
                <tr class="border border-gray-400">
                    <td class="p-2 border border-gray-400">
                        <b>E-mail: </b>{{$user->email}}
                    </td>  
                    <td class="p-2 border border-gray-400">
                        <b>Phone: </b>{{$user->phone}}
                    </td>  
                </tr>              
                <tr class="border border-gray-400">
                    <td class="p-2 border border-gray-400">
                        <b>DOF: </b>{{$user->dof}}
                    </td>  
                    <td class="p-2 border border-gray-400">
                        <b>Gender: </b>{{$user->gender}}
                    </td>  
                </tr>              
                <tr class="border border-gray-400">
                    <td class="p-2 border border-gray-400">
                        <b>Role: </b>{{$user->role}}
                    </td>  
                    <td class="p-2 border border-gray-400">
                        &nbsp;
                    </td>  
                </tr>              
            </tbody>
            <tfoot>
                <tr class="border border-gray-400" >
                    <td colspan="2" class="p-2 border border-gray-400 text-right">
                        @if ($preId != null)
                            <a href="{{ route('user.show', ['id'=>$preId]) }}" class="inline-block px-2 py-1 bg-green-800 text-white border border-gray-400 rounded">
                                Previous
                            </a>
                        @endif
                        @if ($nextId != null)
                            <a href="{{ route('user.show', ['id'=>$nextId]) }}" class="inline-block px-2 py-1 bg-green-800 text-white border border-gray-400 rounded">
                                Next
                            </a>
                        @endif
                    </td>   
                </tr>
            </tfoot>
            
        </table>
    </div>
</div>
@endsection