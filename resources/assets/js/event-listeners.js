/**
 * All credit goes to the folks at Bulma.io for this stuff. The simplicity
 * of this stuff is amazing and they really should consider wrapping all
 * of this up into a small Javascript companion library that works with
 * their framework!
 */

document.addEventListener('DOMContentLoaded', function () {
	/**
	 * Dropdowns
	 */

	var $dropdowns = getAll('.dropdown:not(.is-hoverable)')

	if ($dropdowns.length > 0) {
		$dropdowns.forEach(function ($el) {
			$el.addEventListener('click', function (event) {
				event.stopPropagation()
				$el.classList.toggle('is-active')
			})
		})

		document.addEventListener('click', function (event) {
			closeDropdowns()
		})
	}

	function closeDropdowns() {
		$dropdowns.forEach(function ($el) {
			$el.classList.remove('is-active')
		})
	}

	/**
	 * Modals
	 */

	var rootEl = document.documentElement
	var $modals = getAll('.modal')
	var $modalButtons = getAll('.modal-button')
	var $modalCloses = getAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button')

	if ($modalButtons.length > 0) {
		$modalButtons.forEach(function ($el) {
			$el.addEventListener('click', function () {
				var target = $el.dataset.target
				var $target = document.getElementById(target)
				rootEl.classList.add('is-clipped')
				$target.classList.add('is-active')
			})
		})
	}

	if ($modalCloses.length > 0) {
		$modalCloses.forEach(function ($el) {
			$el.addEventListener('click', function () {
				closeModals()
			})
		})
	}

	document.addEventListener('keydown', function (event) {
		var e = event || window.event

		if (e.keyCode === 27) {
			closeModals()
			closeDropdowns()
		}
	})

	function closeModals() {
		rootEl.classList.remove('is-clipped')

		$modals.forEach(function ($el) {
			$el.classList.remove('is-active')
		})
	}

	/**
	 * Functions
	 */

	function getAll(selector) {
		return Array.prototype.slice.call(document.querySelectorAll(selector), 0)
	}
})
