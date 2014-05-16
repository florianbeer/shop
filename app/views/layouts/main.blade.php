@include('partials._head')

@if (Session::has('message'))
<div class="alert alert-warning alert-dismissable fade" data-alert="alert" id="alert-message">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('message') }}
  </div>
</div>
@endif


@include('partials._navbar')

<div class="wrap">
  <div class="container" id="main" role="main">
    <div class="row">
      <div class="page-header col-xs-12">
        <h1>
          <div class="wow fadeInDown pull-left" data-wow-delay="0.1s">
            @yield('icon')
            {{ $title or Lang::get('misc.home') }}
          </div>
          @yield('print')
        </h1>
      </div>
    </div>
  </div>
</div>

<div class="container">
  @yield('breadcrumbs')

  @yield('pagination')

  @yield('content')

  @yield('pagination')
</div>

@include('partials._footer')