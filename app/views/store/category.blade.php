@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th-large"></span>
@stop
  
@section('content')
  @include('partials._product')
@stop
  
@section('pagination')
  @include('partials._pagination')
@stop