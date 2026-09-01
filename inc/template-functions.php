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

/**
 * Front-page hero slide URLs.
 *
 * Customizer-selected slides take priority; otherwise the default sequence of
 * six media-library images, built from this site's own uploads URL so it
 * resolves on both local and production.
 *
 * Extracted from front-page.php so mcc_preload_hero_slide() can resolve the
 * first slide during wp_head, before the template runs.
 */
function mcc_hero_slides(): array
{
    $slides = [];

    for ($slide = 1; $slide <= 6; $slide++) {
        $slide_url = mcc_get_theme_option('mcc_hero_slide_' . $slide, '');

        if ($slide_url !== '') {
            $slides[] = $slide_url;
        }
    }

    if (!empty($slides)) {
        return $slides;
    }

    $uploads_base = trailingslashit(wp_get_upload_dir()['baseurl']) . '2026/04/';

    return [
        $uploads_base . 'slider-pic-2-100.jpg',
        $uploads_base . 'warehouse-worker-rev.jpg',
        $uploads_base . 'slider-pic-3-100.jpg',
        $uploads_base . 'slider-pic-1-100.jpg',
        $uploads_base . 'warehousing.jpg',
        $uploads_base . 'data-center.jpg',
    ];
}

/**
 * Preload the first hero slide from <head>.
 *
 * The slide is a CSS background-image, which the browser cannot discover until
 * it has built the CSSOM — so it is the LCP element but is fetched late. The
 * preload previously sat in the body, after the slider markup, which is far
 * later than the preload scanner needs it. Emitting it during wp_head makes it
 * discoverable in the initial document (WCAG-neutral; purely a load-order
 * change, the painted result is identical).
 */
function mcc_preload_hero_slide(): void
{
    if (!is_front_page()) {
        return;
    }

    $slides = mcc_hero_slides();

    if (empty($slides[0])) {
        return;
    }

    printf(
        '<link rel="preload" as="image" href="%s" fetchpriority="high">' . "\n",
        esc_url($slides[0])
    );
}
add_action('wp_head', 'mcc_preload_hero_slide', 1);

/**
 * Inline SVG icons (replaces Font Awesome).
 *
 * The theme used seven Font Awesome glyphs and paid 272KB of webfonts plus a
 * render-blocking third-party stylesheet for them. These are the same paths
 * from Font Awesome 6.7.2, inlined.
 *
 * Sizing is deliberately em-based so every existing rule keeps working: a font
 * glyph occupies a 1em box, and `height: 1em; width: auto` over the original
 * viewBox reproduces that exactly (e.g. 448/512 = 0.875em wide). The
 * -0.125em baseline shift is Font Awesome's own. See .mcc-icon in base.css.
 */
function mcc_icon(string $name, string $class = ''): string
{
    static $icons = [
        'instagram' => ['0 0 448 512', 'M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z'],
        'facebook' => ['0 0 512 512', 'M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z'],
        'facebook-f' => ['0 0 320 512', 'M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z'],
        'linkedin' => ['0 0 448 512', 'M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z'],
        'linkedin-in' => ['0 0 448 512', 'M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z'],
        'youtube' => ['0 0 576 512', 'M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z'],
        'user' => ['0 0 448 512', 'M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z'],
    ];

    if (!isset($icons[$name])) {
        return '';
    }

    [$viewbox, $path] = $icons[$name];

    return sprintf(
        '<svg class="mcc-icon%s" viewBox="%s" role="img" aria-hidden="true" focusable="false"><path d="%s"/></svg>',
        $class !== '' ? ' ' . esc_attr($class) : '',
        esc_attr($viewbox),
        esc_attr($path)
    );
}
