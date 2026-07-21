<?php
/**
 * Theme Customizer settings.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

function mcc_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->add_section('mcc_contact', [
        'title'    => __('Company Contact Information', 'mccollisters'),
        'priority' => 30,
    ]);

    $settings = [
        'mcc_phone' => [
            'label'   => __('Primary Phone', 'mccollisters'),
            'default' => '609-386-0600',
            'type'    => 'text',
            'sanitize'=> 'sanitize_text_field',
        ],
        'mcc_email' => [
            'label'   => __('Primary Email', 'mccollisters'),
            'default' => 'info@mccollisters.com',
            'type'    => 'email',
            'sanitize'=> 'sanitize_email',
        ],
        'mcc_cta_url' => [
            'label'   => __('Talk to an Expert URL', 'mccollisters'),
            'default' => '/contact-us/',
            'type'    => 'url',
            'sanitize'=> 'esc_url_raw',
        ],
    ];

    foreach ($settings as $id => $field) {
        $wp_customize->add_setting($id, [
            'default'           => $field['default'],
            'sanitize_callback' => $field['sanitize'],
        ]);

        $wp_customize->add_control($id, [
            'label'   => $field['label'],
            'section' => 'mcc_contact',
            'type'    => $field['type'],
        ]);
    }
}
add_action('customize_register', 'mcc_customize_register');
