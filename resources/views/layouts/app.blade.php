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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Fonts */
        @font-face {
            font-family: 'Vazir';
            src: url('{{ asset('fonts/Vazir.eot') }}'),
            url('{{ asset('fonts/Vazir.woff2') }}') format('woff2'),
            url('{{ asset('fonts/Vazir.woff') }}') format('woff'),
            url('{{ asset('fonts/Vazir.ttf') }}')  format('truetype');
        }
        @font-face {
            font-family: 'Yekan';
            src: url('{{ asset('fonts/Yekan.eot') }}'),
            url('{{ asset('fonts/Yekan.woff') }}') format('woff'),
            url('{{ asset('fonts/Yekan.ttf') }}')  format('truetype');
        url('{{ asset('fonts/Yekan.svg') }}')  format('svg');
        }
        *{
            font-family: 'Vazir' , Vazir , sans-serif !important;
            font-size: 14px;
            overflow-x: hidden;
        }
        ::-webkit-scrollbar {
            width: 8px;
            background:#ccc;
            border-radius: 20px;
        }
        ::-webkit-scrollbar-thumb {
            background: #666;
            border-radius: 20px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #444;
            border-radius: 20px;
        }
    </style>
</head>
<body>
<div id="app" class="text-right">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">

        <div class="container">
            
            <a class="navbar-brand" href="{{ url('/') }}">laravel</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>
            </div>
        </div>
    </nav>
<div class="row">
    <div class="col-2 bg-dark text-light" style="font-family: 'Yekan' , Yekan , sans-serif !important;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                @guest
                    laravel
                @else
                    <img src="{{ asset('img/user.png') }}" alt="{{ Auth::user()->name }}" class="rounded-circle" style="width: 50px; height: auto">
                    <p class="text-light d-inline mr-3">{{ Auth::user()->name }}</p>
                @endguest
            </a>
            <hr class="border-light">
        </div>
        @guest
        <ul class="list-group border-0">
            <li class="list-group-item text-light bg-dark border-0">
                <a class="list-group-item text-light bg-dark " href="{{ route('login') }}">{{ __('ورود') }}</a>
            </li>
            <li class="list-group-item text-light bg-dark border-0">
                @if (Route::has('register'))
                    <a class="list-group-item text-light bg-dark" href="{{ route('register') }}">{{ __('ثبت نام') }}</a>
                @endif
            </li>
        @else
                @yield('sidebar')
            <li class="list-group-item text-light bg-dark border-0">
                <a class="list-group-item text-light bg-dark" href="{{ route('ticket.index') }}"> تیکت ها </a>
            </li>
            <li class="list-group-item text-light bg-dark border-0">
                <a class="list-group-item text-light bg-dark" href="{{ route('task.index') }}"> ورود و خروج </a>
            </li>
            <li class="list-group-item text-light bg-dark border-0">
                <a class="list-group-item text-light bg-dark" href="{{route('task.index')}}"> اطلاعات کارمندان زیر مجموعه </a>
            </li>
            <li class="list-group-item text-light bg-dark border-0">
                <a class="list-group-item text-light bg-dark" href="{{route('todo.index')}}"> Task Manager </a>
            </li>
            <li class="list-group-item text-light bg-dark border-0">
                <a class="list-group-item text-danger bg-dark" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('خروج') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        @endguest
    </div>
    <div class="col-10 mt-2">
        @guest
            @yield('LoginOrRegister')
        @else
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-light "> @yield('title')</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-light">@yield('title2') </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @yield('content2')
                        </div>
                    </div>
                </div>
            </div>
        @endguest

    </div>
</div>
</div>
</body>
</html>
