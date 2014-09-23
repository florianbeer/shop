<?php namespace Shop\Mailers;

use \Mail;

abstract class Mailer {

  public function send($user, $subject, $view, $data = [])
  {
    Mail::queue($view, $data, function($message) use ($user, $subject){
      $message->to($user->email, $user->firstname.' '.$user->lastname)->subject($subject);
    });
  }

}