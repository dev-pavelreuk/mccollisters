<?php
/**
 * Template Name: Page — Contact Us
 *
 * Hard-coded Contact page (slug: contact-us). Editable content lives in the
 * variables up top so it can later map to ACF. A dark hero holds the Gravity
 * Forms "Contact Us" form (id 2) beside the contact copy + socials, followed by
 * the homepage testimonial slider, the .svc-integrated "More About" cards, and
 * the CTA cards.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'      => $uploads . '2025/11/landing-page-background-100-1.jpg',
    'form_title' => 'How Can We Help You?',
    'form'       => '[gravityform id="2" title="false"]',
    'eyebrow'    => 'contact us',
    'title'      => 'Get Moving<br>In The Right<br>Direction',
    'text'       => 'At McCollister’s, we take our dedication to customer service seriously. Once you start a project with us, you will have a dedicated point person to guide you through the process and answer any questions. In the meantime, please use the form on this page for any inquiries or comments, and we will respond promptly.',
];

$socials = [
    ['url' => 'https://www.instagram.com/mccollisters1945/', 'label' => 'Instagram', 'icon' => 'fab fa-instagram'],
    ['url' => 'https://www.facebook.com/McCollisters/', 'label' => 'Facebook', 'icon' => 'fab fa-facebook'],
    ['url' => 'https://www.linkedin.com/company/mccollister\'s-transportation/', 'label' => 'LinkedIn', 'icon' => 'fab fa-linkedin'],
    ['url' => 'https://www.youtube.com/@Mccollisters', 'label' => 'YouTube', 'icon' => 'fab fa-youtube'],
];

$quote_img    = $uploads . '2026/05/Quotation-Marks-Blue.svg';
$testimonials = [
    [
        'name'    => 'Shimon Kringel',
        'company' => 'VP Operations NAM, SolarEdge',
        'paras'   => [
            'Working with the McCollister’s team has been an incredibly positive experience. Their professionalism, dedication, execution and expertise have truly stood out in the last 10 years plus. One of the aspects I value most about our partnership is how seamlessly the McCollister’s team integrates with our goals, providing unwavering support and solutions that drive our success. The impact of their work on our organization has been significant, making our operations smoother and more efficient.',
        ],
    ],
    [
        'name'    => 'Hanna Angle',
        'company' => 'Store Development & Operations Leader, Kendra Scott',
        'paras'   => [
            'We’ve been proud to partner with McCollister’s for over 10 years, and they’ve consistently been a team we can rely on. No matter the situation—big or small—they’re always willing to jump in and help however they can. Over the years they’ve worked closely with us to uncover meaningful cost savings across a variety of projects, which has made a real impact on our operations. Their support, flexibility, and easygoing approach make them a great partner, and we truly value the relationship we’ve built together.',
        ],
    ],
    [
        'name'    => 'Ruth Lazalde',
        'company' => 'WeSolve Workplace Environments',
        'paras'   => [
            'What sets McCollister’s apart is their people. I have had the pleasure of working with several locations as well as sales and management, and everyone on the team communicates clearly and makes things happen. The installation teams are prepared, professional, and knowledgeable. Truly a valued partner.',
        ],
    ],
    [
        'name'    => 'Chris Owen',
        'company' => 'World Wide Technology (WWT)',
        'paras'   => [
            'I have worked with McCollister’s for over 25 years, supporting our transportation operations out of Edwardsville. They have been a reliable and professional partner, consistently delivering on schedule while safely handling high-value technology equipment.',
            'Their team is responsive, flexible, and understands the importance of meeting our operational demands. McCollister’s has been a trusted extension of our operation, and I highly recommend them as a transportation and logistics partner.',
        ],
    ],
];

$more = [
    'title' => 'More About<br>McCollister’s',
    'cards' => [
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

    <!-- Hero: form + contact info -->
    <section class="contact-hero" style="background-image: url('<?php echo esc_url($hero['image']); ?>');">
        <div class="contact-hero__inner">
            <div class="contact-hero__form">
                <h1 class="contact-hero__form-title"><?php echo esc_html($hero['form_title']); ?></h1>
                <div class="contact-hero__gform">
                    <?php echo do_shortcode($hero['form']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
            </div>

            <div class="contact-hero__info">
                <p class="contact-hero__eyebrow">/ <?php echo esc_html($hero['eyebrow']); ?> /</p>
                <h2 class="contact-hero__title"><?php echo wp_kses($hero['title'], ['br' => []]); ?></h2>
                <p class="contact-hero__text"><?php echo esc_html($hero['text']); ?></p>
                <ul class="contact-hero__socials">
                    <?php foreach ($socials as $s) : ?>
                        <li>
                            <a href="<?php echo esc_url($s['url']); ?>" aria-label="<?php echo esc_attr($s['label']); ?>" target="_blank" rel="noopener">
                                <i class="<?php echo esc_attr($s['icon']); ?>" aria-hidden="true"></i>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

    <!-- What Customers Are Saying (homepage testimonial slider) -->
    <section class="home-testimonials home-testimonials--contact">
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
                <h2 class="home-testimonials__title">What Customers Are Saying</h2>

                <div class="home-testimonials__slider" data-slider>
                    <div class="home-testimonials__slides" data-slider-track>
                        <?php foreach ($testimonials as $t_index => $t) : ?>
                            <blockquote class="home-testimonials__slide<?php echo 0 === $t_index ? ' is-active' : ''; ?>" data-slider-slide>
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
                                    class="home-testimonials__dot<?php echo 0 === $t_index ? ' is-active' : ''; ?>"
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
