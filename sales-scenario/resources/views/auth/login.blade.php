@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="input_email">E-Mail Address</label>
            <input id="input_email" type="email" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="input_password">Password</label>
            <input id="input_password" name="password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </div>

        <div class="form-group">

            <button type="submit">Login</button>

            <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </div>
    </form>

@endsection
