<?php
/**
 * Template Name: Service Page — Logistics
 *
 * Hard-coded service page. All editable content lives in the variables at the
 * top so it can later be swapped for ACF fields (get_field()) with no markup
 * changes. Reuses the global components: .section-head, .mcc-btn,
 * [data-accordion], [data-tabs] — and the shared service.css spacing/rhythm.
 *
 * @package McCollisters
 */

get_header();

$uploads  = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow    ='<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$arrow_dr = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6 18 18M18 9V18H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check    = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 10 17.5 19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/03/automotive-hero5.jpg',
    'title'    => 'Logistics',
    'subtitle' => 'Single-source logistics specialists',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/blog/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Services Built<br>For High-Stakes<br>Moves',
    'lead'    => 'McCollister’s removes the need to coordinate transportation with multiple companies and instead provides you with access to a wide variety of resources so you can fulfill every logistics need with one trusted team.',
    'paras'   => [
        'McCollister’s delivers specialized logistics services designed for shipments that demand precision, visibility, and accountability. Whether you are moving high-value freight across the country or managing a sensitive oversize project, our teams coordinate every detail from planning through delivery.',
    ],
];

$tabs = [
    [
        'label' => 'Aerospace',
        'image' => $uploads . '2026/03/aerospace-logistics-inset.jpg',
        'title' => 'Aerospace Logistics',
        'desc'  => 'McCollister’s supports aerospace and defense organizations with specialized logistics services for sensitive, oversized, and mission-critical assets. These shipments require a higher level of planning, coordination, and risk management—delivered through structured project oversight and trained teams. Rather than treating aerospace as standard freight, McCollister’s approaches each move as a managed project, aligning people, process, and equipment to meet strict requirements. For full details on aerospace transportation services, certifications, and project capabilities, visit our Aerospace Logistics page.',
        'url'   => home_url('/aerospace/'),
    ],
    [
        'label' => 'Auto Transport',
        'image' => $uploads . '2026/03/auto-logistics-inset.jpg',
        'title' => 'Auto Transport & Logistics',
        'desc'  => "McCollister’s provides specialized auto transportation and auto logistics solutions designed for individuals, dealers, and OEMs who require secure, reliable vehicle transport.\n\nThese vehicle-specific services are supported by experienced teams, specialized equipment, and clear communication throughout the process.\n\nFor full details on enclosed transport options, dealer and OEM support, tracking capabilities, and auto-focused service models, visit our dedicated Auto Transport page.",
        'url'   => home_url('/auto-transport/'),
    ],
    [
        'label' => 'Aviation',
        'image' => $uploads . '2026/03/aviation-logistics-inset.jpg',
        'title' => 'Aviation & AOG Transportation',
        'desc'  => "McCollister’s offers specialized aviation logistics and transportation services for time-critical aircraft components and operationally sensitive shipments. These moves often require rapid response, precise coordination, and experienced handling to minimize downtime and keep aircraft in service.\n\nOur aviation logistics capabilities support aircraft engines and parts transportation, maintenance and repair operations, and aircraft-on-ground (AOG) shipments—managed through disciplined planning and around-the-clock coordination.\n\nFor full details on aviation transportation services, AOG support, and aviation-specific capabilities, visit our dedicated Aviation Logistics page.",
        'url'   => home_url('/aviation/'),
    ],
];

$freight = [
    'eyebrow' => 'freight brokerage',
    'title'   => 'Domestic Logistics &amp;<br>Freight Brokerage<br>Services',
    'para'    => 'McCollister’s provides nationwide domestic logistics and freight brokerage services supported by an asset-based fleet, a trusted network of partner agencies, and service branches and distribution centers positioned across major US markets. Strategic consolidation points and regularly scheduled truck routes allow us to optimize transit times, reduce product placement and return cycles, and maintain control over service quality and cost.',
    'caps_label' => 'Capabilities Include:',
    'caps'    => [
        'Asset-based fleet supported by a nationwide partner agency network',
        'Padded van transportation for high-value and fragile freight',
        'Air-ride suspension equipment to minimize vibration and in-transit risk',
        'Climate-controlled trucks for temperature-sensitive shipments',
        'Van crane services for heavy, delicate, or difficult-to-access loads',
        'Truckload (TL) transportation with specialty equipment options',
        'Domestic air freight coordination for urgent or time-definite shipments',
        'GPS-based tracking and electronic order visibility through secure web portals',
    ],
    'closing' => 'With decades of experience organizing high-value and non-standard freight, McCollister’s delivers control, consistency, and confidence for customers who cannot afford uncertainty.',
    'button'  => ['label' => 'Talk to an Expert', 'url' => home_url('/talk-to-an-expert/')],
    'image'   => $uploads . '2026/03/logistics-man.jpg',
];

$heavy = [
    'eyebrow' => 'heavy haul',
    'title'   => 'Specialized Heavy Transportation',
    'paras'   => [
        'McCollister’s delivers reliable specialized heavy transportation services for your most intensive hauls. Our expertly trained drivers, operations dispatch team, qualified labor crews, warehouse handling specialists, and certified project managers coordinate, initiate, and complete each move, while communicating with you at every stage of the project.',
        'From permitting to final delivery, every element of the heavy transportation process is carefully managed and customized based on schedule, load requirements, routing considerations, and risk profile. These services are designed to support over-dimensional, overweight, and non-standard loads that require more sophistication than conventional transportation.',
    ],
    'cols'    => [
        [
            'head'  => 'Project Oversight and Coordination',
            'items' => [
                'Feasibility studies and project planning',
                'Detailed transportation plans and procedural control',
                'Route surveys and coordination with local and state authorities',
                'Identification of safe havens and contingency planning',
                'Turn-by-turn routing instructions and maps',
                'Mobile command centers',
                'Escort and pilot car services',
                'Rigging and special handling',
                'Permit management and overnight security when required',
            ],
        ],
        [
            'head'  => 'Equipment and Capabilities',
            'intro' => 'McCollister’s maintains the purpose-built equipment necessary to handle heavy haul and over-dimensional loads, including:',
            'items' => [
                'Step deck, double drop, Conestoga, and removable gooseneck trailers',
                'Rear-steer trailers for long loads',
                'Heavy-duty tractors and crane services',
                'Multi-axle and cryogenic transport options',
                'Dual-driver and time-definite transport solutions',
                'Turnkey oversize transportation packages',
            ],
            'closing' => 'Organizations across the country rely on McCollister’s to safely transport their most valuable, sensitive, and complex equipment.',
        ],
    ],
    'button'  => ['label' => 'Talk to an Expert', 'url' => home_url('/talk-to-an-expert/')],
];

$integrated = [
    'eyebrow' => 'additional support',
    'title'   => 'Integrated Services',
    'paras'   => [
        'McCollister’s logistics services extend beyond transportation alone. Our teams are designed to integrate seamlessly with complementary offerings, allowing our customers to manage complex moves through a single, coordinated partner rather than multiple vendors. This approach reduces handoffs, improves accountability, and supports consistent execution from origin through final delivery.',
        'By aligning our services, McCollister’s delivers a more efficient, controlled logistics experience.',
        'Tell us what you’re shipping, where it’s going, and your required timeline. Our team will recommend the right service and coordinate every detail—from planning and permits to delivery.',
    ],
    'cards'   => [
        [
            'icon'  => $uploads . '2026/06/White-Glove-Handling-Logistics-i.png',
            'title' => 'White-glove handling capabilities',
            'url'   => home_url('/final-mile-white-glove/'),
            'text'  => 'For projects requiring precision handling, elevated care, and damage-free execution.',
        ],
        [
            'icon'  => $uploads . '2026/06/First-Mile-Final-Mile-Logistics-i.png',
            'title' => 'First-mile and final-mile<br>services',
            'url'   => '',
            'text'  => 'From secure, well-coordinated pickup to seamless, professionally managed delivery.',
        ],
        [
            'icon'  => $uploads . '2026/06/Warehousing-Storage-Distribution-Logistics-i.png',
            'title' => 'Warehousing, storage, and distribution',
            'url'   => home_url('/warehousing/'),
            'text'  => 'Specialized logistics solutions to meet the moment—and your supply chain needs.',
        ],
        [
            'icon'  => $uploads . '2026/06/Installation-Specialized-Handling-Logistics-io.png',
            'title' => 'Installation and specialized handling',
            'url'   => '',
            'text'  => 'Services supporting the transport, staging, and installation of complex, high-value equipment.',
        ],
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Logistics',
    'items'   => [
        [
            'q' => 'What is the difference between logistics and transportation services?',
            'a' => '<p>Transportation focuses on moving freight from one location to another. Logistics encompasses the broader planning, coordination, and management of transportation, warehousing, handling, and delivery activities to ensure shipments move efficiently from origin through destination.</p>',
        ],
        [
            'q' => 'When should I use a logistics provider instead of a single carrier?',
            'a' => '<p>A logistics provider is best suited for shipments that involve multiple service components, specialized handling, tight timelines, or operational complexity. Logistics support helps reduce coordination burden, improve visibility, and manage risk when moves require more than standard transportation.</p>',
        ],
        [
            'q' => 'Can McCollister’s handle urgent or time-sensitive shipments?',
            'a' => '<p>Yes. McCollister’s supports urgent and time-critical shipments by coordinating equipment availability, routing, handling requirements, and communication across all service components. Our teams manage execution details to help meet aggressive timelines while maintaining shipment integrity.</p>',
        ],
        [
            'q' => 'How does McCollister’s manage visibility across complex logistics projects?',
            'a' => '<p>McCollister’s maintains visibility across logistics projects through centralized coordination, proactive communication, and tracking technologies that span transportation, handling, and delivery stages. This approach allows customers to stay informed while our logistics teams manage execution and issue resolution behind the scenes.</p>',
        ],
        [
            'q' => 'Can McCollister’s scale as my needs change?',
            'a' => '<p>Yes. McCollister’s works with you to design a logistics solution tailor-made for your project. We make sure it is built to scale with your changing needs, including fluctuating volumes, seasonal demand, and project-based requirements. Service scope and resources can be adjusted to support evolving logistics challenges without disrupting your operations.</p>',
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

    <!-- Overview eyebrow (kept outside the grey card) -->
    <section class="svc-section svc-section--tight-top">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $overview['eyebrow'],
            ]); ?>
        </div>
    </section>

    <!-- Overview title + body + tabs (one grey card on mobile) -->
    <section class="svc-section svc-tabs-section svc-tabs-section--overview">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $overview['title'],
            ]); ?>
            <div class="svc-prose">
                <p><?php echo esc_html($overview['lead']); ?></p>
                <?php foreach ($overview['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <div class="svc-tabs svc-tabs--logistics" data-tabs>
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
                            <span class="svc-tabs__tab-label"><?php echo esc_html($tab['label']); ?></span>
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
                            <img src="<?php echo esc_url($tab['image']); ?>" alt="<?php echo esc_attr($tab['title']); ?>" loading="lazy" decoding="async">
                        </div>
                        <div class="svc-tabs__body">
                            <h3 class="svc-tabs__title"><?php echo esc_html($tab['title']); ?></h3>
                            <div class="svc-tabs__desc"><?php echo wp_kses_post(wpautop($tab['desc'])); ?></div>
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

    <!-- Freight brokerage + Heavy haul (dark card) -->
    <section class="svc-freight" id="freight-brokerage">
        <div class="svc-freight__inner">

            <!-- Freight brokerage -->
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $freight['eyebrow'],
                'title'   => $freight['title'],
                'light'   => true,
            ]); ?>
            <div class="svc-freight__prose">
                <p><?php echo esc_html($freight['para']); ?></p>
            </div>
            <p class="svc-freight__label"><?php echo esc_html($freight['caps_label']); ?></p>
            <ul class="svc-freight__caps">
                <?php foreach ($freight['caps'] as $cap) : ?>
                    <li>
                        <span class="svc-freight__marker" aria-hidden="true"><?php echo $arrow_dr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <span><?php echo esc_html($cap); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="svc-freight__prose">
                <p><?php echo esc_html($freight['closing']); ?></p>
            </div>
            <a class="mcc-btn svc-freight__cta" href="<?php echo esc_url($freight['button']['url']); ?>">
                <span class="mcc-btn__label"><?php echo esc_html($freight['button']['label']); ?></span>
                <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
            </a>

            <div class="svc-freight__media">
                <img src="<?php echo esc_url($freight['image']); ?>" alt="" loading="lazy" decoding="async">
            </div>

            <!-- Heavy haul -->
            <div class="svc-freight__block" id="heavy-haul">
                <?php get_template_part('template-parts/components/section-head', null, [
                    'eyebrow' => $heavy['eyebrow'],
                    'title'   => $heavy['title'],
                    'light'   => true,
                ]); ?>
                <div class="svc-freight__prose">
                    <?php foreach ($heavy['paras'] as $p) : ?>
                        <p><?php echo esc_html($p); ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="svc-freight__cols">
                    <?php foreach ($heavy['cols'] as $col) : ?>
                        <div class="svc-freight__col">
                            <h3 class="svc-freight__col-head"><?php echo esc_html($col['head']); ?></h3>
                            <?php if (!empty($col['intro'])) : ?>
                                <p class="svc-freight__col-intro"><?php echo esc_html($col['intro']); ?></p>
                            <?php endif; ?>
                            <ul class="svc-freight__list">
                                <?php foreach ($col['items'] as $item) : ?>
                                    <li>
                                        <span class="svc-freight__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                        <span><?php echo esc_html($item); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php if (!empty($col['closing'])) : ?>
                                <p class="svc-freight__col-closing"><?php echo esc_html($col['closing']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="mcc-btn svc-freight__cta" href="<?php echo esc_url($heavy['button']['url']); ?>">
                    <span class="mcc-btn__label"><?php echo esc_html($heavy['button']['label']); ?></span>
                    <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Integrated services -->
    <section class="svc-section svc-integrated">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $integrated['eyebrow'],
                'title'   => $integrated['title'],
            ]); ?>
            <div class="svc-prose svc-integrated__intro">
                <?php foreach ($integrated['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <div class="svc-integrated__grid">
                <?php foreach ($integrated['cards'] as $card) : ?>
                    <div class="svc-integrated__card">
                        <div class="svc-integrated__icon">
                            <img src="<?php echo esc_url($card['icon']); ?>" alt="" loading="lazy" decoding="async">
                        </div>
                        <h3 class="svc-integrated__title">
                            <?php if (!empty($card['url'])) : ?>
                                <a href="<?php echo esc_url($card['url']); ?>"><?php echo wp_kses($card['title'], ['br' => []]); ?></a>
                            <?php else : ?>
                                <?php echo wp_kses($card['title'], ['br' => []]); ?>
                            <?php endif; ?>
                        </h3>
                        <p class="svc-integrated__text"><?php echo esc_html($card['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="mcc-btn mcc-btn--on-light svc-integrated__cta" href="<?php echo esc_url(home_url('/contact-us/')); ?>">
                <span class="mcc-btn__label"><?php esc_html_e('Contact Us', 'mccollisters'); ?></span>
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
