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

    // Homepage hero background slider — up to six images.
    $wp_customize->add_section('mcc_hero', [
        'title'    => __('Homepage Hero Slider', 'mccollisters'),
        'priority' => 31,
    ]);

    for ($slide = 1; $slide <= 6; $slide++) {
        $slide_id = 'mcc_hero_slide_' . $slide;

        $wp_customize->add_setting($slide_id, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, $slide_id, [
                /* translators: %d: slide number */
                'label'   => sprintf(__('Hero Slide %d', 'mccollisters'), $slide),
                'section' => 'mcc_hero',
            ])
        );
    }

    // Homepage "About Us" quote card background image.
    $wp_customize->add_section('mcc_about', [
        'title'    => __('Homepage About Section', 'mccollisters'),
        'priority' => 32,
    ]);

    $wp_customize->add_setting('mcc_about_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Image_Control($wp_customize, 'mcc_about_image', [
            'label'       => __('Quote Card Background Image', 'mccollisters'),
            'description' => __('The photo behind the employee quote in the About section.', 'mccollisters'),
            'section'     => 'mcc_about',
        ])
    );

    // Homepage "Features" accordion image.
    $wp_customize->add_setting('mcc_features_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Image_Control($wp_customize, 'mcc_features_image', [
            'label'       => __('Features Section Image', 'mccollisters'),
            'description' => __('The truck image beside the "Confidence with McCollister’s" accordion.', 'mccollisters'),
            'section'     => 'mcc_about',
        ])
    );

    // Homepage "Industries" band background image.
    $wp_customize->add_setting('mcc_industries_bg', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(
        new WP_Customize_Image_Control($wp_customize, 'mcc_industries_bg', [
            'label'       => __('Industries Background Image', 'mccollisters'),
            'description' => __('The dark textured background behind the "Specialty Solutions" industries carousel.', 'mccollisters'),
            'section'     => 'mcc_about',
        ])
    );
}
add_action('customize_register', 'mcc_customize_register');
