<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ProPlix - Profit margin Calculator</title>

    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/gif" sizes="16x16">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!---Sweet alert---->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div id="app" style="background: #fff;">
        <!--================Header Menu Area =================-->
        <div class="main-navbar">
            <ul>
                <li class="logo-img">
                    <a href="{{url('')}}">
                        <img src="{{asset('images/logo1.png')}}" width="42" height="42">
                        <span class="logo-text">
                            {{ucwords(strtolower(env('APP_NAME')))}}
                            <span class="small-tag">Beta v.0.1</span>
                        </span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                @if(is_null($userDetails))
                    <a class="nav-link login-btn" href="{{url('login')}}"><span>Login</span></a>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{ ucwords(strtolower(Auth::user()->name)) }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('dashboard')}}">Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('logout') }}"onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
        <!--================Header Menu Area =================-->

        <main>
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
</body>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#navbarDropdown').click(function(){
            jQuery(".dropdown-menu").toggle();
        })
    });
</script>
</html>
