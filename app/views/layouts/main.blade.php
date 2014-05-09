<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Config::get('shop.title') }} - {{ $title or "Home" }}</title>
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/theme.css') }}
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    @if (Session::has('message'))
    <div class="row">
      <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissable fade" data-alert="alert" id="alert-message">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ Session::get('message') }}
        </div>
      </div>
    </div>
    @endif
    
    @include('partials._navbar')
  
    <div class="container" id="main" role="main">
    
    
      <div class="row">
        <div class="page-header col-xs-12">
          @yield('breadcrumbs')
          <h1>
            @yield('icon')
            {{ $title or "Newest items" }}
            @yield('print')
          </h1>
        </div>
      </div>
    
      @yield('pagination')

      @yield('content')

      @yield('pagination')
    </div>
    
    <footer class="row well well-sm hidden-print">
      <div class="col-lg-12">
        <small class="text-muted">
          <span class="pull-left">&copy;{{ date('Y') }} <a href="http://42dev.eu">42dev</a> - All rights reserved.</span>
          <span class="pull-right">
            <a href="#">Imprint</a> | 
            <a href="#">Privacy policy</a> |
            <a href="#">Terms of service</a> |
            <a href="/contact">Contact us</a>
          </span>
        </small>
      </div>
    </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/main.js') }}
    @yield('script')
  </body>
</html>