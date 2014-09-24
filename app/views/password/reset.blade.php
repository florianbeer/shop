@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-user"></span>
@stop

@section('content')

  <div class="row">
    {{ Form::open(['action' => 'RemindersController@postReset', 'class' => 'col-lg-4 col-md-4']) }}
      {{ Form::hidden('token', $token) }}
      <div class="form-group">
        {{ Form::email('email', null, ['class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => Lang::get('misc.email')]) }}
      </div>
      <div class="form-group">
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => Lang::get('misc.password')]) }}
      </div>
      <div class="form-group">
        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => Lang::get('misc.password-confirmation')]) }}
      </div>
      <div class="form-group pull-right">
        {{ Form::submit(Lang::get('misc.password-reset'), ['class' => 'btn btn-primary']) }}
      </div>
    {{ Form::close() }}
  </div>
@stop
