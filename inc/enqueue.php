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

/**
 * Resolve an asset to its minified twin for production.
 *
 * Returns the `.min.css` / `.min.js` path when that file exists on disk — unless
 * SCRIPT_DEBUG is on, in which case the readable source is served. Falls back to
 * the source when no minified twin has been built. Regenerate the twins with
 * bin/build-min.sh after editing a source file (CSS uses clean-css -O0, so the
 * minified cascade is identical to the source).
 */
function mcc_asset_min(string $relative_path): string
{
    if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
        return $relative_path;
    }

    $min = preg_replace('/\.(css|js)$/', '.min.$1', $relative_path, 1, $count);

    if ($count && is_string($min) && file_exists(MCC_THEME_DIR . $min)) {
        return $min;
    }

    return $relative_path;
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
        $asset = mcc_asset_min($relative_path);

        wp_enqueue_style(
            $handle,
            MCC_THEME_URI . $asset,
            [$dependency],
            mcc_asset_version($asset)
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

    $navigation = mcc_asset_min('/assets/js/navigation.js');
    wp_enqueue_script(
        'mcc-navigation',
        MCC_THEME_URI . $navigation,
        [],
        mcc_asset_version($navigation),
        true
    );

    // Reusable interactive components (counters, accordions, sliders) — loaded
    // site-wide so any page can use the data-attribute hooks.
    $components = mcc_asset_min('/assets/js/components.js');
    wp_enqueue_script(
        'mcc-components',
        MCC_THEME_URI . $components,
        [],
        mcc_asset_version($components),
        true
    );

    // Hero typewriter animation — only needed on the front page.
    if (is_front_page()) {
        $hero = mcc_asset_min('/assets/js/hero.js');
        wp_enqueue_script(
            'mcc-hero',
            MCC_THEME_URI . $hero,
            [],
            mcc_asset_version($hero),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'mcc_enqueue_assets');
