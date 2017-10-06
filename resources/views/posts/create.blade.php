@extends('layouts.app')

@section('content')
    <h1>Create private message</h1>

    {{--  Form for creating messages. After submit, the store() function of PostsController is executed  --}}
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', '', ['id' => 'article-ckeditor',
                                          'class' => 'form-control',
                                          'placeholder' => 'Body Text']) }}
        </div>
        <div class="form-group">
            {{ Form::file('cover_image') }}
        </div>
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection