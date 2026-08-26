<?php
/**
 * Template Name: Page — Our History
 *
 * Hard-coded History page (slug: history). Editable content lives in the
 * variables up top so it can later map to ACF. Includes an interactive vertical
 * timeline (components.js → initHistorySlider), the "Today and Beyond" block
 * with a video modal, and the .svc-integrated "More About" cards.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$chevron = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9 12 15 18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$header = [
    'crumb' => 'mccollister’s',
    'title' => 'Our History',
];

$eras = [
    [
        'year'  => '1945',
        'image' => $uploads . '2025/12/etw-20191112-0027.jpg',
        'title' => 'Founded To<br>Meet Post-War<br>Demand',
        'text'  => 'McCollister’s was founded on November 1, 1945, in Burlington, New Jersey, by Daniel H. McCollister, Sr., following the acquisition of Dixon’s Express. Amid rapid post-war relocation and economic transition, the company was established to deliver reliable, professional moving services at a time when consistency and trust were in short supply. From its earliest days, McCollister’s emphasized disciplined operations, customer accountability, and long-term relationships.',
    ],
    [
        'year'  => '1955',
        'image' => $uploads . '2026/01/1950s-man.jpg',
        'title' => 'Scaling<br>Capacity &<br>Extending<br>Reach',
        'text'  => 'As demand increased, McCollister’s invested heavily in infrastructure, including the construction of its flagship Route 130 warehouse, early fleet expansion, and standardized operating procedures. Becoming a United Van Lines agent in 1950 and a stockholder in 1953 enabled the company to establish a nationwide service network while preserving strong regional execution and customer accountability.',
    ],
    [
        'year'  => '1965',
        'image' => $uploads . '2026/01/mccollisters-history-60s-woman.jpg',
        'title' => 'Diversification<br>To Overcome<br>Seasonality',
        'text'  => 'To reduce reliance on seasonal household moves, McCollister’s expanded into military relocations during the Vietnam War and launched McCollister’s Express, adding freight, commercial, and office moving services. As computer technology emerged, the company partnered with manufacturers to develop specialized transport solutions, including early testing of air-ride suspension and equipment upgrades to protect high-value technology. In 1967, H. Daniel McCollister assumed leadership, accelerating national growth and formalizing the service discipline known as the “McCollister’s Touch.”',
    ],
    [
        'year'  => '1975',
        'image' => $uploads . '2026/04/mccollisters-image-from-1970s.jpg',
        'title' => 'Innovation<br>Driving<br>Specialization',
        'text'  => 'During the 1970s, McCollister’s evolved from a traditional mover into a specialized logistics provider. The adoption of air-ride suspension and expansion of its proprietary crane fleet—enclosed trailers with integrated hydraulic cranes—enabled precision transport and placement of large-scale computer and telecommunications systems nationwide for companies such as IBM and AT&T. Investments in headquarters infrastructure, systems, and workforce development positioned the organization for scalable, multi-site operations.',
    ],
    [
        'year'  => '1985',
        'image' => $uploads . '2026/03/mccollisters-1985-history-image2.jpg',
        'title' => 'Deregulation As<br>An Opportunity<br>For Expansion',
        'text'  => 'Following the Household Goods Transportation Act of 1980, McCollister’s leveraged deregulation to expand nationally, opening facilities in major US markets and strengthening its operating network. Service offerings broadened to include packaging, crating, asset management, and regional distribution. Continued investment in temperature-controlled and crane-equipped equipment supported rapid growth in technology, telecommunications, and medical device logistics, reinforcing McCollister’s position as a white-glove logistics leader.',
    ],
    [
        'year'  => '1995',
        'image' => $uploads . '2026/02/mccollister-1995-history-image4.jpg',
        'title' => 'Advancing<br>Industry<br>Capabilities &<br>Market<br>Presence',
        'text'  => 'During the 1990s, McCollister’s expanded services to support growing technology and telecommunications programs, enhanced medical device logistics capabilities, and added hospitality support through furniture, fixtures, and equipment (FF&E) delivery and installation. The company also entered the financial sector with ATM installation services and established a stronger presence in northern and southern California, further extending its national footprint.',
    ],
    [
        'year'  => '2005',
        'image' => $uploads . '2026/02/mccollister-2005-history-image.jpeg',
        'title' => 'Innovation<br>& Specialized<br>Industry<br>Growth',
        'text'  => 'In the early 2000s, McCollister’s expanded nationwide through the acquisition of a fitness installation company, growing McCollister’s Fitness Systems into the largest fitness installation team in the country. The company broadened specialized service offerings to support aerospace and advanced manufacturing clients requiring precision handling and installation. During this decade, H. Daniel McCollister became Chairman of UniGroup, advanced logistics technologies were adopted, and a new Orlando, Florida location opened to support specialized industry programs.',
    ],
    [
        'year'  => '2015',
        'image' => $uploads . '2026/02/mccollister-2025-history-image.jpeg',
        'title' => 'Strategic<br>Expansion<br>& Operational<br>Modernization',
        'text'  => 'Throughout the 2010s, McCollister’s expanded into auto transport, entertainment logistics, and large-scale medical device installations, supporting complex national programs for manufacturers, healthcare systems, and touring productions. In 2016, the company earned ISO 13485 certification, reinforcing its leadership in regulated medical logistics. The relocation to a modern, eco-friendly 90,000-square-foot headquarters reflected continued investment in systems, sustainability, and workforce capacity.',
    ],
    [
        'year'  => '2025',
        'image' => $uploads . '2026/01/McCollister2.jpg',
        'title' => 'Resilience,<br>Growth, &<br>Digital<br>Leadership',
        'text'  => 'During the 2020s, McCollister’s supported critical national supply chains throughout the COVID-19 pandemic while accelerating its digital transformation. The company expanded its multi-state footprint, integrated acquired operations, and deployed advanced analytics, automation, and IoT-based tracking. Under the leadership of our current Chairman, Daniel H. McCollister II, McCollister’s operates as a fully integrated first- and final-mile logistics platform supporting enterprise supply chains across North America.',
    ],
];

$today = [
    'title' => 'Today And<br>Beyond',
    'paras' => [
        'Now with 15 full-service locations, a vast network of over 300 partner agents, and a diverse range of assets capable of handling specialized logistics needs across industries, McCollister’s has grown exponentially since 1945.',
        'McCollister’s continues to embody its founding principles while embracing modern technology, sustainability, and progressive strategies to address today’s complex logistics challenges. Whether moving priceless artifacts, satellites, sensitive medical equipment, or critical IT infrastructure, McCollister’s remains committed to excellence, safety, and customer satisfaction.',
    ],
    'video' => 'https://player.vimeo.com/video/1199843773?autoplay=1&title=0&byline=0&portrait=0',
];

$more = [
    'title' => 'More About<br>McCollister’s',
    'cards' => [
        [
            'icon'  => $uploads . '2026/06/Careers-About-Us-i.png',
            'title' => 'Careers',
            'url'   => home_url('/careers/'),
            'text'  => 'Learn more about working for McCollister’s and view open positions.',
        ],
        [
            'icon'  => $uploads . '2026/06/About-Us-Our-Team-i.png',
            'title' => 'About Us',
            'url'   => home_url('/about-us/'),
            'text'  => 'Learn more about who we are, who we serve, and what we do.',
        ],
        [
            'icon'  => $uploads . '2026/06/In-The-News-Our-History-i.png',
            'title' => 'In The News',
            'url'   => home_url('/blog/'),
            'text'  => 'Check out our latest press releases, news coverage, and company updates.',
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
<main id="primary" class="site-main">

    <!-- Header -->
    <section class="svc-section hist-head">
        <div class="svc-section__inner">
            <p class="hist-head__crumb">/ <?php echo esc_html($header['crumb']); ?> /</p>
            <h1 class="hist-head__title"><?php echo esc_html($header['title']); ?></h1>
        </div>
    </section>

    <!-- Interactive timeline -->
    <section class="hist-timeline">
        <div class="hist-timeline__inner">
            <div class="hist-slider" data-hist-slider>
                <div class="hist-slider__stage">
                    <?php foreach ($eras as $i => $era) : ?>
                        <div class="hist-slider__slide<?php echo 0 === $i ? ' is-active' : ''; ?>" data-hist-slide="<?php echo esc_attr($i); ?>"<?php echo 0 === $i ? '' : ' aria-hidden="true"'; ?>>
                            <div class="hist-slider__slide-bg" style="background-image: url('<?php echo esc_url($era['image']); ?>');"></div>
                            <div class="hist-slider__content">
                                <p class="hist-slider__eyebrow">/ <?php echo esc_html($era['year']); ?> /</p>
                                <h2 class="hist-slider__title"><?php echo wp_kses($era['title'], ['br' => []]); ?></h2>
                                <p class="hist-slider__text"><?php echo esc_html($era['text']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <nav class="hist-slider__nav" aria-label="Timeline years">
                    <div class="hist-slider__years">
                        <?php foreach ($eras as $i => $era) : ?>
                            <button type="button" class="hist-slider__year<?php echo 0 === $i ? ' is-active' : ''; ?>" data-hist-go="<?php echo esc_attr($i); ?>"><?php echo esc_html($era['year']); ?></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="hist-slider__arrows">
                        <button type="button" class="hist-slider__arrow hist-slider__arrow--prev" data-hist-prev aria-label="Previous year"><?php echo $chevron; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
                        <button type="button" class="hist-slider__arrow hist-slider__arrow--next" data-hist-next aria-label="Next year"><?php echo $chevron; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
                    </div>
                </nav>
            </div>
        </div>
    </section>

    <!-- Today and Beyond -->
    <section class="svc-section hist-today">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $today['title'],
            ]); ?>
            <div class="svc-prose">
                <?php foreach ($today['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <button type="button" class="mcc-video-btn mcc-video-btn--outline hist-today__video" data-video-open>Watch Our Video</button>
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
            var src = <?php echo wp_json_encode($today['video']); ?>;

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
