<?php
/**
 * Theme assets.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

function mcc_asset_version(string $relative_path): string
{
    $path = MCC_THEME_DIR . $relative_path;

    return file_exists($path) ? (string) filemtime($path) : MCC_THEME_VERSION;
}

function mcc_enqueue_assets(): void
{
    wp_enqueue_style(
        'mcc-style',
        get_stylesheet_uri(),
        [],
        mcc_asset_version('/style.css')
    );

    $styles = [
        'mcc-variables'   => '/assets/css/variables.css',
        'mcc-base'        => '/assets/css/base.css',
        'mcc-layout'      => '/assets/css/layout.css',
        'mcc-components'  => '/assets/css/components.css',
        'mcc-header'      => '/assets/css/header.css',
        'mcc-footer'      => '/assets/css/footer.css',
        'mcc-home'        => '/assets/css/home.css',
        'mcc-service'     => '/assets/css/service.css',
        'mcc-pages'       => '/assets/css/pages.css',
        'mcc-responsive'  => '/assets/css/responsive.css',
    ];

    $dependency = 'mcc-style';

    foreach ($styles as $handle => $relative_path) {
        wp_enqueue_style(
            $handle,
            MCC_THEME_URI . $relative_path,
            [$dependency],
            mcc_asset_version($relative_path)
        );

        $dependency = $handle;
    }

    // Icon font. Enqueued here (not at theme-load time) so it runs on the
    // wp_enqueue_scripts hook as WordPress expects.
    wp_enqueue_style(
        'mcc-font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css',
        [],
        '6.7.2'
    );

    wp_enqueue_script(
        'mcc-navigation',
        MCC_THEME_URI . '/assets/js/navigation.js',
        [],
        mcc_asset_version('/assets/js/navigation.js'),
        true
    );

    // Reusable interactive components (counters, accordions, sliders) — loaded
    // site-wide so any page can use the data-attribute hooks.
    wp_enqueue_script(
        'mcc-components',
        MCC_THEME_URI . '/assets/js/components.js',
        [],
        mcc_asset_version('/assets/js/components.js'),
        true
    );

    // Hero typewriter animation — only needed on the front page.
    if (is_front_page()) {
        wp_enqueue_script(
            'mcc-hero',
            MCC_THEME_URI . '/assets/js/hero.js',
            [],
            mcc_asset_version('/assets/js/hero.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'mcc_enqueue_assets');
