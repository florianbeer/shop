<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">{{ Lang::get('misc.toggle-navigation') }}</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">{{ Config::get('shop.title') }}</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">

        @if ($categories->count() > 1)
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-th-large"></span>
            <span class="hidden-sm">{{ Lang::get('categories.name') }}</span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            @foreach($categories as $category)
            <li>{{ HTML::linkRoute('categories.show', $category->name, [$category->id]) }}</li>
            @endforeach
          </ul>
        </li>
        @else
          @foreach($categories as $category)
            <li>{{ HTML::linkRoute('categories.show', Lang::get('products.all-products'), [$category->id]) }}</li>
          @endforeach
        @endif
        
        @if (Auth::check() && Cart::totalItems() > 0)
        <li>
          <a href="{{ URL::route('cart.index') }}">
            <span class="glyphicon glyphicon-shopping-cart"></span> 
            <span class="hidden-sm">{{ Lang::get('cart.name') }}</span>
            <span class="badge">{{ Cart::totalItems(true) }}</span>
          </a>
        </li>
        @endif
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
        <li class="visible-md visible-lg visible-xs visible-sm">
          <a href="{{ URL::route('users.create') }}">
            <span class="glyphicon glyphicon-plus"></span> {{ Lang::get('users.create') }}
          </a>
        </li>
        <li class="visible-lg visible-md visible-xs visible-sm">
          <a href="{{ URL::route('users.login') }}"><span class="glyphicon glyphicon-log-in"></span> {{ Lang::get('users.login') }}</a>
        </li>
        @else
        
          @if (Auth::user()->admin == 1)
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-wrench"></span>
              <span class="hidden-sm">{{ Lang::get('admin.name') }}</span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ URL::route('admin.index') }}"><span class="glyphicon glyphicon-dashboard"></span> {{ Lang::get('admin.dashboard') }}</a></li>
              <li><a href="{{ URL::route('users.index') }}"><span class="glyphicon glyphicon-user"></span> {{ Lang::get('users.name') }}</a></li>
              <li><a href="{{ URL::route('categories.index') }}"><span class="glyphicon glyphicon-th-large"></span> {{ Lang::get('categories.name') }}</a></li>
              <li><a href="{{ URL::route('products.index') }}"><span class="glyphicon glyphicon-th"></span> {{ Lang::get('products.name') }}</a></li>
            </ul>
          </li>
          @endif
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user"></span>
            <span class="hidden-sm">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::route('orders.index') }}"><span class="glyphicon glyphicon-calendar"></span> {{ Lang::get('orders.history') }}</a></li>
            <li><a href="{{ URL::route('users.edit') }}"><span class="glyphicon glyphicon-user"></span> {{ Lang::get('users.profile') }}</a></li>
            <li><a href="{{ URL::route('users.logout') }}"><span class="glyphicon glyphicon-off"></span> {{ Lang::get('users.logout') }}</a></li>
          </ul>
        </li>        
        @endif
        
        <li>
        {{ Form::open(['route' => 'home', 'method' => 'get', 'class' => 'navbar-form', 'role' => 'search']) }}
          <div class="form-group col-xs-9">
            {{ Form::input('search', 'q', isset($query)?$query:'' , ['placeholder' => Lang::get('misc.search'), 'class' => 'form-control input-sm']) }}
          </div>
          <button type="submit" class="btn btn-primary btn-sm col-xs-2"><span class="glyphicon glyphicon-search"></span></button>
        {{ Form::close() }}
        </li>
      </ul>
    </div>
  </div>
</div>