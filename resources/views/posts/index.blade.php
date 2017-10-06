@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        <div class="row">
            {{--  {{ Form::open(['action' => 'SearchController@search'], 'method' => 'POST') }}  --}}
            {{--  {!! Form::open(array('action' => 'SearchController@search')) !!}
                {!! Form::text('searchString', 'Search') !!}
            {!! Form::close() !!}  --}}
            <br><br>
        </div>
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:30%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div>
                
            </div>
        @endforeach

        {{--  To make a paginator.Must have paginate function on controller  --}}
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif

@endsection