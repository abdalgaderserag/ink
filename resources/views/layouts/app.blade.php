<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pop-up.css') }}" rel="stylesheet">
    @yield('styles')


</head>
<body bgcolor="#f2f2f2">
{{--
<div class="pop-main">
    <div class="pop-card">
        <textarea cols="124" rows="12" class="text-input"></textarea>
        <textarea cols="124" rows="12" class="text-input"></textarea>
        <input type="button" value="Ink It !">
    </div>
</div>
--}}

<div id="app">
    <pop-up></pop-up>
    <notification-main></notification-main>

    <div class="nav-bar flew-box">
        <div class="nav-bar-l flew-box">
            <div class="title">
                <a href="/home">Ink.</a>
            </div>
            <input type="search" placeholder="S e a r c h">
        </div>
        <div class="icon-menu flew-box">
            <img src="/images/profile.jpeg" class="icon">

            <img src="/images/notification.svg"
                 onclick="var notification =
                 document.getElementsByClassName('notification')[0];
                 notification.style.display == 'none'?
                 notification.style.display = 'block'
                 :notification.style.display = 'none';"
                 class="icon">

            <div class="icon">
                <hr class="line">
                <hr class="line">
                <hr class="line">
            </div>
        </div>
    </div>
    <div class="container flew-box">
        <div class="main-body">
            @yield('content')
        </div>

        <div class="follow-card">
        <span class="follow-card-title">
            Sugested
        </span><br>
            <img src="/images/profile.jpeg" style="float: left" alt="">
            <div class="flew-box">
                <span>Name Last</span>
                <span>@name.last</span>
                <button>Follow</button>
            </div>
        </div>

        <div class="ink" onclick="inkForm()">

        </div>
    </div>
</div>
</body>
<script>
    function inkForm() {
        document.getElementById('pop-main').style.display = "block"
    }

    let app = new Vue({
        el: "#app",
        data: {
            images: [],
            imageNames: [],
            api_token: '{{ \Illuminate\Support\Facades\Auth::user()->api_token }}',
        }
    });
</script>
</html>
