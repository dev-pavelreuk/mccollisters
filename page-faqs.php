<?php
/**
 * Template Name: Page — FAQs (General Questions)
 *
 * Hard-coded FAQs page (slug: faqs). The General Questions accordion sits beside
 * a "By Industry" list; selecting an industry opens a modal with that industry's
 * FAQ accordion plus Download (PDF) and Print actions. Industry FAQ content is
 * shared from inc/faq-data.php (mcc_industry_faqs), so it stays in sync with the
 * service pages. Reuses the [data-accordion] FAQ component, svc-integrated, and
 * cta-cards.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);

// Diagonal arrow (down-right closed → up-right open handled by CSS rotation).
$faq_arrow  = '<svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$dl_icon    = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$print_icon = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9V3h12v6M6 18H4a1 1 0 0 1-1-1v-5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5a1 1 0 0 1-1 1h-2M6 14h12v7H6z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';

$faq_kses = [
    'p'      => [],
    'ul'     => [],
    'li'     => [],
    'strong' => [],
    'br'     => [],
    'span'   => [],
    'a'      => ['href' => [], 'target' => [], 'rel' => [], 'aria-label' => []],
];

/* -- Editable content (→ ACF later) --------------------------------------- */

$header = [
    'crumb' => 'faqs',
    'title' => 'General Questions',
];

$general = [
    ['q' => 'How do I get a quote?', 'a' => '<p>To request a quote, click the <strong><a href="' . esc_url(home_url('/contact-us/')) . '" aria-label="Talk to an Expert">Talk to an Expert</a></strong> button on any page to access our intake form. Provide shipment details (origin, destination, dimensions, weight, service type, timeline), and a McCollister’s <strong><a href="' . esc_url(home_url('/logistics/')) . '" aria-label="logistics">logistics</a></strong> specialist will follow up with customized pricing and a tailored solution.</p><p>If you’re an individual or dealer handling auto transport, our easy quote‑to‑book platform offers a faster way to move forward and is available on select auto transport pages.</p>'],
    ['q' => 'What determines pricing?', 'a' => '<p>Pricing is based on:</p><ul><li>Distance and route</li><li>Freight size and weight</li><li>Equipment type</li><li>Service choice (transportation, warehousing, logistics, installation)</li><li>Service level (standard, expedited, white‑glove)</li><li>Handling complexity</li><li>Insurance requirements</li><li>Timeline</li><li>Market conditions</li></ul><p>Every solution is customized for transparency and accuracy.</p>'],
    ['q' => 'How do I track my shipment?', 'a' => '<p>You will receive proactive shipment updates from our logistics team throughout transit. We utilize GPS technology and the Samsara platform to monitor truck positioning and maintain shipment visibility. Select business units may also provide direct tracking links when available.</p>'],
    ['q' => 'What tracking technology do you use?', 'a' => '<p>McCollister’s uses an array of tracking technology to maintain shipment visibility, including:</p><ul><li>SkyBitz asset tracking</li><li>Samsara fleet monitoring</li><li>Real‑time reporting systems</li><li>Integrated communication tools</li></ul>'],
    ['q' => 'What are your billing options?', 'a' => '<p>Billing options include:</p><ul><li>Cash on Delivery (COD)</li><li>Prepaid</li><li>National Account with 30‑day terms (pending credit approval)</li></ul><p>COD is commonly used for single moves, including residential relocations, commercial moves, and personal vehicle transfers.</p><p>National Accounts streamline invoicing across ongoing or repeat shipments. We also support API and EDI digital invoicing integration for seamless billing connectivity.</p>'],
    ['q' => 'What payment methods do you accept?', 'a' => '<p>We accept approved business payment methods outlined in your agreement, including:</p><ul><li>ACH</li><li>Wire transfer</li><li>Certified check</li><li>Major credit cards</li></ul><p>All payments must be processed through official McCollister’s billing channels. Representatives will review payment options prior to booking and recommend the appropriate method based on service type.</p>'],
    ['q' => 'What is your geographic coverage?', 'a' => '<p>McCollister’s delivers nationwide transportation, distribution, and specialized warehousing solutions through:</p><ul><li>15 company‑operated locations</li><li>Client‑designated warehouse facilities</li></ul><p>Through our UniGroup affiliation and a network of 500+ agents, we support coordinated services across the United States and Canada. International service is available based on project scope.</p>'],
    ['q' => 'Where does McCollister’s have locations?', 'a' => '<p>McCollister’s operates a nationwide network of secure, certified, and specialized facilities strategically located across the United States. Our locations support transportation, logistics, and warehousing projects for clients in every region.</p><p>If none of our existing properties meets your requirements, McCollister’s has the capabilities, resources, and expertise to deliver customizable and scalable solutions wherever you need them.</p><p>Our facilities are located in:</p><ul><li>Tracy, California</li><li>Fontana, California</li><li>Orlando, Florida</li><li>Suwanee, Georgia</li><li>West Chicago, Illinois</li><li>Commerce Township, Michigan</li><li>Maryland Heights, Missouri</li><li>Westampton, New Jersey</li><li>Burlington, New Jersey</li><li>Poughkeepsie, New York</li><li>Menands, New York</li><li>Belle Vernon, Pennsylvania</li><li>Coppell, Texas</li><li>Manassas, Virginia</li></ul><p>For a full list of our locations and to find the facility nearest you, visit our <a href="' . esc_url(home_url('/locations/')) . '" aria-label="Locations page"><strong>Locations page</strong></a>.</p>'],
    ['q' => 'What insurance coverage do you carry?', 'a' => '<p>We maintain comprehensive cargo and <a href="' . esc_url(home_url('/forms-certifications-documents/')) . '" aria-label="liability insurance"><strong>liability insurance</strong></a> coverage across transportation, warehousing, and handling operations.</p><p>Coverage limits can be reviewed and adjusted based on shipment value and requirements. Certificates of insurance, additional insured endorsements, and extended coverage options are available upon request and review.</p>'],
    ['q' => 'What is the claims process?', 'a' => '<p>McCollister’s prioritizes shipment protection and risk prevention. In the unlikely event of damage:</p><ul><li>Notify your account representative</li><li>Submit the required claim form</li><li>Provide supporting documentation</li><li>Allow our claims team to inspect, investigate, and resolve the claim promptly</li></ul><p>We are committed to efficient and transparent claims resolution.</p>'],
    ['q' => 'Do you provide dedicated account management?', 'a' => '<p>Yes. Every client is supported by experienced logistics professionals who provide coordination and proactive problem resolution.</p><p>For larger or complex projects, we assemble cross-functional teams to ensure seamless execution and operational oversight.</p>'],
    ['q' => 'Can your services scale with my business?', 'a' => '<p>Yes. Our long‑standing success and diversification are founded on scalable transportation and warehousing solutions that adapt to:</p><ul><li>Business growth</li><li>Seasonal demand</li><li>Project‑based requirements</li></ul>'],
    ['q' => 'Do you provide specialized and mission-critical transportation solutions?', 'a' => '<p>Yes. Backed by our asset‑based fleet and diversified business verticals, McCollister’s delivers high‑touch, specialized logistics solutions for mission‑critical transportation needs.</p><p>Our capabilities include:</p><ul><li>Over‑dimensional and heavy‑haul freight transport</li><li>White‑glove and inside delivery services</li><li>High‑value cargo handling</li><li>Temperature‑controlled shipments</li><li>Project‑based logistics programs</li><li>Mission‑critical transportation</li><li>Enhanced security protocols</li><li>Air‑ride equipment</li><li>Retractable Conestoga trailers</li><li>Flatbed transportation</li><li>Enclosed auto transport</li><li>Open auto transport</li></ul>'],
    ['q' => 'What does your UniGroup affiliation mean?', 'a' => '<p>Our affiliation with UniGroup, United Van Lines, and Mayflower Transit strengthens our national network while maintaining personalized service and operational accountability.</p>'],
    ['q' => 'Do you offer warehousing and distribution services?', 'a' => '<p>Yes. Our warehousing capabilities include:</p><ul><li>Secure warehouse locations</li><li>WMS inventory tracking systems</li><li>Scalable storage solutions</li><li>Cross‑docking</li><li>Inventory management</li><li>Coordinated distribution services</li></ul>'],
    ['q' => 'Are you licensed and compliant?', 'a' => '<p>Yes. McCollister’s maintains all required operating authorities and complies with federal and state regulations, including FMCSA requirements where applicable.</p><p>We proudly maintain an A+ rating with the Better Business Bureau (BBB).</p>'],
    ['q' => 'How do you ensure cargo safety?', 'a' => '<p>Our safety culture includes:</p><ul><li>Skilled drivers trained in proper loading and securement</li><li>Comprehensive cargo insurance</li><li>GPS‑enabled tracking</li><li>Routine inspections</li><li>Emergency response planning</li><li>Ongoing driver training</li></ul>'],
    ['q' => 'How do you maintain quality standards?', 'a' => '<p>We maintain structured regulatory compliance, ongoing staff training, risk management protocols, internal audits, and continuous monitoring to ensure consistent operational excellence.</p>'],
    ['q' => 'What industries does McCollister’s serve?', 'a' => '<p>We serve a broad range of industries requiring specialized and high‑value transportation solutions.</p><p>McCollister’s supports both B2B and B2C clients, including:</p><ul><li>Corporate and industrial supply chains</li><li>Project‑based logistics</li><li>Warehousing and distribution programs</li><li>Residential relocations</li><li>Personal vehicle transport</li></ul>'],
    ['q' => 'What transportation services does McCollister’s offer?', 'a' => '<p>McCollister’s proudly offers the following transportation services:</p><ul><li>Full truckload (FTL)</li><li>Less‑than‑truckload (LTL)</li><li>Expedited freight</li><li>Dry van</li><li>Temperature‑controlled</li><li>Intermodal</li><li>Over‑dimensional</li><li>Air cargo</li><li>Warehousing &amp; cross‑docking</li></ul>'],
    ['q' => 'How do you vet transportation, warehousing, installation, and logistics partners?', 'a' => '<p>To partner with McCollister’s, our providers must meet strict standards for operational practices. All partners must maintain:</p><ul><li>Active operating authority (where applicable)</li><li>Verified insurance</li><li>Acceptable safety ratings</li><li>Ongoing compliance verification</li></ul><p>Our oversight ensures alignment with McCollister’s safety and operational standards.</p>'],
    ['q' => 'Can you manage my entire supply chain?', 'a' => '<p>Yes. We provide integrated transportation, warehousing, and distribution solutions under a coordinated logistics strategy.</p>'],
    ['q' => 'What is McCollister’s approach to sustainability?', 'a' => '<p>Our sustainability efforts include:</p><ul><li>Route optimization</li><li>Fleet efficiency monitoring</li><li>Preventative maintenance</li><li>Fuel performance tracking</li><li>Participation in the EPA SmartWay® Transport Partnership</li></ul><p>For more information on our ESG practices, visit our <a href="' . esc_url(home_url('/esg/')) . '" aria-label="dedicated page"><strong>dedicated page</strong></a>.</p>'],
    ['q' => 'How do you manage service disruptions?', 'a' => '<p>Through GPS visibility, structured contingency planning, and operational oversight, McCollister’s responds quickly to weather events, equipment issues, or capacity shifts to minimize impact and maintain delivery performance.</p>'],
];

$industries = function_exists('mcc_industry_faqs') ? mcc_industry_faqs() : [];

$more = [
    'title' => 'More About<br>McCollister’s',
    'cards' => [
        ['icon' => $uploads . '2026/06/About-Us-Our-Team-i.png', 'title' => 'About Us', 'url' => home_url('/about-us/'), 'text' => 'Learn more about who we are, who we serve, and what we do.'],
        ['icon' => $uploads . '2026/06/Certifications-About-Us-i.png', 'title' => 'Certifications', 'url' => home_url('/forms-certifications-documents/'), 'text' => 'Find important forms, certifications, and helpful guides.'],
        ['icon' => $uploads . '2026/06/Careers-About-Us-i.png', 'title' => 'Careers', 'url' => home_url('/careers/'), 'text' => 'Learn more about working for McCollister’s and view open positions.'],
        ['icon' => $uploads . '2026/06/ESG-Practices-About-Us-i.png', 'title' => 'ESG Practices', 'url' => home_url('/esg/'), 'text' => 'Explore the principles that guide our company and commitment to customers.'],
    ],
];

/**
 * Render one FAQ accordion (<details> list) from [{q,a}] items; first item open.
 */
$render_accordion = static function (array $items) use ($faq_arrow, $faq_kses): void {
    echo '<div class="svc-faqs__list" data-accordion>';
    foreach ($items as $i => $item) {
        echo '<details class="svc-faq"' . (0 === $i ? ' open' : '') . '>';
        echo '<summary class="svc-faq__summary">';
        echo '<span class="svc-faq__q">' . wp_kses($item['q'], []) . '</span>';
        echo '<span class="svc-faq__icon" aria-hidden="true">' . $faq_arrow . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '</summary>';
        echo '<div class="svc-faq__panel">' . wp_kses($item['a'], $faq_kses) . '</div>';
        echo '</details>';
    }
    echo '</div>';
};
?>
<main id="primary" class="site-main">

    <!-- Header -->
    <section class="svc-section hist-head faqs-head">
        <div class="svc-section__inner">
            <p class="hist-head__crumb">/ <?php echo esc_html($header['crumb']); ?> /</p>
            <h1 class="hist-head__title"><?php echo esc_html($header['title']); ?></h1>
        </div>
    </section>

    <!-- General Questions + By Industry -->
    <section class="svc-section faqs-main">
        <div class="svc-section__inner faqs-main__inner">
            <div class="faqs-main__questions">
                <?php $render_accordion($general); ?>
            </div>

            <aside class="faqs-industries" aria-label="FAQs by industry">
                <p class="faqs-industries__label">By Industry</p>
                <ul class="faqs-industries__list">
                    <?php foreach ($industries as $slug => $ind) : ?>
                        <li>
                            <button type="button" class="faqs-industries__link" data-faqs-open="<?php echo esc_attr($slug); ?>">
                                <?php echo esc_html($ind['label']); ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
    </section>

    <!-- More About McCollister's (icon cards) -->
    <section class="svc-section svc-integrated">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $more['title'],
            ]); ?>
            <div class="svc-integrated__grid">
                <?php foreach ($more['cards'] as $card) : ?>
                    <div class="svc-integrated__card">
                        <div class="svc-integrated__icon">
                            <img src="<?php echo esc_url($card['icon']); ?>" alt="" loading="lazy" decoding="async">
                        </div>
                        <h3 class="svc-integrated__title">
                            <a href="<?php echo esc_url($card['url']); ?>"><?php echo esc_html($card['title']); ?></a>
                        </h3>
                        <p class="svc-integrated__text"><?php echo esc_html($card['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA cards -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

    <!-- Industry FAQ templates (cloned into the modal on demand) -->
    <?php foreach ($industries as $slug => $ind) : ?>
        <template data-faqs-tpl="<?php echo esc_attr($slug); ?>"
                  data-title="<?php echo esc_attr($ind['label'] . ' FAQs'); ?>"
                  data-pdf="<?php echo esc_url($uploads . '2026/05/' . $ind['pdf']); ?>">
            <?php $render_accordion($ind['items']); ?>
        </template>
    <?php endforeach; ?>

    <!-- Industry FAQ modal -->
    <div class="faqs-modal" id="faqs-modal" hidden>
        <div class="faqs-modal__overlay" data-faqs-close></div>
        <div class="faqs-modal__box" role="dialog" aria-modal="true" aria-labelledby="faqs-modal-title">
            <div class="faqs-modal__head">
                <h2 class="faqs-modal__title" id="faqs-modal-title" data-faqs-title></h2>
                <div class="faqs-modal__actions">
                    <a class="faqs-modal__action" data-faqs-download href="#" target="_blank" rel="noopener" download>
                        <span class="faqs-modal__action-icon"><?php echo $dl_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>Download
                    </a>
                    <button type="button" class="faqs-modal__action" data-faqs-print>
                        <span class="faqs-modal__action-icon"><?php echo $print_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>Print
                    </button>
                    <button type="button" class="faqs-modal__close" data-faqs-close aria-label="Close">&times;</button>
                </div>
            </div>
            <div class="faqs-modal__body" data-faqs-body></div>
        </div>
    </div>

    <script>
        (function () {
            var modal = document.getElementById('faqs-modal');
            if (!modal) { return; }
            var body = modal.querySelector('[data-faqs-body]');
            var titleEl = modal.querySelector('[data-faqs-title]');
            var dlEl = modal.querySelector('[data-faqs-download]');

            function openModal(slug) {
                var tpl = document.querySelector('[data-faqs-tpl="' + slug + '"]');
                if (!tpl) { return; }
                body.innerHTML = '';
                body.appendChild(tpl.content.cloneNode(true));
                titleEl.textContent = tpl.getAttribute('data-title');
                dlEl.setAttribute('href', tpl.getAttribute('data-pdf'));
                // Smooth height-animated, single-open accordion (same as the page).
                if (window.mccInitAccordions) { window.mccInitAccordions(body); }
                modal.hidden = false;
                document.body.style.overflow = 'hidden';
            }
            function closeModal() {
                modal.hidden = true;
                body.innerHTML = '';
                document.body.style.overflow = '';
            }

            document.querySelectorAll('[data-faqs-open]').forEach(function (btn) {
                btn.addEventListener('click', function () { openModal(btn.getAttribute('data-faqs-open')); });
            });
            modal.querySelectorAll('[data-faqs-close]').forEach(function (el) {
                el.addEventListener('click', closeModal);
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !modal.hidden) { closeModal(); }
            });

            var printBtn = modal.querySelector('[data-faqs-print]');
            if (printBtn) {
                printBtn.addEventListener('click', function () {
                    // Open every answer so the print captures the full FAQ.
                    body.querySelectorAll('details').forEach(function (d) { d.open = true; });
                    document.body.classList.add('faqs-printing');
                    window.print();
                    document.body.classList.remove('faqs-printing');
                });
            }
        })();
    </script>

</main>
<?php get_footer(); ?>
