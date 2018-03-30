<?php namespace App;

use Eloquent;

class Event extends Eloquent
{
	protected $dates = ['date'];
	protected $guarded = [];

	/**
	 * Relationships
	 */

	public function guests()
	{
		return $this->belongsToMany(User::class, 'events_users');
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}
}
