@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-shopping-cart"></span>
@stop
  
@section('content')
  <div class="row" id="cart-row">
    <div class="col-xs-12 table-responsive">
      {{ Form::open(['route' => 'orders.store']) }}
        <table class="table rwd-table">
          <thead>
            <tr class="active">
              <th>{{ Lang::get('shop.quantity') }}</th>
              <th>{{ Lang::get('orders.item') }}</th>
              <th class="text-right">{{ Lang::get('orders.unit-price') }}</th>
              <th class="text-right">{{ Lang::get('orders.subtotal') }}</th>
              <th class="hidden-print"></th>
            </tr>
          </thead>
          <tbody>
          @foreach($products as $product)
            <tr class="text-center">
              <td class="nowrap" data-th="{{ Lang::get('shop.quantity') }}">
                <a class="qty-down" href="{{ URL::route('cart.qtydown', $product->identifier) }}"><span class="glyphicon glyphicon-minus"></span></a>
                <span class="text-muted badge">{{ $product->quantity }}&times;</span>
                <a class="qty-up" href="{{ URL::route('cart.qtyup', $product->identifier) }}"><span class="glyphicon glyphicon-plus"></span></a>
              </td>
              <td data-th="{{ Lang::get('orders.item') }}">
                {{ HTML::linkRoute('products.show', $product->name, $product->id) }}
              </td>
              <td class="text-right" data-th="{{ Lang::get('orders.unit-price') }}">
                {{ $product->price }} {{ Config::get('shop.currency-symbol') }}
                <small class="text-muted">({{ $product->tax }}% Tax)</small>
                </td>
              <td class="text-right" data-th="{{ Lang::get('orders.subtotal') }}">{{ $product->total() }} {{ Config::get('shop.currency-symbol') }}</td>
              <td class="hidden-print" data-th="{{ Lang::get('misc.delete') }}"><a href="{{ URL::route('cart.destroy', $product->identifier) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
          @endforeach
            <tr class="active text-right">
              <td colspan="4" data-th="{{ Lang::get('orders.subtotal') }}">
                <span class="hidden-xs">{{ Lang::get('orders.subtotal') }}: </span>{{ money_format('%!.2n', Cart::total(false)) }} {{ Config::get('shop.currency-symbol') }}
              </td>
              <td data-th="{{ Lang::get('orders.total') }}">
                <strong><span class="hidden-xs">{{ Lang::get('orders.total') }}: </span>{{ money_format('%!.2n', Cart::total()) }} {{ Config::get('shop.currency-symbol') }}</strong>
              </td>
            </td>
          </tbody>
        </table>
    </div>
  </div>
  <div class="row hidden-print">
    <div class="col-xs-12">
      <a href="/" class="btn btn-default">{{ Lang::get('cart.continue-shopping') }} <span class="glyphicon glyphicon-chevron-right"></span></a>
      <button type="submit" class="btn btn-primary pull-right" title="">
        {{ Lang::get('cart.check-out') }}
        <span class="glyphicon glyphicon-ok"></span>
      </button>
    </div>
      {{ Form::close() }}

  </div>
@stop