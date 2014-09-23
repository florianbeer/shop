<?php namespace Shop\Mailers;

use User;
use Order;
use Lang;
use Config;

/**
 * Class OrderMailer
 * @package Shop\Mailers
 */
class OrderMailer extends Mailer {

    /**
     * @param User $user
     * @param Order $order
     */
    public function orderCreate(User $user, Order $order)
    {
        $admins = User::admin()->get();
        $subject = Lang::get('mails.order-create-greeting').' '.Config::get('shop.title').' | #' . $order->id;
        $view = 'mails.order-create';
        $data = [
            'user'  => $user->toArray(),
            'order' => $order->toArray(),
            'items' => json_decode($order->items)
        ];

        foreach ( $admins as $admin ) {
            $this->send($admin, $subject, $view, $data);
        }

        return $this->send($user, $subject, $view, $data);
    }

}