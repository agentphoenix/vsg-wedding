<?php namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Eloquent
{
	use SoftDeletes;

	protected $appends = ['commentsCount', 'favoritesCount', 'isFavorited', 'mediaCount'];
	protected $dates = ['deleted_at'];
	protected $guarded = [];

	/**
	 * Relationships
	 */

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function comments()
	{
		return $this->morphMany(Comment::class, 'commentable');
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}

	public function favorites()
	{
		return $this->morphMany(Favorite::class, 'favorited');
	}

	public function media()
	{
		return $this->hasMany(Media::class);
	}

	/**
	 * Favoriting a post
	 */

	public function favorite()
	{
		$attributes = ['user_id' => auth()->id()];

		if (! $this->favorites()->where($attributes)->exists()) {
			return $this->favorites()->create($attributes);
		}
	}

	public function unfavorite()
	{
		$attributes = ['user_id' => auth()->id()];

		$this->favorites()->where($attributes)->get()->each->delete();
	}

	public function isFavorited()
	{
		return ! ! $this->favorites->where('user_id', auth()->id())->count();
	}

	/**
	 * Attributes
	 */

	public function getCommentsCountAttribute()
	{
		return $this->comments->count();
	}

	public function getIsFavoritedAttribute()
	{
		return $this->isFavorited();
	}

	public function getFavoritesCountAttribute()
	{
		return $this->favorites->count();
	}

	public function getMediaCountAttribute()
	{
		return $this->media->count();
	}
}
