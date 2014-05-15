<?php

class CartController extends \BaseController {

  public function __construct() {
    parent::__construct();
    $this->beforeFilter('auth');
  }

	/**
	 * Display a listing of the resource.
	 * GET /cart
	 *
	 * @return Response
	 */
	public function index()
	{
    return View::make('cart.index')
      ->withTitle(Lang::get('cart.name'))
      ->withProducts(Cart::contents());
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /cart
	 *
	 * @return Response
	 */
	public function store()
	{
    $quantity = Input::get('quantity');
    $validation = Validator::make(['quantity' => $quantity], ['quantity' => 'integer|required|min:1']);

    if ($validation->fails())
    {
      return Redirect::back()
        ->withMessage(implode('<br>', $validation->errors()->get('quantity')));
    }

    $product = Product::find(Input::get('id'));
    
    if ($product)
    {
      Cart::insert([
        'id' => $product->id,
        'name' => $product->title,
        'price' => str_replace(',', '.', $product->price),
        'tax' => $product->tax,
        'quantity' => $quantity,
        'image' => $product->image
      ]);

      return Redirect::back()
        ->withMessage(Lang::get('cart.success-message', ['title' => $product->title]));      
    }
    
    return Redirect::home();
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /cart/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
    $item = Cart::item($id);
    if ($item)
    {
      $name = $item->name;
      $item->remove();
      return Redirect::route('cart.index')
        ->withMessage(Lang::get('cart.remove-message', ['title' => $item->name]));      
    }
    
    return Redirect::home();
	}

	/**
	 * Increment cart item quantity.
	 * GET /cart/{id}/qtyUp
	 *
	 * @param  String  $id
	 * @return Response
	 */
  public function qtyUp($id)
  {
    $item = Cart::item($id);
    if ($item)
    {
      $item->quantity++;
      return Redirect::back();
    }
    
    return Redirect::home();
  }

	/**
	 * Decrement cart item quantity.
	 * GET /cart/{id}/qtyUp
	 *
	 * @param  String  $id
	 * @return Response
	 */
  public function qtyDown($id)
  {
    $item = Cart::item($id);
    if ($item)
    {
      $item->quantity--;
      if ($item->quantity <= 0)
      {
        $item->remove();
      }
      return Redirect::back();      
    }
    
    return Redirect::home();
  }

}