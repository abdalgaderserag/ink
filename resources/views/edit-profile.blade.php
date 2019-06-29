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


</head>
<body bgcolor="#f2f2f2">
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
            <a href="/profile" style="width: 58px;height: 58px;">
                <img src="{{ \Illuminate\Support\Facades\Auth::user()->avatar }}" style="width: 58px;height: 58px"
                     class="icon">
            </a>

            <img src="/images/notification.svg"
                 onclick="var notification =
                 document.getElementsByClassName('notification')[0];
                 notification.style.display == 'none'?
                 notification.style.display = 'block'
                 :notification.style.display = 'none';"
                 class="icon">


            <div class="icon">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <hr class="line">
                    <hr class="line">
                    <hr class="line">
                </a>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="container flew-box">
        {{-- // MAin content in the page --}}
        <div style="width: 10%;padding-top: 20px;margin-left: 8px;padding-left: 6px;">
        </div>
        <div class="main-body flew-box" style="width: 79.5461200586%;margin:0;margin-bottom: 60px;padding-bottom: 40px">
            <div>
                <div style="width: 79.5%;height: 240px;background-color: rgba(119,119,119,0.51);position: absolute">
                    {{--<div style="border: 2px solid #FFFFFF;width: 10%;height: 36px;margin-left: 44%;margin-top: 100px">Change Image</div>--}}
                </div>
                <img class="images" src="{{ \Illuminate\Support\Facades\Auth::user()->background }}" width="100%"
                     height="240px"
                     style="margin-bottom: 40px"
                     alt="">
                <div style="float: left;width: 150px">
                    <img class="images" src="{{ \Illuminate\Support\Facades\Auth::user()->avatar }}"
                         style="border-radius: 20px;margin-bottom: 8px" width="150px" height="150px" alt="">
                    <hr>
                    <span>{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                    <span style="color: #636b6f;font-size: 15px;">{{ '@' . \Illuminate\Support\Facades\Auth::user()->slug }}</span>
                    <hr>
                    <span>{{ \Illuminate\Support\Facades\Auth::user()->details }}</span>
                </div>
                <form action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="text" class="text-input" name="name" placeholder="name"
                           value="{{ \Illuminate\Support\Facades\Auth::user()->name }}"><br>
                    <input type="text" class="text-input" name="slug"
                           value="{{ \Illuminate\Support\Facades\Auth::user()->slug }}" placeholder="user.name">
                    <textarea name="details" class="text-input" cols="30" rows="10"
                              placeholder="details about the user">{{ \Illuminate\Support\Facades\Auth::user()->details }}</textarea><br>
                    <input type="submit" class="input-text" value="Submit">
                </form>
            </div>
        </div>
        {{-- // end of the content--}}
    </div>
</div>
</body>

<style>
    .text-input {
        width: 82%;
        margin-bottom: 12px;
        float: right;
        font-size: 16px;
        padding: 12px;
        border: 2px solid #d2d2d2;
        border-radius: 4px;
    }


    .input-bottom {
        width: 84.6%;
        margin-bottom: 12px;
        float: right;
        font-size: 16px;
        padding: 12px;
        border-width: 0;
        border-radius: 4px;
    }
</style>
</html>
