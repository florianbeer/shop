<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

  protected $fillable = ['firstname', 'lastname', 'email', 'street', 'number', 'zip', 'city', 'country'];
  
  public static $rules = [
    'firstname' => 'required|min:2|alpha',
    'lastname' => 'required|min:2|alpha',
    'email' => 'required|email|unique:users',
    'password' => 'required|alpha_num|between:8,12|confirmed',
    'password_confirmation' => 'required|alpha_num|between:8,12',
    'street' => 'required',
    'number' => 'required',
    'zip' => 'required|between:2,8',
    'city' => 'required',
    'country' => 'required',
    'admin' => 'integer'
  ];
  
  public static $rulesUpdate = [
    'firstname' => 'required|min:2|alpha',
    'lastname' => 'required|min:2|alpha',
    'email' => 'required|email',
    'street' => 'required',
    'number' => 'required',
    'zip' => 'required|between:2,8',
    'city' => 'required',
    'country' => 'required',
    'admin' => 'integer'
  ];
  
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

  public function order() {
    return $this->hasMany('Order');
  }


}
