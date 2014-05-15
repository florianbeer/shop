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
            {{ Form::hidden('quantity', 1) }}
            {{ Form::hidden('id', $product->id) }}
            <div class="input-group input-group-sm col-xs-4">
              {{ Form::text('quantity', 1, ['class' => 'qty form-control']) }}
              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">
                  <span class="glyphicon glyphicon-shopping-cart"></span> {{ Lang::get('shop.add-to-cart') }}
                </button>
              </span>
              <span class="input-group-addon price-wrap"><span class="price" data-price="{{ $product->price }}">{{ $product->price }}</span> {{ Config::get('shop.currency-symbol') }}</span>
            </div>
          {{Form::close() }}
        </div>
        <hr class="visible-sm visible-xs">
      </article>
    @endforeach
  </div>
  <hr class="hidden-sm hidden-xs">
@endforeach