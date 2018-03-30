function isIOSSafari() {
	let userAgent = window.navigator.userAgent

	return userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)
}

function isTouch() {
	let isIETouch = navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0

	return [].indexOf.call(window, 'ontouchstart') >= 0 || isIETouch
}

const isIOS = isIOSSafari()
const clickHandler = isIOS || isTouch() ? 'touchstart' : 'click'

function extend(a, b) {
	for (let key in b) {
		if (b.hasOwnProperty(key)) {
			a[key] = b[key]
		}
	}

	return a
}

window.Animocon = function (el, options) {
	this.el = el
	this.rect = el.getBoundingClientRect()
	this.options = extend({}, this.options)
	extend(this.options, options)

	this.checked = false

	this.timeline = new mojs.Timeline()

	for (let i = 0, len = this.options.tweens.length; i < len; ++i) {
		this.timeline.add(this.options.tweens[i])
	}

	let self = this

	this.el.addEventListener(clickHandler, () => {
		if (self.checked) {
			self.options.onUnCheck()
		} else {
			self.options.onCheck()
			self.timeline.replay()
		}

		self.checked = !self.checked
	})
}

Animocon.prototype.options = {
	tweens: [
		new mojs.Burst({})
	],
	onCheck () { return false },
	onUnCheck () { return false }
}
