<?php
/**
 * Template helper functions.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

function mcc_get_theme_option(string $key, string $fallback = ''): string
{
    return (string) get_theme_mod($key, $fallback);
}

function mcc_phone_href(string $phone): string
{
    return preg_replace('/[^0-9+]/', '', $phone) ?: '';
}

/**
 * Render a footer link column. The footer design has no column headings —
 * each list is just the assigned menu.
 */
function mcc_footer_menu(string $location): void
{
    wp_nav_menu([
        'theme_location' => $location,
        'container'      => false,
        // Location modifier so an individual column can be targeted in CSS.
        'menu_class'     => 'footer-menu footer-menu--' . str_replace('_', '-', $location),
        'fallback_cb'    => false,
        'depth'          => 1,
    ]);
}

function mcc_body_classes(array $classes): array
{
    if (is_front_page()) {
        $classes[] = 'is-home';
    }

    return $classes;
}
add_filter('body_class', 'mcc_body_classes');
