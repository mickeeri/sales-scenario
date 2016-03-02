@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <form method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            @include('unauthorized.logo')

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="input_email" type="email" name="email" placeholder="Email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="input_password" name="password" placeholder="Password" type="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group float-left">
                <div class="checkbox">
                    <label class="upper smaller" id="remember_me">
                        <input type="checkbox" name="remember"><span>Keep me logged in</span>
                    </label>
                </div>
            </div>

            <div class="form-group children-block float-right">

                <button type="submit" class="upper">Sign in</button>

                <a href="{{ url('/password/reset') }}" class="small">Forgot Your Password?</a>
            </div>
            <div class="clear"></div>
            <a href="{{ url('/register') }}" class="full-width button upper top-space" id="register_button">Register</a>

        </form>
    </div>
@endsection
