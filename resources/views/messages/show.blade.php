@extends('layouts.app')

@section('content')
    <a href="/messages" class="btn btn-default">Go Back</a>
    <h1>{{$message->title}}</h1>
    <br>
    <hr>
    <div>
        {{--  Use {!! !!} to parse chtml because the text has e.x bold html tags that need to be parsed  --}}
        {!! $message->body !!} 
    </div>

    {{--  If user is not a guest show this else don't  --}}
    @if(!Auth::guest())
        {{--  Show edit/delete only if the user who created it is the active user  --}}
        @if(Auth::user()->id == $message->user_id)
            <a href="/message/{{$message->id}}/edit" class="btn btn-default">Edit</a>
            
            {!! Form::open(['action' => ['MessagesController@destroy', $message->id], '_method' => 'POST', 'class' => 'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif 

@endsection