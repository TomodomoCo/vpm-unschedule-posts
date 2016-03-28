jQuery(document).ready(function () {
	jQuery('#vpm-js-unschedule-post').on('click', function (event) {
		event.preventDefault();

		jQuery('#save')
			.before('<input type="hidden" name="vpm_unschedule_post" id="vpm_unschedule_post" value="1" />')
			.trigger('click');
	});
});
