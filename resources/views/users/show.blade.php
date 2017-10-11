@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1><small>Users</small></h1>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">User information</div>
        <div class="panel-body">
            <h3><small>ID:</small> {{$user->id}}</h3>
            <h3><small>Name:</small> {{$user->name}}</h3>
            <h3><small>Email:</small> {{$user->email}}</h3>
            <small>Registered at {{$user->created_at}}</small>
        </div>
    </div>
    <hr>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Send private message</h3>
        </div>  
        <div class="panel-body">
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
                    <div class="form-group">
                        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
                        <a href="/posts" class="btn btn-default pull-right">Go Back</a>
                    </div>
                {!! Form::close() !!}
                @else
                    {{--  Insert user profile code  --}}
                @endif
            @endif 
        </div>
    </div>
@endsection