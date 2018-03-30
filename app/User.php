<?php namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	protected $appends = ['fullName'];
	protected $guarded = [];
	protected $with = ['events'];

	/**
	 * Relationships
	 */

	public function events()
	{
		return $this->belongsToMany(Event::class, 'events_users');
	}

	/**
	 * Attributes
	 */

	public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}
}
