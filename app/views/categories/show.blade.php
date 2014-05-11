@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th-large"></span>
@stop
  
@section('content')
  @if(count($products) > 0)
    @include('partials._products')
  @else
    <p>{{ Lang::get('shop.no-products') }}</p>
  @endif
@stop
  
@section('pagination')
  @include('partials._pagination')
@stop