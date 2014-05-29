@include('partials._head')

@if (Session::has('message'))
<div class="alert alert-warning alert-dismissable fade" data-alert="alert" id="alert-message">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('message') }}
  </div>
</div>
@endif


@include('partials._navbar')
<div class="side-collapse-container">
  <div class="wrap-home">
    <div class="container" id="main" role="main">
      <div class="row">
        <div class="page-header col-xs-12 text-center">
          <h1>
            <div class="wow fadeInDown " data-wow-delay="0.1s">
              Welcome to the <strong>Demo</strong>.
            </div>
            @yield('print')
          </h1>
        </div>

        <div class="row">
          <div class="col-xs-12 text-center wow fadeInUp">
            <p>
              Login information is available on the {{ HTML::linkRoute('users.login', 'login page') }}.<br>
            </p>
            <p>
              All sample data will be refreshed every 24 hours.<br>
              Feel free to browse around, add, edit, delete, order etc.
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="container">
    @yield('breadcrumbs')

    @yield('pagination')

    <h3>
      @yield('icon')
      {{ Lang::get('shop.featured') }}
    </h3>
    @yield('content')

    @yield('pagination')
  </div>
</div>

@include('partials._footer')