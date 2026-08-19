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

/**
 * Render blog / archive pagination as "Previous 1 2 Next".
 *
 * Unlike the default paginate_links output, Previous and Next are always shown —
 * disabled (a non-link span) on the first / last page — to match the reference
 * design. $base is a paginate_links base string with a %#% placeholder (used by
 * the static Blog page so links resolve to /blog/page/2/); pass null on true
 * archives to let WordPress infer the URLs from the current request. Renders
 * nothing when there is only one page.
 */
function mcc_render_pagination(int $paged, int $total, ?string $base = null): void
{
    $paged = max(1, $paged);

    if ($total < 2) {
        return;
    }

    $args = [
        'format'    => '',
        'current'   => $paged,
        'total'     => $total,
        'type'      => 'array',
        'mid_size'  => 3,
        'end_size'  => 1,
        'prev_next' => false,
    ];

    if ($base !== null) {
        $args['base'] = $base;
    }

    $numbers = paginate_links($args);

    if (empty($numbers)) {
        return;
    }

    // Build a page URL from the same base the numbers use. page/1/ redirects to
    // the bare permalink, so link the first page cleanly.
    $page_url = static function (int $n) use ($base): string {
        if ($base !== null) {
            return $n <= 1
                ? str_replace('page/%#%/', '', $base)
                : str_replace('%#%', (string) $n, $base);
        }
        return (string) get_pagenum_link($n);
    };

    $prev = $paged > 1
        ? '<a class="page-numbers prev" href="' . esc_url($page_url($paged - 1)) . '">' . esc_html__('Previous', 'mccollisters') . '</a>'
        : '<span class="page-numbers prev is-disabled" aria-disabled="true">' . esc_html__('Previous', 'mccollisters') . '</span>';

    $next = $paged < $total
        ? '<a class="page-numbers next" href="' . esc_url($page_url($paged + 1)) . '">' . esc_html__('Next', 'mccollisters') . '</a>'
        : '<span class="page-numbers next is-disabled" aria-disabled="true">' . esc_html__('Next', 'mccollisters') . '</span>';

    echo '<nav class="blog__pagination" aria-label="' . esc_attr__('Articles pagination', 'mccollisters') . '">';
    echo $prev; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    foreach ((array) $numbers as $link) {
        echo $link; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
    echo $next; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '</nav>';
}

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
