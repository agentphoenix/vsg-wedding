<?php namespace App\Http\Controllers;

use App\User;

class UsersController extends Controllers
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function update(User $user)
	{
		$user->update(request()->all());

		return $user;
	}
}
