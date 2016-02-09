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

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="input_email">E-Mail Address</label>

            <input id="input_email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit">Send Password Reset Link</button>
        </div>
    </form>

@endsection
