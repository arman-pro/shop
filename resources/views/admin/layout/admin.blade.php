<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')-Dashboard</title>
    @yield('head')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="m-0 p-0 box-border">
    <!-- main menu -->
    <div id="dash-menu" class="fixed top-0 left-0 bottom-0 w-60 bg-gray-600 text-white overflow-hidden " style="transition: 0.5s;">
        <div class="top-bar w-60 px-5 py-1 text-lg cursor-default w-60 ">
            <img class="object-cover border border-gray-400 m-auto" style="width:50px;height:50px;border-radius:50%;" src="{{ asset('./storage/admin/profile.png') }}" alt="Prifile Image">
            <p class="text-sm mt-3 w-60">
                @auth
                {{auth()->user()->fName}}
                {{auth()->user()->lName}}
                @endauth
            </p>
            <p class="text-xs w-60">
                @can('admin')
                    Admin
                @endcan
            </p>
        </div>
        <div class="menu">
            <ul class="list-none m-0 p-0 text-base text-white text-semilbold">
                <li class="block w-60">
                    <a href="/admin" class="block px-5 py-3 hover:bg-gray-200 hover:text-black cl">
                       <i class="fa fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="block w-60">
                    <a href="/admin/products" class="block px-5 py-3 hover:bg-gray-200 hover:text-black">
                       <i class="fa fa-product-hunt"></i> Products
                    </a>
                </li>
                <li class="block w-60">
                    <a href="{{ route('order') }}" class="block px-5 py-3 hover:bg-gray-200 hover:text-black">
                       <i class="fa fa-list"></i> Order
                    </a>
                </li>
                <li class="block w-60">
                    <a href="/admin/users" class="block px-5 py-3 hover:bg-gray-200 hover:text-black">
                       <i class="fa fa-user"></i> User
                    </a>
                </li>
                <li class="block w-60">
                    <a href="{{ route('admin.general') }}" class="block px-5 py-3 hover:bg-gray-200 hover:text-black">
                       <i class="fa fa-gear"></i> General
                    </a>
                </li>
                <li class="block w-60">
                    <a href="#" class="block px-5 py-3 hover:bg-gray-200 hover:text-black">
                       <i class="fa fa-print"></i> Report
                    </a>
                </li>
                <li class="block w-60">
                    <a href="{{ route('/') }}" target="_blank" class="block px-5 py-3 hover:bg-gray-200 hover:text-black">
                       <i class="fa fa-eye"></i> Site
                    </a>
                </li>
                <li class="block w-60">
                    <a title="Logout and page exit" href="#" target="_blank" class="block px-5 py-3 hover:bg-gray-200 hover:text-black">
                       <i class="fa fa-power-off"></i> Power Off
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- main content area -->
    <div id="main-content" class="mr-0 ml-60 ">
        <div class="top-bar w-full flex justify-between p-5 border-0 border-b border-gray-100 text-sm ">
            <div>
                <ul class="list-none m-0 p-0">
                    <li class="float-left" >
                        <button id="menu-left-arrow" class=" px-5 py-1 bg-white text-semilbold text-black outline-none focus:outline-none"><i class="fa fa-arrow-left"></i></button>
                    </li>
                    <li class="float-left" >
                        <button id="menu-right-arrow" class="hidden px-5 py-1 bg-white text-semilbold text-black outline-none focus:outline-none"><i class="fa fa-arrow-right"></i></button>
                    </li>
                    <li class="float-left" >
                        <button class=" px-5 py-1 bg-white text-semilbold text-black outline-none focus:outline-none"><i class="fa fa-search"></i></button>
                    </li>
                    <!-- <li class="float-left" >
                        <input type="text" name="searh" class="px-5 py-1 border border-gray-200 rounded outline-none focus:outline-none " />
                    </li> -->
                </ul>
            </div>
            <div >
                <ul class="list-none m-0 p-0">
                    <li class="float-left" >
                        <button class=" px-5 py-1 bg-white text-semilbold text-black outline-none focus:outline-none"><i class="fa fa-envelope"></i></button>
                    </li>
                    
                    <li class="float-left relative " >
                        <button id="notification-button" class="px-5 py-1 bg-white text-semilbold text-black outline-none focus:outline-none"><i class="fa fa-bell"></i></button>

                        <div id="notification-box" class="w-auto absolute rounded border border-gray-400 text-semilbold shadow-2xl z-10 " style="display:none; top: 55px;right:0px; min-width:350px;transition:1s;" >
                            <div class="text-sm px-2 py-3 sticky right-0 top-0 left-0 bg-gray-300 z-15" >
                                Notifcation
                            </div>
                            <hr class="border-gray-400" />
                            <div class="divide-y divide-gray-500 overflow-hidden overflow-y-scroll" style="max-height:350px;">
                                 <div class="px-2 py-3">
                                    <a href="#" class="-space-y-2">
                                        <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                         <p><small class="text-gray-400">1 min age</small></p></a>
                                 </div>
                                 <div class="px-2 py-3">
                                     <a href="#" class="-space-y-2">
                                         <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                          <p><small class="text-gray-400">1 min age</small></p></a>
                                  </div>
                                  <div class="px-2 py-3">
                                     <a href="#" class="-space-y-2">
                                         <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                          <p><small class="text-gray-400">1 min age</small></p></a>
                                  </div>
                                  <div class="px-2 py-3">
                                     <a href="#" class="-space-y-2">
                                         <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                          <p><small class="text-gray-400">1 min age</small></p></a>
                                  </div>
                                  <div class="px-2 py-3">
                                     <a href="#" class="-space-y-2">
                                         <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                          <p><small class="text-gray-400">1 min age</small></p></a>
                                  </div>
                                  <div class="px-2 py-3">
                                     <a href="#" class="-space-y-2">
                                         <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                          <p><small class="text-gray-400">1 min age</small></p></a>
                                  </div>
                                  <div class="px-2 py-3">
                                     <a href="#" class="-space-y-2">
                                         <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                          <p><small class="text-gray-400">1 min age</small></p></a>
                                  </div>
                                  <div class="px-2 py-3">
                                     <a href="#" class="-space-y-2">
                                         <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                          <p><small class="text-gray-400">1 min age</small></p></a>
                                  </div>
                                  <div class="px-2 py-3">
                                     <a href="#" class="-space-y-2">
                                         <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                          <p><small class="text-gray-400">1 min age</small></p></a>
                                  </div>
                                  <div class="px-2 py-3">
                                     <a href="#" class="-space-y-2">
                                         <p><span class="text-gray-800 text-sm">Mohammad Arman Ali</span> <small>Purches her cart</small></p>
                                          <p><small class="text-gray-400">1 min age</small></p></a>
                                  </div> 
                                </div>
                            </div>
                    </li>

                    <li class="float-left relative ">
                        <button id="profile-show" class="px-5 py-1 border bg-white text-semilbold text-black rounded outline-none focus:outline-none"> <i class="fa fa-caret-down"></i> </button>
                        <!-- profile card -->
                        <div id="profile-card" class="w-auto absolute rounded p-5 border-0 border-gray-400 bg-gray-700 text-semilbold text-white shadow-2xl z-10" style="top: 55px;right:0px; min-width:170px;display: none;transition:1s;" >
                            <a class="block py-1 hover:text-red-600" href="#">Profile</a>
                            <a class="block py-1 hover:text-red-600" href="#">Account Setting</a>
                            <a class="block py-1 hover:text-red-600" href="./admin/logout">Logout</a>
                        </div>
                    </li>
                </ul>

               


                
            </div>
        </div>
        <div class="w-full p-5 overflow-hidden">
           @yield('content')
        </div>
    </div>
<script src={{ asset('js/app.js') }}></script>

<script>
    /**
 * admin panel
 */
var profileCard = document.querySelector("#profile-card");
var profileButton = document.querySelector("#profile-show");

profileButton.onclick = function () {
    if (profileCard.style.display == "none") {
        profileCard.style.display = "block";
    } else {
        profileCard.style.display = "none";
    }
};

// dashboard menu
var notiBox = document.querySelector("#notification-box");
var notiButton = document.querySelector("#notification-button");

notiButton.onclick = function () {
    if (notiBox.style.display == "none") {
        notiBox.style.display = "block";
    } else {
        notiBox.style.display = "none";
    }
};

// dashboard menu
var dashMenu = document.querySelector("#dash-menu");
var menuRightArrow = document.querySelector("#menu-right-arrow");
var menuLeftArrow = document.querySelector("#menu-left-arrow");
var mainContent = document.querySelector("#main-content");

menuLeftArrow.onclick = function () {
    dashMenu.style.width = "0";
    mainContent.style.marginLeft = "0";
    menuRightArrow.style.display = "block";
    menuLeftArrow.style.display = "none";
};

menuRightArrow.onclick = function () {
    dashMenu.style.width = "15rem";
    mainContent.style.marginLeft = "15rem";
    menuRightArrow.style.display = "none";
    menuLeftArrow.style.display = "block";
};

</script>

</body>
</html>