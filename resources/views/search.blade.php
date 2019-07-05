@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comments.css') }}" rel="stylesheet">
@endsection


@section('header')
    <search-filter></search-filter>
    <br>
    <div class="users-view">
        <div class="follow-card flew-box" style="justify-content: safe">
            <img src="/images/profiles/profile.jpeg" style="float: left" alt="">
            <div class="flew-box">
                <span>Name Last</span>
                <span>@name.last</span>
                <button>Follow</button>
            </div>
            <img src="/images/profiles/profile.jpeg" style="float: left" alt="">
            <div class="flew-box">
                <span>Name Last</span>
                <span>@name.last</span>
                <button>Follow</button>
            </div>
            <img src="/images/profiles/profile.jpeg" style="float: left" alt="">
            <div class="flew-box">
                <span>Name Last</span>
                <span>@name.last</span>
                <button>Follow</button>
            </div>
            <img src="/images/profiles/profile.jpeg" style="float: left" alt="">
            <div class="flew-box">
                <span>Name Last</span>
                <span>@name.last</span>
                <button>Follow</button>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <ink-main></ink-main>

@endsection


@section('footer')


    <div class="media-view">
        <img src="/images/profiles/profile.jpeg" alt="">
        <video src="/images/ad.mp4" autoplay></video>
        <img src="/images/profiles/profile.jpeg" alt="">
        <img src="/images/profiles/profile.jpeg" alt="">
        <img src="/images/profiles/profile.jpeg" alt="">
        <img src="/images/profiles/profile.jpeg" alt="">
        <video src="/images/ad.mp4" autoplay></video>
        <img src="/images/profiles/profile.jpeg" alt="">
    </div>
@endsection

@section('sc')
    <script>
        // document.addEventListener('click', function (event) {
        //     if (event.path[0].className === 'tag' || event.path[0].className === 'tag active-tag') {
        //         if (event.path[0].className === 'tag') {
        //             event.path[0].innerHTML = "&dash; " + event.path[0].innerHTML;
        //             event.path[0].className += ' active-tag';
        //         } else {
        //             event.path[0].innerHTML = event.path[0].innerHTML.slice(2, event.path[0].innerHTML.length);
        //             event.path[0].className = 'tag'
        //         }
        //     }
        // });
    </script>
@endsection