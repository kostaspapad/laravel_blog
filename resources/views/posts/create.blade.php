@extends('layouts.app')

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">Create new post</div>
        <div class="panel-body">
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
                <div class="form-group">
                    {{ Form::label('category', 'Category') }}
                    {{--  TODO: Change the array maybe not needed  --}}
                    {{ Form::select('category', ['news' => 'News', 'sports' => 'Sports', 'tech' => 'Technology'], 'N') }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
                    <a href="/posts" class="btn btn-default pull-right">Go Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection