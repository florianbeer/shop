@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-search"></span>
@stop

@section('content')
  @include('partials._product')
@stop
  
@section('pagination')
  @include('partials._pagination')
@stop