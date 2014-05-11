@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-user"></span>
@stop
  
@section('content')

  <div class="row">
    {{ Form::open(['action' => 'RemindersController@postRemind', 'class' => 'col-lg-4 col-md-4']) }}
      <div class="form-group">
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => Lang::get('misc.email')]) }}
      </div>
      <div class="form-group pull-right">
        {{ Form::submit(Lang::get('misc.send'), ['class' => 'btn btn-primary']) }}
      </div>
    {{ Form::close() }}
  </div>
@stop