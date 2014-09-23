<?php

/**
 * Class CategoriesController
 */
class CategoriesController extends \BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('admin', ['except' => ['show']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return View::make('categories.index')
            ->withRoute('categories.store')
            ->withMethod('post')
            ->withTitle(Lang::get('categories.name'))
            ->withCategory([])
            ->withCategories(Category::orderBy('created_at', 'DESC')->get());
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $validation = Validator::make(Input::all(), Category::$rules);

        if ( $validation->fails() )
        {
            return Redirect::route('categories.index')
                ->withErrors($validation)
                ->withInput();
        }

        $category = Category::create(Input::all());
        Cache::forget('shop.navbar-categories');

        return Redirect::route('categories.index')
            ->with('message', $category->name . ' ' . Lang::get('misc.created'));

    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function show(Category $category)
    {
        $products = Product::where('category_id', '=', $category->id)
            ->inStock()
            ->paginate(Config::get('shop.items-per-page'));

        return View::make('categories.show')
            ->withTitle($category->name)
            ->withProducts($products);
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function edit(Category $category)
    {
        return View::make('categories.edit')
            ->withRoute(['categories.update', $category->id])
            ->withMethod('put')
            ->withTitle($category->name)
            ->withCategory($category);
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function update(Category $category)
    {
        $validation = Validator::make(Input::all(), Category::$rules);

        if ( $validation->fails() )
        {
            return Redirect::route('categories.edit', $category->id)
                ->withErrors($validation)
                ->withInput();
        }

        $category->name = Input::get('name');
        $category->save();
        Cache::forget('shop.navbar-categories');

        return Redirect::route('categories.edit', $category->id)
            ->with('message', $category->name . ' ' . Lang::get('misc.updated'));
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function destroy(Category $category)
    {
        $productsCount = $category->products->count();
        if ( $productsCount )
        {
            return View::make('categories.delete')
                ->withProductsCount($productsCount)
                ->withCategories(Category::orderBy('created_at', 'DESC')->lists('name', 'id'))
                ->withCategory($category)
                ->withTitle($category->name);
        }

        $category->delete();
        Cache::forget('shop.navbar-categories');

        return Redirect::route('categories.index')
            ->with('message', $category->name . ' ' . Lang::get('misc.deleted'));
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function moveProducts(Category $category)
    {
        Product::where('category_id', '=', Input::get('old_category_id'))
            ->update(['category_id' => Input::get('category_id')]);

        $category->delete();
        Cache::forget('shop.navbar-categories');

        return Redirect::route('categories.index')
            ->with('message', $category->name . ' ' . Lang::get('misc.deleted'));

    }

}