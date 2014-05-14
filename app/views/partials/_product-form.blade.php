{{ Form::model($product, ['route' => $route, 'method' => $method, 'files' => true, 'class' => 'col-lg-4 col-md-4']) }}
  <div class="form-group">
    {{ Form::select('category_id', $categories, null, ['class' => "form-control"]) }}
  </div>
  <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
    {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => Lang::get('misc.title'))) }}
    @foreach($errors->get('title') as $message)
      <span class='help-block'>{{ $message }}</span>
    @endforeach
  </div>
  <div class="form-group {{ $errors->has('description') ? 'has-error' : false }}">
    {{ Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => Lang::get('misc.description'))) }}
    @foreach($errors->get('description') as $message)
      <span class='help-block'>{{ $message }}</span>
    @endforeach
  </div>
  <div class="form-group {{ $errors->has('price') ? 'has-error' : false }}">
    <div class="input-group">
      {{ Form::text('price', null, array('class' => 'form-control', 'placeholder' => Lang::get('misc.price'))) }}
      <span class="input-group-addon">{{ Config::get('shop.currency-symbol') }}</span>
    </div>
    @foreach($errors->get('price') as $message)
      <span class='help-block'>{{ $message }}</span>
    @endforeach
  </div>
  <div class="form-group {{ $errors->has('tax') ? 'has-error' : false }}">
    <div class="input-group">
      {{ Form::text('tax', null, array('class' => 'form-control', 'placeholder' => Lang::get('misc.tax'))) }}
      <span class="input-group-addon">%</span>
    </div>
    @foreach($errors->get('tax') as $message)
      <span class='help-block'>{{ $message }}</span>
    @endforeach
  </div>
  <div class="form-group {{ $errors->has('image') ? 'has-error' : false }}">
    {{ Form::file('image') }}
    @foreach($errors->get('image') as $message)
      <span class='help-block'>{{ $message }}</span>
    @endforeach
  </div>
  <div class="form-group">
    {{ Form::submit(Lang::get('misc.send'), array('class' => 'btn btn-primary pull-right')) }}
  </div>
  <div class="col-xs-12">&nbsp;</div>
{{ Form::close() }}

@if ($product)
    <div class="col-lg-7 col-lg-offset-1 col-md-7 col-md-offset-1 col-xs-12">
      {{ HTML::image($product->image, $product->title, array('class' => 'img-responsive')) }}
    </div>
@endif