<template>
	<transition name="comments"
				enter-active-class="animated slideInDown"
				leave-active-class="animated slideOutUp">
		<div class="text-grey-dark mt-3" v-show="active">
			<div class="flex flex-row items-center text-sm my-6">
				<input type="text" class="outline-none appearance-none rounded border-2 border-grey-lighter w-full p-3 focus:border-blue-lighter" placeholder="Leave a comment..." v-model="body">

				<button class="appearance-none ml-2 text-blue leading-0 outline-none" @click.prevent="submit">
					<i data-feather="send"></i>
				</button>
			</div>

			<transition-group name="comment" tag="div">
				<div class="text-sm mb-4" v-for="comment in comments" v-bind:key="comment.id">
					<strong class="font-semibold" v-text="comment.author.fullName"></strong>
					<span v-html="comment.body"></span>
				</div>
			</transition-group>
		</div>
	</transition>
</template>

<script>
	export default {
		props: {
			initialComments: { type: Array, required: true }
		},

		data () {
			return {
				active: false,
				body: '',
				comments: this.initialComments
			}
		},

		methods: {
			submit () {
				// Push the comment into the database

				// Now, we're going to fake it by pushing the new comment
				// onto the beginning of the comments array to make it
				// seem like magic things are happening
				this.comments.unshift({
					id: this.comments.length + 1,
					body: this.body,
					author: {
						'id': App.auth.id,
						'fullName': App.auth.name
					}
				})

				// Next, let's make sure the comment component knows that we
				// have a new comment
				bus.$emit('comment-created')

				// Finally, clear the comment field
				this.body = ''
			}
		},

		mounted () {
			let self = this

			bus.$on('comment-list-toggled', () => {
				self.active = !self.active
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
