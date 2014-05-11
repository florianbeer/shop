@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-shopping-cart"></span>
@stop
  
@section('content')
  <div class="row" id="cart-row">
    <div class="col-xs-12 table-responsive">
      {{ Form::open(['route' => 'orders.store']) }}
        <table class="table" id="cart-products-table">
          <thead>
            <tr class="active">
              <th class="hidden-print"></th>
              <th>{{ Lang::get('shop.quantity') }}</th>
              <th>{{ Lang::get('orders.item') }}</th>
              <th class="text-right">{{ Lang::get('orders.unit-price') }}</th>
              <th class="text-right">{{ Lang::get('orders.subtotal') }}</th>
            </tr>
          </thead>
          <tbody>
          @foreach($products as $product)
            <tr>
              <td class="hidden-print">
                <a href="{{ URL::route('cart.destroy', $product->identifier) }}" class="btn btn-xs btn-default"  title="Remove item"
                  data-toggle="tooltip" data-placement="right">
                  <span class="glyphicon glyphicon-remove"></span>
                </a>
              </td>
              <td class="nowrap">
                <a class="qty-down" href="{{ URL::route('cart.qtydown', $product->identifier) }}"><span class="glyphicon glyphicon-minus"></span></a>
                <span class="text-muted badge">{{ $product->quantity }}&times;</span>
                <a class="qty-up" href="{{ URL::route('cart.qtyup', $product->identifier) }}"><span class="glyphicon glyphicon-plus"></span></a>
              </td>
              <td>
                {{ HTML::linkRoute('products.show', $product->name, $product->id) }}
              </td>
              <td class="text-right">
                {{ $product->price }} {{ Config::get('shop.currency-symbol') }}
                <small class="text-muted">({{ $product->tax }}% Tax)</small>
                </td>
              <td class="text-right">{{ $product->total() }} {{ Config::get('shop.currency-symbol') }}</td>
            </tr>
          @endforeach
            <tr class="active">
              <td class="hidden-print"></td>
              <td colspan="3" class="text-right">
                {{ Lang::get('orders.subtotal') }}: {{ money_format('%!.2n', Cart::total(false)) }} {{ Config::get('shop.currency-symbol') }}
              </td>
              <td class="text-right">
                <strong>{{ Lang::get('orders.total') }}: {{ money_format('%!.2n', Cart::total()) }} {{ Config::get('shop.currency-symbol') }}</strong>
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