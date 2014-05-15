<?php

class UsersController extends \BaseController {

  public function __construct() {
    parent::__construct();
    $this->beforeFilter('auth', ['only' => ['edit', 'update']]);
    $this->beforeFilter('admin', ['only' => ['index']]);
  }

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
    $users = User::orderBy('created_at', 'DESC')->with('orders')->get();
    return View::make('users.index')
      ->withTitle(count($users).' '.Lang::get('users.name'))
      ->withUsers($users);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /register
	 *
	 * @return Response
	 */
	public function create()
	{
    return View::make('users.create')
      ->withTitle(Lang::get('users.create'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
    $validation = Validator::make(Input::all(), User::$rules);

    if ($validation->fails()) {
      return Redirect::route('users.create')
        ->withErrors($validation)
        ->withInput();
    }

    $user = User::create(Input::all());
    Auth::login($user);

    return Redirect::home()
      ->with('message', Lang::get('users.create-success'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /profile
	 *
	 * @return Response
	 */
	public function edit()
	{
    $user = Auth::user();
    return View::make('users.edit')
      ->withUser($user)
      ->withTitle(Lang::get('users.profile'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  User  $user
	 * @return Response
	 */
	public function update(User $user)
	{
    if($user->admin)
    {
      return Redirect::route('users.edit')
        ->withMessage("Admin user can't be changed.");
    }
    
    $validation = Validator::make(Input::all(), User::$updateRules);

    if ($validation->fails()) {
      return Redirect::route('users.edit')
        ->withErrors($validation)
        ->withInput();
    }

		$user->update(Input::all());

    return Redirect::route('users.edit')
      ->withMessage(Lang::get('users.update-success'));
	}

	/**
	 * Display login form.
	 * GET /login
	 *
	 * @return Response
	 */
  public function login() {
    return View::make('users.login')
      ->with('title', 'Log in');
  }

	/**
	 * Attempt user login.
	 * POST /login
	 *
	 * @return Response
	 */
  public function doLogin() {
    if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')], true)) {
      return Redirect::intended();
    }

    return Redirect::route('users.login')
      ->with('message', Lang::get('users.login-error'));
  }

	/**
	 * Log out the user.
	 * GET /logout
	 *
	 * @return Response
	 */
  public function logout() {
    Auth::logout();
    return Redirect::home()
      ->with('message', Lang::get('users.logout-message'));
  }

}