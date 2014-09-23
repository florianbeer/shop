<?php

use Shop\Mailers\OrderMailer as Mailer;

/**
 * Class OrdersController
 */
class OrdersController extends \BaseController {

    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        parent::__construct();
        $this->beforeFilter('auth', ['only' => ['index', 'store', 'show']]);
        $this->beforeFilter('admin', ['only' => ['toggleProcessed']]);
        $this->mailer = $mailer;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return View::make('orders.index')
            ->withOrders(Auth::user()->orders)
            ->withTitle(Lang::get('orders.history'));
    }

    /**
     * @return mixed
     */
    public function store()
    {

        $user = Auth::user();

        $items = [];
        foreach ( Cart::contents() as $product ) {
            array_push($items, [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => str_replace(',', '.', $product->price),
                'tax'      => $product->tax,
                'quantity' => $product->quantity
            ]);
        }

        $order = Order::create([
            'user_id'  => $user->id,
            'subtotal' => Cart::total(false),
            'total'    => Cart::total(),
            'items'    => json_encode($items)
        ]);

        $this->mailer->orderCreate($user, $order);

        Cart::destroy();

        return Redirect::home()
            ->with('message', Lang::get('orders.order-success-message'));
    }

    /**
     * @param Order $order
     * @return mixed
     */
    public function show(Order $order)
    {
        if ( Auth::user()->admin || $order->user == Auth::user() ) {
            return View::make('orders.show')
                ->withOrder($order)
                ->withTitle(Lang::choice('orders.name', 1) . ' #' . $order->id);
        }

        return Redirect::home()
            ->withMessage(Lang::get('orders.not-found-message'));
    }

    /**
     * @param Order $order
     * @return mixed
     */
    public function toggleProcessed(Order $order)
    {
        if ( ! $order->processed ) {
            $message = Lang::choice('orders.name', 1) . ' #' . $order->id . ' ' . Lang::get('orders.processed');
        } else {
            $message = Lang::choice('orders.name', 1) . ' #' . $order->id . ' ' . Lang::get('orders.re-opened');
        }
        $order->processed = ! $order->processed;
        $order->save();

        return Redirect::back()
            ->withMessage($message);
    }

}
