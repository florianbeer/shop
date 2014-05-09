@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th-large"></span> 
@stop

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li><a href="/admin">Admin</a></li>
    <li class="active">{{ $title }}</li>
  </ol>
@stop

@section('content')

  <div class="row">
    {{ Form::open(['url' => 'admin/categories/create', 'class' => 'col-lg-4 col-md-4']) }}
      <div class="form-group">
          {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Category name')) }}
      </div>
      <div class="form-group">
          {{ Form::submit('Create category', array('class' => 'btn btn-primary pull-right')) }}
      </div>
    {{ Form::close() }}
    
    <div class="col-xs-12 visible-sm visible-xs">&nbsp;</div>

    <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-xs-12">
      <table class="table table-condensed" id="admin-products-table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
            <tr>
              <td>{{ $category->name }}</td>
              <td>
                {{ Form::open(['url' => 'admin/categories/destroy', 'style' => 'display: inline-block;']) }}
                  <div class="form-group">
                    {{ Form::hidden('id', $category->id) }}
                    {{ Form::submit('delete', array('class' => 'btn btn-danger btn-xs')) }}
                  </div>
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
@stop