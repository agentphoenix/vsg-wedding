<?php namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Eloquent
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $guarded = [];

	/**
	 * Relationships
	 */

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}
