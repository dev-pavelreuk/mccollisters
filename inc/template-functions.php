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

function mcc_body_classes(array $classes): array
{
    if (is_front_page()) {
        $classes[] = 'is-home';
    }

    return $classes;
}
add_filter('body_class', 'mcc_body_classes');
