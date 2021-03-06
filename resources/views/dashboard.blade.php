@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{--  Show only if user has create permissions  --}}
                    @if(Entrust::can('create'))
                        <a href="/posts/create" class="btn btn-primary">Create post</a>
                    @endif
                    <h1>Your blog posts</h1>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        {{--  Show only if user has edit permissions  --}}
                                        @if(Entrust::can('edit'))
                                            <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{--  Show only if user has delete permissions  --}}
                                        @if(Entrust::can('delete'))
                                            {!! Form::open(['action' => ['PostsController@destroy', $post->id], '_method' => 'POST', 'class' => 'pull-right']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
