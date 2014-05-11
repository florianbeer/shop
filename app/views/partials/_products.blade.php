@foreach(array_chunk($products->all(), 2) as $row)
  <div class="row">
    @foreach($row as $product)
      <article class="media col-md-6 col-xs-12">
        <a class="pull-left" href="{{ URL::route('products.show', $product->id) }}">
          {{ HTML::image(str_replace('products/', 'products/thumb-', $product->image), $product->title, ['class' => 'img-responsive thumbnail', 'height' => '128', 'width' => '170']) }}
        </a>
        <div class="media-body">
          <h4 class="media-heading"><a href="{{ URL::route('products.show', $product->id) }}">{{ $product->title }}</a></h4>
          <p>{{ nl2br($product->description) }}</p>
          {{ Form::open(['route' => 'cart.store']) }}
            <div class="input-group input-group-sm col-xs-4">
              {{ Form::hidden('quantity', 1) }}
              {{ Form::hidden('id', $product->id) }}
              <button type="submit" class="btn btn-primary btn-sm form-control">
                <span class="glyphicon glyphicon-shopping-cart"></span> {{ Lang::get('shop.add-to-cart') }}
              </button>
              <span class="price input-group-addon">{{ $product->price }} {{ Config::get('shop.currency-symbol') }}</span>
            </div>
          {{Form::close() }}
        </div>
        <hr class="visible-sm visible-xs">
      </article>
    @endforeach
  </div>
  <hr class="hidden-sm hidden-xs">
@endforeach