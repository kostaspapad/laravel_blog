@extends('layouts.app')

@section('content')
    <div class="row">
        @if(Entrust::hasRole(['owner', 'admin', 'user']))
            <input type="text" class="form-control" id="description" name="searchBoxPosts" placeholder="Description" value="">
        @endif
        <br>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">Posts</div>
        <div id="searchContainer" class="panel-body">
            @if(count($posts) > 0)
                @foreach($posts as $post)
                    {{--  For administrator show all posts (active/in-active) and option to toggle active state  --}}
                    @if(Entrust::hasRole('admin'))
                        <div class="well">
                            <div class="row">
                                <div class="col-md-1 col-sm-1">
                                    {{--  Container has an id similar to post for updating the number of votes after ajax  --}}
                                    <div id="vote-container">
                                        <ul>
                                            <li>
                                                <div class="glyphicon glyphicon-arrow-up text-primary" onclick="upvote({{$post->id}},{{Auth::user()->id}})"></div>
                                            </li>
                                            <li>
                                                {{--  This is the number below the up arrow  --}}
                                                @if($post->upvotes - $post->downvotes > 0)
                                                    <b id="post-votes-{{$post->id}}" class="vote-counter text-primary">  {{$post->upvotes - $post->downvotes}}</b>
                                                @elseif($post->upvotes - $post->downvotes < 0)
                                                    <b id="post-votes-{{$post->id}}" class="vote-counter text-danger">{{$post->upvotes - $post->downvotes}}</b>
                                                @else
                                                    <b id="post-votes-{{$post->id}}" class="vote-counter text-default">{{$post->upvotes - $post->downvotes}}</b>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="glyphicon glyphicon-arrow-down text-danger" onclick="downvote({{$post->id}},{{Auth::user()->id}})"></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <img style="width:80%" src="/storage/cover_images/{{$post->cover_image}}">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                    <hr>
                                    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                                </div>
                            </div>
                            @if($post->active)
                                <a class="btn btn-xs btn-warning" href="{{ URL::to('toggle/' . $post->id ) }}">De-activate</a>
                            @else
                                <a class="btn btn-xs btn-info" href="{{ URL::to('toggle/' . $post->id ) }}">Activate</a>
                            @endif
                        </div>
                    @else
                        {{--  For user show only active posts  --}}
                        @if($post->active)
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-1 col-sm-1">
                                        {{--  Container has an id similar to post for updating the number of votes after ajax  --}}
                                        <div id="vote-container">
                                            <ul>
                                                <li>
                                                    <div class="glyphicon glyphicon-arrow-up text-primary" onclick="upvote({{$post->id}},{{Auth::user()->id}})"></div>
                                                </li>
                                                <li>
                                                    {{--  This is the number below the up arrow  --}}
                                                    @if($post->upvotes - $post->downvotes > 0)
                                                        <b id="post-votes-{{$post->id}}" class="vote-counter text-primary">  {{$post->upvotes - $post->downvotes}}</b>
                                                    @elseif($post->upvotes - $post->downvotes < 0)
                                                        <b id="post-votes-{{$post->id}}" class="vote-counter text-danger">{{$post->upvotes - $post->downvotes}}</b>
                                                    @else
                                                        <b id="post-votes-{{$post->id}}" class="vote-counter text-default">{{$post->upvotes - $post->downvotes}}</b>
                                                    @endif
                                                </li>
                                                <li>
                                                    <div class="glyphicon glyphicon-arrow-down text-danger" onclick="downvote({{$post->id}},{{Auth::user()->id}})"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <img style="width:80%" src="/storage/cover_images/{{$post->cover_image}}">
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                        <hr>
                                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                                    </div>
                                </div>
                            </div>
                        @endif 
                    @endif
                @endforeach
                {{--  To make a paginator.Must have paginate function on controller  --}}
                <div class="row">
                    <div class="col-md-6">
                        {{$posts->links()}}
                    </div>
                    <div class="col-md-6">
                        <a href="/posts" class="btn btn-default pull-right">Go Back</a>
                    </div>
                </div>
            @else
                <p>No posts found</p>
                <br>
                <a href="/posts" class="btn btn-default pull-right">Go Back</a>
            @endif
        </div> {{-- panel-body  --}}
    </div> {{-- panel panel-info  --}}
@endsection

