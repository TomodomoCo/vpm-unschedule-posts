jQuery(document).ready(function () {
	jQuery('#vpm-js-unschedule-post').on('click', function (event) {
		event.preventDefault();

		jQuery('#publish').trigger('click');
	});
});
