<?php
/**
 * Theme setup and navigation registration.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

function mcc_theme_setup(): void
{
    load_theme_textdomain('mccollisters', MCC_THEME_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');

    add_theme_support('custom-logo', [
        'height'      => 90,
        'width'       => 360,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    register_nav_menus([
        'primary'           => __('Primary Navigation', 'mccollisters'),
        'utility'           => __('Utility Navigation', 'mccollisters'),
        'footer_services'   => __('Footer Services', 'mccollisters'),
        'footer_company'    => __('Footer Company', 'mccollisters'),
        'footer_industries' => __('Footer Industries', 'mccollisters'),
        'footer_resources'  => __('Footer Resources', 'mccollisters'),
        'footer_legal'      => __('Footer Legal', 'mccollisters'),
    ]);

    add_image_size('mcc-card', 900, 650, true);
    add_image_size('mcc-hero', 1920, 900, true);
}
add_action('after_setup_theme', 'mcc_theme_setup');
