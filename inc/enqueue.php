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

    /*
     * Production loads one combined stylesheet; development loads the readable
     * sources so a rule can be traced to its file.
     *
     * bin/build-min.sh concatenates the minified files above, in this exact
     * order, into assets/css/theme.min.css -- so the cascade is identical, but
     * it is one render-blocking request instead of ten. That distinction barely
     * shows on desktop and dominates on mobile: each stylesheet cost 180-890ms
     * on Lighthouse's Slow 4G profile, ~6.5s in total.
     */
    $combined     = '/assets/css/theme.min.css';
    $use_combined = !(defined('SCRIPT_DEBUG') && SCRIPT_DEBUG)
        && file_exists(MCC_THEME_DIR . $combined);

    if ($use_combined) {
        wp_enqueue_style(
            'mcc-theme',
            MCC_THEME_URI . $combined,
            [$dependency],
            mcc_asset_version($combined)
        );

        $dependency = 'mcc-theme';
    } else {
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
    }

    // Blog posts only: the bold-italic face is used by .post-content blockquote
    // and nothing else, so it stays out of every other page's critical path.
    if (is_singular('post')) {
        $single_post = mcc_asset_min('/assets/css/single-post.css');

        wp_enqueue_style(
            'mcc-single-post',
            MCC_THEME_URI . $single_post,
            [$dependency],
            mcc_asset_version($single_post)
        );
    }

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

    // Conversion tracking — pushes the GA4 events behind the Google Ads
    // conversion actions into the GTM dataLayer. Loaded site-wide; it attaches
    // delegated listeners only, so it is inert until something is clicked.
    $tracking = mcc_asset_min('/assets/js/tracking.js');
    wp_enqueue_script(
        'mcc-tracking',
        MCC_THEME_URI . $tracking,
        [],
        mcc_asset_version($tracking),
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
