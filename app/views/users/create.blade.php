@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-plus"></span> 
@stop
  
@section('content')
  
  <div class="row">
    {{ Form::open(['route' => 'users.store']) }}
    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
      <div class="form-group {{ $errors->has('firstname') ? 'has-error' : false }}">
        {{ Form::text('firstname', null, array('class' => 'form-control', 'placeholder' => Lang::get('users.firstname'))) }}
        @foreach($errors->get('firstname') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('lastname') ? 'has-error' : false }}">
      {{ Form::text('lastname', null, array('class' => 'form-control', 'placeholder' => Lang::get('users.lastname'))) }}
        @foreach($errors->get('lastname') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('email') ? 'has-error' : false }}">
        {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => Lang::get('misc.email'))) }}
        @foreach($errors->get('email') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('password') ? 'has-error' : false }}">
        {{ Form::password('password', array('class' => 'form-control', 'placeholder' => Lang::get('misc.password'))) }}
        @foreach($errors->get('password') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : false }}">
        {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => Lang::get('misc.password-confirmation'))) }}
        @foreach($errors->get('password_confirmation') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <hr class="visible-xs">
    </div>
    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
      <div class="form-group {{ $errors->has('street') ? 'has-error' : false }}">
        {{ Form::text('street', null, array('class' => 'form-control', 'placeholder' => Lang::get('users.street'))) }}
        @foreach($errors->get('street') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('number') ? 'has-error' : false }}">
        {{ Form::text('number', null, array('class' => 'form-control', 'placeholder' => Lang::get('users.number'))) }}
        @foreach($errors->get('number') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('zip') ? 'has-error' : false }}">
        {{ Form::text('zip', null, array('class' => 'form-control', 'placeholder' => Lang::get('users.zip'))) }}
        @foreach($errors->get('zip') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('city') ? 'has-error' : false }}">
        {{ Form::text('city', null, array('class' => 'form-control', 'placeholder' => Lang::get('users.city'))) }}
        @foreach($errors->get('city') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('country') ? 'has-error' : false }}">
        {{ Form::text('country', null, array('class' => 'form-control', 'placeholder' => Lang::get('users.country'))) }}
        @foreach($errors->get('country') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group pull-right">
        {{ Form::submit(Lang::get('users.create-account'), array('class' => 'btn btn-primary')) }}
      </div>
    </div>
    {{ Form::close() }}
  </div>

@stop