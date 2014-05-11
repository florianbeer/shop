@extends('layouts.main')

@section('icon')
  @if ($query)
    <span class="glyphicon glyphicon-search"></span>
  @else
    <span class="glyphicon glyphicon-star"></span>
  @endif
@stop

@section('pagination')
  @include('partials._pagination')
@stop

@section('content')
  @if(count($products) > 0)
    @include('partials._products')
  @else
    <p>{{ Lang::get('shop.no-products') }}</p>
  @endif
@stop