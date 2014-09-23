@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th-large"></span>
@stop

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li>{{ HTML::linkRoute('admin.index', Lang::get('admin.name')) }}</li>
    <li>{{ HTML::linkRoute('categories.index', Lang::get('categories.name')) }}</li>
    <li class="active">{{ $category->name }}</li>
  </ol>
@stop

  
@section('content')
  <div class="row">
    {{ Form::model($category, ['route' => $route, 'method' => $method, 'class' => 'col-lg-4 col-md-4']) }}
      <div class="form-group {{ $errors->has('name') ? 'has-error' : false }}">
          {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => Lang::get('categories.category-name') )) }}
          @foreach($errors->get('name') as $message)
            <span class='help-block'>{{ $message }}</span>
          @endforeach
      </div>
      <div class="form-group">
          {{ Form::submit(Lang::get('misc.send'), array('class' => 'btn btn-primary ')) }}
      </div>
    {{ Form::close() }}

    <div class="col-xs-12 visible-sm visible-xs">&nbsp;</div>

    <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-xs-12">
      <p>{{ Lang::get('categories.edit-message', ['num' => $category->products->count(), 'name' => $category->name]) }}</p>
    </div>
  </div>
@stop