@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-plus"></span> 
@stop
  
@section('content')
  
  <div class="row">
    {{ Form::open(['url' => 'users/create']) }}
    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
      <div class="form-group {{ $errors->has('firstname') ? 'has-error' : false }}">
        {{ Form::text('firstname', null, array('class' => 'form-control', 'placeholder' => 'First name')) }}
        @foreach($errors->get('firstname') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('lastname') ? 'has-error' : false }}">
      {{ Form::text('lastname', null, array('class' => 'form-control', 'placeholder' => 'Last name')) }}
        @foreach($errors->get('lastname') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('email') ? 'has-error' : false }}">
        {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email')) }}
        @foreach($errors->get('email') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('password') ? 'has-error' : false }}">
        {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
        @foreach($errors->get('password') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : false }}">
        {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Password confirmation')) }}
        @foreach($errors->get('password_confirmation') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <hr class="visible-xs">
    </div>
    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
      <div class="form-group {{ $errors->has('street') ? 'has-error' : false }}">
        {{ Form::text('street', null, array('class' => 'form-control', 'placeholder' => 'Street')) }}
        @foreach($errors->get('street') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('number') ? 'has-error' : false }}">
        {{ Form::text('number', null, array('class' => 'form-control', 'placeholder' => 'House number')) }}
        @foreach($errors->get('number') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('zip') ? 'has-error' : false }}">
        {{ Form::text('zip', null, array('class' => 'form-control', 'placeholder' => 'Zip code')) }}
        @foreach($errors->get('zip') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('city') ? 'has-error' : false }}">
        {{ Form::text('firstname', null, array('class' => 'form-control', 'placeholder' => 'City')) }}
        @foreach($errors->get('city') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group {{ $errors->has('country') ? 'has-error' : false }}">
        {{ Form::text('country', null, array('class' => 'form-control', 'placeholder' => 'Country')) }}
        @foreach($errors->get('country') as $message)
          <span class='help-block'>{{ $message }}</span>
        @endforeach
      </div>
      <div class="form-group pull-right">
        {{ Form::submit('Create new account', array('class' => 'btn btn-primary')) }}
      </div>
    </div>
    {{ Form::close() }}
  </div>

@stop