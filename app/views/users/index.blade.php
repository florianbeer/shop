@extends('layouts.main')

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li><a href="{{ URL::route('admin.index') }}">{{ Lang::get('admin.name') }}</a></li>
    <li class="active">{{ Lang::get('users.name') }}</li>
  </ol>
@stop

@section('icon')
  <span class="glyphicon glyphicon-user"></span>
@stop
  
@section('content')

  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table" id="admin-users-table">
        <thead>
          <tr class="active">
            <th>{{ Lang::get('misc.name') }}</th>
            <th>{{ Lang::get('misc.email') }}</th>
            <th>{{ Lang::choice('orders.name', 2) }}</th>
            <th>{{ Lang::get('misc.created-at') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
              <td>{{ $user->firstname }} {{ $user->lastname }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if(count($user->orders) > 0)
                <div class="dropdown">
                  <a href="#" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">{{ $user->orders->count() }} {{ Lang::choice('orders.name', $user->orders->count()) }} <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  @foreach($user->orders as $order)
                    <li><a href="{{ URL::route('orders.show', $order->id) }}">{{ $order->created_at->formatLocalized(Config::get('shop.date-long')) }}</a></li>
                  @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <td>
                <span class="text-muted" title="{{ $user->created_at->formatLocalized(Config::get('shop.date-long')) }}"
                  data-toggle="tooltip" data-placement="left">
                  {{ Carbon::createFromTimeStamp(strtotime($user->created_at))->diffForHumans() }}
                </span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@stop