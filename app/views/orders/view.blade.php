@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-edit"></span>
@stop
  
@section('print')
  @include('partials._print-button')
@stop

@section('breadcrumbs')
  @if(Auth::user()->admin)
  <ol class="breadcrumb hidden-print">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/users">Users</a></li>
    <li class="active">{{ $title }}</li>
  </ol>
  @else
  <ol class="breadcrumb hidden-print">
    <li><a href="/order/history">Oder history</a></li>
    <li class="active">{{ $title }}}</li>
  </ol>
  @endif
@stop
  
@section('content')
  
  <div class="row">
    <div class="col-xs-4 text-left">
      <h4 class="text-muted">{{ $title }}</h4>
      <span class="text-muted">{{ $order->created_at->formatLocalized(Config::get('shop.date-long')) }}</span>
    </div>
    
    @if(Auth::user()->admin)
    <div class="col-xs-8 text-right hidden-print">
      @if(!$order->processed)
      <a href="/admin/order/process/{{ $order->id }}" class="btn btn-success">
        <span class="glyphicon glyphicon-ok-circle"></span> Mark as processed
      </a>
      @else
      <a href="/admin/order/reopen/{{ $order->id }}" class="btn btn-default">
        <span class="glyphicon glyphicon-plus-sign"></span> Re-open order
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
            <th>Item</th>
            <th class="text-right">Unit price</th>
            <th class="text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
        @foreach($items as $product)
          <tr>
            <td><span class="text-muted badge">{{ $product->quantity }}&times;</span> {{ $product->name }}</td>
            <td class="text-right">
              {{ money_format('%!.2n', $product->price) }} {{ Config::get('shop.currency-symbol') }}
              <small class="text-muted">({{ $product->tax }}% Tax)</small>
              </td>
            <td class="text-right">{{ money_format('%!.2n', ($product->price + $product->price * $product->tax/100) * $product->quantity) }} {{ Config::get('shop.currency-symbol') }}</td>
          </tr>
        @endforeach
          <tr class="active">
            <td colspan="2" class="text-right">
              Subtotal: {{ money_format('%!.2n', $order->subtotal) }} {{ Config::get('shop.currency-symbol') }}
            </td>
            <td class="text-right">
              <strong>Total: {{ money_format('%!.2n', $order->total) }} {{ Config::get('shop.currency-symbol') }}</strong>
            </td>
          </td>
        </tbody>
      </table>
    </div>
  </div>
@stop