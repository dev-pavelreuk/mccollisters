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

/**
 * EqualWeb (interdeal) accessibility widget.
 *
 * Loads the EqualWeb accessibility toolbar for ADA/WCAG support. Ported from the
 * previous theme's functions.php (sitekey 41c9e1623efcda52a548e1ce628ee860,
 * EqualWeb core 5.2.8). Clears any saved drag position on load, then injects the
 * core script with SRI + crossorigin.
 */
add_action('wp_footer', function () {
	?>
	<!-- Accessibility Code for mccollisters.com -->
	<script>
	(function () {

		/* Clear saved EqualWeb dragged position */
		try {
			Object.keys(localStorage).forEach(function (key) {
				if (
					key.toLowerCase().includes('interdeal') ||
					key.toLowerCase().includes('equalweb') ||
					key.toLowerCase().includes('ind')
				) {
					localStorage.removeItem(key);
				}
			});
		} catch (e) {}

		window.interdeal = {
			get sitekey() {
				return "41c9e1623efcda52a548e1ce628ee860";
			},
			get domains() {
				return {
					js: "https://cdn.equalweb.com/",
					acc: "https://access.equalweb.com/"
				};
			},
			Position: "right", // Change to "left" if desired
			Menulang: "EN",
			draggable: false,
			btnStyle: {
				vPosition: [
					"50%", // Change to "80%" if you want the default position
					null
				],
				margin: [
					"0",
					"0"
				],
				scale: [
					"0.5",
					"0.5"
				],
				color: {
					main: "#1c4bb6",
					second: "#ffffff"
				},
				icon: {
					outline: false,
					outlineColor: "#ffffff",
					type: 1,
					shape: "circle"
				}
			}
		};

		var coreCall = document.createElement('script');
		coreCall.src = window.interdeal.domains.js + 'core/5.2.8/accessibility.js';
		coreCall.defer = true;
		coreCall.integrity = 'sha512-ka0NgF7zDksnhoZ5ZCKlm+t0F7KTih5lCfXwuzQDnrwu/EdKZSsJotoJvQPd0cuVmV63s0q2cgoUjeki688PuQ==';
		coreCall.crossOrigin = 'anonymous';
		coreCall.setAttribute('data-cfasync', 'false');

		document.body.appendChild(coreCall);

	})();
	</script>
	<?php
}, 100);
