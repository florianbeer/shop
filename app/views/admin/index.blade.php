@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-dashboard"></span>
@stop

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
      <ul class="list-group">
        <li class="list-group-item wow slideInLeft">
          <span class="glyphicon glyphicon-user"></span>
          {{ Lang::get('users.name') }}
          <span class="label label-default pull-right">{{$numusers}}</span>
        </li>
        <li class="list-group-item wow slideInLeft" data-wow-delay=".2s">
          <span class="glyphicon glyphicon-th-large"></span>
          {{ Lang::get('categories.name') }}
          <span class="label label-default pull-right">{{ $numcategories }}</span>
        </li>
        <li class="list-group-item wow slideInLeft" data-wow-delay=".3s">
          <span class="glyphicon glyphicon-th"></span>
          {{ Lang::get('products.name') }}
          <span class="label label-default pull-right">{{ $numproducts }}</span>
        </li>
        <li class="list-group-item wow slideInLeft" data-wow-delay=".4s">
          <span class="glyphicon glyphicon-edit"></span>
          {{ Lang::get('orders.processed-orders') }}
          <span class="label label-default pull-right">{{ $numprocessed }}</span>
        </li>
        <li class="list-group-item wow slideInLeft" data-wow-delay=".5s">
          <span class="glyphicon glyphicon-edit"></span>
          {{ Lang::get('orders.unprocessed-orders') }}
          <span class="label label-default pull-right">{{ count($unprocessed) }}</span>
        </li>
      </ul>
    </div>
    
      <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
        <h4 class="text-center">{{ Lang::get('admin.graph-title') }}</h4>
        <canvas id="report-graph"></canvas>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12 wow slideInUp">
        <h4>{{ Lang::get('orders.unprocessed-orders') }}</h4>
        <table class="table">
          <thead>
            <tr class="active">
              <th>{{ Lang::get('orders.order-number') }}</th>
              <th>{{ Lang::get('misc.name') }}</th>
              <th>{{ Lang::get('misc.items') }}</th>
              <th>{{ Lang::get('misc.created-at') }}</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          @foreach($unprocessed as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td><a href="{{ URL::route('orders.show', $order->id) }}">{{ $order->user->firstname }} {{ $order->user->lastname }}</a></td>
              <td><span class="badge">{{count(json_decode($order->items)) }}</span></td>
              <td>{{ $order->created_at->formatLocalized(Config::get('shop.date-long')) }}</td>
              <td>
                <a href="{{ URL::route('orders.toggleprocessed', $order->id) }}" class="btn btn-success btn-sm"
                  title="{{ Lang::get('orders.process') }}" data-toggle="tooltip" data-placement="left">
                  <span class="glyphicon glyphicon-ok-circle"></span>
                </a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
@stop
  
@section('script')
<script src="/js/chart.min.js"></script>
<script>
  $(function() {
    var $el = $('#report-graph');
    $el.get(0).setAttribute('width', parseInt($el.css('width')));
    $el.get(0).setAttribute('height', parseInt($el.css('height')));
    var ctx = $el.get(0).getContext('2d');
    var chart = {
      labels: {{ json_encode($dates) }},
      datasets: [{
        data: {{ json_encode($totals) }},
        fillColor : "#ecd7aa",
  			strokeColor : "#d8ad52",
  			pointColor : "#ecd7aa",
  			pointStrokeColor : "#d8ad52"
        }]
    };
    new Chart(ctx).Line(chart);
  });
</script>
@stop