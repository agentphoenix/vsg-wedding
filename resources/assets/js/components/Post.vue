<template>
	<div class="mb-8 p-3 bg-white shadow-stripe-lg rounded">
		<div>
			<div class="flex flex-row justify-between">
				<div>
					<div class="font-black text-lg" v-html="authorName"></div>
					<div class="mb-3 text-grey text-xs uppercase tracking-caps" v-html="uploadTime"></div>
				</div>
				<div v-if="hasMultipleInvites">
					<svg class="h-8 w-8 fill-current text-grey-light"><use xlink:href="#bridal-shower"></use></svg>
				</div>
			</div>

			<div class="mb-3 text-grey-dark" v-text="item.caption" v-if="item.caption != null"></div>
		</div>

		<div class="swiper-container">
			<div class="swiper-wrapper">
				<div class="leading-0 swiper-slide" v-for="(media, index) in item.media">
					<media-item :media="media" :count="item.media.length" :index="index"></media-item>
				</div>
			</div>

			<div class="swiper-pagination"></div>
		</div>

		<div class="mt-3">
			<div class="flex items-center justify-between">
				<favorite :post="item"></favorite>
				<comment :post="item"></comment>
			</div>
		</div>

		<comments :initial-comments="item.comments"></comments>
	</div>
</template>

<script>
	import moment from 'moment'
	import Swiper from 'swiper'
	import MediaItem from './MediaItem.vue'
	import Favorite from './Favorite.vue'
	import Comment from './Comment.vue'
	import Comments from './Comments.vue'

	export default {
		components: { MediaItem, Favorite, Comment, Comments },

		props: {
			item: { type: Object, required: true }
		},

		computed: {
			authorName () {
				return this.item.author.first_name + ' ' + this.item.author.last_name
			},

			canEdit () {
				return this.item.author.id === App.auth.id
			},

			commentCount () {
				if (this.item.comments.length > 0) {
					return this.item.comments.length
				}
			},

			commentCountClasses () {
				let pieces = ['font-medium', 'text-sm', 'mr-2']

				if (this.commentActive) {
					pieces.push('text-blue-dark')
				} else {
					pieces.push('text-grey-dark')
				}

				return pieces
			},

			hasMultipleInvites () {
				return App.auth.user.events.length > 1
			},

			uploadTime () {
				return moment(this.item.created_at, 'YYYY-MM-DD kk:mm:ss').fromNow()
			}
		},

		methods: {
			mediaClasses (index) {
				if (this.item.mediaCount == 1) {
					return ['rounded']
				}

				if (this.item.mediaCount > 1) {
					if (index == 0) {
						return ['rounded-t']
					}

					if (this.item.mediaCount - 1 == index) {
						return ['rounded-b']
					}
				}
			},

			remove () {}
		},

		mounted () {
			feather.replace()

			let carousel = new Swiper('.swiper-container', {
				autoHeight: true,
				direction: 'horizontal',
				pagination: {
					el: '.swiper-pagination',
					dynamicBullets: true,
				},
			})
		}
	}
</script>
