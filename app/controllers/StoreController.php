<?php

class StoreController extends BaseController {

  public static $orderRules = [
    'quantity' => 'integer|required|min:1'
  ];
  

  public function __construct() {
    parent::__construct();
    $this->beforeFilter('auth', ['only' => ['postAddtocart', 'getCart', 'getRemoveitem']]);
  }
  
  public function getIndex() {
    return View::make('store.index')
      ->with('title', 'Featured products')
      ->with('products', Product::orderBy('created_at', 'DESC')
        ->where('availability', '=', 1)
        ->where('featured', '=', 1)
        ->get());
  }
  
  public function getView($id) {
    $product = Product::find($id);
    if ($product && $product->availability) {
      return View::make('store.view')
        ->with('title', $product->title)
        ->with('product', $product);      
    }
    
    return Redirect::home()
      ->with('message', 'Product not found');
    
  }
  
  public function getCategory($id) {
    $category = Category::find($id);
    if ($category){
      $products = Product::where('category_id', '=', $id)
        ->where('availability', '=', 1)
        ->paginate(6);
    
      return View::make('store.category')
        ->with('title', $category->name)
        ->with('products', $products);      
    }
    
    return Redirect::home()
      ->with('message', 'Category not found');
    
  }
  
  public function getSearch() {
    $keyword = Input::get('s');
    if (strlen($keyword) > 2) {
      $count = Product::where('title', 'like', '%'.$keyword.'%')->count();
      if ($count == 0) {
        return Redirect::home()
          ->with('message', 'Nothing found for &quot;'.$keyword.'&quot;');
      }
      
      return View::make('store.search')
        ->with('title',$count.' search results for &quot;'.$keyword.'&quot;')
        ->with('products', Product::where('title', 'like', '%'.$keyword.'%')->paginate(6))
        ->with('s', $keyword);
    }
    
    return Redirect::home()
        ->with('message', 'Please provide a search keyword with at least 3 characters');
  }
  
  public function postAddtocart() {

    $validator = Validator::make(['quantity' => Input::get('quantity')], $this::$orderRules);

    if ($validator->passes()) {
      $product = Product::find(Input::get('id'));
      $quantity = Input::get('quantity');
    
      Cart::insert([
        'id' => $product->id,
        'name' => $product->title,
        'price' => $product->price,
        'tax' => $product->tax,
        'quantity' => $quantity,
        'image' => $product->image
      ]);
    
      return Redirect::back()
        ->with('message', '&quot;'.$product->title.'&quot; was added to your shopping cart');
    }
    
    return Redirect::back()
      ->with('message', 'Invalid quantity')
        ->withErrors($validator);
    
  }
  
  public function getCart() {
    return View::make('store.cart')
      ->with('title', 'Shopping cart')
      ->with('products', Cart::contents());
  }
  
  public function getRemoveitem($id) {
    $item = Cart::item($id);
    $name = $item->name;
    $item->remove();
    return Redirect::to('store/cart')
      ->with('message', '&quot;'.$name.'&quot; was removed from your cart');
  }
  
  public function postCreateorder() {
    $items = [];
    foreach (Cart::contents() as $product) {
      $i = [];
      $i['id'] = $product->id;
      $i['name'] = $product->name;
      $i['price'] = $product->price;
      $i['tax'] = $product->tax;
      $i['quantity'] = $product->quantity;
      array_push($items, $i);
    }

    Order::create([
      'user_id' => Auth::user()->id,
      'subtotal' => Cart::total(false),
      'total' => Cart::total(),
      'items' => json_encode($items)
    ]);
      
    Cart::destroy();
      
    return Redirect::home()
      ->with('message', 'Thank you for ordering! You will receive details in your eMail');
  }
  
  public function getToggleProcessed($id) {
    $order = Order::find($id);
    
    if ($order) {
      if (!$order->processed) {
        $message = 'Order #'.$order->id.' processed';
      } else {
        $message = 'Order #'.$order->id.' re-opened';
      }
      $order->processed = !$order->processed;
      $order->save();
      
      return Redirect::back()
        ->with('message', $message);
    }

    return Redirect::back()
      ->with('message', 'Order not found');
          
  }
   
  public function getContact() {
    return View::make('store.contact')
      ->with('title', 'Contact');
  }

}