@extends('layouts.app')

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">{{$message->title}}</div>
        <div class="panel-body">
            <br>
            <div>
                {{--  Use {!! !!} to parse chtml because the text has e.x bold html tags that need to be parsed  --}}
                {!! $message->body !!} 
            </div>

            {{--  If user is not a guest show this else don't  --}}
            @if(!Auth::guest())
                
                {{--  Show edit/delete only if the user who created it is the active user  --}}
                @if(Auth::user()->id == $message->user_receiver_id)
                    <hr>
                    <a href="/message/{{$message->id}}/edit" class="btn btn-warning">Edit</a>
                    
                    {!! Form::open(['action' => ['MessagesController@destroy', $message->id], '_method' => 'POST', 'class' => 'pull-right']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!! Form::close() !!}
                    <a href="/dashboard" class="btn btn-default">Go Back</a>
                    
                @endif

            @endif 
            
        </div>
    </div>
@endsection