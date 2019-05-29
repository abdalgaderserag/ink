@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="{{ asset('css/comments.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="main-container">


        <div>
            <div class="wallpaper">
                <img src="/images/profile-image.png" alt="">
            </div>
            <div class="w-line">
                {{ $user->name }}
            </div>
            <img src="/images/profile.jpeg" class="profile-avatar" alt="">

            <div class="flew-box profile-details">
                <div class="flew-box">
                    <span>Follower</span>
                    {{ $user->followed()->count() }}
                </div>
                <div class="flew-box">
                    <span>Followed</span>
                    {{ $user->follower()->count() }}
                </div>
                <div>
                    <button>
                        Follow
                    </button>
                </div>
            </div>
            <p class="details">loaslkd;j salj dklwg;kahgsok ;hpgdja;lajg lakgh;kaghklh ;koaglh</p>
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
