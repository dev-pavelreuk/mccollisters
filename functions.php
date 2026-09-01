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
 * Pushes the GA4 form-submission events that the Google Ads conversion actions
 * are built on, when a Gravity Forms AJAX confirmation is rendered. Requires
 * the GTM container to be loaded separately (Site Kit / head-footer-code).
 * Each form is tracked once per page load.
 *
 * Event names match the existing Ads conversion actions exactly so they can be
 * re-imported rather than rebuilt:
 *   form 2 (Contact Us)        -> contactus_form_submission
 *   form 3 (Talk to an Expert) -> general_form_submission
 *   any other form             -> general_form_submission
 *
 * Set window.mccTrackingDebug = true in the console to log pushes while
 * testing (see assets/js/tracking.js, which owns the click-based events).
 */
add_action('wp_footer', function () {
	?>
	<script>
	(function () {

		window.dataLayer = window.dataLayer || [];
		window.gfTrackedForms = window.gfTrackedForms || {};

		// Form ID -> [GA4 event name, human-readable form name].
		var FORMS = {
			'2': ['contactus_form_submission', 'Contact Us'],
			'3': ['general_form_submission', 'Talk to an Expert']
		};

		function fire(formId) {

			formId = String(formId);

			// Prevent the same form submission from being tracked more than once.
			if (window.gfTrackedForms[formId]) {
				return;
			}

			window.gfTrackedForms[formId] = true;

			var config = FORMS[formId] || ['general_form_submission', 'Gravity Form ' + formId];

			var params = {
				form_id: formId,
				form_name: config[1]
			};

			// Route through the shared sender in assets/js/tracking.js, which
			// picks the right transport (GTM object push vs gtag command).
			if (typeof window.mccTrack === 'function') {
				window.mccTrack(config[0], params);
				return;
			}

			// Fallback if tracking.js has not executed yet (NitroPack defers
			// scripts). Same rule: gtag.js ignores plain {event: ...} objects.
			var containers = window.google_tag_manager;
			var hasGtm = false;

			try {
				hasGtm = !!containers && Object.keys(containers).some(function (key) {
					return key.indexOf('GTM-') === 0;
				});
			} catch (error) {
				hasGtm = false;
			}

			if (hasGtm) {
				window.dataLayer.push({
					event: config[0],
					form_id: formId,
					form_name: config[1]
				});
			} else if (typeof window.gtag === 'function') {
				window.gtag('event', config[0], params);
			} else {
				window.dataLayer.push(arguments_of('event', config[0], params));
			}

			if (window.mccTrackingDebug) {
				console.log('[mcc-tracking]', hasGtm ? 'gtm' : 'gtag', config[0], params);
			}
		}

		// Builds a real `arguments` object, which is what gtag.js expects to
		// find on the dataLayer command queue (a plain array is not equivalent).
		function arguments_of() {
			return arguments;
		}

		function check() {

			var confirmations = document.querySelectorAll(
				'[id^="gform_confirmation_wrapper_"]'
			);

			Array.prototype.forEach.call(confirmations, function (confirmation) {

				var formId = confirmation.id.replace(
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
 * Loads the EqualWeb accessibility toolbar for ADA/WCAG support (sitekey
 * 41c9e1623efcda52a548e1ce628ee860, EqualWeb core 5.3.1). This is the current
 * snippet from the EqualWeb dashboard — the core version and its SRI integrity
 * hash MUST stay in sync or the browser blocks the script and the widget won't
 * render. Update both together if EqualWeb issues a new version.
 */
add_action('wp_footer', function () {
	?>
	<!-- Accessibility Code for "mccollisters.com" -->
	<script>
	/*
	Want to customize your button? visit our documentation page:
	https://login.equalweb.com/custom-button
	*/
	window.interdeal = {
		get sitekey (){ return "41c9e1623efcda52a548e1ce628ee860"} ,
		get domains(){
			return {
				"js": "https://cdn.equalweb.com/",
				"acc": "https://access.equalweb.com/"
			}
		},
		"Position": "right",
		"Menulang": "EN",
		"draggable": true,
		"btnStyle": {
			"vPosition": [
				"50%",
				"50%"
			],
			"margin": [
				"0",
				"0"
			],
			"scale": [
				"0.5",
				"0.5"
			],
			"color": {
				"main": "#1c4bb6",
				"second": "#ffffff"
			},
			"icon": {
				"outline": false,
				"outlineColor": "#ffffff",
				"type":  1 ,
				"shape": "circle"
			}
		},
	};

	(function(doc, head, body){
		var coreCall             = doc.createElement('script');
		coreCall.src             = interdeal.domains.js + 'core/5.3.1/accessibility.js';
		coreCall.defer           = true;
		coreCall.integrity       = 'sha512-3qLj5jbjMQnXk+FqEdVJjUnjJBGuBTRVOwaiT0ms6mQKQcrz4nulBxl2Hsr0/PpvEqdyJsMsU1NB+Mtfzw8hxA==';
		coreCall.crossOrigin     = 'anonymous';
		coreCall.setAttribute('data-cfasync', true );
		body? body.appendChild(coreCall) : head.appendChild(coreCall);
	})(document, document.head, document.body);
	</script>
	<?php
}, 100);
