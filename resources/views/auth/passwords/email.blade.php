@extends('layouts.logs')

@section('content')

    <style>
        .log-box{
            width: 100%;
        }
        .log-box button {
            width: 50%;
            margin-left: 25%;
            font-size: 14px;
        }
        .log{
            width: 40%;
            margin-left: 27%;
            margin-top: 7%;
        }

        .footer{
            margin-top: 120px;
        }
    </style>
    <div class="log">
        <div class="log-box">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="log-title">
                    Reset Password
                </div>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{ old('email') }}" required>


                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>
        </div>
    </div>

@endsection
