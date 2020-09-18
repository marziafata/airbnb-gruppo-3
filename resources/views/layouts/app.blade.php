<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

     <!-- Leaflet Js -->
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
     integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
     crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f25fd8a42.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js">

    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="logo-wrap d-flex align-items-center h-100">
                        <img class="img-fluid" src="{{asset('/storage/image/logo.png')}}" alt="logo">
                    </div>
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item mr-4">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Diventa un host') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="sidebar-header d-flex align-items-center">
                                    {{-- mostra avatar solo se presente --}}
                                    @if (Auth::user()->avatar)
                                        <img class="rounded-circle center-cropped" src="{{asset('/storage/image/' . Auth::user()->avatar)}}" alt="avatar">
                                    {{-- altrimenti non mostra nulla --}}
                                    @endif
                                        <p class="nome-admin">{{Auth::user()->name . ' ' . Auth::user()->lastname}}</p>
                                        <span class="caret fa-2x"></span>
                                    </div>
                                </a>

                                <div id="drop-home" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.home') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
                <div id="toggle" class="p-4 d-md-none">
                    <a id="panino" href="#">
                        <i class="fas fa-2x fa-bars"></i>
                    </a>

                    <div class="hamburger-menu">
                        <ul class="">
                            <!-- Authentication Links -->
                            @guest
                            <li class="voce-menu">
                                    <a href="{{ route('login') }}">
                                        <span class="icon pr-2"><i class="fas fa-home"></i></span>
                                        <span class="title">{{ __('Login') }}</span>
                                    </a>
                                </li>
                            @if (Route::has('register'))
                                <li class="voce-menu">
                                    <a href="{{ route('register') }}">
                                        <span class="icon pr-2"><i class="fas fa-user"></i></span>
                                        <span class="title">{{ __('Diventa un host') }}</span>
                                    </a>
                                </li>
                            @endif
                            @else
                                <li class="voce-menu">
                                    <a href="{{ route('admin.home') }}">
                                        <span class="icon pr-2"><i class="fas fa-list"></i></span>
                                        <span class="title">{{ __('Dashboard') }}</span>
                                    </a>
                                </li>
                                <li class="voce-menu">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="icon pr-2"><i class="fas fa-sign-out-alt"></i></span>
                                        <span class="title">Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                            </ul>
                        <a class="close">
                            <i id="close" class="fas fa-times"></i>
                        </a>

                    </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('partials.footer')

    @yield('script')
</body>
</html>
