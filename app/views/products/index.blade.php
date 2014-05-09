@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th"></span>
@stop

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li><a href="/admin">Admin</a></li>
    @if ($filter == 'featured')
      <li class="active"><a href="/admin/products">Products</a></li>
      <li class="active">Featured</li>
    @elseif ($filter == 'outofstock')
      <li class="active"><a href="/admin/products">Products</a></li>
      <li class="active">Out of stock</li>
    @else
      <li class="active">Products</li>
    @endif
  </ol>
@stop

  
@section('content')
  
  <div class="row">
    {{ Form::open(['url' => 'admin/products/create', 'files' => true, 'class' => 'col-lg-4 col-md-4']) }}
      <div class="form-group ">
        {{ Form::select('category_id', $categories, null, ['class' => "form-control"]) }}
      </div>
      <div class="form-group">
        {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Title')) }}
      </div>
      <div class="form-group">
        {{ Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Description')) }}
      </div>
      <div class="form-group">
        <div class="input-group">
          {{ Form::text('price', null, array('class' => 'form-control', 'placeholder' => 'Price')) }}
          <span class="input-group-addon">{{ Config::get('shop.currency-symbol') }}</span>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          {{ Form::text('tax', '20', array('class' => 'form-control', 'placeholder' => 'Tax')) }}
          <span class="input-group-addon">%</span>
        </div>
      </div>
      <div class="form-group">
        {{ Form::file('image') }}
      </div>
      <div class="form-group">
        {{ Form::submit('Create product', array('class' => 'btn btn-primary pull-right')) }}
      </div>
    {{ Form::close() }}

    <div class="col-xs-12 visible-sm visible-xs">&nbsp;</div>

    <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-xs-12">
      <table class="table table-condensed" id="admin-products-table">
        <thead>
          <tr class="active">
            <th>&nbsp;</th>
            <th>
              <a href="/admin/products/featured">Featured</a>
              <span class="glyphicon glyphicon-info-sign hidden-xs" 
                title="Show only featured"
                data-toggle="tooltip" data-placement="top" data-original-title="Show only featured">
              </span>
            </th>
            </th>
            <th>Title</th>
            <th>
              <a href="/admin/products/outofstock">Availability</a>
              <span class="glyphicon glyphicon-info-sign hidden-xs" 
                title="Show only out of stock"
                data-toggle="tooltip" data-placement="top" data-original-title="Show only out of stock">
              </span>
            </th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr>
              <td>{{ HTML::image($product->image, $product->title, array('width' => '50')) }}</td>
              <td class="text-center">
                @if($product->featured)
                  <a href="/admin/product/togglefeatured/{{ $product->id }}"><span class="glyphicon glyphicon-star"></span></a>
                @else
                  <a href="/admin/product/togglefeatured/{{ $product->id }}"><span class="glyphicon glyphicon-star-empty"></span></a>
                @endif
              </td>
              <td>{{ $product->title }}</td>
              <td>
                {{ Form::open(['url' => 'admin/products/toggle-availability', 'style' => 'display: inline-block;']) }}
                  <div class="form-group">
                    {{ Form::hidden('id', $product->id) }}
                    {{ Form::select('availability', ['1' => 'In stock', '0' => 'Out of stock'], $product->availability, ['class' =>'form-control input-sm stock-control']) }}
                  </div>
                {{ Form::close() }}
              </td>
              <td>
                {{ Form::open(['url' => 'admin/products/destroy', 'style' => 'display: inline-block;']) }}
                  <div class="form-group">
                    {{ Form::hidden('id', $product->id) }}
                    {{ Form::submit('delete', array('class' => 'btn btn-danger btn-xs')) }}
                  </div>
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
@stop
  
@section('pagination')
  @include('partials._pagination')
@stop