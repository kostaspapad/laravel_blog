@extends('layouts.app')

@section('content')
    <h1><span class="glyphicon glyphicon-envelope"></span> Private Messages</h1>
    <br>
    {{--  Only the administrator can view this search box  --}}
    @if(Entrust::hasRole('admin'))
        <div class="row">
            <input type="text" class="form-control" id="description" name="searchBoxMessages" placeholder="Search" value="">
            <br><br>
        </div>
        <div id="searchContainer" class="panel panel-default" style="display:none;">
            <div class="panel-heading">Results</div>
            <div class="panel-body">
                <div id="searchResponse"></div>
            </div>
        </div>
    @endif
@endsection