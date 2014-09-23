<?php namespace Shop\Mailers;

use User;
use Order;
use Lang;
use Config;

class OrderMailer extends Mailer {

  public function orderCreate(User $user, Order $order)
  {
    $admins = User::admin()->get();
    $subject = Lang::get('mails.order-create-subject', ['shopname' => Config::get('shop.title')]);
    $view = 'mails.order-create';
    $data = [
      'user' => $user->toArray(),
      'order' => $order->toArray(),
      'items' => json_decode($order->items)
    ];

    foreach($admins as $admin){
      $this->send($admin, $subject, $view, $data);
    }

    return $this->send($user, $subject, $view, $data);
  }

}