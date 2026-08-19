<?php
/**
 * McCollister's Custom Theme functions.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
	exit;
}

define('MCC_THEME_VERSION', '1.0.1');
define('MCC_THEME_DIR', get_stylesheet_directory());
define('MCC_THEME_URI', get_stylesheet_directory_uri());

$includes = [
	'/inc/theme-setup.php',
	'/inc/enqueue.php',
	'/inc/widgets.php',
	'/inc/post-types.php',
	'/inc/customizer.php',
	'/inc/template-functions.php',
	'/inc/mega-menu.php',
	'/inc/faq-data.php',
];

foreach ($includes as $file) {
	$path = MCC_THEME_DIR . $file;

	if (!file_exists($path)) {
		wp_die(
			'Required theme file is missing: ' . esc_html($path)
		);
	}

	require_once $path;
}

if (!function_exists('mcc_get_theme_option')) {
	wp_die(
		'The template-functions.php file was loaded, but mcc_get_theme_option() was not defined.'
	);
}

/**
 * Gravity Forms conversion tracker.
 *
 * Pushes a `gravity_form_success` event into the GTM dataLayer when a Gravity
 * Forms AJAX confirmation is rendered, so a Tag Manager trigger can record the
 * conversion. Requires the GTM container to be loaded separately. Each form is
 * tracked once per page load.
 */
add_action('wp_footer', function () {
	?>
	<script>
	(function () {

		console.log('GF tracker loaded');

		window.dataLayer = window.dataLayer || [];
		window.gfTrackedForms = window.gfTrackedForms || {};

		function fire(formId) {

			formId = String(formId);

			// Prevent the same form submission from being tracked more than once.
			if (window.gfTrackedForms[formId]) {
				return;
			}

			window.gfTrackedForms[formId] = true;

			let formName = 'Gravity Form';

			if (formId === '2') {
				formName = 'Contact Us';
			}

			if (formId === '3') {
				formName = 'Talk to an Expert';
			}

			console.log('Firing GTM event', formId, formName);

			window.dataLayer.push({
				event: 'gravity_form_success',
				form_id: formId,
				form_name: formName
			});

			console.log(window.dataLayer);
		}

		function check() {

			const confirmations = document.querySelectorAll(
				'[id^="gform_confirmation_wrapper_"]'
			);

			confirmations.forEach(function (confirmation) {

				const formId = confirmation.id.replace(
					'gform_confirmation_wrapper_',
					''
				);

				fire(formId);
			});
		}

		// Check immediately in case the confirmation is already present.
		check();

		// Continue checking for AJAX confirmation messages.
		setInterval(check, 500);

	})();
	</script>
	<?php
}, 999);
