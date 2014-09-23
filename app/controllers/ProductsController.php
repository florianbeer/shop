<?php

use Shop\Creators\ProductCreator;

/**
 * Class ProductsController
 */
class ProductsController extends \BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('admin', ['except' => ['show']]);
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function show(Product $product)
    {
        if ( $product->availability )
        {
            return View::make('products.show')
                ->withTitle($product->title)
                ->withProduct($product);
        }

        return Redirect::home()
            ->with('message', Lang::get('products.name') . ' ' . Lang::get('misc.not-found'));
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $filter = Input::get('filter');

        if ( $filter === 'featured' )
        {
            $title = Lang::get('products.featured');
            $products = Product::orderBy('created_at', 'DESC')->featured()->paginate(10);
        } else if ( $filter === 'outofstock' )
        {
            $title = Lang::get('products.out-of-stock');
            $products = Product::orderBy('created_at', 'DESC')->outOfStock()->paginate(10);
        } else
        {
            $title = Lang::get('products.name');
            $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        }

        return View::make('products.index')
            ->withProduct([])
            ->withMethod('post')
            ->withRoute('products.store')
            ->withTitle($title)
            ->withCategories(Category::orderBy('created_at', 'DESC')->lists('name', 'id'))
            ->withProducts($products);
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $creator = new ProductCreator($this);

        return $creator->create(Input::all());
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function edit(Product $product)
    {
        return View::make('products.edit')
            ->withRoute(['products.update', $product->id])
            ->withMethod('patch')
            ->withTitle($product->title)
            ->withCategories(Category::orderBy('created_at', 'DESC')->lists('name', 'id'))
            ->withProduct($product);
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function update(Product $product)
    {
        $creator = new ProductCreator($this);

        return $creator->create(Input::all(), $product);
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function destroy(Product $product)
    {
        File::delete(public_path() . DIRECTORY_SEPARATOR . $product->image);
        File::delete(public_path() . DIRECTORY_SEPARATOR . str_replace('img/products/', 'img/products/thumb-', $product->image));
        File::delete(public_path() . DIRECTORY_SEPARATOR . str_replace('img/products/', 'img/products/small-', $product->image));
        $product->delete();

        return Redirect::route('products.index')
            ->with('message', $product->title . ' ' . Lang::get('misc.deleted'));
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function toggleAvailability(Product $product)
    {
        $product->availability = ! $product->availability;
        $product->save();

        return Redirect::back()
            ->withMessage($product->title . ' ' . Lang::get('misc.updated'));
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function toggleFeatured(Product $product)
    {
        $product->featured = ! $product->featured;
        $product->save();

        return Redirect::back()
            ->withMessage($product->title . ' ' . Lang::get('misc.updated'));
    }

    /**
     * @param $errors
     * @return mixed
     */
    public function productCreationFails($errors)
    {
        return Redirect::back()
            ->withErrors($errors)
            ->withInput();
    }

    /**
     * @return mixed
     */
    public function productCreationSucceeds()
    {
        return Redirect::route('products.index')
            ->withMessage(Lang::get('products.name') . ' ' . Lang::get('misc.saved'));
    }

}