@extends('admin.layout.admin')
@section('title', 'Product Activity')
@section('head')
    <style>
        .modal-content {
            position: relative;
            background: white;
            opacity: 1;
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 1s;
            animation-name: animatetop;
            animation-duration: 1s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0} 
            to {top:0; opacity:1}
        }

        @keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }
        .modal-box {
            display: none;
            padding-top: 30px;
            padding-left: 20px;
            padding-right: 20px;
        }
    </style>
@endsection
@section('content')

    <div class="w-full px-2  py-1">
        @if (session('status'))
        <div class="p-2 mb-1 rounded bg-green-600 text-white">{{session('status')}}</div>
        @endif
        <div class="px-5 py-2 mb-2">
            All Products List
            <span class="float-right">
                <a href="/admin/products/create" class="p-2 font-bold border border-green-600 rounded bg-green-600 text-white hover:bg-white hover:text-green-600">Create New Product</a>
            </span>
        </div>
        <div class="px-5 py-2">
        <table class="table-collapse border border-gray-400 w-full text-xs">
            <thead class="bg-gray-100">
                <tr class="border border-gray-400">
                    <th class="p-2 border border-gray-400">
                        <input type="checkbox" id="checkAll" onclick="checkAll(this)" />
                    </th>
                    <th class="p-2 border border-gray-400">#</th>
                    <th class="p-2 border border-gray-400">P. Id</th>
                    <th class="p-2 border border-gray-400">Name</th>
                    <th class="p-2 border border-gray-400">Price</th>
                    <th class="p-2 border border-gray-400">Quantity</th>
                    <th class="p-2 border border-gray-400">Date</th>
                    <th class="p-2 border border-gray-400">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr class="border border-gray-400">
                    <td class="p-2 border border-gray-400 text-center">
                        <input type="checkbox" name="product" data-id="{{$product->id}}" id="productId" class="productId" />
                    </td>
                    <td class="p-2 border border-gray-400 text-center">{{$loop->iteration}}</td>
                    <td class="p-2 border border-gray-400 text-center">
                        <small>#{{$product->id}}</small>
                    </td>   
                    <td class="p-2 border border-gray-400">
                        <a href="#" class="text-blue-600">{{$product->productName}}</a>
                    </td>
                    <td class="p-2 border border-gray-400 text-center">${{$product->unitPrice}}</td>
                    <td class="p-2 border border-gray-400 text-center text-red-600 lowercase">
                        <span>Total: {{$product->unitStock}} Pc</span> <br/>
                    </td>
                    <td class="p-2 border border-gray-400 text-center">
                        {{$product->created_at}}
                    </td>
                    <td class="p-2 border border-gray-400 text-center">
                        <button type="button" onclick="showProduct({{$product->id}})" class="px-2 py-1 border border-gray-400 rounded">
                            <i class="fa fa-eye"></i>
                        </button>
                        <a href="{{ route('product.admin.show', ['id'=>$product->id]) }}" class="px-2 py-1 border border-gray-400 rounded mr-1">
                            <i class="fa fa-edit"></i>
                        </a>

                        <form class="inline-block" action="{{ route('product.destroy')}}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$product->id}}" />
                            <button type="submit" class="px-2 py-1 border border-gray-400 rounded">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <a target="_blank" href="{{ route('product.print', ['id'=>$product->id]) }}" class="inline-block px-2 py-1 border border-gray-400 rounded">
                            <i class="fa fa-print"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
                
            </tbody>
            <tfoot class="py-2">
                <tr>
                    <td colspan="4">
                        <select name="action" id="action" class="m-2 px-2 py-1 border border-gray-600 outline-none rounded">
                            <option value="" hidden>Select Action</option>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button onclick="apply()" class="px-2 py-1 border border-green-600 rounded bg-green-600 text-white hover:bg-white hover:text-green-600">Apply</button>
                    </td>
                    <td colspan="4">&nbsp;</td>
                </tr>
            </tfoot>
        </table>
        <br/>
        {{$products->links()}}
        </div>

        {{-- modal box --}}
        <div id='modalBox' class="modal-box w-full fixed inset-0 z-50">
            <div id="modalContent" class="modal-content w-1/2 m-auto relative text-black bg-white rounded shadow-2xl">
                {{-- here is show product details --}}
            </div>
        </div>
    </div>
    <script>
        // CHECK all product
        var checkBtn = document.getElementsByClassName('productId');
        function checkAll(e) {
            if(e.checked) {
                for (let i = 0; i < checkBtn.length; i++) {
                   if(!checkBtn[i].checked) {
                       checkBtn[i].checked = true;
                   }
                }
            } else {
                for (let i = 0; i < checkBtn.length; i++) {
                   if(checkBtn[i].checked) {
                       checkBtn[i].checked = false;
                   }
                }
            }
        }

        // set action for product
        function apply()
        {
            var checkBtn = document.getElementsByClassName('productId');
            var selectId = [];
            var action = document.querySelector('#action').value;
            for (let i = 0; i < checkBtn.length; i++) {
                if(checkBtn[i].checked) {
                    selectId.push(checkBtn[i].dataset.id);
                }
            }

            axios.post('/api/products/', {
                action: action,
                selectId: selectId
            })
            .then(res=> {
                alert(res.data.message);
            })
            .catch(e => {
                // alert(e.message);
                console.log(e);
            });
        }

        
        var modalBox = document.querySelector('#modalBox');
        var modalContent = document.querySelector('#modalContent');
        var btnClose = document.querySelector('#modalClose');

        // box close function 
        function btnCloseFun(){
            modalBox.style.display = 'none';
        }

        // show product function
        function showProduct(id) {
            modalBox.style.display = 'block';
            modalContent.innerHTML = null;
            modalContent.innerHTML = `<div class="p-3 rounded border-none bg-green-600 text-white text-xs">Loading...</div>`;
            axios.get(`/api/products/${id}`)
            .then(res=> {
                if(res.status === 200) {
                    var data = res.data;
                    var output = '';
                    output += `<div class="p-5 bg-green-600 text-white text-xs rounded-t clear-both block"><span>Product Details</span><button onclick="btnCloseFun()" id="modalClose" class="px-3 py-1 rounded border-none bg-red-600 text-white float-right">&times;</button></div>`;
                    output += `<div class="p-5 bg-gray-600 text-xs">`;
                    output += `<h1>#${data.id} - ${data.productName} </h1>`;
                    output += `<img class="rounded" style="width:200px;margin:auto;margin-top:10px;margin-bottom:10px;" src="${data.image}" alt="Product Image">`;
                    output += `<table class="table-collapse border border-gray-400 w-full"><tbody>`;
                    output += `<tr class="border border-white"><th class="p-2 border border-white">Price:</th><td class="p-2 border border-white" >$ ${data.unitPrice}</td><th class="p-2 border border-white" >Category Name: </th><td class="p-2 border border-white" >${data.category_name} </td></tr>`;
                    output += `<tr class="border border-white"><th class="p-2 border border-white">Unit Weight:</th><td class="p-2 border border-white" > ${data.unitWeight != null ? data.unitWeight : 'N/A'}</td><th class="p-2 border border-white" >Unit Stock: </th><td class="p-2 border border-white" >${data.unitStock != null ? data.unitStock : 'N/A'} </td></tr>`;
                    output += `<tr class="border border-white"><th class="p-2 border border-white">Size:</th><td class="p-2 border border-white" > ${data.availableSize != null ? data.availableSize : 'N/A'}</td><th class="p-2 border border-white" >Color: </th><td class="p-2 border border-white" >${data.availableColor != null ? data.availableColor : 'N/A'} </td></tr>`;
                    output += `<tr class="border border-white"><th class="p-2 border border-white">Discount:</th><td class="p-2 border border-white" > ${data.discount != null ? data.discount : 'N/A'}</td><th class="p-2 border border-white" >Rank: </th><td class="p-2 border border-white" >${data.rank != null ? data.rank : 'N/A'} </td></tr>`;
                    output += `<tr class="border border-white"><th class="p-2 border border-white">Status:</th><td class="p-2 border border-white" > ${data.status != null ? data.status : 'N/A'}</td><th class="p-2 border border-white" >&nbsp;</th><td class="p-2 border border-white" >&nbsp;</td></tr>`;
                    output += `</tbody></table></div>`;
                    output += `<div class="p-2 bg-green-600 text-white text-xs rounded-b text-right"><button class="px-3 py-2 rounded border-none bg-blue-600 text-white">Previous</button>&nbsp;<button class="px-3 py-2 rounded border-none bg-blue-600 text-white">Next</button></div>`;
                    output += `</div></div>`;
                    modalContent.innerHTML = output;

                } else {
                    throw new Error('Something is worng');
                }
            })
            .catch(e=> {
                var output = null;
                output += `<div class="p-3 rounded bg-red-600 text-white border-none">${e.message}</div>`;
                modalContent.innerHTML = output;
            });
            
        }
    </script>
@endsection