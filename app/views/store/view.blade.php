@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th"></span>
@stop
  
@section('content')
  <div class="row">
    <div class="product col-sm-4">
      {{ HTML::image($product->image, $product->title, ['class' => 'img-responsive thumbnail']) }}
    </div>
    <div class="col-sm-8">
      <p>{{ nl2br($product->description) }}</p>
      
      {{ Form::open(['url' => 'store/addtocart']) }}
      <div class="row">
        {{ Form::hidden('id', $product->id) }}
        <div class="form-group col-xs-4">
          {{ Form::label('quantity', 'Quantity', ['class' => 'control-label']) }}
          {{ Form::text('quantity', 1, ['class' => 'qty form-control input-sm']) }}
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-xs-4">
          <div class="input-group">
            <span class="price input-group-addon" data-price="{{ $product->price }}">{{ money_format('%!.2n', $product->price) }} {{ Config::get('shop.currency-symbol') }}</span>
            <button type="submit" class="btn btn-primary form-control">
              <span class="glyphicon glyphicon-shopping-cart"></span> Add to cart
            </button>
          </div>
        </div>
      </div>
      {{Form::close() }}
      
    </div>
  </div>
@stop