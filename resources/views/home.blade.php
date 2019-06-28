@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comments.css') }}" rel="stylesheet">
@endsection

@section('content')
    <ink-main></ink-main>
@endsection
