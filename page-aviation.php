<?php
/**
 * Template Name: Service Page — Aviation
 *
 * Hard-coded service page (slug: aviation). Editable content lives in the
 * variables up top so it can later map to ACF. Reuses the global components:
 * .section-head, .mcc-btn, [data-accordion] — and the shared service.css.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 10 17.5 19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/06/Aviation-2.jpg',
    'title'    => 'Aviation',
    'subtitle' => 'Reliable logistics for aircraft, engines, and critical components',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/blog/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Grounded Aircraft.<br>Elevated Expectations.',
    'paras'   => [
        'When an aircraft, engine, or critical component is stuck on the ground, the pressure is immediate. Downtime is costly, schedules are disrupted, and every decision carries risk. You need a logistics partner who understands how unforgiving aviation timelines can be—and how critical precision is at every step.',
        'McCollister’s supports aviation and aerospace clients facing time-sensitive, high-stakes transportation challenges. From aircraft-on-ground (AOG) situations to planned component moves, we understand the urgency, complexity, and accountability your operation demands.',
    ],
];

$capabilities = [
    'title'      => 'Our<br>Capabilities',
    'intro'      => [
        'McCollister’s provides specialized aviation logistics services tailored to the unique demands of aircraft, engines, and aviation components, including assets moving to and from maintenance, repair, and overhaul (MRO) facilities.',
        'Whether components are newly removed from service, aged out, or in need of inspection, repair, or overhaul, our teams manage transportation with the care, security, and coordination aviation assets require. We regularly support shipments moving between operators, MRO providers, manufacturers, and storage locations.',
    ],
    'image'      => $uploads . '2026/03/mccollisters-aviation-prop-engine-inset.jpg',
    'alt'        => 'A close-up of a radial aircraft engine with polished metal cylinders against a yellow cowling.',
    'list_title' => 'Our aviation capabilities include:',
    'items'      => [
        'AOG transportation',
        'Aircraft engines and critical parts shipping',
        'Time-critical and time-specific moves',
        'Cross-country aviation freight coordination',
        'Specialized trailers and asset-based transportation',
        'GPS-tracked shipments with full visibility',
    ],
    'closing'    => 'Every aviation move is supported by trained drivers and experienced logistics professionals who understand the importance of protecting sensitive assets while meeting demanding schedules, no matter if they’re returning to service or awaiting repair.',
    'button'     => ['label' => 'Talk to an Expert', 'url' => home_url('/talk-to-an-expert/')],
];

$confidence = [
    'eyebrow' => 'expertise',
    'image'   => $uploads . '2026/03/inairplane-inset.jpg',
    'alt'     => 'A large passenger airplane parked on the runway in front of a modern airport terminal building with glass windows.',
    'title'   => 'Confidence With<br>McCollister’s',
    'paras'   => [
        'Aviation logistics is not standard freight—and McCollister’s doesn’t treat it that way.',
        'What sets us apart is our aviation-specific experience, asset-based fleet, and round-the-clock availability. Our drivers are trained in aviation transportation and equipped to handle sensitive, high-value cargo with care and precision. With nationwide coverage and 24/7/365 support, we remain responsive when timing matters most.',
        'McCollister’s brings structure, visibility, and accountability to aviation shipments that cannot afford delays, missteps, or uncertainty. When aircraft operations are on the line, our clients trust us to deliver.',
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Aviation',
    'items'   => [
        [
            'q' => 'What are the risks of not using a specialized aviation logistics provider?',
            'a' => '<p>Aviation shipments involve tight timelines, sensitive components, and strict handling requirements. Using a general freight provider increases the risk of delays, improper handling, asset damage, and extended aircraft downtime—each of which can carry significant operational and financial consequences.</p>',
        ],
        [
            'q' => 'What is aircraft-on-ground (AOG) transportation?',
            'a' => '<p>AOG transportation supports situations where an aircraft is grounded due to mechanical issues or missing components. These shipments are time-critical and require immediate coordination to restore operations as quickly as possible.</p>',
        ],
        [
            'q' => 'Can McCollister’s support time-critical aviation shipments?',
            'a' => '<p>Yes. McCollister’s provides 24/7/365 pickup, delivery, and support for time-sensitive aviation moves, including AOG requests and scheduled critical shipments.</p>',
        ],
        [
            'q' => 'How does McCollister’s ensure the safety of aviation components?',
            'a' => '<p>Our aviation shipments are handled by trained drivers using specialized equipment and secure loading practices. Shipments are GPS-tracked to provide visibility and accountability throughout transit.</p>',
        ],
        [
            'q' => 'How do I get started with McCollister’s for my aviation project?',
            'a' => '<p>Simply contact our team to speak with an aviation logistics expert. We’ll assess your requirements and coordinate a transportation solution built around your timeline, asset, and operational needs.</p>',
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

    <!-- Our Capabilities (image + checklist) -->
    <section class="svc-section svc-avcaps svc-avcaps--aviation">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $capabilities['title'],
            ]); ?>
            <div class="svc-prose svc-avcaps__intro">
                <?php foreach ($capabilities['intro'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <div class="svc-avcaps__grid">
                <div class="svc-avcaps__media">
                    <img src="<?php echo esc_url($capabilities['image']); ?>" alt="<?php echo esc_attr($capabilities['alt']); ?>" loading="lazy" decoding="async">
                </div>
                <div class="svc-avcaps__content">
                    <h3 class="svc-avcaps__list-title"><?php echo esc_html($capabilities['list_title']); ?></h3>
                    <ul class="svc-avcaps__list">
                        <?php foreach ($capabilities['items'] as $item) : ?>
                            <li>
                                <span class="svc-avcaps__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="svc-avcaps__text"><?php echo esc_html($capabilities['closing']); ?></p>
                    <a class="mcc-btn mcc-btn--on-light svc-avcaps__cta" href="<?php echo esc_url($capabilities['button']['url']); ?>">
                        <span class="mcc-btn__label"><?php echo esc_html($capabilities['button']['label']); ?></span>
                        <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Confidence with McCollister's (dark, image band + title + paras) -->
    <section class="svc-freight svc-avconf">
        <div class="svc-freight__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $confidence['eyebrow'],
                'light'   => true,
            ]); ?>
            <div class="svc-avconf__band">
                <img src="<?php echo esc_url($confidence['image']); ?>" alt="<?php echo esc_attr($confidence['alt']); ?>" loading="lazy" decoding="async">
            </div>
            <h2 class="svc-freight__title svc-avconf__title"><?php echo wp_kses($confidence['title'], ['br' => []]); ?></h2>
            <div class="svc-freight__prose">
                <?php foreach ($confidence['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
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
