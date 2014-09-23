<?php namespace Shop\Mailers;

use User;
use Lang;

/**
 * Class UserMailer
 * @package Shop\Mailers
 */
class UserMailer extends Mailer {

    /**
     * @param User $user
     */
    public function welcome(User $user)
    {
        $subject = Lang::get('mails.user-welcome-subject');
        $view = 'mails.user-welcome';
        $data = ['user' => $user->toArray()];

        return $this->send($user, $subject, $view, $data);
    }

}
