<?php namespace App\Http\Controllers;

use App\Media;

class MediaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function destroy(Media $media)
	{
		// If the current user is not the post's author, we need to log that
		// it wasn't the post author who deleted the media, but someone else
		if (auth()->id() != $media->post->user_id) {
			activity()
				->performedOn($media)
				->causedBy(auth()->user())
				->log('Media removed by someone other than the original author');
		}
	}
}
