import Vue from 'vue'
import MoJs from 'mo-js'
import Axios from 'axios'
import LoDash from 'lodash'
import Swiper from 'swiper'
import FeatherIcons from 'feather-icons'

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
    Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

// Make a few things available globally
window._ = LoDash
window.mojs = MoJs
window.axios = Axios
window.bus = new Vue()
window.Vue = Vue
window.Swiper = Swiper
window.feather = FeatherIcons

// Pull in some event listeners from dropdowns
require('./event-listeners')

// Pull in all of the motion functions
require('./motion')

// Import the top-level components that we need
import SignIn from './components/SignIn.vue'
import AllPosts from './components/AllPosts.vue'
import EventPicker from './components/EventPicker.vue'

// Import plugins
import VueClip from 'vue-clip'

// Make sure we can use the plugins now
Vue.use(VueClip)

// Spin up a new Vue instance now...
const vm = new Vue({
	el: '#app',

	components: {
		AllPosts,
		SignIn,
		EventPicker
	},

	mounted () {
		feather.replace()
	}
})
