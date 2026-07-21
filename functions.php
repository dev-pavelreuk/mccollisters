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

wp_enqueue_style(
	'mcc-font-awesome',
	'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css',
	[],
	'6.7.2'
);