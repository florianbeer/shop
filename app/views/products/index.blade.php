@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-th"></span>
@stop

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li><a href="/admin">{{ Lang::get('admin.name') }}</a></li>
    @if (Input::get('filter') === 'featured')
      <li class="active">{{ HTML::linkRoute('products.index', Lang::get('products.name')) }}</li>
      <li class="active">{{ Lang::get('products.featured') }}</li>
    @elseif (Input::get('filter') === 'outofstock')
      <li class="active">{{ HTML::linkRoute('products.index', Lang::get('products.name')) }}</li>
      <li class="active">{{ Lang::get('products.out-of-stock') }}</li>
    @else
      <li class="active">{{ Lang::get('products.name') }}</li>
    @endif
  </ol>
@stop

@section('content')

  <div class="row">
    
    @include('partials._product-form')
    
    <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-xs-12">
      <table class="table table-condensed" id="admin-products-table">
        <thead>
          <tr class="active">
            <th>&nbsp;</th>
            <th>{{ Lang::get('misc.title') }}</th>
            <th class="text-center">
              <a href="{{ URL::route('products.index') }}?filter=featured">{{ Lang::get('products.featured') }}</a>
              <span class="glyphicon glyphicon-info-sign hidden-xs" title="{{ Lang::get('products.featured-helptext') }}" data-toggle="tooltip" data-placement="top"></span>
            </th>
            <th class="text-center">
              <a href="{{ URL::route('products.index') }}?filter=outofstock">{{ Lang::get('products.availability') }}</a>
              <span class="glyphicon glyphicon-info-sign hidden-xs" title="{{ Lang::get('products.availability-helptext') }}" data-toggle="tooltip" data-placement="top"></span>
            </th>
            <th class="text-center">{{ Lang::get('misc.delete') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr>
              <td>
                <a href="{{ URL::route('products.edit', [$product->id]) }}">
                  {{ HTML::image(str_replace('products/', 'products/small-', $product->image), $product->title, array('width' => '50')) }}
                </a>
              </td>
              <td>{{ HTML::linkRoute('products.edit', $product->title, [$product->id]) }}</td>
              <td class="text-center">
                @if ($product->featured)
                  <a href="{{ URL::route('products.togglefeatured', [$product->id]) }}"><span class="glyphicon glyphicon-star"></span></a>
                @else
                  <a href="{{ URL::route('products.togglefeatured', [$product->id]) }}"><span class="glyphicon glyphicon-star-empty"></span></a>
                @endif
              </td>
              <td class="text-center">
                @if ($product->availability)
                  <a href="{{ URL::route('products.toggleavailability', [$product->id]) }}" class="text-success"><span class="glyphicon glyphicon-ok-sign"></span></a>
                @else
                  <a href="{{ URL::route('products.toggleavailability', [$product->id]) }}" class="text-danger"><span class="glyphicon glyphicon-minus-sign"></span></a>
                @endif
              </td>
              <td class="text-center">
                  <a href="{{ URL::route('products.destroy', [$product->id]) }}" class="text-danger"><span class="glyphicon glyphicon-remove"></span></a>
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