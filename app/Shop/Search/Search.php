<?php namespace Shop\Search;

use Product;

class Search {
  
  public function product($keyword)
  {
    return Product::search($keyword);
  }
  
}