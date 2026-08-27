<?php
/**
 * Template Name: Service Page — Warehousing
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
$arrow    = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$arrow_dr = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6 18 18M18 9V18H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check    = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 10 17.5 19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/03/mccollisters-warehousing-fulfillment.jpg',
    'title'    => 'Warehousing',
    'subtitle' => 'Secure, scalable warehousing, distribution & fulfillment solutions for your business',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/blog/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'An Extension Of<br>Your Team, From<br>Dock To Doorstep',
    'lead'    => 'For today’s businesses, traditional warehousing models no longer suit their supply chains. Modern companies demand innovative and dynamic facilities, designed with real-time visibility, efficiency, and flexibility in mind.',
    'paras'   => [
        'At McCollister’s, there is no-one-size-fits-all philosophy. We work with you to build the logistics solution that makes the most sense for you and your company. Whether you require a turnkey solution or want to plug a few of our services into your existing workflow, we can streamline your operations and give you peace of mind.',
        'From e-commerce pick and pack and on-demand order fulfillment to white glove distribution of high-value product, McCollister’s provides specialized logistics solutions to meet the moment—and your supply chain needs.',
    ],
];

$capabilities = [
    'title' => 'Our Capabilities',
    'cards' => [
        [
            'variant' => 'light',
            'title'   => 'Warehousing',
            'text'    => 'Cost-effective, secure storage solutions designed to scale with your business, supported by best-in-class supply chain visibility.',
        ],
        [
            'variant' => 'dark',
            'image'   => $uploads . '2026/03/truck-bucket5.jpg',
            'title'   => 'Distribution',
            'text'    => 'Flexible distribution services including cross-docking, inventory management, and asset recovery—whether or not you warehouse with us.',
        ],
        [
            'variant' => 'blue',
            'title'   => 'Fulfillment',
            'text'    => 'End-to-end fulfillment handled as an extension of your brand, allowing you to focus on growth while we manage execution.',
        ],
    ],
];

$services = [
    'title'   => 'Our Services',
    'intro'   => 'We offer a full suite of customizable supply chain services. As part of McCollister’s nationwide logistics network, we also provide access to specialized transportation services to ensure your materials arrive at our warehouses and their final destinations safely and timely. End-to-end and turnkey solutions are available, as well as mix and match packages.',
    'columns' => [
        [
            'head'  => 'Fulfillment &amp; Order <br>Services',
            'items' => ['Fulfillment and order management', 'Pick and pack', 'Returns processing', 'Reverse logistics'],
        ],
        [
            'head'  => 'Warehouse &amp; Distribution <br>Operations',
            'items' => ['Container devanning', 'Cross-docking', 'Returns processing', 'Reverse logistics'],
        ],
        [
            'head'  => 'Value-Added &amp; Specialized <br>Services',
            'items' => ['Labeling and kitting', 'Advanced staging', 'On-site assembly and distribution', 'Palletizing and repalletizing', 'Asset recovery'],
        ],
        [
            'head'  => 'Technology &amp; Software <br>Integration',
            'items' => ['API connectors to eCommerce platforms', 'EDI connectors to trading partners'],
        ],
    ],
];

$features = [
    'image' => $uploads . '2026/03/warehouse-racks.jpg',
    'title' => 'Warehouse features',
    'text'  => 'The right warehouse features do more than support daily operations, they protect your inventory, reduce risk, and keep your supply chain moving without disruption. From security and access controls to flexible layouts and temperature management, these capabilities ensure your products are handled safely, efficiently, and in a way that scales with your business needs.',
    'items' => [
        'Strategically located facilities across the United States for faster, more efficient distribution',
        'Controlled facility access with centrally monitored security and fire protection systems',
        'Flexible short- and long-term storage options, including multi-client and dedicated space',
        'Racked, bulk, and open-floor configurations designed for efficient space utilization',
        'Modern material-handling equipment suitable for fragile, oversized, or high-value goods',
        'Truck-high docks with dock levelers and drive-up ramps for streamlined inbound/outbound',
        'Temperature-controlled environments to protect sensitive or regulated products',
    ],
];

$wms = [
    'title'    => 'McCollister’s warehouse management system',
    'text'     => 'McCollister’s delivers real-time supply chain visibility through a proprietary warehouse management system (WMS), powered by <strong>Infios</strong>. The system centralizes inventory, orders, and reporting in a single, secure platform, giving customers greater control, accuracy, and confidence across their warehousing and fulfillment operations.',
    'label'    => 'WMS Benefits Include:',
    // Rendered column-first: first six fill the left column, last six the right.
    'benefits' => [
        'Configurable workflows aligned to customer-specific SOWs and SOPs',
        'Flexible system setup tailored to unique operational requirements',
        'Web-based access to inventory data 24/7/365',
        'Multiple inventory tracking methods for accurate identification',
        'Real-time visibility into inventory movement and status',
        'Scalable system architecture that grows with your business',
        'Automated inventory reports delivered on a scheduled basis',
        'Same-day fulfillment requests submitted directly through the system',
        'EDI and secure file transfer to streamline data exchange',
        'Built-in quality processes that support consistent execution',
        'Secure customer logins for reports, inventory, and service orders',
        'Multi-location support with a single system of record',
    ],
];

$certs = [
    'title' => 'Our Certifications',
    'intro' => 'As regulatory requirements tighten and customer expectations increase, partnering with a warehousing provider that offers certified facilities not only helps ensure compliance but also boosts your credibility. Depending on the location, our warehouses have the following certifications:',
    'items' => [
        [
            'logo'    => get_stylesheet_directory_uri() . '/assets/img/iso-13485-medical.svg',
            'alt'     => 'ISO 13485:2016 certified',
            'url'     => 'https://www.iso.org/iso-13485-medical-devices.html',
            'caption' => 'Supports compliant storage and handling of regulated medical devices.',
        ],
        [
            'logo'    => $uploads . '2026/02/ctpat-blk.svg',
            'alt'     => 'CTPAT certified',
            'url'     => 'https://www.cbp.gov/border-security/ports-entry/cargo-security/CTPAT',
            'caption' => 'Enhances international supply chain security and customs efficiency.',
        ],
        [
            'logo'    => $uploads . '2026/03/fda.svg',
            'alt'     => 'FDA registered',
            'url'     => 'https://www.fda.gov/',
            'caption' => '(Tracy, CA) Approved for food, beverage, pharmaceutical & supplement logistics.',
        ],
        [
            'badge'   => 'State-Licensed<br>Medical Distribution',
            'caption' => 'Reduces regulatory burden across complex state requirements.',
        ],
    ],
];

$expertise = [
    'eyebrow' => 'expertise',
    'title'   => 'Confidence With<br>McCollister’s',
    'lead'    => 'Confidence comes from working with a logistics partner that understands complexity, manages risk, and delivers consistent execution across specialized supply chain needs. McCollister’s combines deep operational expertise with proven processes to support industries and services that demand precision, accountability, and adaptability. From highly specialized verticals to complex reverse logistics programs, our experience helps customers move forward with clarity and control.',
    'button'  => ['label' => 'Talk to an Expert', 'url' => home_url('/talk-to-an-expert/')],
    'tabs'    => [
        [
            'label' => 'Asset Recovery',
            'slug'  => 'asset-recovery',
            'image' => $uploads . '2026/03/warehousing-asset-recovery.jpg',
            'title' => 'Asset Recovery',
            'paras' => [
                'McCollister’s is an industry leader in reverse logistics, delivering asset recovery, returns management, and product disposition services through a dedicated asset return center. We manage complex, multi-step workflows—from individual returns to large portfolios—coordinating with field teams, call centers, and end users to ensure accurate, consistent execution.',
                'Services include staging and kitting, inspection and damage assessment, secure data wiping, and consolidated or direct return shipments. This structured approach helps clients maintain control, ensure compliance, reduce risk, and improve efficiency while driving better visibility across reverse supply chain operations.',
            ],
        ],
        [
            'label' => 'E-Waste Recycling',
            'slug'  => 'e-waste-recycling',
            'image' => $uploads . '2026/03/mccollisters-e-waste-phones.jpg',
            'title' => 'E-Waste Recycling',
            'paras' => [
                'McCollister’s provides secure, compliant handling of end-of-life electronics, managing collection, transport, and responsible disposition across single sites and multi-location programs. Our processes protect sensitive data and keep regulated material out of the waste stream.',
                'From secure data destruction and asset tracking to certified recycling and reporting, we help clients meet environmental and compliance obligations while recovering value wherever possible.',
            ],
        ],
        [
            'label' => 'Medical Devices',
            'slug'  => 'medical-devices',
            'image' => $uploads . '2026/03/warehousing-medical-devices.jpg',
            'title' => 'Medical Devices',
            'paras' => [
                'McCollister’s supports medical device manufacturers and distributors with storage, handling, and distribution built for regulated, high-value product. Our ISO 13485–aligned facilities and trained teams maintain the traceability and controls this industry demands.',
                'From inbound inspection and controlled storage to kitting, returns, and final-mile delivery, we manage each step with the documentation and accountability required for compliant device logistics.',
            ],
        ],
        [
            'label' => 'Solar Experts',
            'slug'  => 'solar',
            'image' => $uploads . '2026/03/mccollisters-solar-experts.jpg',
            'title' => 'Solar Experts',
            'paras' => [
                'McCollister’s delivers specialized logistics for the solar industry, handling panels, inverters, and balance-of-system components that are oversized, fragile, and time-sensitive. We coordinate transport, staging, and site delivery to keep installations on schedule.',
                'From warehousing and inventory management to project-based staging and final-mile coordination, our teams support solar developers and EPC partners with the precision these projects require.',
            ],
        ],
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Warehousing',
    'items'   => [
        [
            'q' => 'What are the risks associated with improper warehousing?',
            'a' => '<p>Operational risks include, but are not limited to, fire hazards from overcrowded storage, inventory damage, reduced productivity from inefficient layouts, and potential regulatory fines for non-compliance with safety standards.</p>',
        ],
        [
            'q' => 'What are the key functions of a warehouse?',
            'a' => '<p>Modern warehouses play a critical role in keeping supply chains efficient, flexible, and responsive. Core warehouse functions include:</p>'
                 . '<ul>'
                 . '<li><strong>Receiving:</strong> Incoming shipments are carefully received, inspected, and documented to ensure accuracy and product integrity from the moment goods arrive.</li>'
                 . '<li><strong>Storage:</strong> Inventory is strategically organized and maintained to support easy access, scalability, and efficient space utilization.</li>'
                 . '<li><strong>Order Picking:</strong> Products are accurately selected from inventory based on order requirements, supporting fast, reliable fulfillment.</li>'
                 . '<li><strong>Inventory Management:</strong> Real-time tracking and reporting help maintain optimal inventory levels, reducing excess stock while preventing shortages.</li>'
                 . '<li><strong>Value-Added Services:</strong> Many warehouses offer customized services such as kitting, labeling, or light assembly to support unique operational and customer needs.</li>'
                 . '</ul>'
                 . '<p>Together, these capabilities work seamlessly to improve operational efficiency, enhance visibility, and support the smooth, reliable movement of freight across the supply chain.</p>',
        ],
        [
            'q' => 'How can efficient warehousing support my overall logistics operations?',
            'a' => '<p>Efficient warehousing is essential for your logistics operations to be balanced, responsive, and cost-effective. By optimizing inventory levels, warehouses help companies align supply with customer demand while avoiding excess stock or shortages.</p>'
                 . '<p>Real-time inventory visibility supports better forecasting and planning, while well-positioned inventory enables fast, accurate order fulfillment. These capabilities also support just-in-time (JIT) strategies, helping reduce carrying costs without sacrificing service levels.</p>'
                 . '<p>Advanced practices such as cross-docking and transloading further improve efficiency by moving goods quickly from inbound to outbound transportation. Combined, integrated warehousing and logistics operations support a more agile, reliable supply chain.</p>',
        ],
        [
            'q' => 'What is a 3PL warehouse?',
            'a' => '<p>A 3PL (third-party logistics) warehouse is a facility managed by an external provider that handles warehousing, inventory management, and order fulfillment for other companies. These warehouses specialize in receiving inventory, storing it, and picking, packing, and shipping orders to customers, allowing businesses to outsource logistics.</p>',
        ],
        [
            'q' => 'Is third-party logistics the same as drop shipping? What’s the difference?',
            'a' => '<p>No, they are different things. Drop shipping is a low-cost, inventory-free model where suppliers ship directly to customers, offering lower margins and less control. Third-party logistics, on the other hand, involves outsourcing inventory storage, packing, and shipping to a partner, providing higher control, faster delivery, and better branding, but requires purchasing stock upfront.</p>',
        ],
    ],
];
?>
<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="svc-hero" style="background-image: url('<?php echo esc_url($hero['image']); ?>'); background-position: bottom center;">
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
                <p class="svc-prose__lead"><?php echo esc_html($overview['lead']); ?></p>
                <?php foreach ($overview['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Our Capabilities -->
    <section class="svc-section svc-caps">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $capabilities['title'],
            ]); ?>
            <div class="svc-caps__grid">
                <?php foreach ($capabilities['cards'] as $card) : ?>
                    <?php
                    $mcc_style = '';
                    if ($card['variant'] === 'dark' && !empty($card['image'])) {
                        $mcc_style = " style=\"background-image: url('" . esc_url($card['image']) . "');\"";
                    }
                    ?>
                    <div class="svc-caps__card svc-caps__card--<?php echo esc_attr($card['variant']); ?>"<?php echo $mcc_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from esc_url above. ?>>
                        <h3 class="svc-caps__title"><?php echo esc_html($card['title']); ?></h3>
                        <span class="svc-caps__rule" aria-hidden="true"></span>
                        <p class="svc-caps__text"><?php echo esc_html($card['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Our Services -->
    <section class="svc-section svc-services">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $services['title'],
            ]); ?>
            <p class="svc-services__intro"><?php echo esc_html($services['intro']); ?></p>
            <div class="svc-services__grid">
                <?php foreach ($services['columns'] as $col) : ?>
                    <div class="svc-services__col">
                        <h3 class="svc-services__head"><?php echo wp_kses($col['head'], ['br' => []]); ?></h3>
                        <ul class="svc-services__list">
                            <?php foreach ($col['items'] as $item) : ?>
                                <li><?php echo esc_html($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Warehouse features -->
    <section class="svc-section svc-features">
        <div class="svc-section__inner">
            <div class="svc-features__grid">
                <div class="svc-features__media">
                    <img src="<?php echo esc_url($features['image']); ?>" alt="" loading="lazy" decoding="async">
                </div>
                <div class="svc-features__body">
                    <h2 class="svc-features__title"><?php echo esc_html($features['title']); ?></h2>
                    <p class="svc-features__text"><?php echo esc_html($features['text']); ?></p>
                    <ul class="svc-features__list">
                        <?php foreach ($features['items'] as $item) : ?>
                            <li>
                                <span class="svc-features__marker" aria-hidden="true"><?php echo $arrow_dr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Warehouse management system -->
    <section class="svc-section svc-wms">
        <div class="svc-section__inner">
            <h2 class="svc-wms__title"><?php echo esc_html($wms['title']); ?></h2>
            <p class="svc-wms__text"><?php echo wp_kses($wms['text'], ['strong' => []]); ?></p>
            <p class="svc-wms__label"><?php echo esc_html($wms['label']); ?></p>
            <ul class="svc-wms__benefits">
                <?php foreach ($wms['benefits'] as $benefit) : ?>
                    <li>
                        <span class="svc-wms__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <span><?php echo esc_html($benefit); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- Our Certifications -->
    <section class="svc-section svc-certs">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $certs['title'],
            ]); ?>
            <p class="svc-certs__intro"><?php echo esc_html($certs['intro']); ?></p>
            <div class="svc-certs__grid">
                <?php foreach ($certs['items'] as $cert) : ?>
                    <div class="svc-certs__item">
                        <div class="svc-certs__logo">
                            <?php if (!empty($cert['badge'])) : ?>
                                <span class="svc-certs__badge"><?php echo wp_kses($cert['badge'], ['br' => []]); ?></span>
                            <?php elseif (!empty($cert['url'])) : ?>
                                <a class="svc-certs__link" href="<?php echo esc_url($cert['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($cert['alt']); ?>">
                                    <img src="<?php echo esc_url($cert['logo']); ?>" alt="<?php echo esc_attr($cert['alt']); ?>" loading="lazy" decoding="async">
                                </a>
                            <?php else : ?>
                                <img src="<?php echo esc_url($cert['logo']); ?>" alt="<?php echo esc_attr($cert['alt']); ?>" loading="lazy" decoding="async">
                            <?php endif; ?>
                        </div>
                        <p class="svc-certs__caption"><?php echo esc_html($cert['caption']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Expertise (dark) with tabs -->
    <section class="svc-expertise svc-expertise--tabs">
        <div class="svc-expertise__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $expertise['eyebrow'],
                'title'   => $expertise['title'],
                'lead'    => $expertise['lead'],
                'light'   => true,
            ]); ?>

            <div class="svc-tabs svc-tabs--dark" data-tabs>
                <div class="svc-tabs__nav" role="tablist">
                    <?php foreach ($expertise['tabs'] as $i => $tab) : ?>
                        <button
                            type="button"
                            class="svc-tabs__tab<?php echo $i === 0 ? ' is-active' : ''; ?>"
                            role="tab"
                            data-tabs-tab="<?php echo esc_attr($i); ?>"
                            <?php // No id= for the anchor: an id would make this focusable button the
                            // fragment target and show a focus ring. JS matches the hash to
                            // data-tab-anchor and scrolls, so no id is needed. ?>
                            <?php if (!empty($tab['slug'])) : ?>data-tab-anchor="<?php echo esc_attr($tab['slug']); ?>"<?php endif; ?>
                            style="--tab-i: <?php echo esc_attr($i); ?>"
                            aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                        >
                            <span class="svc-tabs__tab-label"><?php echo esc_html($tab['label']); ?></span>
                            <span class="svc-tabs__tab-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($expertise['tabs'] as $i => $tab) : ?>
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
                            <div class="svc-tabs__prose">
                                <?php foreach ($tab['paras'] as $p) : ?>
                                    <p><?php echo esc_html($p); ?></p>
                                <?php endforeach; ?>
                            </div>
                            <a class="mcc-btn svc-tabs__cta" href="<?php echo esc_url($expertise['button']['url']); ?>">
                                <span class="mcc-btn__label"><?php echo esc_html($expertise['button']['label']); ?></span>
                                <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                            </a>
                        </div>
                    </div>
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
