<template>
	<div class="leading-0">
		<img :src="path" class="leading-0 rounded-sm" v-if="type == 'image'">
	</div>
</template>

<script>
	export default {
		props: {
			count: { type: Number, required: true },
			index: { type: Number, required: true },
			media: { type: Object, required: true },
			type: { type: String, default: 'image' }
		},

		computed: {
			path () {
				return this.media.filename
			}
		}
	}
</script>
