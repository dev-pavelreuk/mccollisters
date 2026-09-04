<?php
/**
 * Template Name: Service Page — Fitness Solutions
 *
 * Hard-coded service page (slug: fitness). Editable content lives in the
 * variables up top so it can later map to ACF. Reuses the global components:
 * .section-head, .mcc-btn, [data-accordion], the .svc-avcaps image+checklist and
 * the .svc-freight dark section — and service.css.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 10 17.5 19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/01/mccollisters-fitness-eqipment-exercise.jpg',
    'title'    => 'Fitness',
    'subtitle' => 'Logistics built for performance',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/blog/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Setting The Bar<br>For Fitness<br>Projects',
    'lead'    => '<strong>Think about it:</strong> Your facility is about to open or reopen. The staff is trained. Marketing is live. On paper, it’s “just” fitness equipment delivery and installation. In reality, it’s a web of variables: site conditions, equipment layouts, labor coordination, pre-build requirements, routing constraints, last-minute schedule shifts, and out-of-box surprises that no one could have predicted months earlier.',
    'paras'   => [
        'Now layer in today’s reality. Fitness spaces are no longer just weight rooms and cardio floors. They are comprehensive wellness destinations, blending strength, recovery, digital ecosystems, mental health, and experience-driven design. Expectations are higher. Timelines are tighter. The margin for error is slim.',
        'When installation goes wrong, the cost isn’t just financial. It’s return trips. Delayed openings. Frustrated partners. Strained relationships. And in high-value, high-expectation environments, brand reputation is always on the line.',
        'The difference comes down to one question: Is your fitness installation being treated as a unique project—or is it just another task on someone’s checklist?',
        'Our fitness solutions exists for clients who can’t afford the latter.',
    ],
];

$capabilities = [
    'title'      => 'Nationwide Fitness<br>Logistics, Installation,<br>And Support',
    'subtitle'   => 'Built for modern wellness environments',
    'intro'      => [
        'With over 20 years of hands-on experience in the fitness industry, McCollister’s supports original equipment manufacturers (OEMs), club operators, developers, and property teams with end-to-end fitness logistics designed for today’s complexity and tomorrow’s growth. That level of execution starts well before any equipment even ships.',
        'McCollister’s Fitness works closely with project managers, architects, and general contractors early in the development process to ensure fitness spaces are designed with installation requirements in mind from day one.',
        'Beyond logistics and installation, our team provides early-stage technical input on critical considerations such as equipment placement, flooring specifications, electrical requirements, wall clearances, anchoring and mounting points, rigging considerations, and equipment flow throughout the space.',
        'By integrating installation expertise during the planning phase, McCollister’s helps project teams anticipate infrastructure needs, reduce change orders, and avoid costly downstream adjustments. The result is a facility that is fully prepared for precise, efficient equipment installation—and a smoother path from construction completion to operational readiness.',
        'We don’t just move and install fitness equipment. We understand the ecosystem it lives in, the experience it enables, and the expectations it carries once it hits the floor.',
    ],
    'image'      => $uploads . '2026/03/gym-equipment-1000×1000-inset.jpg',
    'alt'        => 'A Rogue glute-ham developer bench beside stacked weight plates on blue gym turf.',
    'list_title' => 'Our fitness capabilities include:',
    'items'      => [
        'Nationwide warehousing, delivery, and white-glove installation',
        'Dedicated fitness division with deep industry expertise',
        'Pre-planning support including product consolidation, pre-builds, and route planning',
        'Installation of cardio, strength, rigs, recovery, and specialty equipment',
        'Support for projects ranging from single-unit residential installs to multi-story, multi-phase facilities',
        'Coordination across OEMs, operators, amenity managers, construction teams, and campus stakeholders',
        'Final-mile execution that adapts to shifting schedules, site realities, and real-world constraints',
    ],
    'closing'    => 'From a single treadmill in a city apartment to large-scale university wellness centers and nationwide boutique rollouts, every project receives the same mindset: precision first, no shortcuts.',
];

$confidence = [
    'eyebrow'  => 'expertise',
    'image'    => $uploads . '2026/03/mccollisters-fitness-equipment.jpg',
    'alt'      => 'A person in blue athletic shoes stands amid rows of cardio and strength equipment in a modern gym.',
    'title'    => 'Confidence With McCollister’s',
    'intro'    => 'The fitness industry evolves quickly, but execution fundamentals never go out of style. Strength and cardio endure. Recovery is now core. Digital and AI tools are reshaping experiences. And facilities are more layered than ever.',
    'sub1'     => 'What hasn’t changed is the need for partners who:',
    'list1'    => [
        'Plan thoroughly',
        'Adapt quickly',
        'Communicate clearly',
        'And execute flawlessly under pressure',
    ],
    'mid'      => 'McCollister’s brings a unique vantage point to fitness logistics. Our long-standing relationships with leading manufacturers, club operators, and amenity providers give us insight into where the industry is headed—and what it takes to support it at scale.',
    'sub2'     => 'Clients choose McCollister’s because we offer:',
    'list2'    => [
        'Deep fitness logistics expertise, not generic delivery services',
        'Teams who understand that every install reflects your brand, not ours',
        'A relationship-driven approach built on trust, feedback, and long-term partnership',
        'Nationwide reach with local execution teams who show up prepared—even on weekends, even under tight deadlines',
        'A calm, solutions-focused presence when projects inevitably change',
    ],
    'closing'  => 'We mirror your standards, respect your space, and treat your equipment as what it truly is: a promise of experience to the people who will use it every day.',
];

$cta = [
    'title'  => 'Let McCollister’s<br>Do The Heavy<br>Lifting',
    'para'   => 'Whether you’re expanding nationally, opening a flagship location, or evolving an existing fitness space into a full wellness destination, McCollister’s delivers the experience behind the scenes so your brand shines front and center.',
    'button' => ['label' => 'Contact Us', 'url' => home_url('/contact-us/')],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Fitness',
    'items'   => [
        [
            'q' => 'What are the risks associated with improper fitness installation?',
            'a' => '<p>Improper installation often leads to more than visible issues. Missed details can cause equipment downtime, return trips, delayed openings, and strained relationships with end users and partners. In premium environments, even small missteps can undermine trust and brand perception. The real cost is rarely just the invoice—it’s the long-term impact on your reputation.</p>',
        ],
        [
            'q' => 'How does McCollister’s handle complex or multi-phase fitness projects?',
            'a' => '<p>Every project is treated as a unique environment, not a repeatable task. That means early planning, coordination across stakeholders, flexibility when schedules shift, and experienced teams who anticipate challenges rather than react to them. Complexity isn’t the exception—it’s the expectation.</p>',
        ],
        [
            'q' => 'Do you support both large facilities and smaller installations?',
            'a' => '<p>Yes. McCollister’s supports the full spectrum, from single-unit residential or corporate gym installs to large, multi-story facilities and nationwide rollouts. The same attention to detail applies regardless of scale.</p>',
        ],
        [
            'q' => 'Why does white-glove final-mile service matter so much in fitness?',
            'a' => '<p>Fitness equipment doesn’t arrive in a vacuum. It enters active spaces, finished environments, and brand-defining moments. White-glove service ensures proper handling, placement, assembly, and presentation, reducing risk, eliminating rework, and protecting the client experience from day one.</p>',
        ],
        [
            'q' => 'Does McCollister’s offer fitness equipment repair and maintenance?',
            'a' => '<p>Yes. McCollister’s offers on-site fitness equipment repair and maintenance for commercial gyms, studios, residential communities, and corporate fitness centers, supporting both cardio and strength equipment. With decades of hands-on fitness experience, our technicians help minimize downtime and protect the member experience long after installation is complete.</p>',
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
                <p class="svc-prose__intro"><?php echo wp_kses($overview['lead'], ['strong' => []]); ?></p>
                <?php foreach ($overview['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Nationwide fitness logistics (heading + subtitle + intro + image + checklist) -->
    <section class="svc-section svc-avcaps">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $capabilities['title'],
            ]); ?>
            <h3 class="svc-avcaps__subtitle"><?php echo esc_html($capabilities['subtitle']); ?></h3>
            <div class="svc-prose svc-avcaps__intro">
                <?php foreach ($capabilities['intro'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <div class="svc-avcaps__grid">
                <div class="svc-avcaps__media svc-avcaps__media--635">
                    <img src="<?php echo esc_url($capabilities['image']); ?>" alt="<?php echo esc_attr($capabilities['alt']); ?>" loading="lazy" decoding="async">
                </div>
                <div class="svc-avcaps__content">
                    <h4 class="svc-avcaps__list-title"><?php echo esc_html($capabilities['list_title']); ?></h4>
                    <ul class="svc-avcaps__list">
                        <?php foreach ($capabilities['items'] as $item) : ?>
                            <li>
                                <span class="svc-avcaps__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="svc-avcaps__text svc-avcaps__closing"><?php echo esc_html($capabilities['closing']); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Confidence with McCollister's (dark, image band + title + two checklists) -->
    <section class="svc-freight svc-avconf">
        <div class="svc-freight__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $confidence['eyebrow'],
                'light'   => true,
            ]); ?>
            <div class="svc-avconf__band">
                <img src="<?php echo esc_url($confidence['image']); ?>" alt="<?php echo esc_attr($confidence['alt']); ?>" loading="lazy" decoding="async">
            </div>
            <h2 class="svc-freight__title svc-avconf__title"><?php echo esc_html($confidence['title']); ?></h2>
            <div class="svc-freight__prose">
                <p><?php echo esc_html($confidence['intro']); ?></p>
            </div>

            <div class="svc-fitconf__cols">
                <div class="svc-fitconf__col">
                    <h3 class="svc-freight__sub"><?php echo esc_html($confidence['sub1']); ?></h3>
                    <ul class="svc-freight__list svc-freight__list--stack">
                        <?php foreach ($confidence['list1'] as $item) : ?>
                            <li>
                                <span class="svc-freight__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="svc-freight__prose svc-freight__prose--after-list">
                        <p><?php echo esc_html($confidence['mid']); ?></p>
                    </div>
                </div>
                <div class="svc-fitconf__col">
                    <h3 class="svc-freight__sub"><?php echo esc_html($confidence['sub2']); ?></h3>
                    <ul class="svc-freight__list svc-freight__list--stack">
                        <?php foreach ($confidence['list2'] as $item) : ?>
                            <li>
                                <span class="svc-freight__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="svc-freight__prose svc-freight__prose--after-list">
                        <p><?php echo esc_html($confidence['closing']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Let McCollister's do the heavy lifting -->
    <section class="svc-section svc-heavylift">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $cta['title'],
            ]); ?>
            <div class="svc-prose">
                <p><?php echo esc_html($cta['para']); ?></p>
            </div>
            <a class="mcc-btn mcc-btn--on-light svc-heavylift__cta" href="<?php echo esc_url($cta['button']['url']); ?>">
                <span class="mcc-btn__label"><?php echo esc_html($cta['button']['label']); ?></span>
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
