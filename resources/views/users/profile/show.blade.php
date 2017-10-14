@extends('layouts.app')

@section('content')
    {{--  Only the current logged in user
    @if($user->id == Auth::user()->id)          --}}
    {{--  Check privilages  --}}
    @if(Entrust::hasRole(['owner', 'admin', 'user']))
        <div class="container">    
            <div class="row">
                <div class="panel panel-info">
                <div class="panel-heading ">  <h4 >User Profile</h4></div>
                <div class="panel-body">
                    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                        @if($user->avatar != 'mrnobody.jpg')
                            <img alt="User Pic" src="/storage/gallery/{{$user->avatar}}" id="profile-image1" class="img-circle img-responsive"> 
                        @else
                            <div>
                                <div class="input-group image-preview">
						<input placeholder="" type="text" class="form-control image-preview-filename" disabled="disabled">
						<!-- don't give a name === doesn't send on POST/GET --> 
						<span class="input-group-btn"> 
						<!-- image-preview-clear button -->
						<button type="button" class="btn btn-default image-preview-clear" style="display:none;"> <span class="glyphicon glyphicon-remove"></span> Clear </button>
						<!-- image-preview-input -->
						<div class="btn btn-default image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>
							<input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/>
							<!-- rename it --> 
						</div>
						<button type="button" class="btn btn-labeled btn-primary"> <span class="btn-label"><i class="glyphicon glyphicon-upload"></i> </span>Upload</button>
						</span> 
                    </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
                        <div class="container" >
                            <h2>{{$user->name}}</h2>
                            <p>an   <b> Employee</b></p>
                            <span class="glyphicon glyphicon-arrow-up text-primary">{{$user->upvotes}}</span> <span class="glyphicon glyphicon-arrow-down text-danger">{{$user->downvotes}}</span>
                        </div>
                        <hr>
                        <ul class="container details" >
                            <li><p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>i.rudberg</p></li>
                            <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$user->email}}</p></li>
                            <li><p>Gender</p><li>
                        </ul>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5 col-xs-6 tital " >Joined: {{$user->created_at}}</div>
                            <a href="/users" class="btn btn-default">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Nothing to see here</p>
    @endif
        
@endsection