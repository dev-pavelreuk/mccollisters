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

    wp_enqueue_script(
        'mcc-navigation',
        MCC_THEME_URI . '/assets/js/navigation.js',
        [],
        mcc_asset_version('/assets/js/navigation.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'mcc_enqueue_assets');
