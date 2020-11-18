<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/gif" sizes="16x16">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <!---Sweet alert---->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div  style="background: #fff;">
        <div class="main-navbar">
            <ul>
                <li class="logo-img">
                    <a href="{{url('')}}">
                        <img src="{{asset('images/logo1.png')}}" width="42" height="42">
                        <span class="logo-text ">
                            {{ucwords(strtolower(env('APP_NAME')))}}
                            <span class="small-tag">Beta v.0.1</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <main>
            @yield('content')
        </main>

        @include('layouts.footer')

    </div>
</body>
</html>
