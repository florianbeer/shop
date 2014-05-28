<?php

class OrdersController extends \BaseController {

  public function __construct() {
    parent::__construct();
    $this->beforeFilter('auth', ['only' => ['index', 'store', 'show']]);
    $this->beforeFilter('admin', ['only' => ['toggleProcessed']]);
  }

	/**
	 * Display a listing of the resource.
	 * GET /orders
	 *
	 * @return Response
	 */
	public function index()
	{
    return View::make('orders.index')
      ->withOrders(Auth::user()->orders)
      ->withTitle(Lang::get('orders.history'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /cart
	 *
	 * @return Response
	 */
  public function store(){

    $items = [];
    foreach (Cart::contents() as $product) {
      array_push($items, [
        'id' => $product->id,
        'name' => $product->name,
        'price' => str_replace(',', '.', $product->price),
        'tax' => $product->tax,
        'quantity' => $product->quantity
      ]);
    }

    Order::create([
      'user_id' => Auth::user()->id,
      'subtotal' => Cart::total(false),
      'total' => Cart::total(),
      'items' => json_encode($items)
    ]);

    Cart::destroy();

    return Redirect::home()
      ->with('message', Lang::get('orders.order-success-message'));
  }

	/**
	 * Display the specified resource.
	 * GET /orders/{id}
	 *
	 * @param  Order  $order
	 * @return Response
	 */
	public function show($order)
	{
    if (Auth::user()->admin || $order->user == Auth::user()){
      return View::make('orders.show')
        ->withOrder($order)
        ->withTitle(Lang::choice('orders.name',1).' #'.$order->id);
    }
    return Redirect::home()
      ->withMessage(Lang::get('orders.not-found-message'));
	}

	/**
	 * Toggle order status.
	 * GET /orders/{id}/toggleProcessed
	 *
	 * @param  Order  $order
	 * @return Response
	 */
  public function toggleProcessed(Order $order)
  {
    if (!$order->processed) {
      $message = Lang::choice('orders.name', 1).' #'.$order->id.' '.Lang::get('orders.processed');
    } else {
      $message = Lang::choice('orders.name', 1).' #'.$order->id.' '.Lang::get('orders.re-opened');
    }
    $order->processed = !$order->processed;
    $order->save();

    return Redirect::back()
      ->withMessage($message);
  }

}