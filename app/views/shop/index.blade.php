@extends('layouts.main')

@section('icon')
  @if ($query)
    <span class="glyphicon glyphicon-search"></span>
  @else
    <span class="glyphicon glyphicon-star"></span>
  @endif
@stop

@section('pagination')
  @include('partials._pagination')
@stop

@section('content')
  @if (!isset($query))
  <div class="row">
    <div class="col-xs-12">
      <h3>Welcome to the <strong>Demo</strong>.</h3>
      <p>
        Login information is available on the {{ HTML::linkRoute('users.login', 'login page') }}.<br>
        Currently only the german localization is complete. Future versions will pick a translation, 
        according to your browser's language settings.
      </p>
      <p>
        All sample data will be refreshed every 24 hours.<br>
        Feel free to browse around, add, edit, delete, order etc. 
      </p>
      <hr>
    </div>
  </div>
  @endif
  @if(count($products) > 0)
    @include('partials._products')
  @else
    <p>{{ Lang::get('shop.no-products') }}</p>
  @endif
@stop