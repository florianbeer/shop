<?php namespace Shop\Search;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider {
  
  public function register()
  {
    $this->app->bind('search', 'Shop\Search\Search');
  }
  
}