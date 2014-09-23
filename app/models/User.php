<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

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

    /**
     * Specifies which fileds are mass asignable
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'password', 'email', 'street', 'number', 'zip', 'city', 'country'];

    /**
     * Validation rules for user creation
     *
     * @var array
     */
    public static $rules = [
        'firstname'             => 'required|min:2|alpha',
        'lastname'              => 'required|min:2|alpha',
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|alpha_num|between:6,12|confirmed',
        'password_confirmation' => 'required|alpha_num|between:6,12',
        'street'                => 'required',
        'number'                => 'required',
        'zip'                   => 'required|between:2,8',
        'city'                  => 'required',
        'country'               => 'required',
        'admin'                 => 'integer'
    ];

    /**
     * Validation rules for user update
     *
     * @var array
     */
    public static $updateRules = [
        'firstname' => 'required|min:2|alpha',
        'lastname'  => 'required|min:2|alpha',
        'email'     => 'required|email',
        'street'    => 'required',
        'number'    => 'required',
        'zip'       => 'required|between:2,8',
        'city'      => 'required',
        'country'   => 'required',
        'admin'     => 'integer'
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
     * @param  string $value
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

    /**
     * One to many relation for orders
     *
     * @return mixed
     */
    public function orders()
    {
        return $this->hasMany('Order');
    }

    /**
     * Ensures the password is always hashed before saving to storage
     *
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Query scope for admin users
     *
     * @param string $query
     * @return query
     */
    public function scopeAdmin($query)
    {
        return $query->whereAdmin(1);
    }

}
