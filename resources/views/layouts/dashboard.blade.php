<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f25fd8a42.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
     <!-- Algolia prova -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 sidebar">
                <ul>
                    <li class="mt-3">
                        <p>
                            <span class="icon"><i class="far fa-laugh-wink"></i></span>
                            <span class="title">Ciao {{ Auth::user()->name }}</span>
                        </p>
                    </li>
                    <li>
                        <a href="{{ route('home') }}">
                            <span class="icon"><i class="fas fa-home"></i></span>
                            <span class="title">Visita il sito</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.home') }}">
                            <span class="icon"><i class="fas fa-user"></i></span>
                            <span class="title">Profilo</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.apartments.index') }}">
                            <span class="icon"><i class="fas fa-clipboard-list"></i></span>
                            <span class="title">Appartamenti</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                            <span class="title">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            {{-- <div class="toggle">

            </div> --}}
            <div class=" col-9 text-center">
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>
