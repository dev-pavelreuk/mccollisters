<?php
/**
 * Template Name: Service Page — Installation
 *
 * Hard-coded service page. All editable content lives in the variables at the
 * top so it can later be swapped for ACF fields (get_field()) with no markup
 * changes. Reuses the global components: .section-head, .mcc-btn,
 * [data-accordion], [data-tabs] — and the shared service.css spacing/rhythm.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/03/installation-hero.jpg',
    'title'    => 'Installation',
    'subtitle' => 'Single source installation expertise for complex, high value deployments',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/resources/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'We Don’t Just<br>Deliver It—We Make<br>It Work',
    'paras'   => [
        'McCollister’s installation services support the transport, staging, and installation of complex, high-value equipment, such as ATMs and kiosks, data center infrastructure, technical systems, and fitness equipment. These projects require pre-planning, site visits, infrastructure reviews, meticulous handling, exact placement, and a deep understanding of both the equipment and the environment in which it operates.',
        'By combining our nationwide transportation footprint, secure warehousing, experienced installation teams, and dedicated project management, McCollister’s delivers installations that are executed to specification and ready for use—not simply dropped off.',
    ],
];

$expertise_head = 'Explore Our Installation Expertise';

$tabs = [
    [
        'label' => 'Banking &amp; Retail',
        'image' => $uploads . '2026/03/finance-banking-install.jpg',
        'title' => 'Finance &amp; Banking',
        'desc'  => 'McCollister’s provides installation and construction support for banks, credit unions, and OEMs, including ATMs, kiosks, vault-related infrastructure, and customer-facing banking equipment. These projects need disciplined planning, regulatory awareness, and precise execution. We approach financial installations as construction-driven, compliance-sensitive deployments, managed by experienced project teams who understand what’s at stake.',
        'url'   => home_url('/finance-banking/'),
    ],
    [
        'label' => 'Data Centers',
        'image' => $uploads . '2026/03/technical-services-installation.jpg',
        'title' => 'Data Centers',
        'desc'  => 'McCollister’s supports data center and technical infrastructure deployments with precise handling, staging, and installation of servers, racks, and sensitive IT equipment. Our teams coordinate delivery, placement, and setup to strict specifications, minimizing downtime and risk across mission-critical environments.',
        'url'   => home_url('/technical-services/'),
    ],
    [
        'label' => 'Fitness Equipment',
        'image' => $uploads . '2026/03/fitness-equipment-install.jpg',
        'title' => 'Fitness Equipment',
        'desc'  => 'McCollister’s delivers end-to-end fitness equipment logistics and installation for gyms, hospitality, residential, and commercial facilities. From transport and staging to precise assembly and placement, we ensure equipment is installed safely, correctly, and ready for use.',
        'url'   => home_url('/fitness/'),
    ],
];

$integrated = [
    'title' => 'Integrated Services',
    'paras' => [
        'Installation doesn’t happen in isolation—and neither do our services. McCollister’s installation solutions are fully integrated with our broader <strong>transportation</strong>, <strong>warehousing</strong>, and <strong>logistics</strong> capabilities, allowing customers to work with one partner from origin to <strong>final placement</strong>.',
        'Whether your project requires inbound transportation, short- or long-term storage, staging, final-mile delivery, or on-site installation, our teams coordinate every step under a single project plan. This integrated approach reduces handoffs, improves visibility, and helps mitigate risk throughout the deployment lifecycle.',
    ],
    'button' => ['label' => 'Contact Us', 'url' => home_url('/contact-us/')],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Installation Services',
    'items'   => [
        [
            'q' => 'What types of projects are best suited for McCollister’s installation services?',
            'a' => '<p>Our installation services are designed for projects involving high-value, specialized, or operationally critical equipment, especially when coordination across transportation, storage, and on-site installation is required.</p>',
        ],
        [
            'q' => 'Do you support multi-location or phased rollouts?',
            'a' => '<p>Yes. We plan and execute multi-site and phased deployments under a single project team, coordinating schedules, logistics, and on-site installation so each location is completed consistently and on time.</p>',
        ],
        [
            'q' => 'How does project management factor into installation services?',
            'a' => '<p>Dedicated project managers oversee every installation from pre-planning and site surveys through delivery, placement, and final setup—keeping timelines, communication, and quality under one point of accountability.</p>',
        ],
        [
            'q' => 'Can installation services be bundled with transportation and warehousing?',
            'a' => '<p>Absolutely. Installation integrates with our transportation, warehousing, and logistics services, so a single partner handles everything from inbound freight and storage to staging, final-mile delivery, and on-site installation.</p>',
        ],
    ],
];
?>
<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="svc-hero" style="background-image: url('<?php echo esc_url($hero['image']); ?>');">
        <div class="svc-hero__inner">
            <h1 class="svc-hero__title"><?php echo esc_html($hero['title']); ?></h1>
            <p class="svc-hero__subtitle"><?php echo esc_html($hero['subtitle']); ?></p>
            <div class="svc-hero__actions">
                <?php foreach ($hero['buttons'] as $btn) : ?>
                    <a class="mcc-btn" href="<?php echo esc_url($btn['url']); ?>">
                        <span class="mcc-btn__label"><?php echo esc_html($btn['label']); ?></span>
                        <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Overview -->
    <section class="svc-section svc-section--tight-top">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $overview['eyebrow'],
                'title'   => $overview['title'],
            ]); ?>
            <div class="svc-prose">
                <?php foreach ($overview['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Installation expertise (tabs) -->
    <section class="svc-section svc-tabs-section svc-tabs-section--installexp">
        <div class="svc-section__inner">
            <h2 class="svc-installexp__head"><?php echo esc_html($expertise_head); ?></h2>

            <div class="svc-tabs svc-tabs--install" data-tabs>
                <div class="svc-tabs__nav" role="tablist">
                    <?php foreach ($tabs as $i => $tab) : ?>
                        <button
                            type="button"
                            class="svc-tabs__tab<?php echo $i === 0 ? ' is-active' : ''; ?>"
                            role="tab"
                            data-tabs-tab="<?php echo esc_attr($i); ?>"
                            style="--tab-i: <?php echo esc_attr($i); ?>"
                            aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                        >
                            <span class="svc-tabs__tab-label"><?php echo wp_kses_post($tab['label']); ?></span>
                            <span class="svc-tabs__tab-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($tabs as $i => $tab) : ?>
                    <div
                        class="svc-tabs__panel<?php echo $i === 0 ? ' is-active' : ''; ?>"
                        role="tabpanel"
                        data-tabs-panel="<?php echo esc_attr($i); ?>"
                        style="--tab-i: <?php echo esc_attr($i); ?>"
                        <?php echo $i === 0 ? '' : 'hidden'; ?>
                    >
                        <div class="svc-tabs__media">
                            <img src="<?php echo esc_url($tab['image']); ?>" alt="<?php echo esc_attr(wp_strip_all_tags($tab['title'])); ?>" loading="lazy" decoding="async">
                        </div>
                        <div class="svc-tabs__body">
                            <h3 class="svc-tabs__title"><?php echo wp_kses_post($tab['title']); ?></h3>
                            <p class="svc-tabs__desc"><?php echo esc_html($tab['desc']); ?></p>
                            <a class="mcc-btn mcc-btn--on-light svc-tabs__cta" href="<?php echo esc_url($tab['url']); ?>">
                                <span class="mcc-btn__label"><?php esc_html_e('Explore', 'mccollisters'); ?></span>
                                <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Integrated services -->
    <section class="svc-section svc-integrated">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $integrated['title'],
            ]); ?>
            <div class="svc-prose svc-integrated__intro">
                <?php foreach ($integrated['paras'] as $p) : ?>
                    <p><?php echo wp_kses($p, ['strong' => []]); ?></p>
                <?php endforeach; ?>
            </div>
            <a class="mcc-btn mcc-btn--on-light svc-integrated__cta" href="<?php echo esc_url($integrated['button']['url']); ?>">
                <span class="mcc-btn__label"><?php echo esc_html($integrated['button']['label']); ?></span>
                <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
            </a>
        </div>
    </section>

    <!-- FAQs -->
    <section class="svc-section svc-faqs">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $faqs['eyebrow'],
                'title'   => $faqs['title'],
            ]); ?>
            <div class="svc-faqs__list" data-accordion>
                <?php foreach ($faqs['items'] as $item) : ?>
                    <details class="svc-faq">
                        <summary class="svc-faq__summary">
                            <span class="svc-faq__q"><?php echo esc_html($item['q']); ?></span>
                            <span class="svc-faq__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </summary>
                        <div class="svc-faq__panel">
                            <?php echo wp_kses($item['a'], ['p' => [], 'ul' => [], 'li' => [], 'strong' => []]); ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA cards (reusable component; defaults to the standard two cards) -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
