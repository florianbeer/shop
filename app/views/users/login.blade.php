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
        {{ HTML::linkRoute('users.reset', Lang::get('users.lost-password'), null, ['class' => 'text-muted']) }}
      <div class="clearfix">&nbsp;</div>
    {{ Form::close() }}
    <div class="col-md-7 col-md-offset-1 well">
      <h3>Demo Login</h3>
      <p>To log in as <strong>admin</strong>, use the email &quot;<strong>admin@example.org</strong>&quot; and the password &quot;<strong>test</strong>&quot;.</p>
      <p>Further user accounts are visible from the {{ HTML::linkRoute('users.index', 'user admin') }} page (must be logged in as admin to view page), all user passwords are &quot;<strong>test</strong>&quot;.
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-4">
      <hr>
      <p>{{ Lang::get('users.register-message') }}</p>
      <p class="pull-right"><a href="{{ URL::route('users.create') }}" class="btn btn-primary">{{ Lang::get('users.create-account') }}</a></p>
    </div>
  </div>

@stop
