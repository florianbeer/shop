@foreach($products as $i => $product)
  @if ($i % 2 == 0)
  <div class="row">
  @endif
  <div class="media col-md-6">
    <a class="pull-left" href="/store/view/{{ $product->id }}">
      {{ HTML::image($product->image, $product->title, ['class' => 'img-responsive thumbnail', 'width' => '128']) }}
    </a>
    <div class="media-body">
      <h4 class="media-heading"><a href="/store/view/{{ $product->id }}">{{ $product->title }}</a></h4>
      <p>{{ nl2br($product->description) }}</p>
      {{ Form::open(['url' => 'store/addtocart']) }}
        <div class="input-group input-group-sm col-xs-4">
          {{ Form::hidden('quantity', 1) }}
          {{ Form::hidden('id', $product->id) }}
          <button type="submit" class="btn btn-primary btn-sm form-control">
            <span class="glyphicon glyphicon-shopping-cart"></span>Add to cart
          </button>
          <span class="price input-group-addon">{{ money_format('%!.2n', $product->price) }} {{ Config::get('shop.currency-symbol') }}</span>
        </div>
      {{Form::close() }}
    </div>
  </div>
  <hr class="visible-sm visible-xs">
  @if ($i % 2 != 0)
  </div><hr class="hidden-sm hidden-xs">
  @endif
@endforeach
@if($i % 2 == 0)
</div><hr class="hidden-sm hidden-xs">
@endif