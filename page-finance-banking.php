<?php
/**
 * Template Name: Service Page — Finance & Banking
 *
 * Hard-coded service page (slug: finance-banking). Editable content lives in the
 * variables up top so it can later map to ACF. Reuses the global components:
 * .section-head, .mcc-btn, [data-accordion], the .svc-logos marquee and the
 * .svc-freight dark section — and service.css.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/01/finance-banking-hero.jpg',
    'title'    => 'Finance & Banking',
    'subtitle' => 'Turnkey ATM installation and rigging services',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/blog/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Precision You Can<br>Bank On',
    'paras'   => [
        'ATM installations are often treated like straightforward equipment placements. In reality, however, they are construction-driven, compliance-sensitive projects with direct implications for operational continuity, regulatory exposure, and brand reputation.',
        'When ADA requirements are misunderstood, site conditions are assumed instead of verified, or communication breaks down between vendors, the impact extends far beyond the install itself. Delays, rework, and compliance issues create risk that operations teams must manage, and executives must explain.',
        'That’s why banks, credit unions, and original equipment manufacturers (OEMs) increasingly look beyond basic installers. They choose partners who understand not just the equipment, but the planning discipline, construction expertise, and accountability required to execute ATM deployments correctly from the start.',
    ],
];

$logos = [
    ['img' => $uploads . '2026/03/ncr.png',                             'alt' => 'NCR'],
    ['img' => $uploads . '2026/03/pnc.png',                             'alt' => 'PNC'],
    ['img' => $uploads . '2026/03/santander.png',                       'alt' => 'Santander'],
    ['img' => $uploads . '2026/03/mccollisters-bank-of-america-logo.png', 'alt' => 'Bank of America'],
    ['img' => $uploads . '2026/03/mccollisters-the-capital-one-logo.png', 'alt' => 'Capital One'],
    ['img' => $uploads . '2026/03/chase.png',                           'alt' => 'Chase'],
];

$capabilities = [
    'title' => 'Our<br>Capabilities',
    'intro' => [
        'McCollister’s Installation Services provides specialized construction and installation solutions for financial institutions and businesses, including design-build planning for banking equipment such as ATMs, VATs, night drops, vaults, kiosk buildings, and related signage.',
        'As an all-in-one source for programmatic deployment and installation solutions, McCollister’s supports projects from conceptualization to closeout with dedicated construction and project managers executing programs with urgency and operational discipline.',
    ],
    'image' => $uploads . '2026/03/chase-building-tall-872x1020.jpg',
    'alt'   => 'A multistory building with the Chase bank logo on its facade stands before a taller skyscraper partially obscured by fog in an overcast urban scene.',
    'items' => [
        [
            'title' => 'ATM installation & construction services',
            'html'  => '<p>Through-the-wall (TTW) ATMs requiring specialized understanding of ADA compliance, service clearances, HVAC and electrical tolerances, elevation deltas, and commercial wall construction.</p>'
                     . '<p>Drive-through ATMs and island construction, including lane refreshes, new capacity builds, and collaboration with architects and engineers to align with industry standards, public ordinances, security concerns, and equipment requirements.</p>'
                     . '<p>Free-standing lobby ATM kiosks, including difficult rigging challenges and installation aligned to customer standards for quality control and compliance verification.</p>',
        ],
        [
            'title' => 'Security, compliance, and risk reduction',
            'html'  => '<ul>'
                     . '<li>ATM security enhancements, including physical barriers, threat risk analysis, and site-specific security recommendations.</li>'
                     . '<li>ADA compliance verification, including required height, wheelchair access, and access pathways, helping reduce the risk of alleged violations.</li>'
                     . '<li>PCI destruction &amp; NPI decommissioning, with documentation to support confidentiality and proper handling.</li>'
                     . '</ul>',
        ],
        [
            'title' => 'Project management, permitting, and program control',
            'html'  => '<ul>'
                     . '<li>Inventory &amp; project management where rigging experts and project managers support each phase; managers handle planning, permitting, and construction and can meet client-dictated update cadences.</li>'
                     . '<li>CAD &amp; permitting support, including soft sketches/CADs for design and landlord verification, plus site plans, CDs, licensing requirements, and A/E documentation to deliver complete permit packages for larger programs.</li>'
                     . '</ul>',
        ],
        [
            'title' => 'Logistics & deployment support',
            'html'  => '<p>End-to-end logistics coordination, including equipment transportation and construction crew resources, plus truckload transportation, nationwide warehousing, inventory management, local distribution, reverse logistics, staging facilities, kitting, rigging services, and equipment disposal.</p>',
        ],
        [
            'title' => 'Response & remediation',
            'html'  => '<p>Vandalism response &amp; remediation with teams available 24/7 to respond after attacks, supporting board-ups, debris removal, site cleanup, electrical termination, and detailed photos of the incident.</p>',
        ],
    ],
];

$confidence = [
    'eyebrow' => 'expertise',
    'image'   => $uploads . '2026/03/atm-1280-336-3.jpg',
    'alt'     => 'A hand reaches toward the keypad of a banking ATM, preparing to enter a PIN, with the card slot and receipt dispenser visible.',
    'title'   => 'Confidence With McCollister’s',
    'paras'   => [
        'ATM installations sit at the intersection of construction, compliance, logistics, and customer experience. When those disciplines are fragmented—or treated as secondary—the risk shows up later as delays, rework, audit exposure, or dissatisfied end clients.',
        'McCollister’s Installation Services is built to prevent those outcomes.',
        'With decades of experience supporting financial institutions and OEM partners, McCollister’s approaches ATM deployments with the same rigor applied to other mission-critical infrastructure projects. Each engagement is managed by tenured professionals who understand regulatory environments, field-level realities, and the operational pressure to deliver consistent results across locations.',
        'Clients trust McCollister’s because the work is planned deliberately, communicated clearly, and executed professionally, from early site evaluation through final activation. That discipline reduces surprises, shortens timelines, and creates documentation and outcomes that stand up to internal review, client scrutiny, and regulatory oversight.',
        'For organizations that can’t afford missteps, McCollister’s offers something more valuable than speed or cost alone: confidence that the job will be done right, the first time, by a partner who understands what’s at stake.',
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Finance & Banking',
    'items'   => [
        [
            'q' => 'What types of ATM installations does McCollister’s support?',
            'a' => '<p>McCollister’s supports through-the-wall (TTW) ATMs, drive-through/island construction, and free-standing lobby ATM kiosks, including challenging rigging and installations aligned to customer QC and compliance standards.</p>',
        ],
        [
            'q' => 'Will I have a dedicated project manager and consistent updates?',
            'a' => '<p>Yes. McCollister’s project managers and rigging experts work with customers through each project phase; managers are responsible for planning, permitting, and construction and can meet client-dictated update cadences.</p>',
        ],
        [
            'q' => 'How do you address ADA compliance risk?',
            'a' => '<p>McCollister’s verifies ATM installations for ADA compliance, including required height, wheelchair access, and access pathways, helping reduce exposure to alleged violations.</p>',
        ],
        [
            'q' => 'Can you support multi-site deployments?',
            'a' => '<p>Yes. McCollister’s is an all-in-one source for programmatic deployment and installation and provides logistics support that includes nationwide warehousing, staging, distribution, reverse logistics, and disposal—helpful for repeat deployments across multiple locations.</p>',
        ],
        [
            'q' => 'Do you support decommissioning or certified destruction?',
            'a' => '<p>Yes. McCollister’s offers PCI destruction &amp; NPI decommissioning services and can provide documentation supporting confidentiality and proper handling.</p>',
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

    <!-- Brand logos (auto-scrolling marquee; pauses on hover) -->
    <section class="svc-logos svc-logos--lg">
        <div class="svc-logos__track" aria-hidden="true">
            <?php for ($g = 0; $g < 2; $g++) : ?>
                <div class="svc-logos__group">
                    <?php foreach ($logos as $logo) : ?>
                        <img src="<?php echo esc_url($logo['img']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" loading="lazy" decoding="async">
                    <?php endforeach; ?>
                </div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- Our Capabilities (accordion + image) -->
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
            <div class="svc-avcaps__grid svc-avcaps__grid--reverse svc-avcaps__grid--free">
                <div class="svc-avcaps__content">
                    <div class="svc-faqs__list svc-faqs__list--beside" data-accordion>
                        <?php foreach ($capabilities['items'] as $i => $item) : ?>
                            <details class="svc-faq"<?php echo 0 === $i ? ' open' : ''; ?>>
                                <summary class="svc-faq__summary">
                                    <span class="svc-faq__q"><?php echo esc_html($item['title']); ?></span>
                                    <span class="svc-faq__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                </summary>
                                <div class="svc-faq__panel">
                                    <?php echo wp_kses($item['html'], ['p' => [], 'ul' => [], 'li' => [], 'strong' => []]); ?>
                                </div>
                            </details>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="svc-avcaps__media svc-avcaps__media--cap700">
                    <img src="<?php echo esc_url($capabilities['image']); ?>" alt="<?php echo esc_attr($capabilities['alt']); ?>" loading="lazy" decoding="async">
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
