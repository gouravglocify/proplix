<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ProPlix - Profit margin Calculator</title>

    <!-- Scripts -->
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/gif" sizes="16x16">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--DATATABLES-->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <!---Sweet alert---->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<script type="text/javascript">
var APP_URL = {!! json_encode(url('/')) !!}
</script>

<body>
    <div id="app" style="background: #fff;">

        <main>
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
</body>
<script>
    jQuery(document).ready(function(){
        jQuery('.dataTables').DataTable({
             responsive: true
        });
    });
</script>
</html>
