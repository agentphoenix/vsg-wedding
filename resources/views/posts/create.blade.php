@extends('layouts.app')

@section('content')
	<h1 class="mb-6 title">Add a Post</h1>

	<div class="field-group-lg">
		<textarea name="caption" class="field" rows="8" placeholder="Share your story"></textarea>
	</div>

	@if ($invites->count() > 1)
		<div class="font-medium text-grey-darker mb-2">Which event is this for?</div>

		<event-picker :events="{{ $events }}"></event-picker>
	@else
		<input type="hidden" name="event_id" value="{{ $invites->first()->id }}">
	@endif

	<div class="field-group">
		<button class="button is-block">
			<i data-feather="check-circle" class="mr-2"></i>
			<span>Add</span>
		</button>
	</div>

	<div class="field-group-lg">
		<a href="{{ route('home') }}" class="button is-block is-subtle">
			<i data-feather="x-circle" class="mr-2"></i>
			<span>Cancel</span>
		</a>
	</div>
@endsection

@section('js')
	<script>
		let swiper = new Swiper('.swiper-container', {
			slidesPerView: 2,
			spaceBetween: 20,
			freeMode: true
		})
	</script>
@endsection
