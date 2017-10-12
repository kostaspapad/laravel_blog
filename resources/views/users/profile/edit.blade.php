@extends('layouts.app')

@section('content')
    {{--  Only the current logged in user  --}}
    @if($user->id == Auth::user()->id)        
        {{--  Check privilages  --}}
        @if(Entrust::hasRole(['owner', 'admin', 'user']))
            <div class="panel panel-info">
                <div class="panel-heading">Edit Profile</div>
                <div class="panel-body">
                    <div class="row">

                        
                    </div>                        
                </div>
            </div>
        @else
            <p>Nothing to see here</p>
        @endif
    @endif
            <br>
            <a href="/users" class="btn btn-default">Go Back</a>
        
@endsection