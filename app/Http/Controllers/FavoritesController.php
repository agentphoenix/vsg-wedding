<?php namespace App\Http\Controllers;

use App\Post;

class FavoritesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store(Post $post)
    {
        $post->favorite();
    }

    public function destroy(Post $post)
    {
        $post->unfavorite();
    }
}
