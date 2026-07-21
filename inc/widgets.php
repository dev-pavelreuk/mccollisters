<?php
/**
 * Widget areas.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

function mcc_register_widget_areas(): void
{
    $areas = [
        'footer-newsletter' => __('Footer Newsletter', 'mccollisters'),
        'blog-sidebar'      => __('Blog Sidebar', 'mccollisters'),
    ];

    foreach ($areas as $id => $name) {
        register_sidebar([
            'name'          => $name,
            'id'            => $id,
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget__title">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'mcc_register_widget_areas');
