<template>
	<div>
		<div class="w-full text-center mb-4" v-show="loading">
			<img src="/svg-loaders/three-dots.svg" width="60" alt="">
		</div>

		<div v-show="!loading">
			<transition-group name="list" tag="div">
				<div v-for="post in filteredPosts" v-show="filteredPosts.length > 0" v-bind:key="post.id">
					<post :item="post"></post>
				</div>
			</transition-group>

			<div class="block w-full p-4 rounded border-2 border-guava-light bg-guava-lightest text-guava-dark"
				 v-show="filter != '' && filteredPosts.length == 0"
				 v-text="errorMessage"
				 v-cloak>
			</div>

			<div class="block w-full p-4 rounded border-2 border-guava-light bg-guava-lightest text-guava-dark"
				 v-if="!hasPosts"
				 v-text="errorMessage"
				 v-cloak>
			</div>
		</div>
	</div>
</template>

<script>
	import Post from './Post'

	export default {
		components: { Post },

		data () {
			return {
				filter: '',
				hasPosts: true,
				loading: true,
				posts: []
			}
		},

		computed: {
			errorMessage () {
				switch (this.filter) {
					case 'latest':
					default:
						return "Whoops! It doesn't look like anyone has created any posts yet. Kick us off and create a new post!"

					case 'mine':
						return "Whoops! It doesn't look like you've shared any posts yet. What are you waiting for? Go ahead and share some memories with us!"
						break

					case 'popular':
						return "Uh-oh! It doesn't look like anyone has liked any posts yet. Lead the way and let us know what your favorites are!"
				}
			},

			filteredPosts () {
				switch (this.filter)
				{
					case 'latest':
					default:
						return this.posts

					case 'popular':
						return this.posts.filter((post) => {
							return post.favoritesCount > 0
						}).sort((a, b) => {
							return b.favoritesCount - a.favoritesCount
						})

						break

					case 'mine':
						return this.posts.filter((post) => {
							return post.author.id == App.auth.id
						})

						break
				}
			}
		},

		methods: {
			fetch () {
				this.loading = true

				let self = this

				axios.get('/posts.json').then((data) => {
					// Store the posts
					self.posts = data.data

					// Stop the loading indicator
					self.loading = false

					// Do we have posts on the initial load?
					self.hasPosts = data.data.length > 0
				})
			}
		},

		mounted () {
			axios.get('/posts.json').then((data) => {
				// Store the posts
				self.posts = data.data

				// Stop the loading indicator
				self.loading = false

				// Do we have posts on the initial load?
				self.hasPosts = data.data.length > 0
			})

			let self = this

			bus.$on('filter-popular', () => {
				self.filter = 'popular'
			})

			bus.$on('filter-mine', () => {
				self.filter = 'mine'
			})

			bus.$on('filter-latest', () => {
				self.filter = 'latest'
			})

			bus.$on('refresh-posts', (newPost) => {
				self.posts.unshift(JSON.parse(newPost))
			})
		}
	}
</script>

<style>
	.list-enter-active, .list-leave-active {
		transition: opacity .5s;
	}

	.list-enter, .list-leave-to /* .fade-leave-active below version 2.1.8 */ {
		opacity: 0;
	}
</style>
