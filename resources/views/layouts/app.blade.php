<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        function lineHe(number = 0) {
            app.$children[2].$children[number].$children[0].$refs.line.parentElement.style.display = "block";
            return app.$children[2].$children[number].$children[0].$refs.end[0].$el.offsetTop -
                app.$children[2].$children[number].$children[0].$refs.line.offsetTop;
        }
    </script>
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
            <a href="/profile" style="width: 58px;height: 58px;">
                <img src="/images/profile.jpeg" style="width: 58px;height: 58px" class="icon">
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

        <div class="ink" onclick="inkForm('ink')">

        </div>
    </div>
</div>
</body>
@yield('sc')

<script>

    function inkForm(type, media) {
        document.getElementById('pop-main').style.display = "block";
        app.$children[0].type = type;
        app.$children[0].media = media[0];

    }

    // let section = ''
    // document.addEventListener('click',function (event) {
    //     section = event.target.parentElement.parentElement.parentElement.innerHTML
    //     document.getElementById('reply-section').innerHTML = section;
    // });


    let app = new Vue({
        el: "#app",
        data: {
            images: [],
            imageNames: [],
            access_token: '{{ $access }}',
            id: '{{ \Illuminate\Support\Facades\Auth::id() }}',
            slug: '{{ \Illuminate\Support\Facades\Auth::user()->slug }}'
        },
        mounted() {
            window.axios.defaults.headers.common["Authorization"] = "Bearer " + this.access_token;
            // axios.get('/oauth/personal-access-tokens')
            //     .then((response) => {
            //         this.access_token = response.data[0].id
            //     })
        }
    });
</script>
</html>
