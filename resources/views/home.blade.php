@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comments.css') }}" rel="stylesheet">
@endsection

@section('content')

    <ink-main></ink-main>


    {{--<div class="main" style="padding-top: 0">--}}
        {{--@foreach($inks as $ink)--}}
        {{--<example-component></example-component>--}}
            {{--<div>--}}
                {{--<div class="ink-card">--}}
                    {{--<img src="{{ $ink->user->avatar }}" class="card-avatar">--}}
                    {{--<div class="card-title">--}}
                        {{--<span class="name-slug">--}}
                        {{--<a href="/profile/{{ $ink->user->slug }}">--}}
                            {{--<span>{{ $ink->user->name }}</span>--}}
                        {{--</a>--}}
                        {{--<br>--}}
                        {{--<span>{{ '@'.$ink->user->slug }}</span>--}}
                    {{--</span>--}}
                    {{--</div>--}}

                    {{--<div class="card-body">--}}
                        {{--<p>{{ $ink->media->first()->text }}</p>--}}
                        {{--<div class="card-footer">--}}
                            {{--<img src="/images/hard-fill.svg" width="28px" height="24px" alt="">--}}
                            {{--<span>{{ $ink->like->count() }}</span>--}}
                            {{--<img src="/images/hard-fill-color.svg" width="28px" height="24px" alt="">--}}
                            {{--<span>{{ $ink->comment->count() }}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--
                <hr class="comments-line">
                <div class="comment flew-box">
                    <img class="comment-avatar" src="/images/profile.jpeg" alt="">
                    <div class="comment-card">
                        <div class="comment-text">
                            <span>Gadora Serag</span>
                            <p>sadas 9diyhhhhfi kjsaf jkdgfd jfjdksatfjiadgkltttttfg kgljfg</p>
                            <div class="comment-footer">
                                <img src="/images/Hard-fill.svg" width="24px" alt="">
                                <span>12</span>
                                <img src="/images/Hard-fill-color.svg" width="24px" alt="">
                                <span>12</span>
                                <a href="/share">Share</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="comments-line replies-line">
                <div class="comment reply flew-box">
                    <img class="comment-avatar" src="/images/profile.jpeg" alt="">
                    <div class="comment-card">
                        <div class="comment-text">
                            <span>Gadora Serag</span>
                            <p>sadas 9diyhhhhfi kjsaf jkdgfd jfjdksatfjiadgkltttttfg kgljfg</p>
                            <div class="comment-footer">
                                <img src="/images/Hard-fill.svg" width="24px" alt="">
                                <span>12</span>
                                <img src="/images/Hard-fill-color.svg" width="24px" alt="">
                                <span>12</span>
                                <a href="/share">Share</a>
                            </div>
                        </div>
                    </div>
                </div>--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}


@endsection
