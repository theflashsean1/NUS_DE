@extends('layouts.de-template')


@section('type')DEG-Experiment
@endsection

@if($page_number == 1)
@section('page1')active @endsection
@section('page1_display')block @endsection
@section('page2_display')none @endsection
@endif

@if($page_number == 2)
@section('page2')active @endsection
@section('page1_display')none @endsection
@section('page2_display')block @endsection
@endif



@section('add-de')

@endsection




@section('view-de')

@endsection



@section('modal')

@endsection