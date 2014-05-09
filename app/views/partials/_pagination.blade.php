<div class="row pull-right">
  <div class="col-lg-12">
    @if(isset($s))
    {{ $products->appends(array('s' => $s))->links() }}
    @else
    {{ $products->links() }}
    @endif
  </div>
</div>
<div class="clearfix"></div>