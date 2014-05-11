@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th"></span>
@stop

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li><a href="{{ URL::route('admin.index') }}">{{ Lang::get('admin.name') }}</a></li>
    <li>{{ HTML::linkRoute('products.index', Lang::get('products.name')) }}</li>
    <li class="active">{{ $product->title }}</li>
  </ol>
@stop

@section('content')
  <div class="row">
    @include('partials._product-form')
  </div>
@stop