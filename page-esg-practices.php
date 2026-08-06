<?php
/**
 * Template Name: Page — ESG Practices
 *
 * Hard-coded ESG Practices page (slug: esg-practices). Editable content lives in
 * the variables up top so it can later map to ACF. Reuses the global components
 * (svc-hero, section-head, the [data-accordion] FAQ list, svc-integrated,
 * cta-cards) plus a blue statement band.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/03/mccollisters-transportation-network.jpg',
    'title'    => 'ESG Practices',
    'subtitle' => 'Our environmental, social, and governance commitment',
    'buttons'  => [
        ['label' => 'History', 'url' => home_url('/history/')],
        ['label' => 'About Us', 'url' => home_url('/about-us/')],
    ],
];

$policies = [
    'eyebrow' => 'policies',
    'lead'    => 'At McCollister’s, environmental stewardship, social responsibility, and strong governance are integral to how we operate as a nationwide transportation and logistics provider. Guided by our family values and long-term business outlook, our ESG approach is overseen by leadership and embedded across the organization to support sustainable growth, operational excellence, and positive community impact.',
    'paras'   => [
        'Our inaugural ESG assessment was led by our executive team and informed by widely recognized ESG frameworks and industry best practices. This process helped identify the ESG topics most relevant to our operations and stakeholders, ensuring alignment with our corporate values and objectives.',
        'Based on this assessment, we identified the following ESG topics as integral to our operations:',
    ],
    'items'   => [
        [
            'open' => true,
            'title' => 'Environmental Responsibility',
            'content' => '<p>As a leader in specialized transportation and logistics services, McCollister’s recognizes the importance of minimizing the environmental impact of our operations while delivering efficient and reliable service.</p><p>We actively manage our environmental responsibilities through effective oversight, operational efficiency, and continuous facility improvements. Our environmental management systems are aligned with ISO 14000 standards, supporting responsible resource use and regulatory compliance.</p>',
        ],
        [
            'title' => 'Environmental Performance Highlights',
            'content' => '<ul><li>18% year-over-year reduction in supply chain emissions</li><li>Reduction of 7.5 million empty miles</li><li>Reduction of over 13,000 metric tons of CO₂ emissions</li><li>Reduction of approximately 1.5 million gallons of diesel fuel consumption</li></ul>',
        ],
        [
            'title' => 'Environmental Initiatives',
            'content' => '<ul><li><strong>Operational Efficiency:</strong> Use of modern equipment, fuel-efficient tires, low-carbon diesel fuels, route optimization technology, paperless systems, and participation in the SmartWay® program</li><li><strong>Fleet Optimization:</strong> Investment in compliant tractors and diverse equipment to improve fuel efficiency and reduce emissions</li><li><strong>Facility Upgrades:</strong> Implementation of energy-efficient lighting, fans, appliances, and HVAC improvements across facilities</li></ul><p>Through these initiatives, McCollister’s continues to reduce its environmental footprint while enhancing operational performance.</p>',
        ],
        [
            'title' => 'Talent Development &amp; Workforce Engagement',
            'content' => '<p>Our people are the foundation of McCollister’s success. We are committed to providing a safe, inclusive, and supportive work environment that promotes professional growth, innovation, and well-being.</p><p>We invest in ongoing training and development to empower employees to deliver innovative, customer-focused solutions. Recruitment and retention remain central priorities, supported by competitive benefits and development opportunities.</p><p><strong>Employee benefits include:</strong></p><ul><li>Medical, vision, and dental insurance</li><li>Life insurance and long-term disability coverage</li><li>401(k) retirement plan</li><li>Paid time off and paid holidays</li><li>Jury duty compensation</li></ul>',
        ],
        [
            'title' => 'Diversity &amp; Inclusion',
            'content' => '<p>McCollister’s is committed to fostering diversity and inclusion through hiring and recruitment practices that encourage participation from all communities. Our workforce reflects this commitment, with 43.6% staff diversity.</p>',
        ],
        [
            'title' => 'Driver Working Conditions &amp; Safety',
            'content' => '<p>Safety is a core value at McCollister’s. We prioritize safe working and traveling environments through training, technology, and proactive risk prevention.</p><p><strong>Key safety practices include:</strong></p><ul><li>Regular site inspections and corporate-wide audits</li><li>Compliance with all applicable federal, state, and local regulations</li><li>Investment in advanced safety technologies such as collision avoidance systems, lane departure warnings, adaptive braking, electronic logging devices (ELDs), and speed-governing systems</li><li>Comprehensive onboarding requirements, including background checks, drug and alcohol screening, and safety training</li><li>Ongoing education covers topics such as defensive driving, load securement, hazardous materials handling, workplace safety, and incident reporting.</li></ul>',
        ],
        [
            'title' => 'Governance &amp; Business Ethics',
            'content' => '<p>Strong governance and ethical business practices are essential to McCollister’s long-term success and ESG commitments. Our governance framework is guided by executive leadership and supported by an advisory board that includes external members.</p>',
        ],
        [
            'title' => 'Governance Principles',
            'content' => '<ul><li>Integrity, accountability, and transparency</li><li>Responsible risk management aligned with corporate goals</li><li>Clear oversight of ESG priorities and compliance programs</li></ul>',
        ],
        [
            'title' => 'Risk Management &amp; Compliance',
            'content' => '<p>We take a proactive approach to managing risk across our operations. Our compliance programs address:</p><ul><li>Business ethics and code of conduct</li><li>Privacy and data protection</li><li>Disclosure practices</li><li>Protection and responsible use of company assets</li><li>Child labor and forced labor prevention</li></ul>',
        ],
        [
            'title' => 'Cybersecurity &amp; Data Protection',
            'content' => '<p>Protecting information is critical to our operations and customer trust. McCollister’s employs multilayered security technologies, strict protocols, and incident response procedures to safeguard data. Our cloud-first approach emphasizes encryption-based solutions and continuous system assessments to maintain high standards of information security.</p>',
        ],
        [
            'title' => 'Giving Back to Our Communities',
            'content' => '<p>Community involvement has been central to McCollister’s identity since 1945. As we have grown nationally, we remain committed to supporting the communities where we live and work. Through charitable contributions and community engagement, we give back to organizations that support healthcare, education, public safety, and community well-being.</p>',
        ],
    ],
];

// Desktop breaks after "to" and "the"; mobile wraps naturally (.esg-br hidden).
$statement = 'Our approach reflects our commitment to<br class="esg-br"> responsible operations, our people, and the<br class="esg-br"> communities we serve — today and for generations.';

$more = [
    'title' => 'More About<br>McCollister’s',
    'cards' => [
        [
            'icon'  => $uploads . '2026/06/Our-History-About-Us-i.png',
            'title' => 'Our History',
            'url'   => home_url('/history/'),
            'text'  => 'Discover how we became the McCollister’s we are today.',
        ],
        [
            'icon'  => $uploads . '2026/06/About-Us-Our-Team-i.png',
            'title' => 'About Us',
            'url'   => home_url('/about-us/'),
            'text'  => 'Learn more about who we are, who we serve, and what we do.',
        ],
        [
            'icon'  => $uploads . '2026/06/Certifications-About-Us-i.png',
            'title' => 'Certifications',
            'url'   => home_url('/forms-certifications-documents/'),
            'text'  => 'Find important forms, certifications, and helpful guides.',
        ],
        [
            'icon'  => $uploads . '2026/06/Careers-About-Us-i.png',
            'title' => 'Careers',
            'url'   => home_url('/careers/'),
            'text'  => 'Learn more about working for McCollister’s and view open positions.',
        ],
    ],
];

$policy_kses = ['p' => [], 'ul' => [], 'li' => [], 'strong' => []];
?>
<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="svc-hero svc-hero--esg" style="background-image: url('<?php echo esc_url($hero['image']); ?>');">
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

    <!-- Policies: intro + accordion -->
    <section class="svc-section esg-policies">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $policies['eyebrow'],
            ]); ?>
            <div class="esg-intro">
                <p class="esg-intro__lead"><?php echo esc_html($policies['lead']); ?></p>
                <?php foreach ($policies['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <div class="svc-faqs__list esg-policies__list" data-accordion>
                <?php foreach ($policies['items'] as $item) : ?>
                    <details class="svc-faq"<?php echo !empty($item['open']) ? ' open' : ''; ?>>
                        <summary class="svc-faq__summary">
                            <span class="svc-faq__q"><?php echo wp_kses($item['title'], []); ?></span>
                            <span class="svc-faq__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </summary>
                        <div class="svc-faq__panel">
                            <?php echo wp_kses($item['content'], $policy_kses); ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Statement band -->
    <section class="esg-statement">
        <div class="esg-statement__inner">
            <p class="esg-statement__text"><?php echo wp_kses($statement, ['br' => ['class' => []]]); ?></p>
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

</main>
<?php get_footer(); ?>
