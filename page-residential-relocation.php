<?php
/**
 * Template Name: Service Page — Residential Relocation
 *
 * Hard-coded service page (slug: residential-relocation). Editable content lives
 * in the variables up top so it can later map to ACF. Reuses the global
 * components: .section-head, .mcc-btn, [data-accordion], the .svc-integrated
 * card grid and .svc-freight dark section — and service.css.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 10 17.5 19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/01/residential-relocation-hero-box.jpg',
    'title'    => 'Residential Relocation',
    'subtitle' => 'Planned. Protected. Professionally-Managed.',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/resources/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Residential<br>Relocation,<br>Done Differently',
    'paras'   => [
        'Relocating a household is more than moving belongings, it’s managing change, minimizing disruption, and protecting what matters most. McCollister’s brings decades of transportation and logistics expertise to moves that require planning, coordination, and accountability.',
        'Whether supporting an employee corporate relocation, assisting a government or military family, or managing a private household move, McCollister’s approaches residential relocation with the same discipline and care trusted by organizations across industries.',
    ],
];

$teams = [
    'image'      => $uploads . '2026/04/mccollisters-residential-relocation-family-unpacking.jpg',
    'alt'        => 'A man and woman smiling and reaching down, seen from inside a cardboard box, unpacking together during a residential relocation.',
    'list_title' => 'Our teams focus on:',
    'items'      => [
        'Advance planning and coordination',
        'Protection of your property, household goods, furnishings, and high-value items',
        'Clear communication and single-point accountability',
        'Flexible support for storage, third-party coordination, timing, and destination requirements',
    ],
    'closing'    => 'This approach reflects how McCollister’s supports corporate, residential, commercial, and government and military relocation programs across the country.',
    'button'     => ['label' => 'Contact Us', 'url' => home_url('/contact-us/')],
];

$capabilities = [
    'title'      => 'Our Capabilities',
    'intro'      => [
        'Unlike traditional household movers, McCollister’s operates as an asset-based transportation and logistics provider. That means every residential relocation is treated as a managed project—not a one-size-fits-all move.',
    ],
    'lead'       => 'While every relocation is different, our residential services are designed to meet a wide range of needs:',
    'image'      => $uploads . '2026/04/McCollisters-residential-relocation-moving-1000x1020.jpg',
    'alt'        => 'Two movers in black uniforms carry a large, plastic-wrapped piece of furniture into a bright room during a residential relocation.',
    'items'      => [
        ['label' => 'Household Goods Transportation', 'text' => 'Local, long-distance, cross-country, and international residential moves managed by trained professionals.'],
        ['label' => 'Packing, Crating and Protection', 'text' => 'Careful handling and protection of property, furniture, personal belongings, and specialty household items.'],
        ['label' => 'High-Value and Specialty Items', 'text' => 'Support for items requiring additional care, coordination, or secure handling.'],
        ['label' => 'Storage and Transitional Support', 'text' => 'Short-term or long-term storage options to support flexible move timelines.'],
        ['label' => 'Dedicated Move Management', 'text' => 'A single point of contact to coordinate planning, communication, and execution.'],
    ],
];

$audiences = [
    'eyebrow' => 'customers served',
    'title'   => 'Who Is This For?',
    'intro'   => 'McCollister’s works with a broad set of residential relocation audiences.',
    'cards'   => [
        [
            'icon'  => $uploads . '2026/06/Employee-Corporate-Relocation-Residential-Relocation-i.png',
            'title' => 'Employee & Corporate Relocation',
            'text'  => 'Organizations rely on us to support employee and executive relocations that require consistency, service accountability, and cost awareness while still delivering a positive experience for the relocating individual and family.',
        ],
        [
            'icon'  => $uploads . '2026/06/Government-Military-Families-i.png',
            'title' => 'Government & Military <br>Families',
            'text'  => 'McCollister’s has long supported military family relocations, understanding the unique demands, timelines, and expectations that accompany these moves.',
        ],
        [
            'icon'  => $uploads . '2026/06/Private-Individual-Residential-Relocation-i.png',
            'title' => 'Private & Individual Residential Moves',
            'text'  => 'For individuals and families planning a household move, McCollister’s offers professional relocation services backed by the same infrastructure, safety standards, and experience trusted by commercial clients.',
        ],
        [
            'icon'  => $uploads . '2026/06/Students-Dorm-Room-Residential-Relocation-i.png',
            'title' => 'Students & Dorm Room Services',
            'text'  => 'McCollister’s supports student and dorm room moves through our U-Pass Program, offering packing, transportation, and storage services designed around academic schedules and campus needs.',
        ],
    ],
];

$beyond = [
    'image' => $uploads . '2026/01/inset-images_0017_layer-3.jpg',
    'alt'   => 'Close-up of the rear of a bright blue vintage car with chrome accents, a round tail light, and a “57 TBIRD” license plate.',
    'title' => 'Moving Beyond<br>The Household',
    'paras' => [
        'Residential moves often involve more than just household goods. McCollister’s offers professional auto transport services for individuals who want the same level of care and coordination for their vehicle as they expect for their home.',
        'Personal vehicle shipping can be coordinated as part of a residential relocation or arranged as a standalone service. Options are available for snowbirds, daily drivers, classic cars, and high-value vehicles, with flexible scheduling aligned to your move timeline.',
    ],
];

$confidence = [
    'eyebrow'  => 'expertise',
    'title'    => 'Confidence With<br>McCollister’s',
    'paras'    => [
        'Choosing the right partner for a residential relocation means trusting more than just a moving crew, it means trusting the planning, people, and process behind the move.',
        'McCollister’s brings decades of experience supporting residential, commercial, and military relocations, applying disciplined logistics practices to every household move. As an asset-based provider, McCollister’s maintains direct control over transportation, handling, and coordination, ensuring consistency, accountability, and care from start to finish.',
    ],
    'list_lead' => 'Clients benefit from:',
    'items'     => [
        'A single point of contact throughout the relocation',
        'Trained, professional crews you can trust',
        'A safety-first culture and established operating standards',
        'Scalable support for storage, timing, and destination needs',
    ],
    'closing'   => 'Every residential relocation begins with understanding the scope, priorities, and timing of the move. From there, McCollister’s develops a thoughtful plan designed to reduce disruption, protect belongings, and deliver a smooth transition from origin to destination—backed by the experience of a company trusted since 1945.',
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Residential Relocation',
    'items'   => [
        [
            'q' => 'What types of residential relocations does McCollister’s support?',
            'a' => '<p>McCollister’s supports a range of residential relocation needs, including employee and corporate relocations, military family moves, and private household moves. Each relocation is planned based on the specific scope, timing, and priorities of the move, rather than a standardized approach.</p>',
        ],
        [
            'q' => 'How is McCollister’s different from a traditional household moving company?',
            'a' => '<p>Unlike traditional household movers, McCollister’s operates as an asset-based transportation and logistics provider. Residential relocations are managed as coordinated projects, supported by trained professionals, established safety standards, and a single point of contact throughout the move.</p>',
        ],
        [
            'q' => 'Can McCollister’s support complex or high-value household moves?',
            'a' => '<p>Yes. McCollister’s regularly supports residential relocations that involve high-value items, specialty furnishings, or unique handling requirements. Each move is evaluated individually to ensure the appropriate level of planning, protection, and coordination.</p>',
        ],
        [
            'q' => 'Is storage available as part of a residential relocation?',
            'a' => '<p>Storage solutions can be incorporated into a residential relocation when timelines or circumstances require flexibility. Short-term or long-term storage options may be used to support transitions between residences or changing move schedules.</p>',
        ],
        [
            'q' => 'Who will I work with during my residential relocation?',
            'a' => '<p>Residential relocations are supported by a dedicated point of contact who helps coordinate planning, communication, and execution. This approach provides clarity, accountability, and consistent support from start to finish.</p>',
        ],
        [
            'q' => 'Is my shipment covered for loss or damage during my relocation?',
            'a' => '<p>Yes. McCollister’s offers full-value protection options for household goods during a residential relocation. Your sales consultant can walk you through available coverage options and help you select the level of protection that best fits your move.</p>',
        ],
    ],
];
?>
<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="svc-hero" style="background-image: url('<?php echo esc_url($hero['image']); ?>'); background-position: top center;">
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

    <!-- Our teams focus on (image + checklist + button) -->
    <section class="svc-section svc-teams">
        <div class="svc-section__inner">
            <div class="svc-avcaps__grid svc-avcaps__grid--free">
                <div class="svc-avcaps__media">
                    <img src="<?php echo esc_url($teams['image']); ?>" alt="<?php echo esc_attr($teams['alt']); ?>" loading="lazy" decoding="async">
                </div>
                <div class="svc-avcaps__content">
                    <h3 class="svc-avcaps__list-title"><?php echo esc_html($teams['list_title']); ?></h3>
                    <ul class="svc-avcaps__list">
                        <?php foreach ($teams['items'] as $item) : ?>
                            <li>
                                <span class="svc-avcaps__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="svc-avcaps__text"><?php echo esc_html($teams['closing']); ?></p>
                    <a class="mcc-btn mcc-btn--on-light svc-avcaps__cta" href="<?php echo esc_url($teams['button']['url']); ?>">
                        <span class="mcc-btn__label"><?php echo esc_html($teams['button']['label']); ?></span>
                        <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Capabilities (labelled list + square image) -->
    <section class="svc-section svc-avcaps">
        <div class="svc-section__inner">
            <div class="svc-avcaps__grid svc-avcaps__grid--reverse">
                <div class="svc-avcaps__content">
                    <?php get_template_part('template-parts/components/section-head', null, [
                        'title' => $capabilities['title'],
                    ]); ?>
                    <div class="svc-prose svc-avcaps__intro">
                        <?php foreach ($capabilities['intro'] as $p) : ?>
                            <p><?php echo esc_html($p); ?></p>
                        <?php endforeach; ?>
                    </div>
                    <p class="svc-avcaps__lead-blue"><?php echo esc_html($capabilities['lead']); ?></p>
                    <ul class="svc-fmlist">
                        <?php foreach ($capabilities['items'] as $item) : ?>
                            <li class="svc-fmlist__item">
                                <strong><?php echo esc_html($item['label']); ?>:</strong> <?php echo esc_html($item['text']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="svc-avcaps__media">
                    <img src="<?php echo esc_url($capabilities['image']); ?>" alt="<?php echo esc_attr($capabilities['alt']); ?>" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </section>

    <!-- Who is this for (icon cards) -->
    <section class="svc-section svc-integrated">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $audiences['eyebrow'],
                'title'   => $audiences['title'],
            ]); ?>
            <div class="svc-prose svc-integrated__intro">
                <p class="svc-prose__lead svc-prose__lead--30"><?php echo esc_html($audiences['intro']); ?></p>
            </div>
            <div class="svc-integrated__grid svc-integrated__grid--stacked">
                <?php foreach ($audiences['cards'] as $card) : ?>
                    <div class="svc-integrated__card">
                        <div class="svc-integrated__icon">
                            <img src="<?php echo esc_url($card['icon']); ?>" alt="" loading="lazy" decoding="async">
                        </div>
                        <h3 class="svc-integrated__title"><?php echo wp_kses($card['title'], ['br' => []]); ?></h3>
                        <p class="svc-integrated__text"><?php echo esc_html($card['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Moving beyond the household (image + text) -->
    <section class="svc-section svc-beyond">
        <div class="svc-section__inner">
            <div class="svc-avcaps__grid svc-avcaps__grid--free">
                <div class="svc-avcaps__media">
                    <img src="<?php echo esc_url($beyond['image']); ?>" alt="<?php echo esc_attr($beyond['alt']); ?>" loading="lazy" decoding="async">
                </div>
                <div class="svc-avcaps__content">
                    <h2 class="section-head__title svc-beyond__title"><?php echo wp_kses($beyond['title'], ['br' => []]); ?></h2>
                    <div class="svc-prose">
                        <?php foreach ($beyond['paras'] as $p) : ?>
                            <p><?php echo esc_html($p); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Confidence with McCollister's (dark, title + paras + checklist) -->
    <section class="svc-freight">
        <div class="svc-freight__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $confidence['eyebrow'],
                'light'   => true,
            ]); ?>
            <h2 class="svc-freight__title svc-avconf__title"><?php echo wp_kses($confidence['title'], ['br' => []]); ?></h2>
            <div class="svc-freight__prose">
                <?php foreach ($confidence['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
                <p><?php echo esc_html($confidence['list_lead']); ?></p>
            </div>
            <ul class="svc-freight__list">
                <?php foreach ($confidence['items'] as $item) : ?>
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
