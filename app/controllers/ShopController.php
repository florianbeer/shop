<?php

/**
 * Class ShopController
 */
class ShopController extends \BaseController {

    /**
     * @return mixed
     */
    public function index()
    {
        $query = Input::get('q');
        if ( $query ) {

            if ( strlen($query) < 3 ) {
                return Redirect::home()->withMessage(Lang::get('shop.query-error'));
            }

            $products = Search::product($query);
            $count = $products->getTotal();

            if ( $count === 0 ) {
                return Redirect::home()->withMessage(Lang::get('shop.search-error', ['keyword' => $query]));
            }

            $title = Lang::choice('shop.search-title', $count, ['count' => $count, 'keyword' => $query]);

        } else {
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
     * @return mixed
     */
    public function contact()
    {
        return View::make('shop.contact')
            ->with('title', 'Contact');
    }

    /**
     * @return mixed
     */
    public function sitemap()
    {
        $categories = Category::remember(4320)->get();
        $products = Product::remember(4320)->get();

        return View::make('shop.sitemap')
            ->withCategories($categories)
            ->withProducts($products);
    }

    /**
     * @param String $lang
     * @return mixed
     */
    public function switchLanguage($lang)
    {
        Session::put('language', $lang);
        Config::set('app.locale', $lang);

        return Redirect::back();
    }

}