<?php
/**
 * Template Name: Page — About Us
 *
 * Hard-coded About page (slug: about-us). Editable content lives in the
 * variables up top so it can later map to ACF. Reuses the global components:
 * .section-head, .mcc-btn, the .svc-integrated icon-card grid — and service.css.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/02/transportation-hero.jpg',
    'title'    => 'About Us',
    'subtitle' => 'When precision, care, and reliability are non-negotiable, it must be McCollister’s.',
    'buttons'  => [
        ['label' => 'Locations', 'url' => home_url('/locations/')],
        ['label' => 'Contact Us', 'url' => home_url('/contact-us/')],
    ],
    'video'    => 'https://player.vimeo.com/video/1199843762?autoplay=1&title=0&byline=0&portrait=0',
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Who We Are',
    'paras'   => [
        'McCollister’s is a leading provider of specialized transportation and logistics services for commercial and residential clients. As an asset-based provider, we offer comprehensive warehousing, transportation, and logistics solutions. From moving automobiles and high-value goods to managing aerospace, fitness, and financial institution projects, we bring expertise and precision to every move.',
        'Our specialties also include large medical device shipping and installation support, full data center relocations and decommissioning, telecommunications and infrastructure transportation, exhibit transport for cultural institutions and touring theater productions, and flawless retail store setups and closures.',
        'Proudly affiliated with UniGroup, Inc. — the parent company of both United Van Lines and Mayflower Transit — we are one of the nation’s most established partners in the moving industry. As the nation’s leading corporate mover and most recognized name in the business, UniGroup’s network strengthens our national reach while empowering us to maintain the personalized service and operational accountability our customers expect.',
    ],
];

$serve = [
    'title' => 'Who We Serve',
    'intro' => 'Fortune 500 companies, military organizations, hospitality groups, and businesses of all sizes trust McCollister’s to transport their most sophisticated equipment and high-value products. Below are just a few of the industries we serve:',
    'cards' => [
        ['label' => 'Aerospace',          'url' => home_url('/aerospace/'),          'image' => $uploads . '2026/02/spacex-gantry2.jpg',        'style' => 'background-position: top center;'],
        ['label' => 'Fitness',             'url' => home_url('/fitness/'),            'image' => $uploads . '2026/03/about-us-yelloow-shorts.jpg', 'style' => 'background-position: center;'],
        ['label' => 'Technical Services',  'url' => home_url('/technical-services/'), 'image' => $uploads . '2026/02/data-center-lockup-1.jpg',  'style' => 'background-position: top center;'],
        ['label' => 'Auto Transport',      'url' => home_url('/auto-transport/'),     'image' => $uploads . '2026/02/antique-car-lockup1.jpg',   'style' => 'background-position: center;'],
        ['label' => 'Warehousing',         'url' => home_url('/warehousing/'),        'image' => $uploads . '2026/03/warehouse-racks2.jpg',      'style' => 'background-position: center;'],
    ],
];

$history = [
    'title'  => 'Our History<br>At A Glance',
    'intro'  => 'Eighty years of experience isn’t something you achieve by accident. From a small cartage company in Burlington, New Jersey to a national network of specialized transportation, warehousing, logistics, and installation services, every chapter of McCollister’s history reflects the same foundation: a family-owned company that treats its people well, holds itself to an uncompromising standard, and earns its customers’ trust one move at a time.',
    'button' => ['label' => 'Explore', 'url' => home_url('/history/')],
    'eras'   => [
        [
            'year'  => '1945',
            'title' => 'Founded to Meet Post-War Demand',
            'text'  => 'McCollister’s was founded on November 1, 1945, in Burlington, New Jersey, by Daniel H. McCollister, Sr., following the acquisition of Dixon’s Express.',
        ],
        [
            'year'  => '1955',
            'title' => 'Scaling Capacity and Extending Reach',
            'text'  => 'As demand increased, McCollister’s invested heavily in infrastructure, including the construction of its flagship Route 130 warehouse, early fleet expansion, and standardized operating procedures.',
        ],
        [
            'year'  => '1965',
            'title' => 'Diversification to Overcome Seasonality',
            'text'  => 'To reduce reliance on seasonal household moves, McCollister’s expanded into military relocations during the Vietnam War and launched McCollister’s Express, adding freight, commercial, and office moving services.',
        ],
        [
            'year'  => '1975',
            'title' => 'Innovation Driving Specialization',
            'text'  => 'During the 1970s, McCollister’s evolved from a traditional mover into a specialized logistics provider.',
        ],
        [
            'year'  => '1985',
            'title' => 'Deregulation as an Opportunity for Expansion',
            'text'  => 'Following the Household Goods Transportation Act of 1980, McCollister’s leveraged deregulation to expand nationally, opening facilities in major US markets and strengthening its operating network.',
        ],
        [
            'year'  => '1995',
            'title' => 'Advancing Industry Capabilities and Market Presence',
            'text'  => 'During the 1990s, McCollister’s expanded services to support growing technology and telecommunications programs, enhanced medical device logistics capabilities, and added hospitality support through furniture, fixtures, and equipment (FF&E) delivery and installation.',
        ],
        [
            'year'  => '2005',
            'title' => 'Expansion, Innovation, and Specialized Industry Growth',
            'text'  => 'In the early 2000s, McCollister’s expanded nationwide through the acquisition of a fitness installation company, growing McCollister’s Fitness Systems into the largest fitness installation team in the country.',
        ],
        [
            'year'  => '2015',
            'title' => 'Strategic Expansion, Specialized Services, and Operational Modernization',
            'text'  => 'Throughout the 2010s, McCollister’s expanded into auto transport, entertainment logistics, and large-scale medical device installations, supporting complex national programs for manufacturers, healthcare systems, and touring productions.',
        ],
        [
            'year'  => '2025',
            'title' => 'Resilience, Growth, and Digital Leadership',
            'text'  => 'During the 2020s, McCollister’s supported critical national supply chains throughout the COVID-19 pandemic while accelerating its digital transformation.',
        ],
    ],
];

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
            'icon'  => $uploads . '2026/06/Certifications-About-Us-i.png',
            'title' => 'Certifications',
            'url'   => home_url('/forms-certifications-documents/') . '#credentials',
            'text'  => 'Find important forms, certifications, and helpful guides.',
        ],
        [
            'icon'  => $uploads . '2026/06/Careers-About-Us-i.png',
            'title' => 'Careers',
            'url'   => home_url('/careers/'),
            'text'  => 'Learn more about working for McCollister’s and view open positions.',
        ],
        [
            'icon'  => $uploads . '2026/06/ESG-Practices-About-Us-i.png',
            'title' => 'ESG Practices',
            'url'   => home_url('/esg/'),
            'text'  => 'Explore the principles that guide our company and commitment to customers.',
        ],
    ],
];
?>
<?php mcc_video_schema('1199843762'); ?>
<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="svc-hero svc-hero--about" style="background-image: url('<?php echo esc_url($hero['image']); ?>');">
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
        <button type="button" class="mcc-video-btn svc-hero__video" data-video-open>Watch Our Video</button>
    </section>

    <!-- Overview: Who We Are -->
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

    <!-- Who We Serve -->
    <section class="svc-section svc-serve">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $serve['title'],
            ]); ?>
            <div class="svc-prose svc-serve__intro">
                <p><?php echo esc_html($serve['intro']); ?></p>
            </div>
            <div class="svc-serve__grid">
                <?php foreach ($serve['cards'] as $card) : ?>
                    <a class="svc-serve__card" href="<?php echo esc_url($card['url']); ?>" style="background-image: url('<?php echo esc_url($card['image']); ?>'); <?php echo esc_attr($card['style']); ?>">
                        <span class="svc-serve__label"><?php echo esc_html($card['label']); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Our History At A Glance -->
    <section class="svc-section svc-history">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $history['title'],
            ]); ?>
            <div class="svc-prose">
                <p><?php echo esc_html($history['intro']); ?></p>
            </div>
        </div>

        <!-- Auto-scrolling timeline (reuses the marquee mechanism; pauses on hover) -->
        <div class="svc-logos svc-history-slider">
            <div class="svc-logos__track">
                <?php for ($g = 0; $g < 2; $g++) : ?>
                    <div class="svc-logos__group">
                        <?php foreach ($history['eras'] as $era) : ?>
                            <div class="svc-history-card"<?php echo 0 === $g ? '' : ' aria-hidden="true"'; ?>>
                                <p class="svc-history-card__year"><?php echo esc_html($era['year']); ?></p>
                                <hr class="svc-history-card__divider">
                                <h3 class="svc-history-card__title"><?php echo esc_html($era['title']); ?></h3>
                                <p class="svc-history-card__text"><?php echo esc_html($era['text']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="svc-section__inner">
            <a class="mcc-btn mcc-btn--on-light svc-history__cta" href="<?php echo esc_url($history['button']['url']); ?>">
                <span class="mcc-btn__label"><?php echo esc_html($history['button']['label']); ?></span>
                <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
            </a>
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

    <!-- CTA cards (reusable component; defaults to the standard two cards) -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

    <!-- Video modal (Vimeo) -->
    <div class="svc-video" id="mcc-video-modal" hidden>
        <div class="svc-video__overlay" data-video-close></div>
        <div class="svc-video__box" role="dialog" aria-modal="true" aria-label="Watch our video">
            <button type="button" class="svc-video__close" data-video-close aria-label="Close video">&times;</button>
            <div class="svc-video__frame"></div>
        </div>
    </div>
    <script>
        (function () {
            var modal = document.getElementById('mcc-video-modal');
            if (!modal) { return; }
            var frame = modal.querySelector('.svc-video__frame');
            var src = <?php echo wp_json_encode($hero['video']); ?>;

            function openModal(event) {
                event.preventDefault();
                frame.innerHTML = '<iframe src="' + src + '" title="Video player" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
                modal.hidden = false;
                document.body.style.overflow = 'hidden';
            }
            function closeModal() {
                modal.hidden = true;
                frame.innerHTML = '';
                document.body.style.overflow = '';
            }

            document.querySelectorAll('[data-video-open]').forEach(function (btn) {
                btn.addEventListener('click', openModal);
            });
            modal.querySelectorAll('[data-video-close]').forEach(function (el) {
                el.addEventListener('click', closeModal);
            });
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !modal.hidden) { closeModal(); }
            });
        })();
    </script>

</main>
<?php get_footer(); ?>
