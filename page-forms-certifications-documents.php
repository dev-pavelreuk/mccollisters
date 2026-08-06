<?php
/**
 * Template Name: Page — Forms, Certifications & Guides
 *
 * Hard-coded Forms/Certifications/Guides page (slug:
 * forms-certifications-documents). Editable content lives in the variables up
 * top so it can later map to ACF. Reuses the global components (svc-hero,
 * section-head, svc-integrated, cta-cards) plus three page-specific blocks:
 * the downloadable forms grid, the certification logo grid, and the guides
 * list. Section ids (downloadables / credentials / resources) are anchor
 * targets — e.g. /forms-certifications-documents/#credentials.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$dl_icon = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 18h14" stroke="currentColor" stroke-width="1.3" stroke-linecap="square" stroke-linejoin="miter"/></svg>';
$eye_icon = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg>';
$bbb_svg  = '<svg viewBox="0 0 553 859.3" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="M438.8,531.6h-316l-11.4,37.8h84.3l16,52.1H350l16.1-52.1h84.2L438.8,531.6z M174.4,319.5c-24.2,33.4-16.8,80.1,16.6,104.3l75.7,55c8.4,6.1,10.3,17.8,4.1,26.1l11.3,8.2l40-55.1c9.3-12.7,14.3-28,14.3-43.7c0-4-0.4-8-1-11.9c-3-19.5-13.7-37.1-29.6-48.7l-75.6-54.9c-4.2-2.8-7.1-7.2-7.9-12.2c-0.1-1-0.1-2,0-3c0-3.9,1.3-7.8,3.6-11l-11.3-8.3L174.4,319.5z M220,98.7c-13.4,18.4-20.6,40.6-20.6,63.3c0,5.8,0.4,11.6,1.4,17.3c4.4,28.4,20,53.8,43.3,70.6l95.1,69.1c12.5,9,20.8,22.6,23.2,37.8c0.5,3.1,0.8,6.2,0.8,9.3c0,12.1-4,24-11.1,33.7l9.2,6.6l74.9-103.5c35-48.5,24.2-116.1-24.2-151.3L297.1,68.3c-7.2-5.2-12-13-13.3-21.8c-1.5-8.7,0.7-17.7,5.9-24.9l-9.1-6.6L220,98.7z M25.8,653.1h86.6c17.8-1.2,35.3,4.7,48.7,16.5c8.4,8.4,13,19.8,12.7,31.7v0.6c0.5,17-9.1,32.8-24.5,40.2c21.5,8.3,34.8,20.8,34.8,45.9c0,34.1-27.6,51.2-69.8,51.2H25.7L25.8,653.1z M103.9,728.5c18.1,0,29.6-5.9,29.6-19.7c0-12.3-9.9-19.7-26.9-19.7H65.8v39.5L103.9,728.5z M114.8,803.6c18.2,0,29-6.4,29-19.7v-0.6c0-12.4-9.3-19.7-30.3-19.7H65.8v41L114.8,803.6z M202.6,653.1h86.6c17.8-1.2,35.3,4.7,48.7,16.5c8.4,8.4,13,19.8,12.6,31.7v0.6c0.5,17-9.1,32.8-24.5,40.2c21.6,8.3,34.9,20.8,34.9,45.9c0,34.1-27.7,51.2-69.9,51.2h-88.6L202.6,653.1z M280.5,728.5c18.1,0,29.6-5.9,29.6-19.7c0-12.3-9.9-19.7-26.8-19.7h-41.1v39.5L280.5,728.5z M291.3,803.6c18.2,0,29-6.4,29-19.7v-0.6c0-12.4-9.3-19.7-30.3-19.7h-48v41L291.3,803.6z M378.4,653.1h86.6c17.8-1.2,35.3,4.7,48.7,16.5c8.4,8.4,13,19.8,12.7,31.7v0.6c0.5,17-9.1,32.8-24.5,40.2c21.6,8.3,34.9,20.8,34.9,45.9c0,34.1-27.7,51.2-69.9,51.2h-88.8L378.4,653.1z M456.3,728.5c18.1,0,29.6-5.9,29.6-19.7c0-12.3-9.9-19.7-26.8-19.7h-40.7v39.5L456.3,728.5z M467.1,803.6c18.2,0,29.1-6.4,29.1-19.7v-0.6c0-12.4-9.4-19.7-30.4-19.7h-47.5v41L467.1,803.6z"/></svg>';

/**
 * Blue "file" icon with the format badge (PDF / DOC), matching the live cards.
 */
$file_icon = static function (string $label): string {
    $label = strtoupper($label);
    return '<svg class="svc-fileicon" viewBox="0 0 46 52" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">'
        . '<path d="M13 3h17l10 10v33a3 3 0 0 1-3 3H13a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3Z" stroke="#0069cb" stroke-width="1.7"/>'
        . '<path d="M30 3v7a3 3 0 0 0 3 3h7" stroke="#0069cb" stroke-width="1.7"/>'
        . '<rect x="4" y="18.5" width="27" height="15" rx="3" fill="#ffffff" stroke="#0069cb" stroke-width="1.5"/>'
        . '<text x="17.5" y="30.1" text-anchor="middle" fill="#0069cb" font-family="Arial, Helvetica, sans-serif" font-size="10" font-weight="700" letter-spacing="0.4">' . esc_html($label) . '</text>'
        . '</svg>';
};

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2024/09/mccollisters-blue-binders.jpg',
    'title'    => 'Forms, Certifications & Guides',
    'subtitle' => 'Download commonly used forms, review our certifications, and access helpful resources and checklists.',
    'buttons'  => [
        ['label' => 'Locations', 'url' => home_url('/locations/')],
        ['label' => 'Contact Us', 'url' => home_url('/contact-us/')],
    ],
];

$forms = [
    'eyebrow' => 'downloadables',
    'title'   => 'Forms',
    'items'   => [
        ['title' => 'Credit Application',              'type' => 'PDF', 'file' => $uploads . '2026/02/credit-application.pdf'],
        ['title' => 'McCollister’s W-9',               'type' => 'PDF', 'file' => $uploads . '2026/02/w9-global-2026.pdf'],
        ['title' => 'Liability Insurance Certificate', 'type' => 'PDF', 'file' => $uploads . '2026/02/25-26-coi-master-no-xs-1.pdf'],
        ['title' => 'Customer Profile',                'type' => 'DOC', 'file' => $uploads . '2026/04/customer-profile.docx'],
    ],
];

$certs = [
    'eyebrow' => 'credentials',
    'title'   => 'Certifications',
    'logos'   => [
        ['img' => $uploads . '2026/03/iso-13485-2016-2.svg',          'alt' => 'ISO 13485 certified'],
        ['img' => $uploads . '2026/05/smartway-blk-1.svg',            'alt' => 'SmartWay partner'],
        ['img' => $uploads . '2026/05/ndta-blk-1.svg',               'alt' => 'NDTA member'],
        ['img' => $uploads . '2026/05/ctpat-blk-1.svg',              'alt' => 'CTPAT — your supply chain’s strongest link'],
        ['img' => $uploads . '2026/05/nsc-blk-1.svg',                'alt' => 'National Safety Council member', 'class' => 'svc-creds__logo--sm'],
        ['img' => $uploads . '2026/05/commercial-space-federation.svg', 'alt' => 'Commercial Space Federation member'],
        ['bbb' => true,                                              'alt' => 'Better Business Bureau accredited'],
    ],
];

$guides = [
    'eyebrow' => 'resources',
    'title'   => 'Helpful Guides',
    'items'   => [
        ['title' => 'How to Prepare Your Vehicle for Transport', 'file' => '#'],
        ['title' => 'Understanding Auto Terms',                  'file' => '#'],
        ['title' => 'Can I Put Items in My Vehicle for Transport?', 'file' => '#'],
        ['title' => 'Will the Driver Pick up or Deliver to My Home?', 'file' => '#'],
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
            'icon'  => $uploads . '2026/06/Our-Blog-Forms-Certifications-i.png',
            'title' => 'Our Blog',
            'url'   => home_url('/blog/'),
            'text'  => 'Uncover our insights on innovations, trends, and issues shaping the industry.',
        ],
        [
            'icon'  => $uploads . '2026/06/Our-History-About-Us-i.png',
            'title' => 'Our History',
            'url'   => home_url('/history/'),
            'text'  => 'Discover how we became the McCollister’s we are today.',
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
    <section class="svc-hero svc-hero--forms" style="background-image: url('<?php echo esc_url($hero['image']); ?>');">
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

    <!-- Forms (downloadables) -->
    <section id="downloadables" class="svc-section svc-docs">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $forms['eyebrow'],
                'title'   => $forms['title'],
            ]); ?>
            <div class="svc-docs__grid">
                <?php foreach ($forms['items'] as $item) : ?>
                    <a class="svc-docs__card" href="<?php echo esc_url($item['file']); ?>" download>
                        <span class="svc-docs__icon"><?php echo $file_icon($item['type']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <span class="svc-docs__meta">
                            <span class="svc-docs__title"><?php echo esc_html($item['title']); ?></span>
                            <span class="svc-docs__type"><?php echo esc_html($item['type']); ?></span>
                        </span>
                        <span class="svc-docs__dl" aria-hidden="true"><?php echo $dl_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Certifications (credentials) -->
    <section id="credentials" class="svc-section svc-creds">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $certs['eyebrow'],
                'title'   => $certs['title'],
            ]); ?>
            <div class="svc-creds__grid">
                <?php foreach ($certs['logos'] as $logo) : ?>
                    <div class="svc-creds__logo<?php echo isset($logo['class']) ? ' ' . esc_attr($logo['class']) : ''; ?>">
                        <?php if (!empty($logo['bbb'])) : ?>
                            <span class="svc-creds__bbb" role="img" aria-label="<?php echo esc_attr($logo['alt']); ?>"><?php echo $bbb_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <?php else : ?>
                            <img src="<?php echo esc_url($logo['img']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" loading="lazy" decoding="async">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Helpful Guides -->
    <section id="guides" class="svc-section svc-guides">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $guides['eyebrow'],
                'title'   => $guides['title'],
            ]); ?>
            <ul class="svc-guides__list">
                <?php foreach ($guides['items'] as $item) : ?>
                    <li class="svc-guides__item">
                        <span class="svc-guides__icon"><?php echo $file_icon('PDF'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <span class="svc-guides__body">
                            <span class="svc-guides__title"><?php echo esc_html($item['title']); ?></span>
                            <span class="svc-guides__type">PDF File</span>
                            <span class="svc-guides__actions">
                                <a class="svc-guides__action" href="<?php echo esc_url($item['file']); ?>" target="_blank" rel="noopener">
                                    <span class="svc-guides__action-icon" aria-hidden="true"><?php echo $eye_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>View
                                </a>
                                <a class="svc-guides__action" href="<?php echo esc_url($item['file']); ?>" download>
                                    <span class="svc-guides__action-icon" aria-hidden="true"><?php echo $dl_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>Download
                                </a>
                            </span>
                        </span>
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

    <!-- CTA cards (reusable component; defaults to the standard two cards) -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
