@extends('admin.layout.admin')
@section('title', 'Change your site setting')

@section('content')
<div class="w-full px-2  py-1">
    <div class="px-5 py-2 mb-2">
        General Site Setting
    </div>
    <form class="px-5 py-2" action="">
        <div class="p-2 w-full">
            <label for="title">Web Site Title</label>
            <input type="text" name="title"id="title" class="px-5 py-2 text-sm mt-2 rounded border border-gray-800 w-full outline-none" placeholder="Title" />
        </div>
        <div class="p-2 w-full">
            <img class="overflow-hidden" style="width:100px" src="{{ asset('/storage/BDSHOP-BDSP-LOGO.webp') }}" alt="site logo"/>
            <input type="file" class="px-5 py-2 text-sm mt-2 rounded border border-gray-800 w-full outline-none"/>
        </div>
        <div class="p-2 w-full">
            <label for="email">Help Line E-mail</label>
            <input type="text" name="email"id="email" class="px-5 py-2 text-sm mt-2 rounded border border-gray-800 w-full outline-none" placeholder="E-mail" />
        </div>
        <div class="p-2 w-full">
            <label for="phone">Help Line Phone</label>
            <input type="text" name="phone"id="phone" class="px-5 py-2 text-sm mt-2 rounded border border-gray-800 w-full outline-none" placeholder="Phone" />
        </div>
        <div class="p-2 w-full">
            <label for="fb">Facebook</label>
            <input type="text" name="fb"id="fb" class="px-5 py-2 text-sm mt-2 rounded border border-gray-800 w-full outline-none" placeholder="Facebook" />
        </div>
        <div class="p-2 w-full">
            <button class="px-5 py-2 border rounded text-sm mt-2 bg-green-800">
                Save
            </button>
        </div>
    </form>

</div>
@endsection