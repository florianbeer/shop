@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-edit"></span>
@stop
  
@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li class="active">{{ $title }}</li>
  </ol>
@stop
  
@section('content')
  
  <div class="row visible-print">
    <div class="col-xs-12 text-right">
      {{ Auth::user()->email }}<br>
      {{ Auth::user()->street }}
      {{ Auth::user()->number }}<br>
      {{ Auth::user()->zip }}
      {{ Auth::user()->city }}<br>
      {{ Auth::user()->country }}<br>
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
            <th>Order #</th>
            <th>Created at</th>
            <th class="text-right">Subtotal</th>
            <th class="text-right">Total</th>
          </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
          <tr>
            <td>#{{ $order->id }}</td>
            <td><a href="/order/{{ $order->id }}">{{ $order->created_at->formatLocalized(Config::get('shop.date-long')) }}</a></td>
            <td class="text-right">{{ money_format('%!.2n', $order->subtotal) }} {{ Config::get('shop.currency-symbol') }}</td>
            <td class="text-right">{{ money_format('%!.2n', $order->total) }} {{ Config::get('shop.currency-symbol') }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop