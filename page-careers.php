<?php
/**
 * Template Name: Page — Careers
 *
 * Hard-coded Careers page (slug: careers). Editable content lives in the
 * variables up top so it can later map to ACF. Reuses the global components
 * (svc-hero + video modal, section-head, mcc-btn, svc-integrated, cta-cards)
 * plus careers-specific blocks: the "Drivers & Owner-Operators" callout, the
 * dark differentiators/culture/opportunities region, an employee quote, and the
 * ADP recruitment widget.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check   = '<svg viewBox="2.5 4.5 19 14" fill="none" aria-hidden="true"><path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/03/warehousing-2-header.jpg',
    'title'    => 'Careers',
    'subtitle' => 'Your next journey starts here',
    'buttons'  => [
        ['label' => 'About Us', 'url' => home_url('/about-us/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
    'video'    => 'https://player.vimeo.com/video/1199843780?autoplay=1&title=0&byline=0&portrait=0',
];

$drives = [
    'eyebrow' => 'opportunities',
    'title'   => 'What Drives You Forward?',
    'paras'   => [
        'At McCollister’s, our success is driven by the talented people who make complex transportation, logistics, and relocation projects happen every day. Since our founding in 1945, we have grown into a nationally recognized, family-owned organization providing specialized transportation, warehousing, logistics, and installation services across the country.',
        'If you’re looking for a career where your work matters, your growth is supported, and your contributions are recognized, McCollister’s offers the opportunity to build something lasting.',
    ],
    'card'    => [
        'title' => 'Drivers &amp;<br>Owner-Operators',
        'text'  => 'Partner with a company built on precision, professionalism, and long-term relationships.',
        'label' => 'Contact Driver Support',
        'phone' => '(609) 526-9490',
        'email' => 'driversupport@mccollisters.com',
        'map'   => $uploads . '2026/03/map-without-alaska.svg',
    ],
];

$why = [
    'title' => 'Why Work At<br>McCollister’s?',
    'para'  => 'McCollister’s operates in a demanding, fast-paced industry—but it’s also one filled with challenges, collaboration, and opportunity. Our teams support meticulous moves and installations for discerning individuals and high-value, mission-critical projects for clients in industries such as aerospace, medical equipment, IT, automotive logistics, and commercial relocation.',
];

$apart = [
    'eyebrow' => 'differentiators',
    'title'   => 'What Sets<br>Us Apart',
    'items'   => [
        ['num' => '01', 'text' => 'An enduring reputation for reliability, care, and precision in transportation and logistics'],
        ['num' => '02', 'text' => 'A family-owned, privately held company with decades of industry expertise and a unique culture and heritage'],
        ['num' => '03', 'text' => 'Opportunities to work with cutting-edge technology, specialized equipment, and complex logistics challenges'],
        ['num' => '04', 'text' => 'Career paths across operations, driving, warehousing, installation services, logistics planning, sales, and corporate support, spanning 17 locations nationwide'],
    ],
];

$culture = [
    'image'   => $uploads . '2026/05/career-page-cluster-4-1020x1020.png',
    'title'   => 'Our Culture',
    'intro'   => 'At McCollister’s, we value people who are:',
    'list'    => [
        'Problem solvers who thrive in dynamic environments',
        'Team players who take pride in collaboration and accountability',
        'Professionals who care about safety, quality, and customer experience',
        'Individuals who want to grow, learn, and build long-term careers',
    ],
    'closing' => 'We believe that investing in our people is essential to delivering the high level of service our customers expect.',
];

$opps = [
    'image'    => $uploads . '2026/03/mccollisters-warehousing-management-800x1020.jpg',
    'title'    => 'Career<br>Opportunities',
    'intro'    => 'McCollister’s offers a wide range of roles across the organization and the US, including but not limited to:',
    'list'     => [
        'Drivers &amp; Owner-Operators',
        'Warehouse &amp; Distribution Team Members',
        'Installation &amp; Technical Services Professionals',
        'Logistics, Operations, and Supply Chain Roles',
        'Sales, Customer Service, and Corporate Positions, including Finance, Accounting, Facilities, and more',
    ],
    'growth_title' => 'Professional<br>Growth',
    'growth_text'  => 'A career at McCollister’s is more than a job, it’s an opportunity to gain valuable experience in a specialized industry. Many team members build long-term careers here by expanding their skills, taking on new responsibilities, and advancing into leadership roles.',
];

$quote_img    = $uploads . '2026/05/Quotation-Marks-Blue.svg';
$testimonials = [
    [
        'name'    => 'Roberta Emmert',
        'company' => 'Inside Sales',
        'paras'   => [
            'Working at McCollister’s is fast-paced, challenging, and very rewarding. I value the company’s commitment to not only meet but exceed our customers’ expectations. McCollister’s has many great attributes, and what I find most valuable is the ability to tailor transportation solutions to fit customers’ needs across many verticals.',
        ],
    ],
    [
        'name'    => 'Ed Cuomo',
        'company' => 'Warehouse Solutions Manager',
        'paras'   => [
            'What I enjoy most about working at McCollister’s is the culture that flows throughout the company. It’s a welcoming, team-oriented environment that truly makes coming to work enjoyable. That positive culture doesn’t just benefit employees; it directly impacts how we serve our customers, allowing us to deliver a high level of service and care every day.',
            'Our genuine commitment to customer satisfaction is what I believe truly sets McCollister’s apart from competitors and makes us stand out in the industry.',
        ],
    ],
    [
        'name'    => 'Darryl Neely',
        'company' => 'General Manager',
        'paras'   => [
            'After 17 total years of service with the company, one word always comes to mind: “Proud”. I am proud that I have been able to call this place home for 17 years and provide for my family as an employee of this company. I am proud to say “McCollister’s” whenever someone asks me where I work or what I do for a living. I am proud of the relationships that I have made over the years with my coworkers. I am proud to know that many others in the organization have a similar story to mine.',
        ],
    ],
    [
        'name'    => 'Christine Geist',
        'company' => 'Driver Relations Coordinator',
        'paras'   => [
            'Working at McCollister’s has absolutely been a pleasure. I work in the Auto Transport division and with the most amazing people. We transport all types of vehicles, and our drivers treat them with a white-glove level of care. You are treated like family here, and they truly care about their employees. I have made many friendships with amazing drivers and coworkers.',
        ],
    ],
    [
        'name'    => 'Cindy McManaway',
        'company' => 'Dispatcher',
        'paras'   => [
            'I like working here because the environment is fast-paced and challenging, which keeps me engaged. I enjoy the problem-solving aspect of dispatching and working with a team that communicates well and supports each other.',
            'One of the best parts of being a dispatcher is the fast pace and constant problem-solving. You work closely with drivers and teams, make real-time decisions, and play a key role in keeping operations running efficiently.',
        ],
    ],
    [
        'name'    => 'Joshua Scott',
        'company' => 'Account Executive In Training',
        'paras'   => [
            'Having been here for almost half a year, I can confidently say my experience with the company has been excellent. Not only does the company have strong leadership and a supportive team, but it also operates with clear values that truly guide what we do.',
            'By learning different departments, my time here has allowed me to grow and gain a deeper understanding of our workflow and operations. The team is always open to new ideas and continuously looks for ways to improve, ensuring we provide the most efficient and effective service possible.',
        ],
    ],
];

$join = [
    'title' => 'Join The McCollister’s Team',
    'intro' => 'Whether you’re an experienced professional or looking to take the next step in your career, behind a wheel or behind a desk, McCollister’s welcomes individuals who are motivated, dependable, and committed to excellence.',
    'lead'  => 'Explore open positions and apply today.',
    // ADP recruitment widget embed (external script + web component).
    'widget' => '<!-- Start of job widgets code. DO NOT DELETE --><script src="https://workforcenow.adp.com/mascsr/default/mdf/recwebcomponents/recruitment/main-config/recruitment.js"></script><recruitment-current-openings cid="2c69cf8e-1bb2-4d58-acd1-00372f8a7f23" ccid="9201014462507_3" host="DP" locale="en_US"></recruitment-current-openings><!-- End of job widgets code -->',
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
            'icon'  => $uploads . '2026/06/In-The-News-Our-History-i.png',
            'title' => 'In the News',
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

    <!-- Hero -->
    <section class="svc-hero svc-hero--careers" style="background-image: url('<?php echo esc_url($hero['image']); ?>');">
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

    <!-- What Drives You Forward? + Drivers callout -->
    <section class="svc-section careers-drives">
        <div class="svc-section__inner careers-drives__inner">
            <div class="careers-drives__prose">
                <?php get_template_part('template-parts/components/section-head', null, [
                    'eyebrow' => $drives['eyebrow'],
                    'title'   => $drives['title'],
                ]); ?>
                <div class="svc-prose">
                    <?php foreach ($drives['paras'] as $p) : ?>
                        <p><?php echo esc_html($p); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <aside class="careers-drivers">
                <h3 class="careers-drivers__title"><?php echo wp_kses($drives['card']['title'], ['br' => []]); ?></h3>
                <img class="careers-drivers__map" src="<?php echo esc_url($drives['card']['map']); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async">
                <p class="careers-drivers__text"><?php echo esc_html($drives['card']['text']); ?></p>
                <p class="careers-drivers__label"><?php echo esc_html($drives['card']['label']); ?></p>
                <p class="careers-drivers__contact">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $drives['card']['phone'])); ?>"><?php echo esc_html($drives['card']['phone']); ?></a>
                    <span aria-hidden="true"> · </span>
                    <a href="mailto:<?php echo esc_attr($drives['card']['email']); ?>"><?php echo esc_html($drives['card']['email']); ?></a>
                </p>
            </aside>
        </div>
    </section>

    <!-- Why Work At McCollister's? -->
    <section class="svc-section careers-why">
        <div class="svc-section__inner careers-why__inner">
            <div class="careers-why__prose">
                <?php get_template_part('template-parts/components/section-head', null, [
                    'title' => $why['title'],
                ]); ?>
                <div class="svc-prose">
                    <p><?php echo esc_html($why['para']); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Dark region: differentiators + culture + opportunities -->
    <section class="careers-dark">
        <div class="careers-dark__inner">

            <!-- What Sets Us Apart -->
            <div class="careers-apart">
                <?php get_template_part('template-parts/components/section-head', null, [
                    'eyebrow' => $apart['eyebrow'],
                    'title'   => $apart['title'],
                    'light'   => true,
                    'class'   => 'careers-apart__head',
                ]); ?>
                <div class="careers-apart__grid">
                    <?php foreach ($apart['items'] as $item) : ?>
                        <div class="careers-apart__item">
                            <span class="careers-apart__num"><?php echo esc_html($item['num']); ?></span>
                            <p class="careers-apart__text"><?php echo esc_html($item['text']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Our Culture -->
            <div class="careers-culture">
                <div class="careers-culture__media">
                    <img src="<?php echo esc_url($culture['image']); ?>" alt="McCollister’s team members" loading="lazy" decoding="async">
                </div>
                <div class="careers-culture__body">
                    <h2 class="careers-dark__title"><?php echo esc_html($culture['title']); ?></h2>
                    <p class="careers-dark__intro"><?php echo esc_html($culture['intro']); ?></p>
                    <ul class="careers-checklist">
                        <?php foreach ($culture['list'] as $li) : ?>
                            <li><span class="careers-check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><span><?php echo esc_html($li); ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="careers-dark__closing"><?php echo esc_html($culture['closing']); ?></p>
                </div>
            </div>

            <!-- Career Opportunities + Professional Growth -->
            <div class="careers-opps">
                <div class="careers-opps__body">
                    <h2 class="careers-dark__title"><?php echo wp_kses($opps['title'], ['br' => []]); ?></h2>
                    <p class="careers-dark__intro"><?php echo esc_html($opps['intro']); ?></p>
                    <ul class="careers-checklist">
                        <?php foreach ($opps['list'] as $li) : ?>
                            <li><span class="careers-check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><span><?php echo wp_kses($li, []); ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                    <h2 class="careers-dark__title careers-opps__growth"><?php echo wp_kses($opps['growth_title'], ['br' => []]); ?></h2>
                    <p class="careers-dark__closing"><?php echo esc_html($opps['growth_text']); ?></p>
                </div>
                <div class="careers-opps__media">
                    <img src="<?php echo esc_url($opps['image']); ?>" alt="Warehouse manager reviewing inventory" loading="lazy" decoding="async">
                </div>
            </div>

        </div>
    </section>

    <!-- What Employees Are Saying (same slider as the homepage testimonials) -->
    <section class="home-testimonials home-testimonials--flush-bottom">
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
                <h2 class="home-testimonials__title">What Employees Are Saying</h2>

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

    <!-- Join the team + ADP widget -->
    <section class="svc-section careers-join">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $join['title'],
            ]); ?>
            <div class="svc-prose">
                <p><?php echo esc_html($join['intro']); ?></p>
            </div>
            <p class="careers-join__lead"><?php echo esc_html($join['lead']); ?></p>
            <div class="careers-join__widget">
                <?php echo $join['widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
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
