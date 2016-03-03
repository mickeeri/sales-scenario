@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <form method="POST" action="{{ url('/password/reset') }}">
            {!! csrf_field() !!}

            @include('unauthorized.logo')

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="input_email" type="email" name="email" placeholder="Email" value="{{ $email or old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="input_password" type="password" name="password" placeholder="Password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input id="input_password_confirm" type="password" name="password_confirmation" placeholder="Confirm Password">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group">
                <button type="submit" class="button full-width upper top-space">Reset Password</button>
            </div>
        </form>
    </div>
@endsection
