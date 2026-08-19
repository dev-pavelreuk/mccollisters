<?php
/**
 * Template helper functions.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

function mcc_get_theme_option(string $key, string $fallback = ''): string
{
    return (string) get_theme_mod($key, $fallback);
}

function mcc_phone_href(string $phone): string
{
    return preg_replace('/[^0-9+]/', '', $phone) ?: '';
}

/**
 * Render a footer link column. The footer design has no column headings —
 * each list is just the assigned menu.
 */
function mcc_footer_menu(string $location): void
{
    wp_nav_menu([
        'theme_location' => $location,
        'container'      => false,
        // Location modifier so an individual column can be targeted in CSS.
        'menu_class'     => 'footer-menu footer-menu--' . str_replace('_', '-', $location),
        'fallback_cb'    => false,
        'depth'          => 1,
    ]);
}

/**
 * Wrap the closing section of a blog post — its last <h2> and everything after
 * it — in a `.single-post__closing` container, so it renders as the dark
 * call-out card at the end of every article. Runs after wpautop (priority 20) so
 * the paragraph/heading tags already exist. No-op when the post has no <h2>.
 */
function mcc_wrap_post_closing_section(string $content): string
{
    if (!is_singular('post') || !in_the_loop() || !is_main_query()) {
        return $content;
    }

    $pos = strripos($content, '<h2');

    if ($pos === false) {
        return $content;
    }

    return substr($content, 0, $pos)
        . '<div class="single-post__closing">'
        . substr($content, $pos)
        . '</div>';
}
add_filter('the_content', 'mcc_wrap_post_closing_section', 20);

function mcc_body_classes(array $classes): array
{
    if (is_front_page()) {
        $classes[] = 'is-home';
    }

    // Slug-based class (e.g. "page-auto-transport") so individual pages can be
    // targeted in CSS without relying on the environment-specific page ID.
    if (is_page()) {
        $queried = get_queried_object();
        if ($queried instanceof WP_Post) {
            $classes[] = 'page-' . $queried->post_name;
        }
    }

    return $classes;
}
add_filter('body_class', 'mcc_body_classes');
