<?php
/**
 * Template Name: Service Page — Auto Transport
 *
 * Hard-coded service page. All editable content lives in the variables at the
 * top so it can later be swapped for ACF fields (get_field()) with no markup
 * changes. Reuses the global components: .section-head, .mcc-btn,
 * [data-tabs], [data-count-to] — and the shared service.css rhythm.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 10 17.5 19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/06/Auto-Transport-2.jpeg',
    'title'    => 'Auto Transport',
    'subtitle' => 'Driving innovation, delivering excellence',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/blog/')],
    ],
];

$features = [
    ['icon' => $uploads . '2026/06/shield.png',      'title' => 'A++ Rated Insurance',        'sub' => 'Move forward with confidence'],
    ['icon' => $uploads . '2026/06/truck-phone.png', 'title' => 'Real-Time Vehicle Tracking', 'sub' => 'Full visibility, every mile'],
    ['icon' => $uploads . '2026/06/heart.png',       'title' => 'Dedicated Account Manager',  'sub' => 'One contact, zero runaround'],
    ['icon' => $uploads . '2026/06/ribbon.png',      'title' => '80 Years in Business',       'sub' => 'Unmatched industry knowledge'],
    ['icon' => $uploads . '2026/06/target.png',      'title' => 'Precision Handling',         'sub' => 'Every detail done right'],
];

$intro = 'From personal vehicles to enterprise-level auto logistics, McCollister’s delivers secure, reliable auto transport backed by 80+ years of experience, industry-leading equipment, and hands-on customer care.';

$tabs = [
    [
        'label' => 'Individuals',
        'image' => $uploads . '2026/03/inset-auto-individual.jpg',
        'title' => 'Auto transport built around you',
        'paras' => [
            'McCollister’s provides professional, personalized auto transport solutions designed for people who care deeply about their vehicles. Whether you’re relocating, purchasing a car from an auction, heading south for the winter, or transporting a classic or luxury vehicle, we treat your car like it’s our own.',
            'With our easy quote-to-book platform, you stay in control—no waiting, no uncertainty, no hassle.',
        ],
        'url'   => home_url('/auto-transport/individuals/'),
    ],
    [
        'label' => 'Dealers',
        'image' => $uploads . '2026/03/dealer-auto-transport-inset.jpg',
        'title' => 'Auto transport built for dealers',
        'paras' => [
            'From original equipment manufacturer (OEM) deliveries and dealer trades to auctions and customer drop-offs, we help dealerships keep vehicles moving and customers satisfied—with dedicated account management and integrated self-booking technology.',
        ],
        'url'   => home_url('/auto-transport/dealers/'),
    ],
    [
        'label' => 'OEMs',
        'image' => $uploads . '2026/03/oeg-auto.jpg',
        'title' => 'Auto transport built for OEMs',
        'paras' => [
            'McCollister’s delivers scalable, secure, and technology-driven transport solutions for OEMs navigating complex supply chains—supported by dedicated account management, real-time visibility, and a best-in-class, asset-based fleet.',
        ],
        'url'   => home_url('/auto-transport/oems/'),
    ],
];

$stats = [
    'heading' => 'The McCollister’s Difference',
    'items'   => [
        ['to' => '15', 'suffix' => '', 'decimals' => 0, 'label' => 'Terminal Locations'],
        ['to' => '130', 'suffix' => '', 'decimals' => 0, 'label' => 'Company Owned Assets'],
        ['to' => '100', 'suffix' => '', 'decimals' => 0, 'label' => 'Trailers and Growing'],
    ],
];

$whychoose = [
    'image' => $uploads . '2026/03/inset-pages-auto.jpg',
    'image_alt' => 'A man wearing a black cap, sunglasses, and a black McCollister’s polo shirt stands in front of a large blue Auto Transport semi-truck, outdoors on a sunny day.',
    'title' => 'Why Customers Choose Us:',
    'items' => [
        'White-glove enclosed transport options',
        'Trusted, experienced drivers',
        'Real-time vehicle tracking and clear communication',
        'Flexible scheduling and nationwide delivery',
        'Industry-leading insurance coverage',
    ],
];

$logos = [
    ['img' => $uploads . '2026/05/honda.png', 'alt' => 'Honda'],
    ['img' => $uploads . '2026/05/jaguar-land-rover.png', 'alt' => 'Jaguar Land Rover'],
    ['img' => $uploads . '2026/05/lamborghini.png', 'alt' => 'Lamborghini'],
    ['img' => $uploads . '2026/05/lucid.png', 'alt' => 'Lucid'],
    ['img' => $uploads . '2026/05/mclaren.png', 'alt' => 'McLaren'],
    ['img' => $uploads . '2026/05/mercedes-benz.png', 'alt' => 'Mercedes-Benz'],
    ['img' => $uploads . '2026/05/nissan.png', 'alt' => 'Nissan'],
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
        window.addEventListener('message', function (event) {
            if (event && event.data && event.data.type === 'mcc-quote-embed:resize') {
                var iframe = document.getElementById('mcc-banner-quote-embed');
                if (iframe) { iframe.style.height = event.data.height + 'px'; }
            }
            if (event && event.data && event.data.type === 'mcc-quote-embed:scroll-into-view') {
                var iframe = document.getElementById('mcc-banner-quote-embed');
                if (iframe) { iframe.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
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

    <!-- Intro -->
    <section class="svc-section svc-autotransport-intro">
        <div class="svc-section__inner">
            <p class="svc-autotransport-intro__text"><?php echo esc_html($intro); ?></p>
        </div>
    </section>

    <!-- Tabs (Individuals / Dealers / OEMs) -->
    <section class="svc-section svc-tabs-section">
        <div class="svc-section__inner">
            <div class="svc-tabs svc-tabs--auto" data-tabs>
                <div class="svc-tabs__nav" role="tablist">
                    <?php foreach ($tabs as $i => $tab) : ?>
                        <button
                            type="button"
                            class="svc-tabs__tab<?php echo $i === 0 ? ' is-active' : ''; ?>"
                            role="tab"
                            data-tabs-tab="<?php echo esc_attr($i); ?>"
                            style="--tab-i: <?php echo esc_attr($i); ?>"
                            aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                        >
                            <span class="svc-tabs__tab-label"><?php echo esc_html($tab['label']); ?></span>
                            <span class="svc-tabs__tab-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($tabs as $i => $tab) : ?>
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
                            <div class="svc-tabs__desc">
                                <?php foreach ($tab['paras'] as $p) : ?>
                                    <p><?php echo esc_html($p); ?></p>
                                <?php endforeach; ?>
                            </div>
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

    <!-- Stats (animated counters) -->
    <section class="svc-stats">
        <h2 class="svc-stats__head"><?php echo esc_html($stats['heading']); ?></h2>
        <div class="svc-stats__grid">
            <?php foreach ($stats['items'] as $stat) : ?>
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

    <!-- Why customers choose us -->
    <section class="svc-section svc-whychoose">
        <div class="svc-section__inner">
            <div class="svc-features__grid">
                <div class="svc-features__media">
                    <img src="<?php echo esc_url($whychoose['image']); ?>" alt="<?php echo esc_attr($whychoose['image_alt']); ?>" loading="lazy" decoding="async">
                </div>
                <div class="svc-features__body">
                    <h2 class="svc-whychoose__title"><?php echo esc_html($whychoose['title']); ?></h2>
                    <ul class="svc-whychoose__list">
                        <?php foreach ($whychoose['items'] as $item) : ?>
                            <li>
                                <span class="svc-whychoose__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
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

    <!-- CTA cards (reusable component; defaults to the standard two cards) -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
