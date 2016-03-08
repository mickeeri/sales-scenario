@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <h1>Profile settings for {{ $user->username }}</h1>

        <!-- error message -->
        @if($errors->any())
            <div class="message failure">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="update-form" id="profile_form">
            {{ Form::open(array('url' => 'users/'.$user->id, 'method' => 'PUT')) }}
                {{ Form::email('email',$user->email, ['placeholder'=> 'Email', 'required']) }}
                {{ Form::password('password', ['placeholder'=> 'New Password', 'minlength'=> '6', 'autocomplete' => 'off']) }}
                {{ Form::password('password_confirmation', ['placeholder'=> 'Confirm Password', 'minlength'=> '6', 'autocomplete' => 'off' ]) }}
                {{ Form::password('current_password', ['placeholder'=> 'Current password', 'required', 'minlength'=> '6']) }}
                {{ Form::submit('Update', array('class'=>'update-btn')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection