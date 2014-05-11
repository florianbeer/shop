<?php

class ShopController extends \BaseController {

	/**
	 * Displays the shop homepage
	 * GET /
	 *
	 * @return Response
	 */
	public function index()
	{
    $query = Input::get('q');
    if ($query)
    {

      if (strlen($query) < 3)
      {
        return Redirect::home()->withMessage(Lang::get('shop.query-error'));
      }

      $products = Search::product($query);      
      $count = $products->getTotal();
      
      if ($count === 0)
      {
        return Redirect::home()->withMessage(Lang::get('shop.search-error', ['keyword' => $query]));
      }

      $title = Lang::choice('shop.search-title', $count, ['count' => $count, 'keyword' => $query]);

    }
    else
    {
      $title = Lang::get('shop.featured');
      $products = Product::orderBy('created_at', 'DESC')
        ->featured()
        ->paginate(Config::get('shop.items-per-page'));
    }

    return View::make('shop.index')
      ->withQuery($query)
      ->withTitle($title)
      ->withProducts($products);

	}

	/**
	 * Displays the contact page
	 * GET /contact
	 *
	 * @return Response
	 */
	public function contact()
	{
    return View::make('shop.contact')
      ->with('title', 'Contact');
	}
  
	/**
	 * Displays the contact page
	 * GET /contact
	 *
	 * @return Response
	 */
	public function sitemap()
	{
    $categories = Category::remember(4320)->get();
    $products = Product::remember(4320)->get();
    return View::make('shop.sitemap')
      ->withCategories($categories)
      ->withProducts($products);
	}  

}