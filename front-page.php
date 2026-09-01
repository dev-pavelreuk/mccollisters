<?php
/**
 * Front page foundation.
 * Replace each placeholder section as the custom build progresses.
 *
 * @package McCollisters
 */

get_header();
?>
<main id="primary" class="site-main">
    <?php
    // Shared with mcc_preload_hero_slide(), which preloads slide 1 from <head>.
    $hero_slides = mcc_hero_slides();
    ?>
    <section class="home-hero">
        <?php if ($hero_slides) : ?>
            <div class="home-hero__slider" aria-hidden="true">
                <?php foreach ($hero_slides as $index => $slide_url) : ?>
                    <?php
                    /* Slide 1 is the LCP element: its background is inline so the
                       browser fetches it immediately, and NitroPack is told not to
                       lazy-load it. Slides 2-6 carry the URL in data-bg instead --
                       hero.js applies it once the page has loaded and keeps one
                       slide pre-warmed ahead of the rotation. Inlining all six cost
                       ~1.7MB on first paint for images nobody sees for 5+ seconds.

                       mcc_webp_url() swaps in Imagify's WebP twin: it only rewrites
                       <img> tags into <picture>, which cannot reach a CSS background,
                       so these were being served the raw JPEG. */
                    ?>
                    <div
                        class="home-hero__slide<?php echo $index === 0 ? ' is-active skip-lazy' : ''; ?>"
                        <?php if ($index === 0) : ?>
                            data-skip-lazy="true" data-nitro-exclude="true"
                            style="background-image: url('<?php echo esc_url(mcc_webp_url($slide_url)); ?>');"
                        <?php else : ?>
                            data-bg="<?php echo esc_url(mcc_webp_url($slide_url)); ?>"
                        <?php endif; ?>
                    ></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="container home-hero__inner">
            <div class="home-hero__content">
                <h1 class="home-hero__title">
                    <?php // Visual, animated version — hidden from assistive tech, which reads the static phrase below. ?>
                    <span aria-hidden="true">
                        <span class="home-hero__title-part"><?php esc_html_e('When', 'mccollisters'); ?></span>
                        <?php
                        /* The rotating word sits in a grid slot alongside a hidden
                           copy of every word, all in the same cell, so the slot is
                           as wide as the widest word from first paint -- in the real
                           font, without JavaScript. Reserving this width in JS
                           instead meant the span painted at "Timing" width and then
                           jumped, which is a layout shift in its own right. */
                        $typed_words = ['TIMING', 'SAFETY', 'AGILITY', 'SECURITY', 'SCALING', 'PREcision'];
                        ?>
                        <span class="home-hero__title-part">
                            <span class="home-hero__typed-slot">
                                <span
                                    class="home-hero__typed"
                                    data-words="<?php echo esc_attr(implode(',', $typed_words)); ?>"
                                >Timing</span>
                                <?php foreach ($typed_words as $typed_word) : ?>
                                    <span class="home-hero__typed-sizer" aria-hidden="true"><?php echo esc_html($typed_word); ?></span>
                                <?php endforeach; ?>
                            </span>
                        </span>
                        <span class="home-hero__title-part"><?php esc_html_e('Matters', 'mccollisters'); ?></span>
                    </span>
                    <span class="screen-reader-text"><?php esc_html_e('When timing, safety, agility, security, scaling and precision matter.', 'mccollisters'); ?></span>
                </h1>

                <p class="home-hero__lead"><?php esc_html_e('Backed by more than 80 years of experience, McCollister’s delivers hands-on, dependable solutions customized for your needs.', 'mccollisters'); ?></p>

                <div class="home-hero__actions">
                    <a class="mcc-btn" href="<?php echo esc_url(home_url('/about-us/')); ?>">
                        <span class="mcc-btn__label"><?php esc_html_e('About Us', 'mccollisters'); ?></span>
                        <span class="mcc-btn__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    </a>
                    <a class="mcc-btn" href="<?php echo esc_url(home_url('/talk-to-an-expert/')); ?>">
                        <span class="mcc-btn__label"><?php esc_html_e('Talk to an Expert', 'mccollisters'); ?></span>
                        <span class="mcc-btn__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    </a>
                </div>

                <ul class="home-hero__tags">
                    <li><a href="<?php echo esc_url(home_url('/transportation/')); ?>"><?php esc_html_e('Transportation', 'mccollisters'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/warehousing/')); ?>"><?php esc_html_e('Warehousing', 'mccollisters'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/logistics/')); ?>"><?php esc_html_e('Logistics', 'mccollisters'); ?></a></li>
                </ul>
            </div>

            <?php // Pinned to the bottom-right corner, independent of the centered content. ?>
            <div class="home-hero__facility">
                <p class="home-hero__facility-label"><?php esc_html_e('Find A McCollister’s Facility Near You', 'mccollisters'); ?></p>
                <?php // Agile Store Locator search (installed + configured); redirects results to the Locations page. ?>
                <div class="home-hero__facility-asl">
                    <?php echo do_shortcode('[ASL_SEARCH btn-color="#0069cb" category_control="0" redirect="' . esc_url(home_url('/locations/')) . '"]'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Services overview — heading on the left, three service cards on the right.
    $uploads       = wp_get_upload_dir();
    $services_base = trailingslashit($uploads['baseurl']) . '2026/06/';
    $services      = [
        [
            'title' => __('Transportation', 'mccollisters'),
            'url'   => '/transportation/',
            'image' => $services_base . 'Transportation-Homepage-i.png',
            'desc'  => __("From autos to airplanes, finance to fine art, and treadmills to trade shows, McCollister's brings expertise and precision to every move.", 'mccollisters'),
        ],
        [
            'title' => __('Warehousing', 'mccollisters'),
            'url'   => '/warehousing/',
            'image' => $services_base . 'Warehousing-Hoempage-i.png',
            'desc'  => __('Seamless end to end warehousing, distribution, and fulfillment, supported by a nationwide network of strategically positioned storage facilities.', 'mccollisters'),
        ],
        [
            'title' => __('Logistics', 'mccollisters'),
            'url'   => '/logistics/',
            'image' => $services_base . 'Government-Military-Families-i.png',
            'desc'  => __('From specialized industries to individual needs, McCollister’s offers flexible local and national logistics solutions built to support growth at every scale.', 'mccollisters'),
        ],
    ];
    ?>
    <section class="home-services">
        <div class="container home-services__grid">
            <div class="home-services__intro">
                <p class="home-services__eyebrow">/ <?php esc_html_e('services', 'mccollisters'); ?> /</p>
                <h2 class="home-services__title"><?php echo wp_kses(__('Streamlined <br class="br--mobile">Logistics, <br class="br--mobile">Seamless <br class="br--mobile">Delivery', 'mccollisters'), ['br' => ['class' => true]]); ?></h2>
            </div>

            <div class="home-services__list">
                <?php foreach ($services as $service) : ?>
                    <div class="home-service">
                        <span class="home-service__icon">
                            <img
                                src="<?php echo esc_url($service['image']); ?>"
                                alt=""
                                width="500"
                                height="500"
                                loading="lazy"
                                decoding="async"
                            >
                        </span>
                        <div class="home-service__body">
                            <h3 class="home-service__title">
                                <a href="<?php echo esc_url(home_url($service['url'])); ?>"><?php echo esc_html($service['title']); ?></a>
                            </h3>
                            <p class="home-service__desc"><?php echo esc_html($service['desc']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    // Industries ticker — an infinite horizontal marquee of the sectors served,
    // each separated by a brand-blue dot. Two identical groups scroll as one
    // seamless loop (translateX 0 → -50%).
    $marquee_items = [
        __('Aerospace', 'mccollisters'),
        __('Automotive', 'mccollisters'),
        __('Aviation', 'mccollisters'),
        __('Commercial Relocation', 'mccollisters'),
        __('Cultural Institutions', 'mccollisters'),
        __('Electronics', 'mccollisters'),
        __('Entertainment', 'mccollisters'),
        __('Finance & Banking', 'mccollisters'),
        __('Fitness', 'mccollisters'),
        __('Hospitality', 'mccollisters'),
        __('Medical Imaging', 'mccollisters'),
        __('Residential Relocation', 'mccollisters'),
        __('Technical Services', 'mccollisters'),
        __('Telecommunications', 'mccollisters'),
    ];

    $marquee_group = '';
    foreach ($marquee_items as $marquee_item) {
        $marquee_group .= '<span class="home-marquee__item">' . esc_html($marquee_item) . '</span>';
        $marquee_group .= '<span class="home-marquee__dot" aria-hidden="true"></span>';
    }
    ?>
    <section class="home-marquee">
        <h2 class="screen-reader-text"><?php esc_html_e('Industries we serve', 'mccollisters'); ?></h2>
        <?php // Static, readable list for assistive tech; the animated copy below is hidden from it. ?>
        <ul class="screen-reader-text">
            <?php foreach ($marquee_items as $marquee_item) : ?>
                <li><?php echo esc_html($marquee_item); ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="home-marquee__track" aria-hidden="true">
            <div class="home-marquee__group"><?php echo $marquee_group; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from esc_html() above. ?></div>
            <div class="home-marquee__group"><?php echo $marquee_group; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from esc_html() above. ?></div>
        </div>
    </section>

    <?php
    // About Us — dark block: animated miles counter, heading + copy, and a
    // wide image card carrying an employee quote.
    $about_image = mcc_get_theme_option('mcc_about_image', '');
    if ($about_image === '') {
        $uploads     = wp_get_upload_dir();
        $about_image = trailingslashit($uploads['baseurl']) . '2026/03/mccollisters-blue-driver.jpg';
    }
    $arrow_svg = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    ?>
    <section class="home-about">
        <div class="container home-about__inner">
            <p class="home-about__eyebrow">/ <?php esc_html_e('about us', 'mccollisters'); ?> /</p>

            <div class="home-about__metric">
                <span
                    class="home-about__count"
                    data-count-to="223158482"
                    data-count-from="222222222"
                >223,158,482</span>
                <span class="home-about__count-label"><?php esc_html_e('Miles Logged', 'mccollisters'); ?></span>
            </div>

            <div class="home-about__cols">
                <h2 class="home-about__title"><?php esc_html_e('Driven by Excellence, Delivered with Passion', 'mccollisters'); ?></h2>
                <div class="home-about__body">
                    <p><?php esc_html_e('Founded by Daniel H. McCollister in 1945, McCollister’s has grown from its humble beginnings as a small, local household mover into a nationally recognized asset-based transportation and logistics company, known for our creative, customized solutions and white-glove service.', 'mccollisters'); ?></p>
                    <p><?php esc_html_e('Still family-owned and privately held, McCollister’s is powered by a team of dedicated professionals across multiple industries. Our people are our greatest strength—and their expertise, integrity, and passion for service drive everything we do. That’s why we invest in their growth, development, and success—so they can deliver the exceptional results our customers expect.', 'mccollisters'); ?></p>
                    <a class="mcc-btn home-about__btn" href="<?php echo esc_url(home_url('/about-us/')); ?>">
                        <span class="mcc-btn__label"><?php esc_html_e('Learn More', 'mccollisters'); ?></span>
                        <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="container">
            <figure
                class="home-about__quote<?php echo $about_image ? '' : ' home-about__quote--no-image'; ?>"
                <?php if ($about_image) : ?>style="background-image: url('<?php echo esc_url($about_image); ?>');"<?php endif; ?>
            >
                <blockquote class="home-about__quote-inner">
                    <p class="home-about__quote-text"><?php esc_html_e('“Our positive culture doesn’t just benefit employees, it directly impacts how we serve our customers, allowing us to deliver a high level of service and care every day.”', 'mccollisters'); ?></p>
                    <figcaption>
                        <span class="home-about__quote-name"><?php esc_html_e('Edward Cuomo', 'mccollisters'); ?></span>
                        <span class="home-about__quote-role"><?php esc_html_e('Warehouse Solutions Manager', 'mccollisters'); ?></span>
                    </figcaption>
                    <a class="mcc-btn home-about__btn" href="<?php echo esc_url(home_url('/careers/')); ?>">
                        <span class="mcc-btn__label"><?php esc_html_e('Careers', 'mccollisters'); ?></span>
                        <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
                    </a>
                </blockquote>
            </figure>
        </div>
    </section>

    <?php
    // Certifications / affiliations logo row (black SVGs from the media library).
    $certs_base = trailingslashit(wp_get_upload_dir()['baseurl']) . '2026/05/';
    $certs      = [
        [
            'name' => 'ISO 13485',
            'file' => 'iso-blk-1.svg',
            'url'  => 'https://www.iso.org/iso-13485-medical-devices.html',
        ],
        [
            'name' => 'EPA SmartWay',
            'file' => 'smartway-blk-1.svg',
            'url'  => 'https://www.epa.gov/smartway',
        ],
        [
            'name' => 'NDTA',
            'file' => 'ndta-blk-1.svg',
            'url'  => 'https://www.ndtahq.com/',
        ],
        [
            'name' => 'CTPAT',
            'file' => 'ctpat-blk-1.svg',
            'url'  => 'https://www.cbp.gov/border-security/ports-entry/cargo-security/CTPAT',
        ],
        [
            'name' => 'National Safety Council',
            'file' => 'nsc-blk-1.svg',
            'url'  => 'https://www.nsc.org/',
        ],
        [
            'name' => 'Commercial Space Federation',
            'file' => 'commercial-space-federation.svg',
            'url'  => 'https://www.commercialspacefederation.com/',
        ],
    ];
    ?>
    <section class="home-certs" aria-label="<?php esc_attr_e('Certifications and affiliations', 'mccollisters'); ?>">
        <div class="container home-certs__row">
            <?php foreach ($certs as $cert) : ?>
                <a
                    class="home-certs__item"
                    href="<?php echo esc_url($cert['url']); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php /* translators: %s: certification/affiliation name */ printf(esc_attr__('Visit %s website', 'mccollisters'), esc_attr($cert['name'])); ?>"
                >
                    <img
                        class="home-certs__logo"
                        src="<?php echo esc_url($certs_base . $cert['file']); ?>"
                        alt="<?php echo esc_attr($cert['name']); ?>"
                        loading="lazy"
                        decoding="async"
                    >
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <?php
    // Features — blue truck on the left, an accordion of five differentiators
    // on the right. Uses native <details> with a shared name for exclusive
    // (one-at-a-time) opening; no JavaScript required.
    $features_image = mcc_get_theme_option('mcc_features_image', '');
    if ($features_image === '') {
        $features_image = trailingslashit(wp_get_upload_dir()['baseurl']) . '2026/03/mccollisters-truck-cab.jpg';
    }
    $features = [
        [
            'title' => __('Specialized Handling', 'mccollisters'),
            'desc'  => __('McCollister’s is purpose-built for high-value, sensitive, and mission-critical shipments. From medical equipment and aerospace components to IT infrastructure and specialty assets, our experienced teams and proven processes are designed to protect what can’t be replaced—every step of the way.', 'mccollisters'),
        ],
        [
            'title' => __('Asset Based Strength', 'mccollisters'),
            'desc'  => __('As an asset-based company, McCollister’s owns and operates the equipment, facilities, and fleet behind our services. That means greater control, higher standards, and consistent execution—without relying on layers of third parties when precision and accountability matter most.', 'mccollisters'),
        ],
        [
            'title' => __('Turnkey Solutions', 'mccollisters'),
            'desc'  => __('From first mile to final delivery, McCollister’s manages every stage under one roof—transportation, warehousing, installation, and logistics—so you work with a single, accountable partner instead of a patchwork of vendors.', 'mccollisters'),
        ],
        [
            'title' => __('Technology Driven Control', 'mccollisters'),
            'desc'  => __('Real-time tracking, transparent reporting, and integrated systems give you full visibility into every shipment. Our technology keeps you informed and in control from pickup to delivery.', 'mccollisters'),
        ],
        [
            'title' => __('Proven Experience', 'mccollisters'),
            'desc'  => __('Eight decades of moving what matters most. McCollister’s brings the expertise, discipline, and proven track record that only comes from generations of hands-on logistics leadership.', 'mccollisters'),
        ],
    ];
    ?>
    <section class="home-features">
        <div class="home-features__grid">
            <div class="home-features__media">
                <?php /* width/height give the browser an aspect ratio to reserve (CLS);
                         the rendered size stays governed by .home-features__img in CSS. */ ?>
                <img
                    class="home-features__img"
                    src="<?php echo esc_url($features_image); ?>"
                    alt="<?php esc_attr_e('McCollister’s Freightliner truck', 'mccollisters'); ?>"
                    width="992"
                    height="792"
                    loading="lazy"
                    decoding="async"
                >
            </div>

            <div class="home-features__content">
                <p class="home-features__eyebrow">/ <?php esc_html_e('features', 'mccollisters'); ?> /</p>
                <h2 class="home-features__title"><?php esc_html_e('Confidence with McCollister’s', 'mccollisters'); ?></h2>

                <div class="home-features__accordion" data-accordion>
                    <?php foreach ($features as $index => $feature) : ?>
                        <details class="home-features__item"<?php echo $index === 0 ? ' open' : ''; ?>>
                            <summary class="home-features__summary">
                                <span class="home-features__num"><?php echo esc_html(sprintf('%02d', $index + 1)); ?>.</span>
                                <span class="home-features__label"><?php echo esc_html($feature['title']); ?></span>
                                <span class="home-features__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </summary>
                            <div class="home-features__panel">
                                <p><?php echo esc_html($feature['desc']); ?></p>
                            </div>
                        </details>
                    <?php endforeach; ?>
                </div>

                <a class="mcc-btn mcc-btn--on-light home-features__cta" href="<?php echo esc_url(home_url('/about-us/')); ?>">
                    <span class="mcc-btn__label"><?php esc_html_e('Explore', 'mccollisters'); ?></span>
                    <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
                </a>
            </div>
        </div>
    </section>

    <?php
    // Industries — dark container-textured band with an infinite, auto-scrolling
    // carousel of industry cards. Each card links to its industry page and
    // reveals a brand-blue gradient on hover.
    $ind_uploads   = trailingslashit(wp_get_upload_dir()['baseurl']);
    $industries_bg = mcc_get_theme_option('mcc_industries_bg', '');
    if ($industries_bg === '') {
        $industries_bg = $ind_uploads . '2026/05/landing-page-background-100-1.jpg';
    }
    $industries = [
        [__('Aerospace', 'mccollisters'), '/aerospace/', '2026/05/mccollisters-industrys_0023_layer-3.jpg'],
        [__('Auto Transport', 'mccollisters'), '/auto-transport/', '2026/05/mccollisters-industrys_0014_layer-13.jpg'],
        [__('Commercial Relocation', 'mccollisters'), '/commercial-relocation/', '2026/05/mccollisters-icomm-relo.jpg'],
        [__('Technical Services', 'mccollisters'), '/technical-services/', '2026/05/mccollisters-industrys_0019_layer-8.jpg'],
        [__('Residential Relocation', 'mccollisters'), '/residential-relocation/', '2026/05/mccollisters-industrys_0005_layer-21.jpg'],
        [__('Fitness', 'mccollisters'), '/fitness/', '2026/05/gym-rat-1.jpg'],
    ];
    ?>
    <section class="home-industries" style="background-image: url('<?php echo esc_url($industries_bg); ?>');">
        <div class="home-industries__head">
            <p class="home-industries__eyebrow">/ <?php esc_html_e('industries', 'mccollisters'); ?> /</p>
            <h2 class="home-industries__title"><?php echo wp_kses(__('Specialty<br>Solutions for<br>Every Industry', 'mccollisters'), ['br' => []]); ?></h2>
        </div>

        <div class="home-industries__carousel">
            <?php // Two identical passes scroll as one seamless loop; the second is hidden from assistive tech. ?>
            <div class="home-industries__track">
                <?php for ($pass = 0; $pass < 2; $pass++) : ?>
                    <?php foreach ($industries as [$ind_name, $ind_path, $ind_img]) : ?>
                        <a
                            class="home-industry"
                            href="<?php echo esc_url(home_url($ind_path)); ?>"
                            <?php echo $pass === 1 ? 'aria-hidden="true" tabindex="-1"' : ''; ?>
                        >
                            <span class="home-industry__bg">
                                <img
                                    class="home-industry__img"
                                    src="<?php echo esc_url($ind_uploads . $ind_img); ?>"
                                    alt="<?php echo $pass === 1 ? '' : esc_attr($ind_name); ?>"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <span class="home-industry__scrim" aria-hidden="true"></span>
                                <span class="home-industry__hover" aria-hidden="true"></span>
                            </span>
                            <span class="home-industry__label"><?php echo esc_html($ind_name); ?></span>
                        </a>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <?php
    // Expertise / stats — "The McCollister's Difference": three animated figures
    // with a label, description, and a short list of supporting points.
    $stat_arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6 18 18M18 9V18H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $stats      = [
        [
            'to'       => '1.8',
            'from'     => '0.1',
            'decimals' => 1,
            'suffix'   => 'M',
            'label'    => __('Warehouse Square Footage', 'mccollisters'),
            'desc'     => __('McCollister’s offers 1.8 million square feet of available warehouse capacity, purpose-built to support sophisticated storage, distribution, and fulfillment at scale.', 'mccollisters'),
            'points'   => [__('Extensive Footprint', 'mccollisters'), __('Seamless Integration', 'mccollisters'), __('Operational Precision', 'mccollisters')],
        ],
        [
            'to'       => '98.8',
            'from'     => '20',
            'decimals' => 1,
            'suffix'   => '%',
            'label'    => __('On-time Delivery', 'mccollisters'),
            'desc'     => __('McCollister’s delivers with consistency and discipline, achieving a 98.8% on-time delivery rate across complex, high-value logistics operations.', 'mccollisters'),
            'points'   => [__('Delivery Reliability', 'mccollisters'), __('Schedule Discipline', 'mccollisters'), __('Proven Performance', 'mccollisters')],
        ],
        [
            'to'       => '0.15',
            'from'     => '20',
            'decimals' => 2,
            'suffix'   => '%',
            'label'    => __('Claims Ratio', 'mccollisters'),
            'desc'     => __('McCollister’s maintains a claims ratio of just 0.15%, meaning only a small percentage of shipments result in a damage or loss claim—reflecting disciplined handling and care.', 'mccollisters'),
            'points'   => [__('Risk Mitigation', 'mccollisters'), __('Careful Handling', 'mccollisters'), __('Consistent Quality', 'mccollisters')],
        ],
    ];
    ?>
    <section class="home-stats">
        <div class="home-stats__inner">
            <p class="home-stats__eyebrow">/ <?php esc_html_e('expertise', 'mccollisters'); ?> /</p>
            <h2 class="home-stats__title"><?php echo wp_kses(__('The McCollister’s<br>Difference', 'mccollisters'), ['br' => []]); ?></h2>

            <div class="home-stats__grid">
                <?php foreach ($stats as $stat) : ?>
                    <div class="home-stat">
                        <p class="home-stat__number">
                            <span
                                class="home-stat__value"
                                data-count-to="<?php echo esc_attr($stat['to']); ?>"
                                data-count-from="<?php echo esc_attr($stat['from']); ?>"
                                data-count-decimals="<?php echo esc_attr($stat['decimals']); ?>"
                            ><?php echo esc_html($stat['to']); ?></span><span class="home-stat__suffix"><?php echo esc_html($stat['suffix']); ?></span>
                        </p>
                        <h3 class="home-stat__label"><?php echo esc_html($stat['label']); ?></h3>
                        <hr class="home-stat__divider">
                        <p class="home-stat__desc"><?php echo esc_html($stat['desc']); ?></p>
                        <ul class="home-stat__list">
                            <?php foreach ($stat['points'] as $point) : ?>
                                <li>
                                    <span class="home-stat__list-icon" aria-hidden="true"><?php echo $stat_arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
                                    <?php echo esc_html($point); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    // Testimonials — autoplaying fade slider (pauses on hover) with a progress
    // counter and dot navigation.
    $testimonials = [
        [
            'name'    => __('Chris Owen', 'mccollisters'),
            'company' => __('World Wide Technology (WWT)', 'mccollisters'),
            'paras'   => [
                __('I have worked with McCollister’s for over 25 years, supporting our transportation operations out of Edwardsville. They have been a reliable and professional partner, consistently delivering on schedule while safely handling high-value technology equipment.', 'mccollisters'),
                __('Their team is responsive, flexible, and understands the importance of meeting our operational demands. McCollister’s has been a trusted extension of our operation, and I highly recommend them as a transportation and logistics partner.', 'mccollisters'),
            ],
        ],
        [
            'name'    => __('Ruth Lazalde', 'mccollisters'),
            'company' => __('WeSolve Workplace Environments', 'mccollisters'),
            'paras'   => [
                __('What sets McCollister’s apart is their people. I have had the pleasure of working with several locations as well as sales and management, and everyone on the team communicates clearly and makes things happen. The installation teams are prepared, professional, and knowledgeable. Truly a valued partner.', 'mccollisters'),
            ],
        ],
        [
            'name'    => __('Hanna Angle', 'mccollisters'),
            'company' => __('Store Development & Operations Leader, Kendra Scott', 'mccollisters'),
            'paras'   => [
                __('We’ve been proud to partner with McCollister’s for over 10 years, and they’ve consistently been a team we can rely on. No matter the situation—big or small—they’re always willing to jump in and help however they can. Over the years they’ve worked closely with us to uncover meaningful cost savings across a variety of projects, which has made a real impact on our operations. Their support, flexibility, and easygoing approach make them a great partner, and we truly value the relationship we’ve built together.', 'mccollisters'),
            ],
        ],
        [
            'name'    => __('Shimon Kringel', 'mccollisters'),
            'company' => __('VP Operations NAM, SolarEdge', 'mccollisters'),
            'paras'   => [
                __('Working with the McCollister’s team has been an incredibly positive experience. Their professionalism, dedication, execution and expertise have truly stood out in the last 10 years plus. One of the aspects I value most about our partnership is how seamlessly the McCollister’s team integrates with our goals, providing unwavering support and solutions that drive our success. The impact of their work on our organization has been significant, making our operations smoother and more efficient.', 'mccollisters'),
            ],
        ],
    ];
    ?>
    <?php $quote_img = trailingslashit(wp_get_upload_dir()['baseurl']) . '2026/05/Quotation-Marks-Blue.svg'; ?>
    <section class="home-testimonials">
        <div class="home-testimonials__inner">
            <img
                class="home-testimonials__mark"
                src="<?php echo esc_url($quote_img); ?>"
                alt=""
                aria-hidden="true"
                width="513"
                height="402"
                loading="lazy"
                decoding="async"
            >

            <div class="home-testimonials__body">
                <h2 class="home-testimonials__title"><?php esc_html_e('What Customers Are Saying', 'mccollisters'); ?></h2>

                <div class="home-testimonials__slider" data-slider>
                    <div class="home-testimonials__slides" data-slider-track>
                        <?php foreach ($testimonials as $t_index => $t) : ?>
                            <blockquote class="home-testimonials__slide<?php echo $t_index === 0 ? ' is-active' : ''; ?>" data-slider-slide>
                                <div class="home-testimonials__quote">
                                    <?php foreach ($t['paras'] as $t_para) : ?>
                                        <p><?php echo esc_html($t_para); ?></p>
                                    <?php endforeach; ?>
                                </div>
                                <footer class="home-testimonials__author">
                                    <span class="home-testimonials__name"><?php echo esc_html($t['name']); ?></span>
                                    <span class="home-testimonials__company"><?php echo esc_html($t['company']); ?></span>
                                </footer>
                            </blockquote>
                        <?php endforeach; ?>
                    </div>

                    <div class="home-testimonials__footer">
                        <div class="home-testimonials__progress">
                            <span class="home-testimonials__current" data-slider-current>01</span> / <span class="home-testimonials__total"><?php echo esc_html(sprintf('%02d', count($testimonials))); ?></span>
                        </div>
                        <div class="home-testimonials__dots">
                            <?php foreach ($testimonials as $t_index => $t) : ?>
                                <button
                                    type="button"
                                    class="home-testimonials__dot<?php echo $t_index === 0 ? ' is-active' : ''; ?>"
                                    data-slider-dot
                                    aria-label="<?php /* translators: %d: testimonial number */ printf(esc_attr__('Show testimonial %d', 'mccollisters'), $t_index + 1); ?>"
                                ></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    // Blog — latest three posts with date, category, title, excerpt, and image.
    $blog_query = new WP_Query([
        'post_type'           => 'post',
        'posts_per_page'      => 3,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    ]);

    if ($blog_query->have_posts()) :
        $posts_page = get_option('page_for_posts');
        $blog_url   = $posts_page ? get_permalink($posts_page) : home_url('/blog/');
        $blog_arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    ?>
    <section class="home-blog">
        <div class="home-blog__inner">
            <div class="home-blog__head">
                <div>
                    <p class="home-blog__eyebrow">/ <?php esc_html_e('blog', 'mccollisters'); ?> /</p>
                    <h2 class="home-blog__title"><?php
                        // Desktop breaks after "Latest"/"From" (3 lines); mobile
                        // breaks after "Articles" (2 lines) — toggled in CSS.
                        esc_html_e('See Latest', 'mccollisters');
                        echo '<br class="home-blog__br--d"> ';
                        esc_html_e('Articles', 'mccollisters');
                        echo '<br class="home-blog__br--m"> ';
                        esc_html_e('From', 'mccollisters');
                        echo '<br class="home-blog__br--d"> ';
                        esc_html_e('Our Company', 'mccollisters');
                    ?></h2>
                </div>
                <a class="mcc-btn mcc-btn--on-light home-blog__cta home-blog__cta--desktop" href="<?php echo esc_url($blog_url); ?>">
                    <span class="mcc-btn__label"><?php esc_html_e('See All Posts', 'mccollisters'); ?></span>
                    <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $blog_arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
                </a>
            </div>

            <div class="home-blog__viewport">
            <div class="home-blog__grid">
                <?php
                while ($blog_query->have_posts()) :
                    $blog_query->the_post();
                    $categories   = get_the_category();
                    $blog_cat     = !empty($categories) ? $categories[0] : null;
                    ?>
                    <article class="home-blog__card">
                        <div class="home-blog__card-meta">
                            <a href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))); ?>">
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('m.d.Y')); ?></time>
                            </a>
                            <?php if ($blog_cat) : ?>
                                <span class="home-blog__dot" aria-hidden="true"></span>
                                <a class="home-blog__cat" href="<?php echo esc_url(get_category_link($blog_cat)); ?>"><?php echo esc_html($blog_cat->name); ?></a>
                            <?php endif; ?>
                        </div>
                        <hr class="home-blog__divider">
                        <h3 class="home-blog__card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="home-blog__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                        <?php if (has_post_thumbnail()) : ?>
                            <a class="home-blog__card-media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail('large', ['class' => 'home-blog__card-img', 'loading' => 'lazy', 'decoding' => 'async']); ?>
                            </a>
                        <?php endif; ?>
                    </article>
                <?php endwhile; ?>
            </div>
            </div>

            <?php // Mobile-only: "See All Posts" sits below the articles. ?>
            <a class="mcc-btn mcc-btn--on-light home-blog__cta home-blog__cta--mobile" href="<?php echo esc_url($blog_url); ?>">
                <span class="mcc-btn__label"><?php esc_html_e('See All Posts', 'mccollisters'); ?></span>
                <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $blog_arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
            </a>
        </div>
    </section>
    <?php
        wp_reset_postdata();
    endif;
    ?>

    <!-- CTA cards -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
