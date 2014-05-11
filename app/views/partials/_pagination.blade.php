<div class="row pull-right">
  <div class="col-xs-12">
    {{ $products->appends(Request::except('page'))->links() }}
  </div>
</div>
<div class="clearfix"></div>