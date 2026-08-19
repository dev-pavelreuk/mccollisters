<?php
/**
 * Site header.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php get_template_part('template-parts/components/preloader'); ?>

<a class="skip-link screen-reader-text" href="#primary">
	<?php esc_html_e('Skip to content', 'mccollisters'); ?>
</a>

<?php get_template_part('template-parts/header/site', 'header'); ?>
<?php // Each page template opens its own <main id="primary">; the skip link targets it. ?>