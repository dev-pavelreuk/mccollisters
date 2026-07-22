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
        'mcc_phone_secondary' => [
            'label'   => __('Secondary Phone', 'mccollisters'),
            'default' => '800-257-9595',
            'type'    => 'text',
            'sanitize'=> 'sanitize_text_field',
        ],
        'mcc_address' => [
            'label'   => __('Headquarters Address', 'mccollisters'),
            'default' => "8 Terri Lane\nBurlington, NJ  08016",
            'type'    => 'textarea',
            'sanitize'=> 'sanitize_textarea_field',
        ],
        'mcc_usdot' => [
            'label'   => __('USDOT / MC Numbers', 'mccollisters'),
            'default' => "USDOT 805405, MC-358185\nUSDOT 2213118, MC-182358",
            'type'    => 'textarea',
            'sanitize'=> 'sanitize_textarea_field',
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
