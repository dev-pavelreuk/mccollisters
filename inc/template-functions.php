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
 *
 * A trailing image/figure (e.g. the McCollister's logo that ends the "Looking
 * Ahead" section) is stripped so the dark card holds only the heading and copy.
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

    $closing = substr($content, $pos);

    // Pull a trailing image/figure (e.g. the McCollister's logo) OUT of the dark
    // card so the card holds only the heading + body text — then render it just
    // below the card. Handles a Gutenberg image block, an image inside its own
    // paragraph (optionally wrapped in a link/picture), or a bare <img>.
    $trailing = '';
    $closing = preg_replace_callback(
        '#\s*(<figure\b[^>]*>(?:(?!</figure>).)*?</figure>|<p\b[^>]*>(?:(?!</p>).)*?<img\b[^>]*>(?:(?!</p>).)*?</p>|(?:<a\b[^>]*>\s*)?<img\b[^>]*>(?:\s*</a>)?)\s*$#is',
        function ($m) use (&$trailing) {
            $trailing = $m[1];
            return '';
        },
        $closing
    );

    return substr($content, 0, $pos)
        . '<div class="single-post__closing">'
        . $closing
        . '</div>'
        . $trailing;
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

/**
 * Sidebar search → posts only.
 *
 * The blog sidebar search form carries a `sidebar_post_search=1` marker; when
 * present, the main search query is restricted to published posts. WordPress'
 * native search already matches the term against the post title, excerpt, and
 * content, so results only ever surface blog posts (e.g. searching "auto"
 * returns "Why Flexibility Matters in Auto Transport"). A site-wide/header
 * search — without the marker — is left untouched.
 */
function mcc_sidebar_post_search(WP_Query $query): void
{
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return;
    }

    if (empty($_GET['sidebar_post_search']) || $_GET['sidebar_post_search'] !== '1') {
        return;
    }

    $query->set('post_type', 'post');
    $query->set('post_status', 'publish');
}
add_action('pre_get_posts', 'mcc_sidebar_post_search');

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

/**
 * The Locations page is the `facility` post-type archive (slug: locations), so
 * its document <title> otherwise defaults to the "Facilities" post-type label.
 * Force it to "Locations | <site name>". Priority 99 runs after Yoast's own
 * pre_get_document_title filter, so this wins whether or not Yoast is active.
 */
function mcc_locations_document_title(string $title): string
{
    if (is_post_type_archive('facility')) {
        return 'Locations | ' . get_bloginfo('name');
    }

    return $title;
}
add_filter('pre_get_document_title', 'mcc_locations_document_title', 99);
