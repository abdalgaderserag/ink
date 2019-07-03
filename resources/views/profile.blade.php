@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        .main-body {
            box-shadow: unset;
        }
    </style>
    <link href="{{ asset('css/comments.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="main-container">


        <div>
            <div class="wallpaper">
                <img src="{{ $user->background }}" alt="">
            </div>
            <div class="w-line">
                {{ $user->name }}
            </div>
            <img src="{{ $user->avatar }}" class="profile-avatar" alt="">

            <div class="flew-box profile-details">
                <div class="flew-box" id="followers">
                    <span>Followers</span>
                    {{ $user->follower()->count() }}
                </div>
                <div class="flew-box">
                    <span>Followed</span>
                    {{ $user->followed()->count() }}
                </div>
                <div class="notify-button">
                    <img id="notify-icon" onclick="showNotify()" src="/images/notify.svg" alt="">
                    <div id="notify-menu">
                        <a onclick="sendNotify(1)">See first</a><br>
                        <hr>
                        <a onclick="sendNotify(2)">View</a><br>
                        <hr>
                        <a onclick="sendNotify(3)">Not interested</a>
                    </div>
                </div>
                <div>
                    @if($user->slug != \Illuminate\Support\Facades\Auth::user()->slug)
                        <button id="follow" onclick="follow()">
                            @empty(\Illuminate\Support\Facades\Auth::user()->followed()->where('follower_id',$user->id))
                                Follow
                            @else
                                Unfollow
                            @endempty
                        </button>
                    @endif
                </div>
            </div>
            <p class="details">{{ $user->details }}</p>
        </div>


        <div class="profile-main">
            <div class="profile-menu">
                <button class="active">Inks and shared</button>
                <button>Inks</button>
                <button>Images</button>
                <button>Stared</button>
            </div>
        </div>
        <ink-main></ink-main>
    </div>
@endsection

@section('sc')
    <script>
        let follower = {{ $user->follower()->count() }};

        document.getElementById('notify-menu').style.display = "none";

        function showNotify() {
            let notify = document.getElementById('notify-menu');
            if (notify.style.display === "none") {
                notify.style.display = "block"
            } else
                notify.style.display = "none"
        }

        function sendNotify(number) {
            axios.post('/api/interest', {
                'id': number,
                'user_id': '{{ $user->id }}'
            }).then((response)=>{
                showNotify();
            });
        }

        function follow() {
            axios.post('/api/follow', {
                'id': {{ $user->id }},
            }).then((response) => {
                if (document.getElementById('follow').innerText === "Follow") {
                    document.getElementById('follow').innerText = "Unfollow";
                    follower++;
                    document.getElementById('followers').innerHTML = '<span>Followers</span>' + follower;
                } else {
                    document.getElementById('follow').innerText = "Follow";
                    follower--;
                    document.getElementById('followers').innerHTML = '<span>Followers</span>' + follower;
                }
            })
        }
    </script>
@endsection