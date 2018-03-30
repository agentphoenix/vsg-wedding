<?php namespace App\Http\Controllers;

use Hash;
use App\User;

class LoginController extends Controller
{
	public function index()
	{
		return view('login');
	}

	public function authenticate()
	{
		// Find the user
		$user = User::where('last_name', trim(str_replace(' ', '', request('last_name'))))
			->where('first_name', trim(request('first_name')))
			->first();

		// We found the user
		if ($user) {
			if ($user->password !== null) {
				if (! Hash::check(request('password'), $user->password)) {
					return redirect()
						->back()
						->with('error', 'Nice try...');
				}
			}

			// Log in the user
			auth()->login($user, true);

			// Send them to the home page
			return redirect()->route('home');
		}

		$errorMessages = [
			"Rule #1: Never leave a fellow Crasher behind. Crashers take care of their own.",
			"Rule #2: Never use your real name.",
			"Rule #7: Blend in by standing out.",
			"Rule #8: Be the life of the party.",
			"Rule #14: You're a distant relative of a dead cousin.",
			"Rule #24: If you get outed, leave calmly. Do not run.",
			"Rule #32: Don't commit to a relative unless you're absolutely sure that they have a pulse.",
			"Rule #47: You forgot your invitation in your rush to get to the church.",
			"Rule #55: If pressed, tell people you're related to Uncle John. Everyone has an Uncle John.",
			"Rule #95: Try not to show off on the dance floor. This means you, ".request('first_name'),
		];

		// Do something if we don't find the user
		return redirect()
			->back()
			->with('error', $errorMessages[array_rand($errorMessages)]);
	}

	public function logout()
	{
		auth()->logout();

		return redirect()->route('sign-in');
	}

	public function getGuardedUsers()
	{
		return User::where('password', '!=', null)->get();
	}
}
