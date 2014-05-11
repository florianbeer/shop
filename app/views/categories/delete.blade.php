@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th-large"></span>
@stop

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li><a href="/admin">Admin</a></li>
    <li>{{ HTML::linkRoute('categories.index', Lang::get('categories.name')) }}</li>
    <li class="active">{{ $category->name }}</li>
  </ol>
@stop
  
@section('content')
  <div class="row">
    <div class="col-xs-12">
      {{ Form::open(['route' => ['categories.move', $category->id], 'class' => 'col-lg-5 col-md-5']) }}
        <p>{{ Lang::get('categories.delete-message', ['num' => $products_count]) }}</p>
        <p>{{ Lang::get('categories.delete-question') }}</p>
        {{ Form::hidden('old_category_id', $category->id) }}
        <div class="form-group">
          {{ Form::select('category_id', $categories, null, ['class' => "form-control"]) }}
        </div>
        <div class="form-group">
          {{ Form::submit(Lang::get('categories.move-and-delete'), array('class' => 'btn btn-primary pull-right')) }}
        </div>        
      {{ Form::close() }}
    </div>
  </div>
@stop