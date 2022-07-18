@extends('admin.layout.admin')
@section('title', 'Create new product')

@section('content')
<div class="w-full px-2  py-1">
    @if (session('status'))
    <div class="p-2 mb-1 rounded bg-green-600 text-white">{{session('status')}}</div>
    @endif
    
    <div class="px-2 py-2 mb-2">
        Create New Product
    </div>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="w-full px-2 flex">
            <div class="w-1/2 mr-2">
                <div class="mt-2">
                    <label for="name">Name *</label>
                    <input type="text" class="w-full mt-2 border border-gray-600 rounded px-5 py-2" id="name" name="productName" placeholder="Product Name" />
                    @error('productName')
                    <p><small class="tex-red-600">{{$message}}</small></p>
                    @enderror                    
                </div>
                <div class="mt-2">
                    <label for="unitPrice">Unit Price *</label>
                    <input type="number" class="w-full mt-2 border border-gray-600 rounded px-5 py-2" id="unitPrice" name="unitPrice" placeholder="Product Price" />
                    @error('unitPrice')
                    <p><small class="tex-red-600">{{$message}}</small></p>
                    @enderror 
                </div>
                <div class="mt-2">
                    <label for="stock">Unit Stock*</label>
                    <input type="number" name="stock" id="stock" class="w-full mt-2 border border-gray-600 rounded px-5 py-2" placeholder="Unit Stock" />
                    @error('stock')
                    <p><small class="tex-red-600">{{$message}}</small></p>
                    @enderror 
                </div>
                <div class="mt-2">
                    <label for="size">Size</label>
                    <input type="text" name="size" id="size" class="w-full mt-2 border border-gray-600 rounded px-5 py-2" placeholder="m,xl,2xl" />
                </div>
                <div class="mt-2">
                    <label for="sortDesc">Sort Description</label>
                    <textarea name="sortDesc" id="sortDesc" cols="30" rows="2" class="w-full mt-2 border border-gray-600 rounded px-5 py-2" placeholder="Sort Description"></textarea>
                </div>
            </div>
            <div class="w-1/2 ml-2">
                <div class="mt-2">
                    <label for="category">Category*</label>
                    <select name="category" id="category" class="w-full mt-2 border border-gray-600 rounded px-5 py-2">
                        <option value="" hidden>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <p><small class="tex-red-600">{{$message}}</small></p>
                    @enderror 
                </div>
                <div class="mt-2">
                    <label for="image">Image*</label>
                    <input type="file" name="image" id="image" class="w-full mt-2 border border-gray-600 rounded px-5 py-2" />
                    @error('image')
                    <p><small class="tex-red-600">{{$message}}</small></p>
                    @enderror 
                </div>
                <div class="mt-2">
                    <label for="weight">Unit Weight</label>
                    <input type="number" name="weight" id="weight" class="w-full mt-2 border border-gray-600 rounded px-5 py-2" placeholder="Unit weight" />
                </div>
                <div class="mt-2">
                    <label for="color">Color</label>
                    <input type="text" name="color" id="color" class="w-full mt-2 border border-gray-600 rounded px-5 py-2" placeholder="blue,red,orange" />
                </div>
                <div class="mt-2">
                    <label for="longDesc">Long Description</label>
                    <textarea name="longDesc" id="longDesc" cols="30" rows="2" class="w-full mt-2 border border-gray-600 rounded px-5 py-2" placeholder="Long Description"></textarea>
                </div>
            </div>
           
        </div>
        <div class="px-2">
            <button type="submit" class="px-5 py-2 border border-green-600 bg-green-600 text-white rounded">Create</button>
        </div>
    </form>
</div>
@endsection