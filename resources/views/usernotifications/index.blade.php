@extends('layouts.app')

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">Notification ID: {{$userNotification->id}}</div>
        <div class="panel-body">
            {{--  If user is admin show this else don't  --}}
            @if(Entrust::hasRole('admin'))  
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">type:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->type}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">notifiable_id:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->notifiable_id}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">notifiable_type:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->notifiable_type}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">data:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->data}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">read_at:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->read_at}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">created_at:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->created_at}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">updated_at:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->updated_at}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">category:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->category}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">sender:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->sender}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h3><span class="label label-primary">active:</span></h3> 
                    </div>
                    <div class="col-md-10">
                        <h3>{{$userNotification->active}}</h3>
                    </div>
                </div>
            @else
                <h2>Only admin can view this page</h2>
            @endif 
            <br>
            <hr>
            <a href="/users" class="btn btn-default">Go Back</a>
        </div>
    </div>
@endsection