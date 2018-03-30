<template>
	<div class="dropdown is-dark">
		<div class="dropdown-trigger">
			<button class="flex items-center text-blue-dark" aria-haspopup="true" aria-controls="dropdown-menu">
				<i data-feather="search" class="h-8 w-8"></i>
			</button>
	  	</div>

		<transition name="custom-classes-transition"
					enter-active-class="animated bounceIn"
					leave-active-class="animated bounceOut">
		  	<div class="dropdown-menu" id="dropdown-menu" role="menu">
				<div class="dropdown-content">
					<a href="#" class="dropdown-item" @click.prevent="filter('latest')">
						<i data-feather="clock" class="dropdown-icon"></i>
						<span>Latest posts</span>
					</a>
					<a href="#" class="dropdown-item" @click.prevent="filter('mine')">
						<i data-feather="user" class="dropdown-icon"></i>
						<span>My posts</span>
					</a>
					<a href="#" class="dropdown-item" @click.prevent="filter('popular')">
						<i data-feather="heart" class="dropdown-icon"></i>
						<span>Most popular</span>
					</a>
				</div>
			</div>
		</transition>
	</div>
</template>

<script>
	export default {
		methods: {
			filter (type) {
				let eventKey = 'filter-' + type

				bus.$emit(eventKey)
			}
		}
	}
</script>
