<?php namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function boot()
	{
		Route::macro('multiformat', function () {
			return $this->setUri($this->uri() . '.{_format?}');
		});

		Request::macro('match', function ($responses, $defaultFormat = 'html') {
			if ($this->route('_format') === null) {
				return value(array_get($responses, $this->format($defaultFormat)));
			}

			return value(array_get($responses, $this->route('_format'), function () {
				abort(404);
			}));
		});

		$this->app->singleton('script-vars', function ($app) {
			if (! auth()->check()) return [];

			return [
				'auth' => [
					'id' => auth()->id(),
					'name' => auth()->user()->fullName,
					'user' => auth()->user(),
				],
				'showUploadMessage' => auth()->user()->show_upload_message,
			];
		});
	}

	public function register()
	{
		//
	}
}
