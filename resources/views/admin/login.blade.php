<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="m-auto mt-5 p-0 box-border">
    <div class="w-96 m-auto mt-32 border border-gray-400 rounded p-5">
        <form action="./login" method="POST" >
            @csrf
            <h4>Admin Login</h4>
            @if (session('status'))
                <div class="px-5 py-3 mt-2 mb-2 rounded bg-red-600 text-white">{{session('status')}}</div>
            @endif
            <input type="text" name="email" id="email" class="w-full mt-2 border border-gray-400 outline-none p-3 rounded" placeholder="example@any.com" value="{{old('email')}}" />
            @error('email')
                <p><small class="text-red-600">{{$message}}</small></p>
            @enderror
            <input type="password" name="password" id="password" class="w-full mt-2 border border-gray-400 outline-none p-3 rounded" placeholder="Password"/>
            @error('password')
                <p><small class="text-red-600">{{$message}}</small></p>
            @enderror
            <p class="mt-2 clear-both">
                <input type="checkbox" name="remember" id="rem" /> <label for="rem">Remember Me</label>
                <span id="show" class="float-right cursor-pointer block ">Show</span>
            </p>
        
            <button type="submit" class="px-3 py-2 mt-2 border-green-600 bg-green-600 text-white rounded border">Login</button>
        </form>
    </div>
    <script>
        var show = document.querySelector('#show');
        show.onclick = function() {
            var psw = document.querySelector('#password');
            if(psw.type=='password') {
               psw.type = 'text';
               show.innerText ='Hide';
            } else {
                psw.type = 'password';
                show.innerText = 'Show';
            }
        }
    </script>
</body>
</html>