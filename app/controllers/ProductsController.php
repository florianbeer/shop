<?php

use Shop\Creators\ProductCreator;

class ProductsController extends \BaseController {

  public function __construct() {
    parent::__construct();
    $this->beforeFilter('admin', ['except' => ['show']]);
  }

	/**
	 * Display a listing of the resource.
	 * GET /products
	 *
	 * @return Response
	 */
	public function index()
	{
    $filter = Input::get('filter');

    if ($filter === 'featured')
    {
      $title = Lang::get('products.featured');
      $products = Product::orderBy('created_at', 'DESC')->featured()->paginate(10);
    }
    else if ($filter === 'outofstock')
    {
      $title = Lang::get('products.out-of-stock');
      $products = Product::orderBy('created_at', 'DESC')->outOfStock()->paginate(10);
    }
    else
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
	 * Store a newly created resource in storage.
	 * POST /products
	 *
	 * @return Response
	 */
	public function store()
	{
    $creator = new ProductCreator($this);
    return $creator->create(Input::all());
	}

	/**
	 * Display the specified resource.
	 * GET /products/{id}
	 *
	 * @param  Product $product
	 * @return Response
	 */
	public function show(Product $product)
	{
    if ($product->availability) {
      return View::make('products.show')
        ->withTitle($product->title)
        ->withProduct($product);
    }

    return Redirect::home()
      ->with('message', Lang::get('products.name').' '.Lang::get('misc.not-found'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /products/{id}/edit
	 *
	 * @param  Prodcut $product
	 * @return Response
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
	 * Update the specified resource in storage.
	 * PUT /products/{id}
	 *
	 * @param  Product  $product
	 * @return Response
	 */
	public function update(Product $product)
	{
    $creator = new ProductCreator($this);
    return $creator->create(Input::all(), $product);
  }

	/**
	 * Remove the specified resource from storage.
	 * GET /products/{id}/delete
	 *
	 * @param  Product  $product
	 * @return Response
	 */
	public function destroy(Product $product)
	{
    File::delete(public_path().DIRECTORY_SEPARATOR.$product->image);
    File::delete(public_path().DIRECTORY_SEPARATOR.str_replace('img/products/', 'img/products/thumb-', $product->image));
    File::delete(public_path().DIRECTORY_SEPARATOR.str_replace('img/products/', 'img/products/small-', $product->image));
    $product->delete();
    return Redirect::route('products.index')
      ->with('message', $product->title.' '.Lang::get('misc.deleted'));
	}

	/**
	 * Set availability status (in stock vs. out of stock).
	 * GET /products/{id}/toggleAvailability
	 *
	 * @param  Product  $product
	 * @return Response
	 */
  public function toggleAvailability(Product $product)
  {
    $product->availability = !$product->availability;
    $product->save();
    return Redirect::back()
      ->withMessage($product->title.' '.Lang::get('misc.updated'));
  }

	/**
	 * Set featured status.
	 * GET /products/{id}/toggleFeatured
	 *
	 * @param  Product  $product
	 * @return Response
	 */
  public function toggleFeatured(Product $product)
  {
    $product->featured = !$product->featured;
    $product->save();
    return Redirect::back()
      ->withMessage($product->title.' '.Lang::get('misc.updated'));
  }


	/**
	 * Product creator calback if creation fails.
	 *
	 * @return Response
	 */
  public function productCreationFails($errors)
  {
    return Redirect::back()
      ->withErrors($errors)
      ->withInput();
  }

	/**
	 * Product creator calback if creation succeeds.
	 *
	 * @return Response
	 */
  public function productCreationSucceeds()
  {
    return Redirect::route('products.index')
      ->withMessage(Lang::get('products.name').' '.Lang::get('misc.saved'));
  }

}