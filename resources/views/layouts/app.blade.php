<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<link href="{{ asset('css/vendor.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<script>
		window.App = {!! json_encode(app('script-vars')) !!}
	</script>
</head>
<body class="bg-grey-lighter">
	<div id="app" class="flex flex-row h-screen w-full">
		<header class="flex lg:hidden items-center py-4 px-6 fixed w-full z-50">
			<div class="flex-shrink w-8 leading-none">
				<a href="#" class="text-blue-dark">
					<i data-feather="menu" class="h-8 w-8"></i>
				</a>
			</div>

			<div class="flex-1 leading-none flex justify-center items-center">
				@svg('monogram', 'h-16 w-16 fill-current text-guava')
			</div>

			<div class="flex-shrink w-8 text-right leading-none">
				<a href="{{ route('posts.create') }}" class="text-blue-dark">
					<i data-feather="plus-circle" class="h-8 w-8"></i>
				</a>
			</div>
		</header>

		<div class="container">
			<nav class="hidden lg:flex flex-col w-1/4 shadow-lg rounded">
				<div class="my-12 mx-auto">
					@svg('monogram', 'h-24 w-24 fill-current text-grey-darker')
				</div>

				<div class="flex flex-col mx-8">
					<a href="#" class="transition-slow block w-full py-3 flex items-center justify-center bg-transparent text-blue-dark rounded border-2 border-blue-dark mb-12 hover:shadow hover:bg-blue-dark hover:text-white hover:border-blue-dark">
						<i data-feather="plus-circle"></i>
						<span class="ml-2">New Post</span>
					</a>

					<div class="uppercase text-sm text-grey font-medium mb-6">Discover</div>

					<a href="#" class="flex items-center text-grey-dark font-medium mb-4 hover:text-grey-darker">
						<i data-feather="clock"></i>
						<span class="ml-3">Latest Posts</span>
					</a>

					<a href="#" class="flex items-center text-grey-dark font-medium mb-4 hover:text-grey-darker">
						<i data-feather="user"></i>
						<span class="ml-3">My Posts</span>
					</a>

					<a href="#" class="flex items-center text-grey-dark font-medium mb-4 hover:text-grey-darker">
						<i data-feather="heart"></i>
						<span class="ml-3">Most Popular</span>
					</a>

					<div class="uppercase text-sm text-grey font-medium my-6">Admin</div>

					<a href="#" class="flex items-center text-grey-dark font-medium mb-4 hover:text-grey-darker">
						<i data-feather="users"></i>
						<span class="ml-3">Guests</span>
					</a>

					<a href="#" class="flex items-center text-grey-dark font-medium mb-4 hover:text-grey-darker">
						<i data-feather="calendar"></i>
						<span class="ml-3">Events</span>
					</a>

					<a href="#" class="flex items-center text-grey-dark font-medium mb-4 hover:text-grey-darker">
						<i data-feather="settings"></i>
						<span class="ml-3">Settings</span>
					</a>
				</div>
			</nav>

			<section class="flex-1 pt-4 px-3 mt-24 lg:mt-6" v-cloak>
				@yield('content')
			</section>
		</div>
		{{ svg_spritesheet() }}
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
	@yield('js')
</body>
</html>
