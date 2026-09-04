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
        ['label' => 'Industry Insights', 'url' => home_url('/blog/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'We Don’t Just<br>Deliver It—We<br>Make It Work',
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
        'desc'  => 'McCollister’s Technical Services supports installation projects where data security, system integrity, and precision handling are non-negotiable. From data center infrastructure and enterprise IT deployments to decommissioning and migration projects, our specialized technicians and project managers deliver carefully planned, securely executed installations—integrated with McCollister’s nationwide transportation and logistics network.',
        'url'   => home_url('/technical-services/'),
    ],
    [
        'label' => 'Fitness Equipment',
        'image' => $uploads . '2026/03/fitness-equipment-install.jpg',
        'title' => 'Fitness Solutions',
        'desc'  => 'McCollister’s installs fitness equipment across a wide range of environments—from private home gyms and residential communities to commercial facilities, wellness centers, and multi-location rollouts. Our dedicated fitness teams understand the precision, sequencing, and care required to install equipment in finished, people-occupied spaces, helping ensure safe setup, protected equipment, and a smooth path to operational readiness.',
        'url'   => home_url('/fitness/'),
    ],
];

$integrated = [
    'title' => 'Integrated Services',
    'paras' => [
        'Installation doesn’t happen in isolation—and neither do our services. McCollister’s installation solutions are fully integrated with our broader <strong><a href="' . esc_url(home_url('/transportation/')) . '">transportation</a></strong>, <strong><a href="' . esc_url(home_url('/warehousing/')) . '">warehousing</a></strong>, and <strong><a href="' . esc_url(home_url('/logistics/')) . '">logistics</a></strong> capabilities, allowing customers to work with one partner from origin to <strong><a href="' . esc_url(home_url('/final-mile-white-glove/')) . '">final placement</a></strong>.',
        'Whether your project requires inbound transportation, short- or long-term storage, staging, final-mile delivery, or on-site installation, our teams coordinate every step under a single project plan. This integrated approach reduces handoffs, improves visibility, and helps mitigate risk throughout the deployment lifecycle.',
    ],
    'button' => ['label' => 'Contact Us', 'url' => home_url('/contact-us/')],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Installation Services',
    'items'   => mcc_faqs_for('installation'),
];
?>
<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="svc-hero" style="background-image: url('<?php echo esc_url($hero['image']); ?>'); background-position: 30% center;">
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
            <h3 class="svc-installexp__head"><?php echo esc_html($expertise_head); ?></h3>

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
                    <p><?php echo wp_kses($p, ['strong' => [], 'a' => ['href' => true]]); ?></p>
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
                        <?php mcc_faq_schema($faqs['items']); ?>
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
