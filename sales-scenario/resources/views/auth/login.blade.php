@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <form method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            @include('unauthorized.logo')

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <input id="input_email" type="text" name="username" minlength="2" maxlength="25" placeholder="Username" value="{{ old('username') }}">

                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="input_password" name="password" minlength="6" placeholder="Password" type="password">

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
                <a href="{{ url('/register') }}" class="small" id="register_link">Register</a>
                <a href="{{ url('/password/reset') }}" class="small">Forgot Your Password?</a>
            </div>
            <div class="clear"></div>
            <button type="submit" class="full-width button upper top-space">Sign in</button>


        </form>
    </div>
@endsection
