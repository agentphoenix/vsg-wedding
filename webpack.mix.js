let mix = require('laravel-mix')
let tailwindcss = require('tailwindcss')
let glob = require('glob-all')
let PurgecssPlugin = require('purgecss-webpack-plugin')

class TailwindExtractor {
	static extract(content) {
		return content.match(/[A-z0-9-:\/]+/g) || [];
	}
}

// mix.webpackConfig({
// 	resolve: {
// 		alias: {
// 			'vue$': 'vue/dist/vue.esm.js'
// 		}
// 	}
// })

mix.js('resources/assets/js/app.js', 'js')
   .less('resources/assets/less/app.less', 'css')
   .less('resources/assets/less/vendor.less', 'css')
   .options({
		postCss: [
			tailwindcss('./tailwind.js'),
		],
		processCssUrls: false
	})

// Only run PurgeCSS during production builds for faster development builds
// and so you still have the full set of utilities available during
// development.
if (mix.inProduction()) {
	mix.webpackConfig({
		plugins: [
			new PurgecssPlugin({

				// Specify the locations of any files you want to scan for class names.
				paths: glob.sync([
					path.join(__dirname, "resources/views/**/*.blade.php"),
					path.join(__dirname, "resources/assets/js/**/*.vue")
				]),
				extractors: [
					{
						extractor: TailwindExtractor,

						// Specify the file extensions to include when scanning for
						// class names.
						extensions: ["html", "js", "php", "vue"]
					}
				]
			})
		]
	})
}
