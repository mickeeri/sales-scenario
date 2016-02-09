@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ url('/password/reset') }}">
        {!! csrf_field() !!}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="input_email">E-Mail Address</label>
            <input id="input_email" type="email" name="email" value="{{ $email or old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="input_password">Password</label>
            <input id="input_password" type="password" name="password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="input_password_confirm">Confirm Password</label>
            <input id="input_password_confirm" name="password_confirmation">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group">
            <button type="submit">Reset Password</button>
        </div>
    </form>

@endsection
