@extends('layouts.app')

@section('content')
    <h1><span class="glyphicon glyphicon-envelope"></span> Private Messages</h1>
        <div class="row">
            <input type="text" class="form-control" id="description" name="searchBox" placeholder="Description" value="">
            <br><br>
        </div>
        <div id="ajaxSearchResponse"></div>    
@endsection