@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-star"></span>
@stop

@section('content')
  @if(count($products) > 0)
    @include('partials._product')
  @else
    <p>No featured products</p>
  @endif
@stop