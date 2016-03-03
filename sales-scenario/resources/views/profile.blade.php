@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <h1>Profile settings</h1>

        <!-- error message -->
        @if($errors->any())
            <div class="message failure">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <!-- success message -->
        @if(Session::has('flash_message'))
            <div class="message success">
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="update-form" id="profile_form">
            {{ Form::open(array('url' => 'users/'.$user->id, 'method' => 'PUT')) }}
                {{ Form::email('email',$user->email, ['placeholder'=> 'Email']) }}
                {{ Form::password('password', ['placeholder'=> 'New Password']) }}
                {{ Form::password('password_confirmation', ['placeholder'=> 'Confirm Password']) }}
                {{ Form::password('current_password', ['placeholder'=> 'Current password']) }}
                {{ Form::submit('Update', array('class'=>'update-btn')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection