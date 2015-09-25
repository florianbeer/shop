<?php

/**
 * Class CartController
 */
class CartController extends \BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return View::make('cart.index')
            ->withTitle(Lang::get('cart.name'))
            ->withShipping([])
            ->withPayment([])
            ->withProducts(Cart::contents());
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $quantity = Input::get('quantity');
        $validation = Validator::make(['quantity' => $quantity], ['quantity' => 'integer|required|min:1']);

        if ( $validation->fails() )
        {
            return Redirect::back()
                ->withMessage(implode('<br>', $validation->errors()->get('quantity')));
        }

        $product = Product::find(Input::get('id'));

        if ( $product )
        {
            Cart::insert([
                'id'       => $product->id,
                'name'     => $product->title,
                'price'    => str_replace(',', '.', $product->price),
                'tax'      => $product->tax,
                'quantity' => $quantity,
                'image'    => $product->image
            ]);

            return Redirect::back()
                ->withMessage(Lang::get('cart.success-message', ['title' => $product->title]));
        }

        return Redirect::home();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $item = Cart::item($id);
        if ( $item )
        {
            $name = $item->name;
            $item->remove();

            return Redirect::route('cart.index')
                ->withMessage(Lang::get('cart.remove-message', ['title' => $item->name]));
        }

        return Redirect::home();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function qtyUp($id)
    {
        $item = Cart::item($id);
        if ( $item )
        {
            $item->quantity++;

            return Redirect::back();
        }

        return Redirect::home();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function qtyDown($id)
    {
        $item = Cart::item($id);
        if ( $item )
        {
            $item->quantity--;
            if ( $item->quantity <= 0 )
            {
                $item->remove();
            }

            return Redirect::back();
        }

        return Redirect::home();
    }

}
