@extends('layouts.app')

@section('content')
    <a href="/messages" class="pager">Go Back</a>
    {{--  If user is admin show this else don't  --}}
    @if(Entrust::hasRole('admin'))
        <div class="well">
            
            <h1>id:{{$userNotification->id}}</h1>    
            <hr>        
            <h3><span class="label label-primary">type:</span></h3> <h4>{{$userNotification->type}}</h4>
            <h3><span class="label label-primary">notifiable_id:</span></h3> <h4>{{$userNotification->notifiable_id}}</h4>
            <h3><span class="label label-primary">notifiable_type:</span></h3> <h4>{{$userNotification->notifiable_type}}</h4>
            <h3><span class="label label-primary">data:</span></h3> <h4>{{$userNotification->data}}</h4>
            <h3><span class="label label-primary">read_at:</span></h3> <h4>{{$userNotification->read_at}}</h4>
            <h3><span class="label label-primary">created_at:</span></h3> <h4>{{$userNotification->created_at}}</h4>
            <h3><span class="label label-primary">updated_at:</span></h3> <h4>{{$userNotification->updated_at}}</h4>
            <h3><span class="label label-primary">category:</span></h3> <h4>{{$userNotification->category}}</h4>
            <h3><span class="label label-primary">sender:</span></h3> <h4>{{$userNotification->sender}}</h4>
            <h3><span class="label label-primary">active:</span></h3> <h4>{{$userNotification->active}}</h4>
        </div>
    @else
        <h2>Only admin can view this page</h2>
    @endif 

@endsection