<template>
	<vue-clip :options="options" :on-complete="complete">
		<template slot="clip-uploader-action">
			<div>
				<div class="dz-message">
					<i data-feather="plus-circle" class="h-8 w-8 text-blue-dark"></i>
				</div>
			</div>
		</template>
	</vue-clip>
</template>

<script>
	export default {
		data () {
			return {
				options: {
					url: '/posts',
					paramName: 'files',
					uploadMultiple: true,
					maxFiles: 25,
					parallelUploads: 25,
					acceptedFiles: ['image/jpg', 'image/jpeg', 'image/png'].join(','),
					headers: window.axios.defaults.headers.common
				}
			}
		},

		methods: {
			complete (file, status, xhr) {
				bus.$emit('refresh-posts', xhr.responseText)
			}
		}
	}
</script>
