@extends('layouts.app')

<!-- Main Content -->
@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/password/email') }}">
        {!! csrf_field() !!}

        @include('unauthorized.logo')

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" id="input_email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="button full-width upper top-space">Send Password Reset Link</button>
        </div>
        <a href="{{ url('/login') }}" class="small">Back to login page</a>
    </form>

@endsection
