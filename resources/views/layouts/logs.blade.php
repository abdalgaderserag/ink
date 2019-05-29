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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/logs.css') }}" rel="stylesheet">


    <style>
        body {
            margin: 0px;
            padding: 0px;
            font-family: sans-serif;

        }

        .nav-bar {
            width: 100%;
            height: 90px;
            font-size: 13px;
            font-weight: 400;
            /*text-align: center;*/
            line-height: 18px;
            color: #333333;
            background: linear-gradient(to right, #F98835, #FC4027);
            /*background-position: left top;*/
            border-bottom: 6px solid #F98835;
            /*box-shadow: 0px 2px 15px -5px #F98835;*/
        }

        .title {
            width: 12.591508%;
            height: 50px;
            font-size: 32px;
            font-weight: 600;
            text-align: center;
            padding-top: 20px;
            line-height: 46px;
            color: #FFFFFF;
        }

        .board {
            width: 74.816944%;
            background-color: #fff;
        }

        .log-box {
            width: 349px;
            background-color: #FFFFFF;
            padding: 68px;
            border-top: #F98835 solid 8px;
        }

        .log-title {
            width: 100%;
            text-align: center;
            font-size: 38px;
        }

        .log-box input {
            width: 100%;
            margin-top: 32px;
            font-size: 16px;
            padding: 12px;
            border: 2px solid #d2d2d2;
            border-radius: 4px;
        }

        .log-box button {
            width: 30%;
            margin-left: 35%;
            margin-top: 32px;
            font-size: 16px;
            text-align: center;
            color: #FFFFFF;
            background: linear-gradient(to right, #FD2220, #F98835);
            border: 0px solid #404040;
            border-radius: 4px;
            padding: 12px;
        }


        .footer{
            background-color: #333333;
            width: 100%;
            height: 180px;
            margin-top: 45.95997%;
        }
    </style>


</head>
<body bgcolor="#f2f2f2">
<div class="nav-bar">
    <div class="title">
        Ink .
    </div>
    {{--@guest--}}

    {{--<a href="{{ route('login') }}">{{ __('Login') }}</a>--}}

    {{--@if (Route::has('register'))--}}
    {{--<a href="{{ route('register') }}">{{ __('Register') }}</a>--}}
    {{--@endif--}}

    {{--@else--}}


    {{--<a href="{{ route('logout') }}"--}}
    {{--onclick="event.preventDefault();--}}
    {{--document.getElementById('logout-form').submit();">--}}
    {{--{{ __('Logout') }}--}}
    {{--</a>--}}

    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
    {{--@csrf--}}
    {{--</form>--}}

    {{--@endguest--}}
</div>

<main class="py-4" style="width: 100%;">
    @yield('content')
</main>

<div class="footer">

</div>

</body>
</html>
