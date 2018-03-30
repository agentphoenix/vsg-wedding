<template>
	<div>
		<button class="flex items-center no-underline outline-none" @click="toggle">
			<span v-text="count" :class="countClass" v-show="count > 0"></span>
			<span class="leading-0" v-html="icon"></span>
		</button>
	</div>
</template>

<script>
	export default {
		props: ['post'],

		data () {
			return {
				active: false
			}
		},

		computed: {
			count: {
				get () {
					return this.post.commentsCount
				},
				set (newValue) {
					return newValue
				}
			},

			countClass () {
				let pieces = ['mr-2', 'text-sm', 'font-medium']

				if (this.active) {
					pieces.push('text-blue-dark')
				} else {
					pieces.push('text-grey-dark')
				}

				return pieces
			},

			icon () {
				let attributes = {}

				if (this.active) {
					attributes['class'] = 'leading-0 text-blue'
				} else {
					attributes['class'] = 'leading-0 text-grey'
				}

				return feather.icons['message-circle'].toSvg(attributes)
			}
		},

		methods: {
			toggle () {
				this.active = !this.active

				bus.$emit('comment-list-toggled')
			}
		},

		mounted () {
			let self = this

			bus.$on('comment-created', () => {
				self.count = self.post.commentsCount++
			})
		}
	}
</script>
