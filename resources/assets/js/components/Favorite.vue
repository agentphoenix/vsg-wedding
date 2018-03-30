<template>
	<div>
		<button :id="btnId" class="flex items-center no-underline outline-none" @click="toggle">
			<span class="leading-0" v-html="icon"></span>
			<span v-text="count" :class="countClass" v-show="count > 0"></span>
		</button>
	</div>
</template>

<script>
	export default {
		props: ['post'],

		data () {
			return {
				burst: {}
			}
		},

		computed: {
			active: {
				get () {
					return this.post.isFavorited
				},
				set (newValue) {
					console.log('active', newValue)
					return newValue
				}
			},

			btnId () {
				return 'post-fav-' + this.post.id
			},

			count: {
				get () {
					return this.post.favoritesCount
				},
				set (newValue) {
					console.log('count', newValue)
					return newValue
				}
			},

			countClass () {
				let pieces = ['ml-2', 'text-sm', 'font-medium']

				if (this.active) {
					pieces.push('text-guava-dark')
				} else {
					pieces.push('text-grey-dark')
				}

				return pieces
			},

			endpoint () {
				return '/posts/' + this.post.id + '/favorites';
			},

			icon () {
				let attributes = {}

				if (this.active) {
					attributes['class'] = 'leading-0 text-guava fill-current'
				} else {
					attributes['class'] = 'leading-0 text-grey fill-none'
				}

				return feather.icons.heart.toSvg(attributes)
			}
		},

		methods: {
			create (e) {
				// axios.post(this.endpoint)

				this.active = true
				this.count++
			},

			destroy () {
				// axios.delete(this.endpoint)

				this.active = false
				this.count--
			},

			toggle (e) {
				this.active ? this.destroy() : this.create(e)
			}
		},

		mounted () {
			let button = '#' + this.btnId
			let favBtn = document.querySelector(button)
			let favIcon = document.querySelector(button + ' span:last-child')
			let rect = favBtn.getBoundingClientRect()
			let self = this

			this.burst = new Animocon(favBtn, {
				tweens: [
					// ring animation
					new mojs.Shape({
						parent: favBtn,
						duration: 750,
						type: 'circle',
						radius: {0: 20},
						fill: 'transparent',
						stroke: '#FA5769',
						strokeWidth: {35:0},
						opacity: 0.2,
						left: rect.left + 28,
						top: rect.top + 11,
						easing: mojs.easing.bezier(0, 1, 0.5, 1)
					}),
					new mojs.Shape({
						parent: favBtn,
						duration: 500,
						delay: 100,
						type: 'circle',
						radius: {0: 10},
						fill: 'transparent',
						stroke: '#FA5769',
						strokeWidth: {5:0},
						opacity: 0.2,
						left: rect.left + 20,
						top: rect.top - 12,
						easing: mojs.easing.sin.out
					}),
					new mojs.Shape({
						parent: favBtn,
						duration: 500,
						delay: 180,
						type: 'circle',
						radius: {0: 5},
						fill: 'transparent',
						stroke: '#FA5769',
						strokeWidth: {5:0},
						opacity: 0.5,
						left: rect.left + 8,
						top: rect.top,
						isRunLess: true,
						easing: mojs.easing.sin.out
					}),
					new mojs.Shape({
						parent: favBtn,
						duration: 800,
						delay: 240,
						type: 'circle',
						radius: {0: 10},
						fill: 'transparent',
						stroke: '#FA5769',
						strokeWidth: {5:0},
						opacity: 0.3,
						left: rect.left + 46,
						top: rect.top - 5,
						easing: mojs.easing.sin.out
					}),
					new mojs.Shape({
						parent: favBtn,
						duration: 800,
						delay: 240,
						type: 'circle',
						radius: {0: 10},
						fill: 'transparent',
						stroke: '#FA5769',
						strokeWidth: {5:0},
						opacity: 0.4,
						left: rect.left + 35,
						top: rect.top - 17,
						easing: mojs.easing.sin.out
					}),
					new mojs.Shape({
						parent: favBtn,
						duration: 1000,
						delay: 300,
						type: 'circle',
						radius: {0: 7},
						fill: 'transparent',
						stroke: '#FA5769',
						strokeWidth: {5:0},
						opacity: 0.2,
						left: rect.left + 10,
						top: rect.top - 13,
						easing: mojs.easing.sin.out
					}),
					// icon scale animation
					new mojs.Tween({
						duration: 1200,
						easing: mojs.easing.ease.out,
						onUpdate (progress) {
							if (progress > 0.3) {
								let elasticOutProgress = mojs.easing.elastic.out(1.63 * progress - 0.63)

								favIcon.style.WebkitTransform = favIcon.style.transform = 'scale3d(' + elasticOutProgress + ',' + elasticOutProgress + ', 1)'
							} else {
								favIcon.style.WebkitTransform = favIcon.style.transform = 'scale3d(0,0,1)'
							}
						}
					})
				],
				onCheck () {},
				onUnCheck () {}
			})

			this.burst.checked = this.active
		}
	}
</script>
