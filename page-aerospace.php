<?php
/**
 * Template Name: Service Page — Aerospace
 *
 * Hard-coded service page. All editable content lives in the variables at the
 * top so it can later be swapped for ACF fields (get_field()) with no markup
 * changes. Reuses the global components: .section-head, .mcc-btn,
 * [data-accordion], [data-count-to] — and the shared service.css rhythm.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 10 17.5 19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2024/09/aeronautics2.jpg',
    'title'    => 'Aerospace',
    'subtitle' => 'Delivering excellence on the ground to get you up in the air',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/blog/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Choosing The Right<br>Transportation<br>Partner Is<br>Mission-Critical',
    'lead'    => '<strong>Consider this:</strong> You have just spent hundreds of millions of dollars and nearly a decade building a satellite. But before you can put it in orbit, it must travel over 3,000 miles to the designated launch site. How can you make sure your satellite gets to where it needs to go on time and in perfect condition?',
    'body'    => 'It is crucial for aerospace companies to thoroughly vet their transportation options and select a reliable partner. Before rockets are launched into space and satellites are placed into orbit, extremely technical and delicate moves must happen first. McCollister’s has over 80 years of logistics, transportation, and warehousing experience and is a pioneer in the aerospace transportation and logistics sector. Certified by the Department of Defense to provide Classified Transportation Protective Services (TPS), McCollister’s has custom equipment operated by specialized teams experienced with hauling loaded spacecraft containers, ground support equipment, rocket motors, and more.',
    'button'  => ['label' => 'Talk to an Expert', 'url' => home_url('/talk-to-an-expert/')],
];

$stats = [
    ['to' => '900', 'suffix' => '+', 'decimals' => 0, 'label' => 'pieces of specialized equipment'],
    ['to' => '15', 'suffix' => '', 'decimals' => 0, 'label' => 'full-service locations'],
    ['to' => '99.8', 'suffix' => '%', 'decimals' => 1, 'label' => 'on-time delivery'],
];

$capabilities = [
    'image' => $uploads . '2026/01/mccollisters-aerospace.jpg',
    'title' => 'Our Capabilities',
    'intro' => 'To ensure your equipment arrives timely, safely, and securely, McCollister’s offers customized turnkey solutions designed by experienced customer service and operations personnel. We take project scope, staffing, communication, schedule, and risk mitigation into consideration, so you experience a cost-effective, controlled process with every shipment.',
    // Column-first order: 1–6 col 1, 7–12 col 2, 13–18 col 3.
    'items' => [
        'Project management oversight',
        'Feasibility studies and route surveys',
        'Meticulous route planning and management',
        'Detailed transportation plans and procedural control',
        'Turn-by-turn instructions and maps',
        'Coordination with authorities',
        'Identified safe havens',
        'Mobile command centers',
        'Escort and pilot cars',
        'Compliance with applicable governmental regulations',
        'Climate and humidity-controlled vehicles',
        'Critical and time-definite moves',
        'Real-time communications',
        'Samsara, Qualcomm, and multilayer tracking systems',
        'Comprehensive security measures',
        'Company-owned flatbeds, tractors, and customized trailers',
        'Rigging services',
        'Warfighter support',
    ],
];

$confidence = [
    'title' => 'Confidence With<br>McCollister’s',
    'image' => $uploads . '2026/01/mccollisters-spacex-rocket-taking-off.jpg',
    'paras' => [
        'When aerospace companies select a transportation and logistics provider, the decision goes far beyond basic delivery capabilities. Because aerospace components are high-value, oversized, delicate, and highly regulated, the provider must meet strict technical, operational, and compliance standards. When you choose McCollister’s for your aerospace transit, you gain a partner equipped to manage complexity, risk, and regulatory demands at every stage.',
        'From mapping out the optimal route to managing temperature control and road vibration and ensuring a safe journey for your valuable assets, McCollister’s provides aerospace transit that is discreet and safeguarded every step of the way, even in high-profile situations.',
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Aerospace',
    'items'   => [
        [
            'q' => 'What is aerospace transportation and logistics?',
            'a' => '<p>Aerospace transportation and logistics refers to the specialized movement, handling, and support of aircraft, spacecraft, aerospace components, and related materials throughout the supply chain. Because aerospace parts are extremely high-value, oversized, and time-critical, and often require strict regulatory compliance, this sector combines advanced logistical practices with industry-specific engineering and safety standards.</p>',
        ],
        [
            'q' => 'What are the risks associated with improper aerospace transportation?',
            'a' => '<p>Improper aerospace transportation can lead to damaged or contaminated parts, safety hazards for workers and drivers, and serious regulatory issues if rules set forth by the Federal Aviation Administration (FAA), International Traffic in Arms Regulations (ITAR), or the Export Administration Regulations (EAR) are not followed. These mistakes often cause delays that interrupt production or repair schedules, create documentation problems that prevent parts from being accepted, and can result in environmental spills or fires when hazardous materials are not handled correctly. Overall, improper handling increases financial losses, harms a company’s reputation, and may leave the organization responsible for costs that insurance will not cover.</p>',
        ],
        [
            'q' => 'What considerations go into mapping out the safest and most effective route for aerospace transport?',
            'a' => '<p>McCollister’s plans routes for aerospace transport by evaluating road dimensions, weight limits, infrastructure capability, regulatory permits, safety risks, weather, community and environmental impact, security requirements, and overall timing and cost efficiency to ensure the safe and on-time delivery of sensitive aerospace components. We always conduct detailed physical route surveys to ensure the safest and most efficient route is utilized.</p>',
        ],
        [
            'q' => 'What security measures need to be put in place for aerospace transport?',
            'a' => '<p>Aerospace transport security requires a combination of controlled access, real-time tracking, and secure vehicles to protect high-value and sensitive components. Key measures include limiting personnel access, using GPS and sensor monitoring, employing tamper-evident containers, and providing trained escorts for oversized or high-risk loads. Strict handling protocols, chain-of-custody documentation, cybersecurity for digital logistics systems, and compliance with regulations like ITAR are essential, along with contingency planning for theft, tampering, or emergencies to ensure the cargo reaches its destination safely and securely.</p>',
        ],
        [
            'q' => 'When should aerospace companies first contact transportation and logistics companies?',
            'a' => '<p>Aerospace companies should contact transportation and logistics providers as early as possible in the project or production planning phase, ideally before manufacturing begins or as soon as components are designed and sourced.</p>'
                 . '<p>Contacting a logistics provider early—during design, procurement, or pre-production—is critical to ensure the safe, timely, and compliant movement of aerospace components while minimizing risk and cost.</p>',
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
            <div class="svc-prose svc-prose--aerospace">
                <p class="svc-prose__lead"><?php echo wp_kses($overview['lead'], ['strong' => []]); ?></p>
                <div class="svc-prose__cols">
                    <p><?php echo esc_html($overview['body']); ?></p>
                </div>
            </div>
            <a class="mcc-btn mcc-btn--on-light svc-cta-right" href="<?php echo esc_url($overview['button']['url']); ?>">
                <span class="mcc-btn__label"><?php echo esc_html($overview['button']['label']); ?></span>
                <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
            </a>
        </div>
    </section>

    <!-- Stats (animated counters) -->
    <section class="svc-stats">
        <div class="svc-stats__grid">
            <?php foreach ($stats as $stat) : ?>
                <div class="svc-stat">
                    <p class="svc-stat__number">
                        <span
                            class="svc-stat__value"
                            data-count-to="<?php echo esc_attr($stat['to']); ?>"
                            data-count-from="0"
                            data-count-decimals="<?php echo esc_attr($stat['decimals']); ?>"
                        ><?php echo esc_html($stat['to']); ?></span><span class="svc-stat__suffix"><?php echo esc_html($stat['suffix']); ?></span>
                    </p>
                    <p class="svc-stat__label"><?php echo esc_html($stat['label']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Capabilities image band -->
    <section class="svc-media-band">
        <img src="<?php echo esc_url($capabilities['image']); ?>" alt="" loading="lazy" decoding="async">
    </section>

    <!-- Our Capabilities (checklist) -->
    <section class="svc-section svc-checklist-section">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $capabilities['title'],
            ]); ?>
            <p class="svc-checklist__intro"><?php echo esc_html($capabilities['intro']); ?></p>
            <ul class="svc-checklist__list">
                <?php foreach ($capabilities['items'] as $item) : ?>
                    <li>
                        <span class="svc-checklist__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <span><?php echo esc_html($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- Confidence with McCollister's -->
    <section class="svc-confidence">
        <div class="svc-confidence__inner">
            <div class="svc-confidence__left">
                <div class="svc-confidence__title-box">
                    <h2><?php echo wp_kses($confidence['title'], ['br' => []]); ?></h2>
                </div>
                <div class="svc-confidence__text-box">
                    <?php foreach ($confidence['paras'] as $p) : ?>
                        <p><?php echo esc_html($p); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="svc-confidence__media">
                <img src="<?php echo esc_url($confidence['image']); ?>" alt="" loading="lazy" decoding="async">
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
