@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-shopping-cart"></span>
@stop
  
@section('content')
  <div class="row" id="cart-row">
    <div class="col-xs-12">
      {{ Form::open(['url' => 'order/create']) }}
        <table class="table" id="cart-products-table">
          <thead>
            <tr class="active">
              <th></th>
              <th>Item</th>
              <th class="text-right">Unit price</th>
              <th class="text-right">Subtotal</th>
            </tr>
          </thead>
          <tbody>
          @foreach($products as $product)
            <tr>
              <td>
                <a href="/store/removeitem/{{ $product->identifier }}" class="btn btn-xs btn-default" 
                  data-toggle="tooltip" data-placement="right" title="Remove item" data-original-title="Remove item">
                  <span class="glyphicon glyphicon-remove"></span>
                </a>
              </td>
              <td><span class="text-muted badge">{{ $product->quantity }}&times;</span> {{ $product->name }}</td>
              <td class="text-right">
                {{ money_format('%!.2n', $product->price) }} {{ Config::get('shop.currency-symbol') }}
                <small class="text-muted">({{ $product->tax }}% Tax)</small>
                </td>
              <td class="text-right">{{ money_format('%!.2n', $product->total()) }} {{ Config::get('shop.currency-symbol') }}</td>
            </tr>
          @endforeach
            <tr class="active">
              <td colspan="3" class="text-right">
                Subtotal: {{ money_format('%!.2n', Cart::total(false)) }} {{ Config::get('shop.currency-symbol') }}
              </td>
              <td class="text-right">
                <strong>Total: {{ money_format('%!.2n', Cart::total()) }} {{ Config::get('shop.currency-symbol') }}</strong>
              </td>
            </td>
          </tbody>
        </table>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <a href="/" class="btn btn-default btn-sm">Continue shopping <span class="glyphicon glyphicon-chevron-right"></span></a>
      <button type="submit" class="btn btn-primary btn-sm pull-right" title="">
        Check out
        <span class="glyphicon glyphicon-ok"></span>
      </button>
    </div>
      {{ Form::close() }}

  </div>
@stop