<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::post('/posts/{post}/favorites', 'FavoritesController@store');
Route::delete('/posts/{post}/favorites', 'FavoritesController@destroy');

Route::get('/posts', 'PostsController@index')->multiformat();
Route::get('/posts/create', 'PostsController@create')->name('posts.create');
Route::post('/posts', 'PostsController@store')->name('posts.store');

Route::get('/sign-in', 'LoginController@index')->name('login');
Route::post('/sign-in', 'LoginController@authenticate')->name('authenticate');
Route::post('/sign-out', 'LoginController@logout')->name('sign-out');
Route::get('/sign-in/get-guarded-users', 'LoginController@getGuardedUsers');

Route::get('test', function () {
	$user = App\User::find(3);
	$events = $user->events;
	$posts = App\Post::whereIn('event_id', $events->pluck('id'))->latest()->get()->toArray();

	dd(
		$user->fullName,
		$user->events->pluck('name')->all(),
		$posts
	);
});
