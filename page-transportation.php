<?php
/**
 * Template Name: Service Page — Transportation
 *
 * Hard-coded service page. All editable content lives in the variables at the
 * top so it can later be swapped for ACF fields (get_field()) with no markup
 * changes. Reuses the global components: .section-head, .mcc-btn,
 * [data-accordion], [data-tabs].
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/03/transportation-inset-2.jpg',
    'title'    => 'Transportation',
    'subtitle' => 'Specialized transportation services executed with precision',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/blog/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'The Right Lane For<br class="br--desktop"> Your Next Move',
    'paras'   => [
        'Every move comes with its own set of constraints and is shaped by the asset, the environment, and the expectations tied to it. McCollister’s brings proven experience across specialized markets while remaining flexible enough to support transportation needs in virtually any setting. Whether the move is routine or highly complex, we apply the same disciplined attention to detail every time.',
        'Our transportation services are tailored to each move, never forced into a standard template. With purpose-built equipment, experienced drivers, and teams trained to handle sensitive, high-value assets, we ensure every shipment is protected from pickup through delivery.',
    ],
];

$industries = [
    'title' => 'Industries<br>Served',
    'intro' => 'Across industries, requirements can vary significantly. Rather than offering one-size-fits-all freight solutions, McCollister’s customizes each transportation plan to the asset, environment, and operational demands involved. Explore our transportation solutions below to see how this approach is applied across different service areas.',
    'tabs'  => [
        [
            'label'    => 'Aerospace',
            'image'    => $uploads . '2026/03/transportation-aerospace-launch.jpg',
            'title'    => 'Aerospace',
            'subtitle' => 'Built for Mission-Critical Moves',
            'desc'     => 'McCollister’s provides specialized transportation for aerospace and defense assets that demand heightened security, precision handling, and detailed planning. From aircraft components and engines to oversized and sensitive equipment, our teams manage each move as a coordinated transportation project, mitigating risk while maintaining strict schedules and compliance.',
            'url'      => home_url('/aerospace/'),
        ],
        [
            'label'    => 'Auto Transport',
            'image'    => $uploads . '2026/03/mccollisters-transportation-auto-inset.jpg',
            'title'    => 'Auto Transport',
            'subtitle' => 'Protection That Goes the Distance',
            'desc'     => 'McCollister’s supports vehicle transportation for individuals, collectors, dealerships, OEMs, and commercial clients, each with different expectations and requirements. From everyday moves to high-value vehicles, we tailor equipment, handling, and routing to ensure cars arrive on time and in the condition expected, with clear communication throughout the move.',
            'url'      => home_url('/auto-transport/'),
        ],
        [
            'label'    => 'Aviation &amp; AOG Transport',
            'image'    => $uploads . '2026/03/transport-aviation-inset.jpg',
            'title'    => 'Aviation &amp; AOG Transport',
            'subtitle' => 'Urgency Without Turbulence',
            'desc'     => 'When aircraft downtime is not an option, McCollister’s delivers time-critical aviation transportation services. We support aircraft-on-ground (AOG) events, maintenance operations, and urgent component moves with rapid response coordination, experienced handling, and nationwide reach, helping minimize disruption and keep operations moving.',
            'url'      => home_url('/aviation/'),
        ],
        [
            'label'    => 'Commercial Relocation',
            'image'    => $uploads . '2026/03/commercial-relocation-inset.jpg',
            'title'    => 'Commercial Relocation',
            'subtitle' => 'Where Downtime Isn’t on the Schedule',
            'desc'     => 'McCollister’s supports commercial relocations with transportation services designed for office furniture, technology, fixtures, and specialized workplace assets. Our teams coordinate equipment, routes, and schedules to ensure efficient transitions, whether supporting a single office move or a multi-site corporate relocation.',
            'url'      => home_url('/commercial-relocation/'),
        ],
        [
            'label'    => 'Residential Relocation',
            'image'    => $uploads . '2026/03/residential-inset.jpg',
            'title'    => 'Residential Relocation',
            'subtitle' => 'Moving Day, Minus the Mayhem',
            'desc'     => 'McCollister’s provides residential transportation services built around care, communication, and trust. With experienced crews and established processes, we ensure household goods are handled responsibly and delivered safely, no matter the distance.',
            'url'      => home_url('/residential-relocation/'),
        ],
    ],
];

$whiteglove = [
    'eyebrow' => 'white-glove and final-mile',
    'title'   => 'When Standard<br>Delivery Isn’t<br>Enough',
    'paras'   => [
        'Some shipments demand more than curbside drop-off or dock delivery. McCollister’s provides white-glove and final-mile transportation services for high-value, fragile, and customer-facing assets where handling, placement, and presentation matter just as much as transit.',
        'Our teams manage the most critical stages of the move, from carefully coordinated pickup to inside delivery and final placement, ensuring assets arrive protected, on schedule, and ready for use. This elevated level of service supports a wide range of environments, from commercial facilities and live venues to residential settings.',
    ],
    'button'  => ['label' => 'Learn More', 'url' => home_url('/final-mile-white-glove/')],
];

$expertise = [
    'eyebrow' => 'expertise',
    'image'   => $uploads . '2026/04/mccollisters-truck-on-a-mountain-road.jpg',
    'title'   => 'A Transportation<br>Partner You Can<br>Rely On',
    'paras'   => [
        'Transportation rarely exists in isolation. Many moves involve more than point-to-point delivery, whether that means coordinating white-glove handling, staging shipments, or aligning transportation with broader project considerations. McCollister’s is built to support those moments without introducing complexity or handoffs.',
        'As part of a fully integrated organization, our transportation services connect seamlessly with warehousing, logistics, installation, and final mile capabilities. This structure allows us to adapt when a move evolves, maintaining continuity, visibility, and accountability from start to finish, even as scope or priorities change.',
        'When you partner with McCollister’s, you’re not just booking transportation. You’re working with a team that understands how transportation fits into the bigger picture—and has the experience, resources, and flexibility to support what comes next.',
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Transportation',
    'items'   => [
        [
            'q' => 'How is McCollister’s transportation different from standard freight services?',
            'a' => 'McCollister’s specializes in transportation for assets that demand more planning, protection, and accountability than typical freight. Rather than applying a fixed process, we tailor equipment, handling methods, and routing to the specific asset and environment involved.',
        ],
        [
            'q' => 'Do you handle both simple and complex transportation moves?',
            'a' => 'Yes. We support everything from straightforward point-to-point deliveries to highly coordinated, multi-stage moves involving specialized equipment, staging, and white-glove handling—applying the same standards to each.',
        ],
        [
            'q' => 'How do you determine the right transportation approach for a move?',
            'a' => 'We start with the asset, the environment, and the outcome you need, then match the equipment, crew, and routing accordingly. Every plan is built around the specifics of the shipment rather than forced into a standard template.',
        ],
        [
            'q' => 'Can transportation plans be customized for different industries or asset types?',
            'a' => 'Absolutely. From aerospace and automotive to commercial and residential relocation, we adapt our handling methods, equipment, and processes to the requirements of each industry and asset type.',
        ],
        [
            'q' => 'What happens if transportation needs change mid-move?',
            'a' => 'Because our transportation connects seamlessly with warehousing, logistics, and final-mile capabilities, we can adapt as scope or priorities shift—maintaining continuity, visibility, and accountability throughout.',
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

    <!-- Industries served (tabs) -->
    <section class="svc-section svc-tabs-section">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => '',
                'title'   => $industries['title'],
                'lead'    => $industries['intro'],
            ]); ?>

            <div class="svc-tabs svc-tabs--transport" data-tabs>
                <div class="svc-tabs__nav" role="tablist">
                    <?php foreach ($industries['tabs'] as $i => $tab) : ?>
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

                <?php foreach ($industries['tabs'] as $i => $tab) : ?>
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
                            <p class="svc-tabs__subtitle"><?php echo esc_html($tab['subtitle']); ?></p>
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

    <!-- White-glove / final-mile -->
    <section class="svc-section svc-callout">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $whiteglove['eyebrow'],
                'title'   => $whiteglove['title'],
            ]); ?>
            <div class="svc-prose">
                <?php foreach ($whiteglove['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <a class="mcc-btn mcc-btn--on-light svc-callout__cta" href="<?php echo esc_url($whiteglove['button']['url']); ?>">
                <span class="mcc-btn__label"><?php echo esc_html($whiteglove['button']['label']); ?></span>
                <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
            </a>
        </div>
    </section>

    <!-- Expertise (dark) -->
    <section class="svc-expertise">
        <div class="svc-expertise__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $expertise['eyebrow'],
                'title'   => '',
                'light'   => true,
            ]); ?>
            <div class="svc-expertise__media">
                <img src="<?php echo esc_url($expertise['image']); ?>" alt="" loading="lazy" decoding="async">
            </div>
            <h2 class="svc-expertise__title"><?php echo wp_kses($expertise['title'], ['br' => []]); ?></h2>
            <div class="svc-expertise__prose">
                <?php foreach ($expertise['paras'] as $p) : ?>
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
                        <?php mcc_faq_schema($faqs['items']); ?>
            <div class="svc-faqs__list" data-accordion>
                <?php foreach ($faqs['items'] as $item) : ?>
                    <details class="svc-faq">
                        <summary class="svc-faq__summary">
                            <span class="svc-faq__q"><?php echo esc_html($item['q']); ?></span>
                            <span class="svc-faq__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </summary>
                        <div class="svc-faq__panel">
                            <p><?php echo esc_html($item['a']); ?></p>
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
