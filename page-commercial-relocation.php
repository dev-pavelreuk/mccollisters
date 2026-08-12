<?php
/**
 * Template Name: Service Page — Commercial Relocation
 *
 * Hard-coded service page (slug: commercial-relocation). Editable content lives
 * in the variables up top so it can later map to ACF. Reuses the global
 * components: .section-head, .mcc-btn, [data-accordion] — and service.css.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 10 17.5 19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/02/McCollisters-Cpmmercial-relocation-hero.jpg',
    'title'    => 'Commercial Relocation',
    'subtitle' => 'From floor plan to final placement, we keep your business moving',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/resources/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Commercial Relocations<br>Planned To Reduce Risk,<br>Stress, And Downtime',
    'paras'   => [
        'Commercial office moves are rarely simple. They often include systems furniture, modular workstations, shared power and data infrastructure, sensitive paper files and records, employee desk items and personal workspace contents, lab environments and specialty spaces, and technology that cannot tolerate downtime. When these elements are handled separately, or without sufficient planning, moves become fragmented, schedules slip, and productivity suffers.',
        'McCollister’s approaches commercial relocation as a managed operational transition, not a single-day event. We plan, coordinate, and execute every component of the move so people, assets, and systems arrive ready to work—together.',
    ],
];

$capabilities = [
    'title' => 'Our Capabilities',
    'intro' => [
        'McCollister’s commercial relocation services are designed for organizations whose moves involve complexity, coordination, and accountability. Each project is overseen by a dedicated relocation specialist who manages planning, communication, execution, and post-move support.',
        'By combining workplace logistics, specialized handling, and nationwide transportation resources, we provide a structured, end-to-end methodology that keeps businesses operating through change.',
    ],
    // Alternating image side (odd = image left, even = image right).
    'blocks' => [
        [
            'image'      => $uploads . '2026/04/McCollisters-Cpmmercial-relocation-office-chair-.jpg',
            'alt'        => 'A cardboard box filled with office supplies sits in front of a desk and an office chair wrapped in protective plastic, with packed boxes stacked in the background.',
            'title'      => 'Office, systems furniture, and interior environments',
            'text'       => 'Modern workplaces are built around systems furniture and technology-enabled workstations. Panel systems, modular workstations, shared power, integrated cabling, computers, monitors, phones, and peripherals all need to be handled correctly for employees to be productive on day one. McCollister’s understands how these environments function and how to move them as a complete system, instead of as disconnected parts.',
            'list_title' => 'Our services include:',
            'items'      => [
                'Systems furniture disassembly and reinstallation',
                'Modular workstations and panel systems',
                'Furniture reconfiguration and reuse',
                'Color-coded floor plans and asset labeling',
                'Packing and protection for computers, monitors, phones, and desk equipment',
                'Antistatic monitor protection and organized packing for keyboards, cables, and peripherals',
                'Interior space reconfiguration and daily churn support',
            ],
            'closing'    => 'This approach ensures workstations are relocated, reassembled, and set up in a way that supports immediate use—not prolonged troubleshooting.',
        ],
        [
            'image'      => $uploads . '2026/04/mccollisters-lab-move-1000x1020.jpg',
            'alt'        => 'A scientist wearing safety goggles and blue gloves adjusts a slide under a microscope in a laboratory setting.',
            'title'      => 'Lab and specialty workspace relocation',
            'text'       => 'Lab moves require a higher level of planning, precision, and care. McCollister’s supports laboratory relocations for private facilities, hospitals, institutions, and research labs, with expertise in handling sensitive equipment, research samples, and regulated environments.',
            'list_title' => 'Our specialized capabilities include:',
            'items'      => [
                'Packing, loading, and delivery of lab equipment, research, samples, and specimens',
                'Climate-controlled and cryogenic trailers to maintain critical temperatures (from -112°F to 39°F) for freezers, refrigerators, and temperature-sensitive materials',
                'Powering and monitoring of equipment during transit to protect sample integrity',
                'Exclusive-use vehicles and team drivers for direct, expedited transit',
                '24-hour control tower and emergency response system',
                'Asset protection, installation alignment, and contingency planning for complex, multi-phase moves',
            ],
            'closing'    => 'Our discipline and proven track record in the scientific community ensure your lab’s assets and research arrive safely, securely, and ready for use.',
        ],
        [
            'image'      => $uploads . '2026/04/office-move3-1000x1020.jpg',
            'alt'        => 'Several cardboard boxes wrapped in plastic are stacked together, ready for commercial relocation, with a clipboard and blue pen resting on top.',
            'title'      => 'Furniture, equipment, and asset management',
            'text'       => 'Large commercial relocations often require difficult decisions about what moves, what gets stored, and what is retired. McCollister’s helps organizations manage these transitions intentionally to avoid unnecessary cost and last-minute decision making.',
            'list_title' => 'Our capabilities include:',
            'items'      => [
                'Asset inventory tracking and tagging for visibility and control throughout the move',
                'Surplus furniture and equipment management to streamline reuse, retirement, or storage',
                'Short- and long-term warehousing solutions for phased moves, asset staging, or ongoing churn support',
                'E-waste recycling for responsible, certified disposal of electronics, reducing environmental impact and supporting a sustainable, circular economy',
                'Asset recovery and reverse logistics including returns management, secure data wiping, and product disposition, coordinated through our dedicated asset return center',
            ],
            'closing'    => 'This comprehensive approach ensures assets are managed efficiently, responsibly, and with minimal disruption to your business.',
        ],
    ],
];

$technical = [
    'eyebrow' => 'technical services',
    'title'   => 'Technology And Data<br>Infrastructure Coordination',
    'paras'   => [
        'Many commercial moves require multiple vendors—one for furniture and another for IT and data infrastructure. McCollister’s simplifies this process by coordinating workplace moves with our technical services division, which specializes in data center relocation, IT asset handling, secure data destruction, and enterprise technology transitions.',
        'This integration reduces risk, shortens timelines, and ensures your workplace and technology environments come online together.',
    ],
    'button'  => ['label' => 'Explore', 'url' => home_url('/technical-services/')],
];

$confidence = [
    'eyebrow' => 'expertise',
    'image'   => $uploads . '2026/04/mccollisters-warehousing-relocation-inset.jpg',
    'alt'     => 'A person in a white shirt uses a stylus on a handheld barcode scanner during a commercial relocation, with shelves of boxes in the background.',
    'title'   => 'Confidence With McCollister’s',
    'paras'   => [
        'Commercial relocations impact people, operations, budgets, and leadership expectations. When details are missed or communication breaks down, the consequences are immediate.',
        'McCollister’s brings structure and clarity to complex workplace transitions. Our teams anticipate challenges, document plans thoroughly, communicate proactively, and adapt quickly as conditions change. No two moves are identical—timelines shift, space plans evolve, and priorities change—but our disciplined approach keeps projects controlled and predictable.',
        'From detailed move-day itineraries and access coordination to employee communication support and contingency planning, we help ensure everyone involved understands what is happening, when it is happening, and what is expected of them. The result is a move that feels managed and intentional rather than disruptive.',
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Commercial Relocation',
    'items'   => [
        [
            'q' => 'What are the risks of using an inexperienced company for a commercial office move?',
            'a' => '<p>Commercial relocations involve more than moving furniture. Inexperienced providers often lack the planning, communication, and coordination required for complex office environments. This scenario can result in damaged assets, downtime, poor employee experience, cost overruns, and last-minute chaos. McCollister’s specializes in structured commercial moves designed to prevent these outcomes.</p>',
        ],
        [
            'q' => 'How are computers, monitors, and phone systems handled during an office move?',
            'a' => '<p>McCollister’s supports the packing, protection, and coordination of employee desk-level technology as part of a commercial relocation. We provide antistatic monitor protection and organized packing solutions for keyboards, cables, mice, phones, and related equipment to keep components protected and properly grouped.</p>'
                 . '<p>If requested, McCollister’s can also coordinate disconnection, reconnection, and rebooting of computers and phone systems through McCollister’s Technical Services (MTS) to help reduce downtime.</p>',
        ],
        [
            'q' => 'Do you coordinate technology and data infrastructure moves?',
            'a' => '<p>Yes. McCollister’s coordinates commercial relocation projects with our in-house technical services team, allowing organizations to manage furniture, systems furniture, desk-level technology, and more complex IT assets under one integrated plan.</p>'
                 . '<p>This approach helps eliminate coordination gaps and ensures workspaces and technology environments come online together.</p>',
        ],
        [
            'q' => 'What information is needed to get a quote for a commercial relocation project?',
            'a' => '<p>To begin, we typically need a general understanding of the project scope, estimated size, locations involved, and desired timeline. For more complex relocations, we may conduct a site walk or planning call to ensure the quote reflects the full scope of work and avoids surprises later.</p>',
        ],
        [
            'q' => 'When should we contact McCollister’s about our office move?',
            'a' => '<p>The earlier, the better. Engaging McCollister’s early in the planning process allows us to help design the move, identify risks, and create a realistic timeline. Early involvement leads to smoother execution, fewer disruptions, and greater confidence throughout the relocation.</p>',
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

    <!-- Our Capabilities (heading + intro + alternating image/content blocks) -->
    <section class="svc-section svc-avcaps">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $capabilities['title'],
            ]); ?>
            <div class="svc-prose svc-avcaps__intro">
                <?php foreach ($capabilities['intro'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>

            <div class="svc-capblocks">
                <?php foreach ($capabilities['blocks'] as $block) : ?>
                    <div class="svc-capblock">
                        <div class="svc-capblock__media">
                            <img src="<?php echo esc_url($block['image']); ?>" alt="<?php echo esc_attr($block['alt']); ?>" loading="lazy" decoding="async">
                        </div>
                        <div class="svc-capblock__content">
                            <h3 class="svc-capblock__title"><?php echo esc_html($block['title']); ?></h3>
                            <p class="svc-capblock__text"><?php echo esc_html($block['text']); ?></p>
                            <h4 class="svc-capblock__list-title"><?php echo esc_html($block['list_title']); ?></h4>
                            <ul class="svc-capblock__list">
                                <?php foreach ($block['items'] as $item) : ?>
                                    <li>
                                        <span class="svc-capblock__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                        <span><?php echo esc_html($item); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <p class="svc-capblock__text"><?php echo esc_html($block['closing']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Technical services -->
    <section class="svc-section svc-techsvc">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $technical['eyebrow'],
                'title'   => $technical['title'],
            ]); ?>
            <div class="svc-prose">
                <?php foreach ($technical['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <a class="mcc-btn mcc-btn--on-light svc-cta-right" href="<?php echo esc_url($technical['button']['url']); ?>">
                <span class="mcc-btn__label"><?php echo esc_html($technical['button']['label']); ?></span>
                <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
            </a>
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
            <h2 class="svc-freight__title svc-avconf__title"><?php echo esc_html($confidence['title']); ?></h2>
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
