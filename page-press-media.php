<?php
/**
 * Template Name: Page — Press & Media
 *
 * Hard-coded Press & Media page (slug: press-media). A hero over a list of
 * external press releases (each opens in a new tab), then the shared
 * .svc-integrated "More About" cards and the CTA cards.
 *
 * @package McCollisters
 */

get_header();

$uploads   = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow     = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$ext_icon  = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M14 4h6v6M20 4 11 13M18 13v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$eye_icon  = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/03/mccollisters-press-releases.jpg',
    'title'    => 'Press &amp; Media',
    'subtitle' => 'Explore the latest happenings at McCollister’s through our press releases, company announcements, and featured articles',
    'buttons'  => [
        ['label' => 'History', 'url' => home_url('/history/')],
        ['label' => 'Contact Us', 'url' => home_url('/contact-us/')],
    ],
];

$press = [
    [
        'title' => 'Behind The Docks - Episode 17: Tyler Yoos From McCollister’s',
        'url'   => 'https://www.youtube.com/watch?v=vbtMgar4vCU',
        'date'  => 'Jul 23, 2026',
    ],
    [
        'title' => 'Cardinals Gear Is Heading to Jupiter and Their Movers Love It',
        'url'   => 'https://spectrumlocalnews.com/mo/st-louis/news/2026/02/02/st-louis-cardinals-jupiter-spring-training-united-van-lines-a-mrazek-moving-systems',
        'date'  => 'Feb. 02, 2026',
    ],
    [
        'title' => 'McCollister’s Celebrates 80 Years',
        'url'   => 'https://www.prnewswire.com/news-releases/mccollisters-celebrates-80-years-of-innovation-service-and-dedication-302604688.html',
        'date'  => 'Nov 05, 2025',
    ],
    [
        'title' => 'McCollister’s to Acquire A-Mrazek Moving',
        'url'   => 'https://www.prnewswire.com/news-releases/mccollisters-global-services-inc-to-acquire-a-mrazek-moving-systems-302381891.html',
        'date'  => 'Feb 21, 2025',
    ],
    [
        'title' => 'McCollister’s Strengthens Latest Technology to Serve Automotive Retailers',
        'url'   => 'https://www.prnewswire.com/news-releases/mccollisters-strengthens-latest-technology-to-serve-automotive-retailers-301642306.html',
        'date'  => 'Oct 06, 2022',
    ],
    [
        'title' => 'McCollister’s Acquires Horseless Carriage Carriers, Inc.',
        'url'   => 'https://www.prnewswire.com/news-releases/mccollisters-global-services-inc-continues-company-legacy-with-acquisition-of-horseless-carriage-carriers-inc-301616684.html',
        'date'  => 'Sep 01, 2022',
    ],
];

$more = [
    'title' => 'More About<br>McCollister’s',
    'cards' => [
        ['icon' => $uploads . '2026/06/About-Us-Our-Team-i.png', 'title' => 'About Us', 'url' => home_url('/about-us/'), 'text' => 'Learn more about who we are, who we serve, and what we do.'],
        ['icon' => $uploads . '2026/06/Our-Blog-Forms-Certifications-i.png', 'title' => 'Our Blog', 'url' => home_url('/blog/'), 'text' => 'Uncover our insights on innovations, trends, and issues shaping the industry.'],
        ['icon' => $uploads . '2026/06/Our-History-About-Us-i.png', 'title' => 'Our History', 'url' => home_url('/history/'), 'text' => 'Discover how we became the McCollister’s we are today.'],
        ['icon' => $uploads . '2026/06/ESG-Practices-About-Us-i.png', 'title' => 'ESG Practices', 'url' => home_url('/esg/'), 'text' => 'Explore the principles that guide our company and commitment to customers.'],
    ],
];
?>
<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="svc-hero svc-hero--press" style="background-image: url('<?php echo esc_url($hero['image']); ?>');">
        <div class="svc-hero__inner">
            <h1 class="svc-hero__title"><?php echo wp_kses($hero['title'], []); ?></h1>
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

    <!-- Press releases -->
    <section class="svc-section press">
        <div class="svc-section__inner">
            <ul class="press__list">
                <?php foreach ($press as $item) : ?>
                    <li class="press__item">
                        <a class="press__icon" href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($item['title']); ?>">
                            <?php echo $ext_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </a>
                        <div class="press__body">
                            <a class="press__title" href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener"><?php echo wp_kses($item['title'], []); ?></a>
                            <a class="press__url" href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener"><?php echo esc_html($item['url']); ?></a>
                            <span class="press__date"><?php echo esc_html($item['date']); ?></span>
                        </div>
                        <a class="press__view" href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener">
                            <span class="press__view-icon" aria-hidden="true"><?php echo $eye_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>View
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
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
