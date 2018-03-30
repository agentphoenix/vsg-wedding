<?php namespace App\Http\Controllers;

use App\Post;
use App\Event;

class PostsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$posts = Post::with('author', 'favorites', 'media', 'event', 'comments')
			->whereIn('event_id', auth()->user()->events->pluck('id'))
			->latest()
			->get();

		// $posts = Post::with('author', 'favorites', 'media')->latest()->get();

		return request()->match([
			'html' => view('home'),
			'json' => $posts,
		]);
	}

	public function create()
	{
		$invites = auth()->user()->events;
		$events = Event::get();
		$eventNames = $events->map(function ($e) {
			$name = $subject = $e->name;
			$position = strrpos($subject, ' ');

			if ($position !== false) {
				$name = '<div>'.substr_replace($subject, '</div><div>', $position, strlen(' ')).'</div>';
			}

			return $name;
		});

		return view('posts.create', compact('invites', 'events', 'eventNames'));
	}

	public function store()
	{
		// dd(request()->file('files'));

		// Get the files
		$files = request()->file('files');

		// Get the current user
		$user = auth()->user();

		// Create a post
		$post = Post::create(['user_id' => $user->id]);

		// Figure out the username
		$userName = strtolower($user->first_name.'-'.$user->last_name);

		// Set the path to use
		$path = "media/{$userName}";

		foreach ($files as $file) {
			// Store the media
			$uploadedFilePath = $file->store("public/{$path}");

			// Create an array out of the uploaded file path
			$filenameArr = explode(DIRECTORY_SEPARATOR, $uploadedFilePath);

			// Now just get the image name
			$uploadedFilename = end($filenameArr);

			// Create the media object and associate it with the post
			$media = $post->media()->create([
				'filename' => "storage/{$path}/{$uploadedFilename}",
				'mime_type' => $file->getClientMimeType(),
			]);
		}

		return $post->load('author');
	}

	public function destroy(Post $post)
	{
		// If the current user is not the post's author, we need to log that
		// it wasn't the post author who deleted the post, but someone else
		if (auth()->id() != $post->user_id) {
			activity()
				->performedOn($post)
				->causedBy(auth()->user())
				->log('Post removed by someone other than the original author');
		}
	}
}
