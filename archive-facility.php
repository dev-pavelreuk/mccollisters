<?php
/**
 * Facilities archive → the Locations page (slug: locations).
 *
 * The `facility` CPT is registered with rewrite slug "locations" and
 * has_archive (see inc/post-types.php), so /locations/ resolves to this
 * archive template — a Page with that slug can never win the URL. The design
 * matches the other hand-coded pages: a plain header (no hero), the Agile Store
 * Locator plugin, the shared .svc-integrated "More About" cards, and the CTA.
 *
 * Facility posts themselves aren't looped here — the store map/list is rendered
 * by the ASL plugin shortcode.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);

/* -- Editable content (→ ACF later) --------------------------------------- */

$header = [
    'crumb' => 'locations',
    // Desktop breaks after "Footprint,"; mobile breaks after "National" and
    // "Local" (see .loc-br--d / .loc-br--m in service.css).
    'title' => 'National<br class="loc-br--m"> Footprint,<br class="loc-br--d"> Local<br class="loc-br--m"> Expertise',
    'lead'  => 'With 15 premises located strategically across the United States, McCollister’s can provide robust solutions for all your transportation, logistics, and warehousing needs.',
];

$locator_shortcode = '[ASL_STORELOCATOR prompt_location="0" radius_color="#8ba5f9" disable_page_scroll="1"]';

$more = [
    'title' => 'More About<br>McCollister’s',
    'cards' => [
        [
            'icon'  => $uploads . '2026/06/About-Us-Our-Team-i.png',
            'title' => 'About Us',
            'url'   => home_url('/about-us/'),
            'text'  => 'Learn more about who we are, who we serve, and what we do.',
        ],
        [
            'icon'  => $uploads . '2026/06/Certifications-About-Us-i.png',
            'title' => 'Certifications',
            'url'   => home_url('/forms-certifications-documents/') . '#credentials',
            'text'  => 'Find important forms, certifications, and helpful guides.',
        ],
        [
            'icon'  => $uploads . '2026/06/Careers-About-Us-i.png',
            'title' => 'Careers',
            'url'   => home_url('/careers/'),
            'text'  => 'Learn more about working for McCollister’s and view open positions.',
        ],
        [
            'icon'  => $uploads . '2026/06/ESG-Practices-About-Us-i.png',
            'title' => 'ESG Practices',
            'url'   => home_url('/esg/'),
            'text'  => 'Explore the principles that guide our company and commitment to customers.',
        ],
    ],
];
?>
<main id="primary" class="site-main">

    <!-- Header (no hero) -->
    <section class="svc-section loc-head">
        <div class="svc-section__inner">
            <p class="loc-head__crumb">/ <?php echo esc_html($header['crumb']); ?> /</p>
            <h1 class="loc-head__title"><?php echo wp_kses($header['title'], ['br' => ['class' => []]]); ?></h1>
            <p class="loc-head__lead"><?php echo esc_html($header['lead']); ?></p>
        </div>
    </section>

    <!-- Store locator (Agile Store Locator plugin) -->
    <section class="loc-locator">
        <div class="loc-locator__inner">
            <div class="loc-locator__box">
                <?php echo do_shortcode($locator_shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
        </div>
    </section>

    <!-- More About McCollister's (icon cards) -->
    <section class="svc-section svc-integrated loc-more">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $more['title'],
            ]); ?>
            <div class="svc-integrated__grid">
                <?php foreach ($more['cards'] as $card) : ?>
                    <div class="svc-integrated__card">
                        <div class="svc-integrated__icon">
                            <img src="<?php echo esc_url($card['icon']); ?>" alt="" loading="lazy" decoding="async">
                        </div>
                        <h3 class="svc-integrated__title">
                            <a href="<?php echo esc_url($card['url']); ?>"><?php echo esc_html($card['title']); ?></a>
                        </h3>
                        <p class="svc-integrated__text"><?php echo esc_html($card['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA cards (reusable component; defaults to the standard two cards) -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

    <?php // Strip a stray, never-compiled jsrender fragment the ASL plugin
          // hardcodes into #asl-panel (bare "{{if description}}…{{/if}}" text
          // nodes). It's invisible on desktop but shows on mobile. jsrender
          // builds the list from the asl_tmpls JS var, so removing these DOM
          // nodes is safe. ?>
    <script>
        (function () {
            function stripAslTemplateLeftovers() {
                var panel = document.getElementById('asl-panel');
                if (!panel) { return; }
                Array.prototype.slice.call(panel.childNodes).forEach(function (node) {
                    if ((node.textContent || '').indexOf('{{') !== -1) {
                        node.parentNode.removeChild(node);
                    }
                });
            }
            if (document.readyState !== 'loading') {
                stripAslTemplateLeftovers();
            } else {
                document.addEventListener('DOMContentLoaded', stripAslTemplateLeftovers);
            }
            window.addEventListener('load', stripAslTemplateLeftovers);
        })();
    </script>

</main>
<?php get_footer(); ?>
