<?php
/**
 * Custom post types.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

function mcc_register_post_types(): void
{
    register_post_type('testimonial', [
        'labels' => [
            'name'          => __('Testimonials', 'mccollisters'),
            'singular_name' => __('Testimonial', 'mccollisters'),
        ],
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-format-quote',
        'supports'     => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'has_archive'  => false,
        'rewrite'      => ['slug' => 'testimonials'],
    ]);

    register_post_type('facility', [
        'labels' => [
            'name'          => __('Facilities', 'mccollisters'),
            'singular_name' => __('Facility', 'mccollisters'),
        ],
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-location-alt',
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'],
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'locations'],
    ]);
}
add_action('init', 'mcc_register_post_types');
