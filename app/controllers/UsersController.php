<?php

class UsersController extends BaseController {

  public function __construct() {
    parent::__construct();
    $this->beforeFilter('auth', ['only' => ['getOrderHistory', 'getProfile']]);
  }

  public function getIndex() {
    $users = User::orderBy('created_at', 'DESC')->with('order')->get();
    return View::make('users.index')
      ->with('title', count($users).' Users')
      ->with('users', $users);
  }
  
  public function getOrder($id) {
    $order = Order::with('user')->find($id);
    if (Auth::user()->admin == 1 || $order->user == Auth::user()){
      return View::make('orders.view')
        ->with('order', $order)
        ->with('items', json_decode($order->items))
        ->with('title', 'Order #'.$order->id);
    }
    return Redirect::home()
      ->with('message', 'Order not found');
    
  }
  
  public function getOrderHistory() {
    return View::make('orders.show')
      ->with('orders', Auth::user()->order)
      ->with('title', 'Order history');
  }
  
  public function getNewaccount() {
    return View::make('users.newaccount')
      ->with('title', 'Sign up');
  }
  
  public function postCreate() {
    $validator = Validator::make(Input::all(), User::$rules);
    
    if ($validator->passes()) {
      $user = new User;
      $user->firstname = Input::get('firstname');
      $user->lastname = Input::get('lastname');
      $user->email = Input::get('email');
      $user->password = Hash::make(Input::get('password'));
      $user->street = Input::get('street');
      $user->number = Input::get('number');
      $user->zip = Input::get('zip');
      $user->city = Input::get('city');
      $user->country = Input::get('country');
      $user->save();
      
      return Redirect::to('/users/signin')
        ->with('message', 'Thank you for creating a new account. Please sign in.');
    }
    
    return Redirect::to('/users/newaccount')
      ->withErrors($validator)
      ->withInput();
  }
  
  public function postUpdate() {
    $validator = Validator::make(Input::all(), User::$rulesUpdate);
    
    if ($validator->passes()) {
      $user = User::find(Auth::user()->id);
      $user->firstname = Input::get('firstname');
      $user->lastname = Input::get('lastname');
      $user->email = Input::get('email');
      $user->street = Input::get('street');
      $user->number = Input::get('number');
      $user->zip = Input::get('zip');
      $user->city = Input::get('city');
      $user->country = Input::get('country');
      $user->save();
      
      return Redirect::to('/users/profile')
        ->with('message', 'Your profile was updated');
    }
    
    return Redirect::to('/users/profile')
      ->withErrors($validator)
      ->withInput();
  }
  
  public function getSignin() {
    return View::make('users.signin')
      ->with('title', 'Log in');
  }
  
  public function postSignin() {
    if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
      return Redirect::to('/');
    }
    
    return Redirect::to('users/signin')
      ->with('message', 'Your email/password combo was incorrect');
  }
  
  public function getSignout() {
    Auth::logout();
    return Redirect::home()
      ->with('message', 'You have been signed out');
  }
  
  public function getProfile() {
    $user = Auth::user();
    return View::make('users.profile')
      ->with('user', $user)
      ->with('title', 'Profile');
  }
    
}