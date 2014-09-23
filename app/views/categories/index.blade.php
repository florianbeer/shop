@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th-large"></span> 
@stop

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li>{{ HTML::linkRoute('admin.index', Lang::get('admin.name')) }}</li>
    <li class="active">{{ $title }}</li>
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
          {{ Form::submit(Lang::get('categories.create-category'), array('class' => 'btn btn-primary pull-right')) }}
      </div>
      <div class="col-xs-12">&nbsp;</div>
    {{ Form::close() }}

    <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-xs-12">
      <table class="table table-condensed" id="admin-categories-table">
        <thead>
          <tr class="active">
            <th>{{ Lang::get('misc.title') }}</th>
            <th class="text-center">{{ Lang::get('misc.delete') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
            <tr>
              <td>{{ HTML::linkRoute('categories.edit', $category->name, [$category->id]) }}</td>
              <td class="text-center">
                  <a href="{{ URL::route('categories.destroy', [$category->id]) }}" class="text-danger"><span class="glyphicon glyphicon-remove"></span></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
@stop