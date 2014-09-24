<?php

class RemindersController extends Controller {

    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function getRemind()
    {
        return View::make('password.remind')
            ->withTitle(Lang::get('misc.password-remind'));
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind()
    {
        switch ($response = Password::remind(Input::only('email'), function ($message)
        {
            $message->subject(Lang::get('reminders.mail-subject'));
        }))
        {
            case Password::INVALID_USER:
                return Redirect::back()->with('message', Lang::get($response));

            case Password::REMINDER_SENT:
                return Redirect::home()->with('message', Lang::get($response));
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if ( is_null($token) ) App::abort(404);

        return View::make('password.reset')
            ->withToken($token)
            ->withTitle(Lang::get('misc.password-reset'));
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password)
        {
            $user->password = $password;

            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('message', Lang::get($response))->withInput();

            case Password::PASSWORD_RESET:
                return Redirect::route('users.login')->with('message', Lang::get('misc.password-reset-message'));
        }
    }

}
