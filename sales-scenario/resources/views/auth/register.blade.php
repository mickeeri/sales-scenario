@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <form method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}

            @include('unauthorized.logo')

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <input id="input_username" type="text" minlength="2" maxlength="25" name="username" placeholder="Username" required value="{{ old('username') }}" />

                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="input_email" type="email" name="email" placeholder="Email" required value="{{ old('email') }}" />

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="input_password" type="password" name="password" minlength="6" required placeholder="Password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input id="input_password_confirmation" type="password" name="password_confirmation" minlength="6" required placeholder="Confirm Password" />

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="button full-width upper top-space" id="register_button">Register</button>
            </div>
            <a href="{{ url('/login') }}" class="small">Back to login page</a>
        </form>
    </div>
@endsection