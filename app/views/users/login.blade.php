@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-log-in"></span>
@stop
  
@section('content')
  
  <div class="row">
  {{ Form::open(['route' => 'users.login', 'class' => 'col-lg-4 col-md-4']) }}
    <div class="form-group">
      {{ Form::email('email', null, ['class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => Lang::get('misc.email')]) }}
    </div>
    <div class="form-group">
      {{ Form::password('password', ['class' => 'form-control', 'placeholder' => Lang::get('misc.password')]) }}
    </div>
    <div class="form-group pull-right">
      {{ Form::submit(Lang::get('users.login'), ['class' => 'btn btn-primary']) }}
    </div>
  {{ Form::close() }}
  </div>
  
  <div class="row">
    <div class="col-lg-4 col-md-4">
      <hr>
      <p>{{ Lang::get('users.register-message') }}</p>
      <p class="pull-right"><a href="{{ URL::route('users.create') }}" class="btn btn-primary">{{ Lang::get('users.create-account') }}</a></p>
    </div>
  </div>

@stop