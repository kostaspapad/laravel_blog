@extends('layouts.app')

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">{{$post->title}}</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4"> 
                    <img style="width:80%" src="/storage/cover_images/{{$post->cover_image}}">
                </div>
                <div class="col-md-8">
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
                            <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
                            
                            {!! Form::open(['action' => ['PostsController@destroy', $post->id], '_method' => 'POST', 'class' => 'pull-right']) !!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!! Form::close() !!}
                        @endif
                    @endif 
                    <div class="row">
                        <small>{{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div>
            </div>
            <br>
            <a href="/posts" class="btn btn-default">Go Back</a>
        </div>
    </div>
@endsection