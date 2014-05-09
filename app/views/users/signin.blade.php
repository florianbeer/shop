@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-log-in"></span>
@stop
  
@section('content')
  
  <div class="row">
  {{ Form::open(['url' => 'users/signin', 'class' => 'col-lg-4 col-md-4']) }}
    <div class="form-group">
      {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email')) }}
    </div>
    <div class="form-group">
      {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
    </div>
    <div class="form-group pull-right">
      {{ Form::submit('Log in', array('class' => 'btn btn-primary')) }}
    </div>
  {{ Form::close() }}
  </div>
  
  <div class="row">
    <div class="col-lg-4 col-md-4">
      <hr>
      <p>If you are not a customer yet, you can create a new account quickly by clicking here:</p>
      <p class="pull-right">{{ HTML::link('users/newaccount', 'Create new account', ['class' => 'btn btn-primary']) }}</p>
    </div>
  </div>

@stop