<template>
	<div class="-mx-3 px-3 w-auto swiper-container">
		<div class="flex swiper-wrapper">
			<div class="bg-transparent pb-8 swiper-slide" v-for="event in events">
				<a href="#" :class="eventClass(event)" @click.prevent="select(event)">
					<div>
						<svg class="h-16 w-16 fill-current">
							<use :xlink:href="eventIcon(event.icon)"></use>
						</svg>
					</div>
					<div v-html="eventName(event.name)"></div>
				</a>
			</div>
		</div>

		<input type="hidden" name="event_id" v-model="selected.id">
	</div>
</template>

<script>
	import moment from 'moment'

	export default {
		props: {
			events: { type: Array, required: true }
		},

		data () {
			return {
				selected: {},
				swiper: {}
			}
		},

		methods: {
			eventClass (ev) {
				let pieces = [
					'flex', 'flex-col', 'justify-center', 'w-full', 'p-3',
					'rounded', 'bg-white', 'border-2',
					'text-xs', 'font-medium', 'uppercase', 'tracking-md', 'text-center',
					'no-underline', 'outline-none', 'transition-box-shadow',
				]

				if (this.selected == ev) {
					pieces.push('shadow-stripe-lg')
					pieces.push('text-blue')
					pieces.push('border-blue-light')
				} else {
					pieces.push('shadow-stripe-sm')
					pieces.push('text-grey-dark')
					pieces.push('border-transparent')
				}

				return pieces
			},

			eventIcon (icon) {
				return '#' + icon
			},

			eventName (name) {
				let position = name.lastIndexOf(' ')

				return name.substring(0, position) + '</div><div>' + name.substring(position + 1)
			},

			select (event) {
				this.selected = event
			}
		},

		mounted () {
			this.swiper = new Swiper('.swiper-container', {
				slidesPerView: 2,
				spaceBetween: 20,
				freeMode: true
			})
		}
	}
</script>
