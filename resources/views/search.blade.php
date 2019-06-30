@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comments.css') }}" rel="stylesheet">
@endsection


@section('header')
    <div class="search-section">
        <input type="search" class="input-text" name="search" id="">
        <hr class="config-line">
        <span class="config-text" onclick="filter()">Config &blacktriangledown;</span>
        <div class="filters">
            <span class="title">type :</span>
            <br>
            <a class="tag">person</a> <a class="tag">Ink</a><a class="tag">photo</a><a class="tag">video</a><a
                    class="tag">hash tag</a>
            <br><br>
            <span class="title">time :</span>
            <br>
            <a class="tag">today</a> <a class="tag">this week</a><a class="tag">this month</a><a class="tag">this
                year</a>
        </div>
    </div>
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
        let showFilter = true;
        document.addEventListener('click', function (event) {
            if (event.path[0].className === 'tag') {
                event.path[0].innerHTML = "&dash; " + event.path[0].innerHTML;
                event.path[0].className += ' active-tag';
            }
        });

        function filter() {
            showFilter = !showFilter;
            if (showFilter) {
                document.getElementsByClassName('filters')[0].style.display = "none"
            } else {
                document.getElementsByClassName('filters')[0].style.display = "block"
            }
        }
    </script>
@endsection