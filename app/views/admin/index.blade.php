@extends('layouts.main')

@section('icon')
  <span class="glyphicon glyphicon-dashboard"></span>
@stop

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li class="active">Admin</li>
  </ol>
@stop
  
@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
      <ul class="list-group">
        <li class="list-group-item">
          <span class="glyphicon glyphicon-user"></span>
          Users
          <span class="label label-default pull-right">{{$numUsers}}</span>
        </li>
        <li class="list-group-item">
          <span class="glyphicon glyphicon-th-large"></span>
          Categories
          <span class="label label-default pull-right">{{ $numCategories }}</span>
        </li>
        <li class="list-group-item">
          <span class="glyphicon glyphicon-th"></span>
          Products
          <span class="label label-default pull-right">{{ $numProducts }}</span>
        </li>
        <li class="list-group-item">
          <span class="glyphicon glyphicon-edit"></span>
          Processed orders
          <span class="label label-default pull-right">{{ $numProcessed }}</span>
        </li>
        <li class="list-group-item">
          <span class="glyphicon glyphicon-edit"></span>
          Unprocessed orders
          <span class="label label-default pull-right">{{ count($unprocessed) }}</span>
        </li>
      </ul>
    </div>
    
      <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
        <h4 class="text-center">Income last month</h4>
        <canvas id="report-graph"></canvas>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12">
        <h4>Unprocessed orders</h4>
        <table class="table">
          <thead>
            <tr class="active">
              <th>Order #</th>
              <th>Name</th>
              <th>Items</th>
              <th>Created at</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
          @foreach($unprocessed as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td><a href="/order/{{ $order->id }}">{{ $order->user->firstname }} {{ $order->user->lastname }}</a></td>
              <td><span class="badge">{{count(json_decode($order->items)) }}</span></td>
              <td>{{ $order->created_at->formatLocalized(Config::get('shop.date-long')) }}</td>
              <td>
                <a href="/order/process/{{ $order->id }}" class="btn btn-success btn-sm"
                  data-toggle="tooltip" data-placement="left" title="Mark as processed" data-original-title="Mark as processed">
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