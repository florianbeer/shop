@extends('layouts.main')

@section('breadcrumbs')
  <ol class="breadcrumb hidden-print">
    <li><a href="/admin">Admin</a></li>
    <li class="active">Users</li>
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
            <th>Name</th>
            <th>Email</th>
            <th>Orders</th>
            <th>Created</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
              <td>{{ $user->firstname }} {{ $user->lastname }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if(count($user->order) > 0)
                <div class="dropdown">
                  <a href="#" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">{{ count($user->order) }} Orders <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  @foreach($user->order as $order)
                    <li><a href="/order/{{ $order->id }}">{{ $order->created_at->formatLocalized(Config::get('shop.date-long')) }}</a></li>
                  @endforeach
                  </ul>
                </div>
                @endif
              </td>
              <td>
                <span class="text-muted" title="{{ $user->created_at->formatLocalized(Config::get('shop.date-long')) }}"
                  data-toggle="tooltip" data-placement="left" data-original-title="{{ $user->created_at->formatLocalized(Config::get('shop.date-long')) }}"
                  >
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