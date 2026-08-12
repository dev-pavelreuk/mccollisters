<?php
/**
 * Template Name: Service Page — OEM Auto Transport
 *
 * Child of Auto Transport (/auto-transport/oems/). Hard-coded; content lives in
 * the variables up top so it can later map to ACF. Mirrors the Dealer Auto
 * Transport page, with OEM content, a "Confidence With McCollister's" partnership
 * section, and a packages-only service-levels block. Reuses the global
 * components and service.css.
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
    'image'    => $uploads . '2026/03/automotive-hero-oem.jpg',
    'title'    => 'OEM Auto Transport',
    'subtitle' => 'Paving the way for smoother finished vehicle transport',
    'buttons'  => [
        ['label' => 'Dealers', 'url' => home_url('/auto-transport/dealers/')],
        ['label' => 'Individuals', 'url' => home_url('/auto-transport/individuals/')],
    ],
];

$features = [
    ['icon' => $uploads . '2026/06/shield.png',      'title' => 'A++ Rated Insurance',        'sub' => 'Move forward with confidence'],
    ['icon' => $uploads . '2026/06/truck-phone.png', 'title' => 'Real-Time Vehicle Tracking', 'sub' => 'Full visibility, every mile'],
    ['icon' => $uploads . '2026/06/heart.png',       'title' => 'Dedicated Account Manager',  'sub' => 'One contact, zero runaround'],
    ['icon' => $uploads . '2026/06/ribbon.png',      'title' => '80 Years in Business',       'sub' => 'Unmatched industry knowledge'],
    ['icon' => $uploads . '2026/06/target.png',      'title' => 'Precision Handling',         'sub' => 'Every detail done right'],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Navigating The<br>Current Landscape',
    'paras'   => [
        'The volatile nature of the auto industry is no longer a trend; it’s business as usual. Supply chain instability, global uncertainty, and progressively strict environmental regulations remain sources of frustration. Concurrently, customer expectations are rising. OEMs are under pressure to move vehicles faster and quickly adapt to new trends. In a market this dynamic, what can you do to make sure your vehicles are delivered safely and efficiently, and with minimal headaches?',
        'Your choice of auto transport service can make or break your business. Unreliable and unqualified third-party logistics (3PL) providers can damage your organization’s vehicles as well as brand image, costing you valuable time and money. At McCollister’s, we appreciate the intricacies of the auto industry and the issues OEMs face. Powered by 80 years of logistics, transportation, and warehousing experience, we work with you to streamline your supply chain operations, smooth logistics coordination, and increase business resilience. McCollister’s is not simply a hauler; we are a strategic and reliable logistics partner, ready to take your operations to the next level.',
    ],
];

$partners_title = 'Trusted By Our Partners';

$logos = [
    ['img' => $uploads . '2026/05/glovis.png',            'alt' => 'Glovis'],
    ['img' => $uploads . '2026/05/honda.png',             'alt' => 'Honda'],
    ['img' => $uploads . '2026/05/jaguar-land-rover.png', 'alt' => 'Jaguar Land Rover'],
    ['img' => $uploads . '2026/05/lamborghini.png',       'alt' => 'Lamborghini'],
    ['img' => $uploads . '2026/05/lucid.png',             'alt' => 'Lucid'],
    ['img' => $uploads . '2026/05/mclaren.png',           'alt' => 'McLaren'],
];

$expertise = [
    'eyebrow'        => 'expertise',
    'services_title' => 'Our<br>Services',
    'services_paras' => [
        'With our fleet of specialized transporters, crew of highly experienced drivers, network of trusted 3PLs, and responsive customer service team, McCollister’s ensures your cars arrive timely, safely, and securely. Your dedicated account manager keeps you informed with proactive updates and timely communication throughout the transport process and addresses any issues with efficiency. All of your important documents, such as inspections, bills of lading, and time-stamped records of pickup and delivery, are easily accessible through a customized portal or by contacting your account manager.',
        'Whether your vehicles need to be picked up from or delivered to vehicle processing centers, special events, dealers, ports, marshalling yards, railheads, or directly to customers, McCollister’s has the resources and capacity to make the journey a smooth one.',
    ],
    // Column-first: 1–7 col 1, 8–14 col 2, 15–21 col 3.
    'services_items' => [
        'Vetted 3PL network with open and enclosed trailers',
        'Prototypes, concept cars, and clay model transport',
        'In-house customer service representatives',
        'Seamless API and EDI integration',
        'Multilayer tracking systems',
        'Flexible scheduling',
        'Race car transport',
        'Detailed transportation plans and procedural control',
        'Dedicated driver training and safety programs',
        'Support for marketing events and showcases',
        'Vehicle tests and demonstrations',
        'Guaranteed on-time delivery',
        'Dealer auto transport',
        'Film and photo shoots',
        'Thorough pick-up and delivery inspections',
        'Comprehensive nationwide white glove delivery',
        'Experienced drivers and technicians',
        'State-of-the-art equipment',
        'Factory to owner transport',
        'Enclosed, secured storage',
        'A++ rated insurance',
    ],
];

$asset = [
    'title' => 'Our<br>Asset-Based<br>Fleet',
    'paras' => [
        'We provide nationwide enclosed vehicle transport using corporate-branded equipment operated by industry-leading drivers and technicians. Our custom-made Kentucky XL-12 trailers are built to OEM specifications and are especially designed to protect low-clearance and wide-body vehicles. These best-in-class enclosed carriers offer hard-side transport with hydraulic liftgates, air-ride suspension, and soft strap tie-downs to keep your automobiles safe from debris, weather, dragging, vibration, and prying eyes. They are outfitted with telematics technology, which not only lets us know where our cabs and trailers are at all times, but also monitors driver behavior and vehicle diagnostics, so we can be sure we are providing an optimized and streamlined journey for your assets.',
    ],
];

$network = [
    'image' => $uploads . '2026/03/man-in-truck-side-view.jpg',
    'alt'   => 'A man wearing sunglasses drives a blue McCollister’s truck, viewed from outside the driver’s side window on a sunny day.',
    'title' => 'Our Extensive<br>Carrier Network',
    'paras' => [
        'In addition to our asset-based fleet, we also provide both open and enclosed auto transport services through our 3PL partner fleet. These businesses are well-vetted carriers that exhibit the same dedication, values, and commitment to excellence as McCollister’s does. Among other checks, the vetting process includes conducting verifications of appropriate insurance coverage, DOT compliance, and internal best practices.',
        'Our 3PL network gives us superior flexibility than auto transport companies that are solely asset-based. It enables us to quickly adapt to market changes and respond to customer needs, ultimately delivering greater value to our clients.',
    ],
];

$confidence = [
    'eyebrow' => 'partnership',
    'title'   => 'Confidence With McCollister’s',
    'intro'   => 'When you partner with McCollister’s for OEM auto transport, both you and your vehicles receive top-of-the-line service. We provide you with a tailored and elevated delivery experience, including specialized handling, enhanced protection, and personalized coordination.',
    'lead'    => 'Some premium features include:',
    'image'   => $uploads . '2026/03/mccollisters-auto-oem-assembly-line.jpg',
    'alt'     => 'Rows of finished vehicles on an automotive assembly line.',
    'items'   => [
        ['title' => 'Customized company-owned trailers', 'text' => 'Our white-glove deliveries travel exclusively in our fully enclosed carriers that safeguard vehicles from weather, road debris, vandalism, and theft. Hydraulic liftgates designed especially for ultra-low clearance vehicles help ensure damage-free loading.'],
        ['title' => 'Maximized protection', 'text' => 'We are meticulous in securing your cars safely, using soft straps, padded tie-downs, non-abrasive covers, and other measures that protect your investment during transit. Our carriers’ air-ride suspension also helps limit unnecessary movement, further reducing the risk of in-transit damage.'],
        ['title' => 'Direct supervision', 'text' => 'Our dedicated customer relations team provides continuous oversight throughout the entire transport process. You will have one point of contact who will make sure your move is efficient, seamless, and headache free.'],
        ['title' => 'Real-time GPS tracking', 'text' => 'Through our telematics systems, we provide 24/7 visibility of your vehicle’s location with updates available through our online tracking portal.'],
    ],
];

$levels = [
    'packages_title' => 'Choose From One Of Our Three Packages:',
    'packages'       => [
        [
            'name'  => 'Silver',
            'items' => [
                'Open carrier 3PL network',
                '1-, 3-, 5-, or 7-day service pickup window',
                '$250,000 minimum with coverage spread out among all vehicles on board',
            ],
        ],
        [
            'name'  => 'Gold',
            'items' => [
                'Enclosed carrier 3PL network',
                '1-, 3-, 5-, or 7-day service pickup window',
                '$1 million minimum with coverage spread out among all vehicles on board',
            ],
        ],
        [
            'name'  => 'Platinum',
            'items' => [
                'McCollister’s enclosed carriers w/ white-glove delivery',
                'Custom scheduling with our customer service agents',
                '$5 million minimum, with coverage available up to $8 million',
            ],
        ],
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'OEM Auto Transport',
    'items'   => [
        [
            'q' => 'What are the major risks associated with improper auto transportation?',
            'a' => '<p>Choosing an incompetent and/or unreliable auto transportation partner can cause many problems that ripple throughout your organization. These issues can include:</p>'
                 . '<ul>'
                 . '<li>Delayed dealer shipments</li>'
                 . '<li>Missed marketing windows for priority vehicles</li>'
                 . '<li>Out of sync new vehicle launches</li>'
                 . '<li>Adjusted factory output</li>'
                 . '<li>Overcrowded storage facilities</li>'
                 . '<li>Misaligned incentive programs due to lack of inventory</li>'
                 . '</ul>'
                 . '<p>Combined, these unnecessary setbacks reduce efficiency at scale and increase the total cost per delivered vehicle.</p>'
                 . '<p>The losses caused by improper auto transport are not just monetary, however. Delayed and/or mishandled shipments will likely also harm your relationships with clients, perhaps irreparably.</p>'
                 . '<p>By partnering with a reputable and reliable auto transportation company, you can minimize frustration and inefficiency while maximizing revenue and satisfaction.</p>',
        ],
        [
            'q' => 'What types of OEM clients do you work with?',
            'a' => '<p>We work with a range of OEM clients, including car manufacturers, automotive suppliers, EV companies, and global logistics partners needing white-label or branded shipping services.</p>',
        ],
        [
            'q' => 'What factors influence the cost of OEM auto transport?',
            'a' => '<p>McCollister’s OEM transport rates are structured around your specific logistics needs and volumes, as well as seasonal demand and market capacity.</p>'
                 . '<p>For an accurate quote, please contact our dedicated OEM logistics team directly.</p>',
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

    <!-- Quote banner (external embed) overlapping the hero -->
    <div class="svc-quote">
        <div class="svc-quote__inner">
            <iframe id="mcc-banner-quote-embed" src="https://dogqvekvr5n1p.cloudfront.net/public/banner-quote" title="McCollister&#039;s Banner Quote" scrolling="no" loading="lazy"></iframe>
        </div>
    </div>
    <script>
        // Route each embed message to the iframe that actually sent it (matched
        // by event.source), so multiple quote embeds on the page each resize to
        // their own height.
        window.addEventListener('message', function (event) {
            if (!event || !event.data || !event.data.type) { return; }
            var iframes = document.querySelectorAll('iframe[src*="banner-quote"]');
            var target = null;
            for (var i = 0; i < iframes.length; i++) {
                if (iframes[i].contentWindow === event.source) { target = iframes[i]; break; }
            }
            if (!target) { return; }
            if (event.data.type === 'mcc-quote-embed:resize') {
                target.style.height = event.data.height + 'px';
            }
            if (event.data.type === 'mcc-quote-embed:scroll-into-view') {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    </script>

    <!-- Feature icons row -->
    <section class="svc-features-row">
        <div class="svc-features-row__grid">
            <?php foreach ($features as $f) : ?>
                <div class="svc-feature">
                    <div class="svc-feature__icon">
                        <img src="<?php echo esc_url($f['icon']); ?>" alt="" loading="lazy" decoding="async">
                    </div>
                    <h3 class="svc-feature__title"><?php echo esc_html($f['title']); ?></h3>
                    <p class="svc-feature__sub"><?php echo esc_html($f['sub']); ?></p>
                </div>
            <?php endforeach; ?>
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

    <!-- Trusted by our partners -->
    <section class="svc-section svc-partners">
        <div class="svc-section__inner">
            <h2 class="section-head__title svc-partners__title"><?php echo esc_html($partners_title); ?></h2>
        </div>
    </section>

    <!-- Brand logos (auto-scrolling marquee; pauses on hover) -->
    <section class="svc-logos">
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

    <!-- Expertise (dark): Our Services + Our Asset-Based Fleet + Our Extensive Carrier Network -->
    <section class="svc-freight">
        <div class="svc-freight__inner">

            <!-- Our Services -->
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $expertise['eyebrow'],
                'light'   => true,
            ]); ?>
            <div class="svc-freight__header">
                <h2 class="svc-freight__title"><?php echo wp_kses($expertise['services_title'], ['br' => []]); ?></h2>
                <div class="svc-freight__prose">
                    <?php foreach ($expertise['services_paras'] as $p) : ?>
                        <p><?php echo esc_html($p); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <ul class="svc-freight__caps svc-freight__caps--services svc-freight__caps--tall7">
                <?php foreach ($expertise['services_items'] as $item) : ?>
                    <li>
                        <span class="svc-freight__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <span><?php echo esc_html($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Our Asset-Based Fleet -->
            <div class="svc-freight__header svc-freight__header--gap">
                <h2 class="svc-freight__title"><?php echo wp_kses($asset['title'], ['br' => []]); ?></h2>
                <div class="svc-freight__prose">
                    <?php foreach ($asset['paras'] as $p) : ?>
                        <p><?php echo esc_html($p); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Our Extensive Carrier Network -->
            <div class="svc-freight__block svc-freight__fleet svc-freight__fleet--gap">
                <div class="svc-freight__fleet-media">
                    <img src="<?php echo esc_url($network['image']); ?>" alt="<?php echo esc_attr($network['alt']); ?>" loading="lazy" decoding="async" width="800" height="680">
                </div>
                <div class="svc-freight__fleet-body">
                    <h2 class="svc-freight__title"><?php echo wp_kses($network['title'], ['br' => []]); ?></h2>
                    <div class="svc-freight__prose">
                        <?php foreach ($network['paras'] as $p) : ?>
                            <p><?php echo esc_html($p); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership: Confidence With McCollister's -->
    <section class="svc-section svc-oemconf">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $confidence['eyebrow'],
                'title'   => $confidence['title'],
            ]); ?>
            <div class="svc-prose">
                <p><?php echo esc_html($confidence['intro']); ?></p>
            </div>
            <div class="svc-oemconf__grid">
                <div class="svc-oemconf__features">
                    <h3 class="svc-oemconf__lead"><?php echo esc_html($confidence['lead']); ?></h3>
                    <?php foreach ($confidence['items'] as $item) : ?>
                        <div class="svc-oemconf__item">
                            <h4 class="svc-oemconf__item-title"><?php echo esc_html($item['title']); ?></h4>
                            <p class="svc-oemconf__item-text"><?php echo esc_html($item['text']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="svc-oemconf__media">
                    <img src="<?php echo esc_url($confidence['image']); ?>" alt="<?php echo esc_attr($confidence['alt']); ?>" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </section>

    <!-- Service levels: packages only -->
    <section class="svc-section svc-levels">
        <div class="svc-section__inner">
            <h2 class="svc-levels__packages-title"><?php echo esc_html($levels['packages_title']); ?></h2>
            <div class="svc-packages">
                <?php foreach ($levels['packages'] as $pkg) : ?>
                    <div class="svc-package">
                        <h3 class="svc-package__title"><?php echo esc_html($pkg['name']); ?></h3>
                        <ul class="svc-package__list">
                            <?php foreach ($pkg['items'] as $item) : ?>
                                <li>
                                    <span class="svc-package__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                    <span><?php echo esc_html($item); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
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
