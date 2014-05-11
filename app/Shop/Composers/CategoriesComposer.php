<?php namespace Shop\Composers;

use Category;
use Cache;

/*
 * View composer for Categories listing in Navbar.
 *
 * Query will be cached forever. CategoriesController 
 * clears cache item on collection change.
 *
 */

class CategoriesComposer {
  
  public function compose($view)
  {
    $categories = Cache::rememberForever('shop.navbar-categories', function()
    {
        return Category::orderBy('created_at', 'DESC')->get();
    });
    
    $view->with('categories', $categories);
  }
  
}