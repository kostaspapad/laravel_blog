@extends('layouts.app')

@section('content')
    <a href="/users" class="btn btn-default">Go Back</a>
    <h1>ID: {{$user->id}}</h1>
    <h1>Name: {{$user->name}}</h1>
    <h1>Email: {{$user->email}}</h1>
    <small>Registered at {{$user->created_at}}</small>
    <h2>Send private message</h2>
    @if(!Auth::guest())
{{--  'user_id' => Auth::user()->id, 'profile_id' => $user->id  --}}
        {{--  Show only if user is not the same user  --}}
        @if(Auth::user()->id !== $user->id)
            {{--  Send current logged in user id and current page used id  --}}
            {{ Form::open(array('action' => array('MessagesController@store', 'user_sender_id' => Auth::user()->id, 'user_receiver_id' => $user->id, 'method' => 'POST'))) }}
            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
            </div>
            <div class="form-group">
                {{ Form::label('body', 'Body') }}
                {{ Form::textarea('body', '', ['class' => 'form-control',
                                            'placeholder' => 'Body Text']) }}
            </div>
            {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
        {!! Form::close() !!}
        @endif
    @endif 
@endsection