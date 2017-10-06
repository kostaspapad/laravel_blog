@extends('layouts.app')

@section('content')
    <h1>Users</h1>
    @if(count($users) > 0)
        <div class="row">
            {{--  {{ Form::open(['action' => 'SearchController@search'], 'method' => 'POST') }}  --}}
            {{--  {!! Form::open(array('action' => 'SearchController@search')) !!}
                {!! Form::text('searchString', 'Search') !!}
            {!! Form::close() !!}  --}}
            <br><br>
        </div>
        @foreach($users as $user)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/users/{{$user->id}}">{{$user->name}}</a></h3>
                        <small>Registered at {{$user->created_at}}</small>
                    </div>
                </div>
                
            </div>
        @endforeach

        {{--  To make a paginator.Must have paginate function on controller  --}}
        {{$users->links()}}
    @else
        <p>No users found</p>
    @endif
    
@endsection