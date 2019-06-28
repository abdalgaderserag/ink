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
            main profile
        </div>
        <div class="main-body flew-box" style="width: 79.5461200586%;margin: 0">
            <div>
                {{-- 1/4 --}}
                <img src="/images/backgrounds/profile-image.png" width="100%" height="240px" alt="">
                <img src="/images/profiles/profile.jpeg" width="150px" height="150px" alt="">
                <input type="text" name="name" placeholder="name"><br>
                <div>
                    @<input type="text" name="slug" value="slug.name" placeholder="user.name">
                </div>
                <br>
                <textarea name="details" cols="30" rows="10" placeholder="details about the user">
                </textarea><br>
                <button>Submit</button>
            </div>
        </div>
        {{-- // end of the content--}}
    </div>
</div>
</body>
</html>
