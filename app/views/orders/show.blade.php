@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-edit"></span>
@stop
  
@section('print')
  @include('partials._print-button')
@stop

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
  @if(Auth::user()->admin)
    <li><a href="{{ URL::route('admin.index') }}">{{ Lang::get('admin.name') }}</a></li>
    <li><a href="{{ URL::route('users.index') }}">{{ Lang::get('users.name') }}</a></li>
    <li class="active">{{ $title }}</li>
  @else
    <li><a href="{{ URL::route('orders.index') }}">{{ Lang::get('orders.history') }}</a></li>
    <li class="active">{{ $title }}</li>
  @endif
  </ol>
@stop
  
@section('content')
  
  <div class="row">
    <div class="col-xs-4 text-left">
      <span class="text-muted">{{ $order->created_at->formatLocalized(Config::get('shop.date-long')) }}</span>
      <h4 class="text-muted">{{ $order->user->firstname }} {{ $order->user->lastname }}</h4>
    </div>
    
    @if(Auth::user()->admin)
    <div class="col-xs-8 text-right hidden-print">
      @if(!$order->processed)
      <a href="{{ URL::route('orders.toggleprocessed', $order->id) }}" class="btn btn-success wow bounceIn" data-wow-delay=".5s" data-wow-duration=".4s">
        <span class="glyphicon glyphicon-ok-circle"></span> {{ Lang::get('orders.mark-as-processed') }}
      </a>
      @else
      <a href="{{ URL::route('orders.toggleprocessed', $order->id) }}" class="btn btn-default">
        <span class="glyphicon glyphicon-plus-sign"></span> {{ Lang::get('orders.reopen') }}
      </a>
      @endif
    </div>
    @endif
    
    <div class="col-xs-8 text-right visible-print">
      {{ $order->user->email }}<br>
      {{ $order->user->street }}
      {{ $order->user->number }}<br>
      {{ $order->user->zip }}
      {{ $order->user->city }}<br>
      {{ $order->user->country }}<br>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">&nbsp;</div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <table class="table">
        <thead>
          <tr class="active">
            <th>{{ Lang::get('orders.item') }}</th>
            <th class="text-right">{{ Lang::get('orders.unit-price') }}</th>
            <th class="text-right">{{ Lang::get('orders.subtotal') }}</th>
          </tr>
        </thead>
        <tbody>
        @foreach(json_decode($order->items) as $product)
          <tr>
            <td><span class="text-muted badge">{{ $product->quantity }}&times;</span> {{ $product->name }}</td>
            <td class="text-right">
              {{ $product->price }} {{ Config::get('shop.currency-symbol') }}
              <small class="text-muted">({{ $product->tax }}% {{ Lang::get('misc.tax') }})</small>
              </td>
            <td class="text-right">{{ money_format('%!.2n', ($product->price + $product->price * $product->tax/100) * $product->quantity) }} {{ Config::get('shop.currency-symbol') }}</td>
          </tr>
        @endforeach
          <tr class="active">
            <td colspan="2" class="text-right">
              {{ Lang::get('orders.subtotal') }}: {{ money_format('%!.2n', $order->subtotal) }} {{ Config::get('shop.currency-symbol') }}
            </td>
            <td class="text-right">
              <strong>{{ Lang::get('orders.total') }}: {{ money_format('%!.2n', $order->total) }} {{ Config::get('shop.currency-symbol') }}</strong>
            </td>
          </td>
        </tbody>
      </table>
    </div>
  </div>
@stop