
	<!-- <div>
		<div v-if="showUploadMessage">
			<div class="dropdown is-dark is-right" v-if="showUploadMessage">
				<div class="dropdown-trigger">
					<i data-feather="plus-circle" class="h-8 w-8 text-blue-dark"></i>
			  	</div>

			  	<div class="dropdown-menu is-wide" id="dropdown-menu" role="menu">
					<div class="text-left dropdown-content">
						<div class="dropdown-item">
							For our special day, we want to keep photos and videos off of social media for a little while.
						</div>
						<div class="dropdown-item">
							Never fear though, you can still share your photos and videos with us and other guests by simply adding a new post and choosing what you want to share!
						</div>
						<div class="dropdown-item">
							Add as many posts, pictures, and videos as you want throughout the festivities as we celebrate together.
						</div>
						<vue-clip :options="options" :on-complete="complete">
							<template slot="clip-uploader-action">
								<div :class="uploadTrigger">
									<button class="block w-full bg-guava text-guava-lightest py-3 text-center font-medium text-lg rounded">Add</button>
								</div>
							</template>
						</vue-clip>
					</div>
				</div>
			</div>
		</div>
	</div> -->
