<?php
/**
 * FAQs managed in WordPress.
 *
 *   - Question = post title, answer = post content, position = Order.
 *   - "Show this FAQ on" = mcc_faq_location terms, one per FAQ section
 *     (Aerospace, Auto Transport, ...). A page's FAQ section shows the FAQs
 *     tagged with its location; FAQs with no location form the main list on
 *     /faqs/. The location slug is what a template asks for, e.g.
 *     mcc_faqs_for('aviation'), so a brand-new location only appears on a page
 *     once its template requests it (it shows in the /faqs/ pop-ups at once).
 *   - inc/faq-data.php reads from here once any FAQ is published and falls back
 *     to its original array until then, so deploying this changes nothing on
 *     its own. `wp mcc-faqs import` copies that array in.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

const MCC_FAQ_POST_TYPE = 'mcc_faq';
const MCC_FAQ_TAXONOMY  = 'mcc_faq_location';

function mcc_register_faq_types(): void
{
    register_post_type(MCC_FAQ_POST_TYPE, [
        'labels' => [
            'name'          => __('FAQs', 'mccollisters'),
            'singular_name' => __('FAQ', 'mccollisters'),
            'all_items'     => __('All FAQs', 'mccollisters'),
            'add_new_item'  => __('Add New FAQ', 'mccollisters'),
            'edit_item'     => __('Edit FAQ', 'mccollisters'),
            'new_item'      => __('New FAQ', 'mccollisters'),
            'search_items'  => __('Search FAQs', 'mccollisters'),
            'not_found'     => __('No FAQs found', 'mccollisters'),
        ],
        // No front-end URLs: an FAQ only ever appears inside a page's accordion.
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 21,
        'menu_icon'           => 'dashicons-editor-help',
        // Classic editor, so answers stay plain HTML rather than block markup.
        'show_in_rest'        => false,
        'supports'            => ['title', 'editor', 'page-attributes'],
        'exclude_from_search' => true,
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
    ]);

    register_taxonomy(MCC_FAQ_TAXONOMY, MCC_FAQ_POST_TYPE, [
        'labels' => [
            'name'          => __('FAQ Locations', 'mccollisters'),
            'singular_name' => __('FAQ Location', 'mccollisters'),
            'menu_name'     => __('Locations', 'mccollisters'),
            'all_items'     => __('All Locations', 'mccollisters'),
            'edit_item'     => __('Edit Location', 'mccollisters'),
            'add_new_item'  => __('Add New Location', 'mccollisters'),
        ],
        'public'            => false,
        'show_ui'           => true,
        'show_in_rest'      => false,
        'show_admin_column' => false, // replaced by the "Shown on" column below
        'hierarchical'      => true,  // checkboxes rather than a free-text tag box
        'rewrite'           => false,
        'query_var'         => false,
        // ACF's "Show this FAQ on" field replaces the default box. Without ACF,
        // keep WordPress's own box so locations can still be edited.
        'meta_box_cb'       => function_exists('acf_add_local_field_group') ? false : null,
    ]);
}
add_action('init', 'mcc_register_faq_types');

/**
 * ACF fields, defined in code so they ship with the theme.
 */
function mcc_faq_acf_fields(): void
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key'      => 'group_mcc_faq',
        'title'    => __('Where this FAQ appears', 'mccollisters'),
        'fields'   => [[
            'key'           => 'field_mcc_faq_locations',
            'label'         => __('Show this FAQ on', 'mccollisters'),
            'name'          => 'faq_locations',
            'type'          => 'taxonomy',
            'instructions'  => __('Tick every FAQ section this question should appear in. Leave them all unticked to show it in the main list on the FAQs page.', 'mccollisters'),
            'taxonomy'      => MCC_FAQ_TAXONOMY,
            'field_type'    => 'checkbox',
            'add_term'      => 0,
            'save_terms'    => 1,
            'load_terms'    => 1,
            'return_format' => 'id',
            'multiple'      => 1,
            'allow_null'    => 1,
        ]],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => MCC_FAQ_POST_TYPE]]],
    ]);

    acf_add_local_field_group([
        'key'      => 'group_mcc_faq_location',
        'title'    => __('FAQ section settings', 'mccollisters'),
        'fields'   => [[
            'key'          => 'field_mcc_faq_location_pdf',
            'label'        => __('Download PDF', 'mccollisters'),
            'name'         => 'faq_pdf_url',
            'type'         => 'url',
            'instructions' => __('Optional. The Download button in this section\'s pop-up on the FAQs page. Leave empty to hide the button.', 'mccollisters'),
        ]],
        'location' => [[['param' => 'taxonomy', 'operator' => '==', 'value' => MCC_FAQ_TAXONOMY]]],
    ]);
}
add_action('acf/init', 'mcc_faq_acf_fields');

/**
 * An answer as the templates expect it.
 *
 * wpautop() because the classic editor saves paragraphs as blank lines.
 * Internal links are stored root-relative (/talk-to-an-expert/) so they work
 * on every environment; render them absolute, like the theme's other links.
 */
function mcc_faq_answer_html(string $content): string
{
    $html = wpautop(mcc_faq_link_tokens(trim($content)));

    return (string) preg_replace_callback(
        '#href="(/(?!/)[^"]*)"#',
        static fn(array $m): string => 'href="' . esc_url(home_url($m[1])) . '"',
        $html
    );
}

/**
 * Every FAQ group built from WordPress, or null while none are published.
 *
 * Same shape as mcc_faq_groups_legacy(): slug => ['label', 'pdf_url', 'items'].
 */
function mcc_faq_groups_from_db(): ?array
{
    if (!post_type_exists(MCC_FAQ_POST_TYPE)) {
        return null;
    }

    $posts = get_posts([
        'post_type'              => MCC_FAQ_POST_TYPE,
        'post_status'            => 'publish',
        'posts_per_page'         => -1,
        'orderby'                => ['menu_order' => 'ASC', 'ID' => 'ASC'],
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
    ]);

    if ($posts === []) {
        return null;
    }

    $groups = ['general' => ['label' => __('General', 'mccollisters'), 'pdf_url' => '', 'items' => []]];

    $terms = get_terms(['taxonomy' => MCC_FAQ_TAXONOMY, 'hide_empty' => false, 'orderby' => 'name']);

    foreach (is_array($terms) ? $terms : [] as $term) {
        $groups[$term->slug] = [
            'label'   => $term->name,
            'pdf_url' => (string) get_term_meta($term->term_id, 'faq_pdf_url', true),
            'items'   => [],
        ];
    }

    foreach ($posts as $post) {
        $item      = ['q' => $post->post_title, 'a' => mcc_faq_answer_html($post->post_content)];
        $locations = get_the_terms($post, MCC_FAQ_TAXONOMY);

        if (empty($locations) || is_wp_error($locations)) {
            $groups['general']['items'][] = $item;
            continue;
        }

        foreach ($locations as $location) {
            $groups[$location->slug]['items'][] = $item;
        }
    }

    return $groups;
}

/* -- Admin list: "Shown on" + "Order" columns and a location filter --------- */

add_filter('manage_' . MCC_FAQ_POST_TYPE . '_posts_columns', static function (array $columns): array {
    unset($columns['date']);
    $columns['title']            = __('Question', 'mccollisters');
    $columns['mcc_faq_shown_on'] = __('Shown on', 'mccollisters');
    $columns['menu_order']       = __('Order', 'mccollisters');

    return $columns;
});

add_action('manage_' . MCC_FAQ_POST_TYPE . '_posts_custom_column', static function (string $column, int $post_id): void {
    if ($column === 'menu_order') {
        echo (int) get_post_field('menu_order', $post_id);
        return;
    }

    if ($column !== 'mcc_faq_shown_on') {
        return;
    }

    $terms = get_the_terms($post_id, MCC_FAQ_TAXONOMY);

    echo esc_html(empty($terms) || is_wp_error($terms)
        ? __('FAQs page (no location)', 'mccollisters')
        : implode(', ', wp_list_pluck($terms, 'name')));
}, 10, 2);

add_filter('manage_edit-' . MCC_FAQ_POST_TYPE . '_sortable_columns', static function (array $columns): array {
    $columns['menu_order'] = 'menu_order';

    return $columns;
});

add_action('restrict_manage_posts', static function (string $post_type): void {
    if ($post_type !== MCC_FAQ_POST_TYPE) {
        return;
    }

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only list filter.
    $current = isset($_GET['mcc_faq_loc']) ? sanitize_key(wp_unslash($_GET['mcc_faq_loc'])) : '';
    $terms   = get_terms(['taxonomy' => MCC_FAQ_TAXONOMY, 'hide_empty' => false, 'orderby' => 'name']);

    echo '<select name="mcc_faq_loc"><option value="">' . esc_html__('All locations', 'mccollisters') . '</option>';
    printf('<option value="__none"%s>%s</option>', selected($current, '__none', false), esc_html__('FAQs page (no location)', 'mccollisters'));

    foreach (is_array($terms) ? $terms : [] as $term) {
        printf('<option value="%s"%s>%s</option>', esc_attr($term->slug), selected($current, $term->slug, false), esc_html($term->name));
    }

    echo '</select>';
});

add_action('pre_get_posts', static function (WP_Query $query): void {
    if (!is_admin() || !$query->is_main_query() || $query->get('post_type') !== MCC_FAQ_POST_TYPE) {
        return;
    }

    // List in the order the site shows them.
    if (!$query->get('orderby')) {
        $query->set('orderby', ['menu_order' => 'ASC', 'title' => 'ASC']);
    }

    // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only list filter.
    $location = isset($_GET['mcc_faq_loc']) ? sanitize_key(wp_unslash($_GET['mcc_faq_loc'])) : '';

    if ($location === '__none') {
        $query->set('tax_query', [['taxonomy' => MCC_FAQ_TAXONOMY, 'operator' => 'NOT EXISTS']]);
    } elseif ($location !== '') {
        $query->set('tax_query', [['taxonomy' => MCC_FAQ_TAXONOMY, 'field' => 'slug', 'terms' => $location]]);
    }
});

/* -- One-time import: `wp mcc-faqs import [--dry-run]` ---------------------- */

if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('mcc-faqs import', static function (array $args, array $assoc_args): void {
        $dry = !empty($assoc_args['dry-run']);

        $existing = (new WP_Query([
            'post_type'      => MCC_FAQ_POST_TYPE,
            'post_status'    => 'any',
            'posts_per_page' => 1,
            'fields'         => 'ids',
        ]))->found_posts;

        if ($existing > 0 && !$dry) {
            WP_CLI::error("WordPress already has {$existing} FAQ(s). The import only runs into an empty FAQs list, so nothing gets duplicated.");
        }

        if ($existing > 0) {
            WP_CLI::warning("WordPress already has {$existing} FAQ(s); a real import would refuse to run.");
        }

        // Tokens become root-relative paths, which work on every environment.
        $paths = [
            '@TALK@'      => '/talk-to-an-expert/',
            '@ESG@'       => '/esg-practices/',
            '@TECHSERV@'  => '/data-center-services/',
            '@PREPGUIDE@' => '/downloads/How-to-Prepare-Your-Vehicle-for-Transport.pdf',
        ];

        // The content is ours and already vetted; don't let kses re-encode it.
        kses_remove_filters();

        $total = 0;

        foreach (mcc_faq_data() as $slug => $group) {
            $term_id = 0;

            if ($slug !== 'general') {
                $term = term_exists($slug, MCC_FAQ_TAXONOMY);

                if (!$term && !$dry) {
                    $term = wp_insert_term($group['label'], MCC_FAQ_TAXONOMY, ['slug' => $slug]);

                    if (is_wp_error($term)) {
                        WP_CLI::error("Could not create location {$slug}: " . $term->get_error_message());
                    }
                }

                $term_id = $term ? (int) $term['term_id'] : 0;

                if ($term_id && !$dry && !empty($group['pdf'])) {
                    update_term_meta($term_id, 'faq_pdf_url', esc_url_raw(mcc_faq_pdf_url($group['pdf'])));
                    update_term_meta($term_id, '_faq_pdf_url', 'field_mcc_faq_location_pdf');
                }
            }

            foreach ($group['items'] as $order => $item) {
                if (!$dry) {
                    $post_id = wp_insert_post(wp_slash([
                        'post_type'    => MCC_FAQ_POST_TYPE,
                        'post_status'  => 'publish',
                        'post_title'   => $item['q'],
                        'post_content' => strtr($item['a'], $paths),
                        'menu_order'   => $order,
                    ]), true);

                    if (is_wp_error($post_id)) {
                        WP_CLI::error('Could not create FAQ "' . $item['q'] . '": ' . $post_id->get_error_message());
                    }

                    if ($term_id) {
                        wp_set_object_terms($post_id, [$term_id], MCC_FAQ_TAXONOMY);
                    }
                }

                $total++;
            }

            WP_CLI::log(sprintf('  %-26s %3d FAQs%s', $group['label'], count($group['items']), $slug === 'general' ? '  (no location: FAQs page)' : ''));
        }

        $dry
            ? WP_CLI::success("Dry run: would create {$total} FAQs. Nothing was written.")
            : WP_CLI::success("Created {$total} FAQs.");
    }, [
        'shortdesc' => 'Import the theme\'s original FAQs (inc/faq-data.php) into the FAQs post type.',
        'synopsis'  => [[
            'type'        => 'flag',
            'name'        => 'dry-run',
            'optional'    => true,
            'description' => 'Report what would be created without writing anything.',
        ]],
    ]);
}
