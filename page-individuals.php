<?php
/**
 * Template Name: Service Page — Individual Auto Transport
 *
 * Child of Auto Transport (/auto-transport/individuals/). Hard-coded; content
 * lives in the variables up top so it can later map to ACF. Reuses the global
 * components: .section-head, .mcc-btn, [data-accordion] — and service.css.
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
    'image'    => $uploads . '2026/03/automotive-hero-individual-2.jpg',
    'title'    => 'Individual Auto Transport',
    'subtitle' => 'Professional, personalized, reliable car shipping solutions',
    'buttons'  => [
        ['label' => 'Dealers', 'url' => home_url('/auto-transport/dealers/')],
        ['label' => 'OEMs', 'url' => home_url('/auto-transport/oems/')],
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
    'title'   => 'Peace Of Mind,<br>Delivered To<br>Your Door',
    'paras'   => [
        'When it comes time to ship your vehicle, you don’t want to trust just any company. Your car is much more than just a mode of transportation to you — it’s your pride and joy, a piece of art, a valuable asset. You want to be sure you choose a transportation company that treats your car like you do, with the precision and care it deserves.',
        'Backed by more than 80 years of transportation, logistics, and warehousing expertise, McCollister’s prides itself not only on our superior transportation services, but also incomparable customer service. We provide a seamless experience for you and your vehicle, complete with prompt pickup and delivery, regular communication, and unparalleled care.',
    ],
];

$expertise = [
    'eyebrow'        => 'expertise',
    'services_title' => 'Our <br>Services',
    'services_paras' => [
        'With our fleet of specialized transporters, crew of highly skilled drivers, network of trusted third-party partners (also known as 3PLs), and responsive customer service team, McCollister’s ensures your cars arrive timely, safely, and securely.',
        'Booking is easy through our online quoting system. Plus, we keep you connected through our real-time vehicle tracking and driver communication capabilities, so you can keep track of your precious cargo.',
    ],
    // Column-first: 1–3 col 1, 4–6 col 2, 7–9 col 3.
    'services_items' => [
        'Nationwide door-to-door delivery for all service levels',
        'Personal vehicle shipping',
        'Snowbird car transport',
        'Enclosed, secured storage options for all vehicle types',
        'Auction house purchases',
        'Factory to owner transport',
        'Classic, exotic, and antique car transport',
        'Race car transport',
        'Film and photo shoots',
    ],
    'features_title' => 'Our <br>Features',
    // Column-first: 1–6 col 1, 7–12 col 2.
    'features_items' => [
        'Vetted 3PL network with open and enclosed trailers',
        'Thorough pick-up and delivery inspections',
        'Enclosed asset-based white glove transport',
        'Experienced drivers and technicians',
        'Multilayer tracking systems',
        'Flexible scheduling',
        'Detailed transportation plans and procedural control',
        'Dedicated driver training and safety programs',
        'In-house customer service representatives',
        'State-of-the-art equipment',
        'Guaranteed on-time delivery',
        'A++ rated insurance',
    ],
];

$fleet = [
    'image' => $uploads . '2026/03/man-in-truck-side-view.jpg',
    'alt'   => 'A man wearing sunglasses drives a blue McCollister’s truck, viewed from outside the driver’s side window on a sunny day.',
    'title' => 'Our Fleet',
    'paras' => [
        'We provide nationwide enclosed vehicle transport using corporate-branded equipment operated by industry-leading drivers and technicians. Our custom-made Kentucky XL-12 trailers are built to OEM specifications and are especially designed to protect low-clearance and wide-body vehicles.',
        'These best-in-class enclosed carriers offer hard-side transport with hydraulic liftgates, air-ride suspension, and soft strap tie-downs to keep your automobiles safe from debris, weather, dragging, vibration, and prying eyes. They are outfitted with telematics technology, which not only lets us know where our cabs and trailers are at all times, but also monitors driver behavior and vehicle diagnostics, so we can be sure we are providing an optimized and streamlined journey for your auto.',
    ],
];

$levels = [
    'eyebrow'        => 'service levels',
    'title'          => 'Take Charge Of<br>Your Auto<br>Transportation',
    'lead'           => 'McCollister’s offers three levels of service, suitable for different needs and budgets.',
    'para'           => 'All of our shipment options provide the responsive customer service and attention to detail McCollister’s is known for. Our platinum package features white-glove service and McCollister’s own top-grade equipment. This option delivers the ultimate experience in precision and confidentiality, setting the standard for high-end auto transport. Our gold and silver services are performed through our 3PL network of vetted carriers that we trust and partner with throughout the US. These options are more budget-friendly and may offer a quicker turnaround than our platinum package.',
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
    'title'   => 'Individual Auto Transport',
    'items'   => [
        [
            'q' => 'What are the major risks associated with improper auto transportation?',
            'a' => '<p>It is crucial to choose a reputable auto transport company to best protect your vehicle(s). Common issues that may arise include theft and scams, hidden fees, poor communication, severe damage due to poor handling and securing, delayed delivery, incorrect documentation, and inadequate insurance coverage.</p>',
        ],
        [
            'q' => 'What does white-glove delivery mean for auto transport?',
            'a' => '<p>When it’s time to transport classic, luxury, antique, and exotic cars, you want to partner with a company that takes the utmost care of your vehicle and gives you peace of mind. White-glove delivery provides customers with a tailored and elevated delivery experience, including specialized handling, enhanced protection, and personalized coordination.</p>'
                 . '<p>White-glove delivery is a core feature of McCollister’s platinum package. Some premium features include:</p>'
                 . '<ul>'
                 . '<li><strong>Customized company-owned trailers:</strong> Our white-glove deliveries travel exclusively in our fully enclosed carriers that safeguard vehicles from weather, road debris, vandalism, and theft. Hydraulic liftgates designed especially for ultra-low clearance vehicles help ensure damage-free loading.</li>'
                 . '<li><strong>Maximized protection:</strong> We are meticulous in securing your car safely, using soft straps, padded tie-downs, non-abrasive covers, and other measures that protect your investment during transit. Our carriers’ air-ride suspension also helps limit unnecessary movement, further reducing the risk of in-transit damage.</li>'
                 . '<li><strong>Direct supervision:</strong> Our dedicated customer relations team provides continuous oversight throughout the entire transport process. You will have one point of contact who will make sure your move is efficient, seamless, and headache free.</li>'
                 . '<li><strong>Real-time GPS tracking:</strong> Through our telematics systems, we provide 24/7 visibility of your vehicle’s location with updates available through our online tracking portal.</li>'
                 . '</ul>'
                 . '<p><strong>Please note: white-glove delivery is only offered under our platinum package.</strong></p>',
        ],
        [
            'q' => 'How far in advance should auto transport be booked?',
            'a' => '<p>When booking your transport, we ask for as much time as possible. For our gold and silver packages, we can usually provide transport within three days, depending on the season and weather. In the AutoVista app, you will see options for 1-, 3-, 5-, and 7-day pickup available. When choosing the best option for you, keep in mind that these date ranges are based on the date two business days from the completed submission of your booking. If you have a rush order that needs to be picked up fewer than two business days out from the date of booking, please contact us directly to confirm we can service the order.</p>'
                 . '<p>For our platinum package, we can typically provide service within two to three weeks. Please contact us directly for more details.</p>',
        ],
        [
            'q' => 'How do I prepare my vehicle for transport?',
            'a' => '<p>To help ensure the best auto transport experience, it is essential to appropriately prepare your vehicle. Consider the following actions:</p>'
                 . '<ul>'
                 . '<li><strong>Clean both the exterior and interior of the car thoroughly.</strong> Doing so will make it easier to identify any pre-existing damage.</li>'
                 . '<li><strong>Remove all personal belongings from the vehicle.</strong> These items may shift in transit, potentially damaging the interior. Additionally, they could draw unwanted attention.</li>'
                 . '<li><strong>Document the vehicle’s current condition with detailed photos.</strong> Should anything happen to your car during transit, it is critical that you have time-stamped photos in case of disputes over damage claims.</li>'
                 . '<li><strong>Perform a mechanical check.</strong> Make sure your vehicle is transport ready by inspecting the battery, checking for leaks, and verifying tire condition.</li>'
                 . '<li><strong>Adjust the fuel level to approximately 1/4 of the tank’s capacity.</strong> More fuel than this amount adds unnecessary weight to the vehicle, which can lead to increased transport costs. Be sure to still have enough fuel to move the car during loading and unloading.</li>'
                 . '<li><strong>Disable any alarm systems.</strong> Alarms that go off mid-journey can drain your car’s battery and cause unnecessary delays.</li>'
                 . '<li><strong>Remove toll tags.</strong> If these are active, you could be charged for tolls incurred by the carrier.</li>'
                 . '<li><strong>Share any special handling instructions with your driver.</strong> Customized cars require customized care. While our drivers are trained to safely transport all types of vehicles, we recognize that certain models may require additional attention. Please inform us of any aspects of your car that may affect loading or securing, so we can best protect your investment.</li>'
                 . '</ul>',
        ],
        [
            'q' => 'What is a 3PL?',
            'a' => '<p>3PL stands for third-party logistics, and it is used to refer to organizations or networks that arrange or handle a variety of supply chain functions. In the case of McCollister’s Auto Transport, we mean companies we contract with to haul on our behalf. These businesses are well-vetted partners who exhibit the same dedication, values, and commitment to excellence as our internal asset-based fleet. Among other checks, the vetting process includes conducting verifications of appropriate insurance coverage, DOT compliance, and internal best practices.</p>'
                 . '<p>Peace of mind on the road, delivered. For auto transport that exceeds your expectations, choose McCollister’s.</p>',
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
            <iframe id="mcc-banner-quote-embed" src="https://dogqvekvr5n1p.cloudfront.net/public/banner-quote" title="McCollister&#039;s Banner Quote" scrolling="no" loading="eager" class="skip-lazy" data-skip-lazy="true" data-nitro-exclude="true"></iframe>
        </div>
    </div>
    <script>
        // Route each embed message to the iframe that actually sent it (matched
        // by event.source), so multiple quote embeds on the page each resize to
        // their own height — otherwise the second one stays short and the
        // stacked Delivery field is clipped on mobile.
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

    <!-- Expertise (dark): Our Services + Our Features -->
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
            <ul class="svc-freight__caps svc-freight__caps--services">
                <?php foreach ($expertise['services_items'] as $item) : ?>
                    <li>
                        <span class="svc-freight__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <span><?php echo esc_html($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Our Features -->
            <div class="svc-freight__block">
                <div class="svc-freight__header svc-freight__header--features">
                    <h2 class="svc-freight__title"><?php echo wp_kses($expertise['features_title'], ['br' => []]); ?></h2>
                    <ul class="svc-freight__caps svc-freight__caps--features">
                        <?php foreach ($expertise['features_items'] as $item) : ?>
                            <li>
                                <span class="svc-freight__marker" aria-hidden="true"><?php echo $arrow_dr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Our Fleet -->
            <div class="svc-freight__block svc-freight__fleet">
                <div class="svc-freight__fleet-media">
                    <img src="<?php echo esc_url($fleet['image']); ?>" alt="<?php echo esc_attr($fleet['alt']); ?>" loading="lazy" decoding="async" width="800" height="680">
                </div>
                <div class="svc-freight__fleet-body">
                    <h2 class="svc-freight__title"><?php echo esc_html($fleet['title']); ?></h2>
                    <div class="svc-freight__prose">
                        <?php foreach ($fleet['paras'] as $p) : ?>
                            <p><?php echo esc_html($p); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service levels -->
    <section class="svc-section svc-levels">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $levels['eyebrow'],
                'title'   => $levels['title'],
            ]); ?>
            <div class="svc-prose">
                <p class="svc-prose__lead"><?php echo esc_html($levels['lead']); ?></p>
                <p><?php echo esc_html($levels['para']); ?></p>
            </div>

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

            <!-- Quote banner again -->
            <div class="svc-quote svc-quote--inline">
                <div class="svc-quote__inner">
                    <iframe class="mcc-quote-2 skip-lazy" src="https://dogqvekvr5n1p.cloudfront.net/public/banner-quote" title="McCollister&#039;s Banner Quote" scrolling="no" loading="eager" data-skip-lazy="true" data-nitro-exclude="true"></iframe>
                </div>
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

    <!-- CTA cards -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
