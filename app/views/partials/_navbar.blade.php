<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Wein Shop</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-th-large"></span>
            <span class="hidden-sm">Categories</span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            @foreach($categories as $category)
            <li>{{ HTML::link('/store/category/'. $category->id, $category->name) }}</li>
            @endforeach
          </ul>
        </li>
        
        @if(Auth::check() && Cart::totalItems() > 0)
        <li>
          <a href="/store/cart">
            <span class="glyphicon glyphicon-shopping-cart"></span> 
            <span class="hidden-sm">Cart</span>
            <span class="badge">{{ Cart::totalItems(true) }}</span>
          </a>
        </li>
        @endif
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
        <li class="visible-md visible-lg visible-xs visible-sm">
          <a href="/users/newaccount">
            <span class="glyphicon glyphicon-plus"></span> Sign up
          </a>
        </li>
        <li class="visible-lg visible-md visible-xs visible-sm">
          <a href="/users/signin"><span class="glyphicon glyphicon-log-in"></span> Log in</a>
        </li>
        @else
        
        @if (Auth::user()->admin == 1)
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-wrench"></span>
            <span class="hidden-sm">Admin</span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li><a href="/admin"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
            <li><a href="/admin/users"><span class="glyphicon glyphicon-user"></span> Users</a></li>
            <li><a href="/admin/categories"><span class="glyphicon glyphicon-th-large"></span> Categories</a></li>
            <li><a href="/admin/products"><span class="glyphicon glyphicon-th"></span> Products</a></li>
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
            @if(count(Auth::user()->order) > 0)
            <li><a href="/order/history"><span class="glyphicon glyphicon-calendar"></span> Order hirstory</a></li>
            @endif
            <li><a href="/users/profile"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            <li><a href="/users/signout"><span class="glyphicon glyphicon-off"></span> Log out</a></li>
          </ul>
        </li>        
        @endif
        
        <li>
        {{ Form::open(['url' => 'store/search', 'method' => 'get', 'class' => 'navbar-form', 'role' => 'search']) }}
          <div class="form-group col-xs-9">
            {{ Form::text('s', isset($s)?$s:'' , ['placeholder' => 'search', 'class' => 'form-control input-sm']) }}
          </div>
          <button type="submit" class="btn btn-primary btn-sm col-xs-2"><span class="glyphicon glyphicon-search"></span></button>
        {{ Form::close() }}
        </li>
      </ul>
    </div>
  </div>
</div>