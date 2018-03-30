<?php namespace App;

use Eloquent;

class Comment extends Eloquent
{
	protected $guarded = [];

	/**
	 * Relationships
	 */

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}
