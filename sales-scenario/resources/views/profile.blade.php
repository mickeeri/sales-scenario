@extends('layouts.app')

@section('content')
    <h1>Profile for {{ $user->username }}</h1>
    <hr/>

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


    <div class="update-form">
        {{ Form::open(array('url' => 'users/'.$user->id, 'method' => 'PUT')) }}

        <!-- email input -->
        {{ Form::label('email','Email') }}
        {{ Form::email('email',$user->email ) }}

        <!-- password inputs -->
        {{ Form::label('password','New Password') }}
        {{ Form::password('password','') }}

        {{ Form::label('password_confirmation','Confirm password') }}
        {{ Form::password('password_confirmation','') }}

        {{ Form::label('current_password','Current password (required)') }}
        {{ Form::password('current_password','') }}

        <!-- submit buttons -->
        {{ Form::submit('Update', array('class'=>'update-btn')) }}

        {{ Form::close() }}
    </div>
@endsection