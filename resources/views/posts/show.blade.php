@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:40%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <div>
        {{--  Use {!! !!} to parse chtml because the text has e.x bold html tags that need to be parsed  --}}
        {!! $post->body !!} 
    </div>
    
    
    <hr>
    {{--  If user is not a guest show this else don't  --}}
    @if(!Auth::guest())

        {{--  Show edit/delete only if the user who created it is the active user  --}}
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
            
            {!! Form::open(['action' => ['PostsController@destroy', $post->id], '_method' => 'POST', 'class' => 'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif 
    <div class="row text-center">
        <small>{{$post->created_at}} by {{$post->user->name}}</small>
    </div>
@endsection