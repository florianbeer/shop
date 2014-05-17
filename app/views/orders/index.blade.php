@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-edit"></span>
@stop
  
@section('content')
    <div class="row">
    <div class="col-xs-12">&nbsp;</div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <table class="table rwd-table">
        <thead>
          <tr class="active">
            <th>{{ Lang::get('orders.order-number') }}</th>
            <th>{{ Lang::get('misc.created-at') }}</th>
            <th class="text-right">{{ Lang::get('orders.subtotal') }}</th>
            <th class="text-right">{{ Lang::get('orders.total') }}</th>
          </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
          <tr>
            <td data-th="{{ Lang::get('orders.order-number') }}">#{{ $order->id }}</td>
            <td data-th="{{ Lang::get('misc.created-at') }}"><a href="{{ URL::route('orders.show', $order->id) }}">{{ $order->created_at->formatLocalized(Config::get('shop.date-long')) }}</a></td>
            <td data-th="{{ Lang::get('orders.subtotal') }}" class="text-right">{{ money_format('%!.2n', $order->subtotal) }} {{ Config::get('shop.currency-symbol') }}</td>
            <td data-th="{{ Lang::get('orders.total') }}" class="text-right">{{ money_format('%!.2n', $order->total) }} {{ Config::get('shop.currency-symbol') }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop