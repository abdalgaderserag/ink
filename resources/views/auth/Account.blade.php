@extends('layouts.logs')

@section('content')


    <style>
        .log {
            margin: 3% 13.177159%;
            width: 73.645682%;
        }

        .box-title {
            margin-bottom: 18px;
        }

        .box-title h1 {
            margin: 12px 0px;
        }

        .box-title span {
            font-size: 22px;
            color: #333333a3;
        }

        .line {
            width: 15%;
            float: left;
            border-top: 4px solid #F98835;
        }
    </style>

    <div class="log">
        <div class="log-box" style="float: left;margin-right: 10px">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="log-title">
                    Sign In
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="username or email"
                       required autofocus>


                <input id="password" type="password" name="password" placeholder="password" required>


                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </form>
        </div>

        <div class="box-title">
            <h1>New to Ink?</h1>
            <span>
                Join our huge communite today by sign up in the form blow.
            </span>
        </div>


        <div class="log-box" style="float: left;margin-left: 10px">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="log-title">
                    Sign Up
                </div>

                <input id="text" type="text" name="text" placeholder="name" required>


                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="email" required>


                <input id="password" type="password" name="password" placeholder="password" required>


                <input id="password" type="password" name="password" placeholder="confirm password" required>


                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </form>
        </div>


    </div>
@endsection
