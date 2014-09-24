@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-user"></span>
@stop

@section('content')

  <div class="row">
    {{ Form::open(['action' => 'RemindersController@postRemind', 'class' => 'col-lg-4 col-md-4']) }}
      <div class="form-group">
        {{ Form::email('email', null, ['class' => 'form-control', 'autofocus' => 'autofocus', 'required' => 'true', 'placeholder' => Lang::get('misc.email')]) }}
      </div>
      <div class="form-group pull-right">
        {{ Form::submit(Lang::get('users.reset-password'), ['class' => 'btn btn-primary']) }}
      </div>
    {{ Form::close() }}
  </div>
@stop
