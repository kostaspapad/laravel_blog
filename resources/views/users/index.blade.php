@extends('layouts.app')

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
            @if(count($users) > 0)
                <div class="row">
                    {{--  {{ Form::open(['action' => 'SearchController@search'], 'method' => 'POST') }}  --}}
                    {{--  {!! Form::open(array('action' => 'SearchController@search')) !!}
                        {!! Form::text('searchString', 'Search') !!}
                    {!! Form::close() !!}  --}}
                    <br><br>
                </div>
                @foreach($users as $user)
                    {{--  Don't show the current logged in user  --}}
                    @if($user->id != Auth::user()->id)
                        <div class="well">
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <h3><a href="/users/{{$user->id}}">{{$user->name}}</a></h3>
                                    <small>Registered at {{$user->created_at}}</small>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                {{--  To make a paginator.Must have paginate function on controller  --}}
                {{$users->links()}}
            @else
                <p>No users found</p>
            @endif
            <br>
            <a href="/posts" class="btn btn-default">Go Back</a>
        </div>
    </div>
@endsection