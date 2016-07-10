@extends('layouts.master')
{{-- layouts.master or welcome????--}}
@section('title')
    DE Database
@endsection


@section('content')
    <div class="row title-for-pub">
        <div class="col-md-12">
            <h1>@yield('type') Database</h1>
            <p class="lead">Add / View Recent @yield('type')</p>

        </div>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation" class= @yield('page1')><a href="#">Add @yield('type')</a></li>
        <li role="presentation" class= @yield('page2')><a href="#">View @yield('type')</a></li>
    </ul>


    <div class="panel panel-default de-nav" id="add-de" style="display: @yield('page1_display');">
        <div class="panel-heading">
            <h3 class="panel-title">Select and fill out the properties for new @yield('type')</h3>
        </div>
        <div class="panel-body">
            @yield('add-de')

        </div>
    </div>

    <div class="panel panel-default de-nav" id="view-de"  style="display: @yield('page2_display') ">

        <div class="panel-heading">
            <h3 class="panel-title">Make a query and find @yield('type')s</h3>
        </div>
        <div class="panel-body view-@yield('type')">
            @yield('view-de')
        </div>
    </div>


    @yield('modal')

@endsection