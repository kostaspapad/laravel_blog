@extends('layouts.app')

@section('content')
    <h1>Edit post</h1>

    {{--  Form for editing posts. After submit the update() function of PostsController is executed. 
          In order for the update function to know witch post to update it needs an id of the function.
          The id is sent in the Form::open(['action']) function. 
          A hidden field is needed for the POST request to work. Because the route for the update function
          supports only PUT and PATCH requests. So a hidden input is spoofing the PUT request.
    --}}
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor',
                                          'class' => 'form-control',
                                          'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        
    {!! Form::close() !!}

@endsection