<?php
/**
 * Template Name: Service Page — Final-Mile & White-Glove
 *
 * Hard-coded service page (slug: final-mile-white-glove). Editable content lives
 * in the variables up top so it can later map to ACF. Reuses the global
 * components: .section-head, .mcc-btn, [data-accordion] — and service.css.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/03/fianal-mile-white-glove-hero3.jpg',
    'title'    => 'Final-Mile & White-Glove',
    'subtitle' => 'Specialized services for discerning clients',
    'buttons'  => [
        ['label' => 'Industry Insights', 'url' => home_url('/resources/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'From The First To<br>The Last, We Go<br>The Extra Mile',
    'lead'    => 'Some items simply can’t be left out in the cold.',
    'paras'   => [
        'Your shipment arrives with damaged components. Placement is rushed or incomplete. Installation is delayed while teams wait on replacements. What should have been a straightforward delivery turns into lost time, unplanned costs, and unnecessary disruption.',
        'When delicate, oversized, high-value, or specialty items are handled without the right level of care at the first and final mile, small missteps quickly become expensive problems. White-glove service protects more than your freight—it protects your timeline, your budget, and your peace of mind.',
    ],
];

$capabilities = [
    'title'      => 'Our<br>Capabilities',
    'intro'      => [
        'When your shipment demands more than standard delivery, McCollister’s delivers more. For projects requiring precision handling, elevated care, and damage-free execution, our white-glove transportation and padded van services are designed to protect your assets every step of the way.',
        'Through our integrated first- and final-mile solutions, we safeguard the most critical stages of your supply chain—from secure, well-coordinated pickup to seamless, professionally managed delivery—ensuring your freight arrives exactly as intended, on time and in perfect condition.',
    ],
    'image'      => $uploads . '2026/03/palettes.jpg',
    'alt'        => 'Stacks of large rectangular packages wrapped in brown paper and plastic, secured with colorful straps on wooden pallets for white-glove or final-mile delivery.',
    'list_title' => 'When you work with McCollister’s, you will have access to:',
    'items'      => [
        ['label' => 'Multi-person freight pickup and delivery', 'text' => 'Experienced teams coordinate each move to ensure safe handling and efficient execution tailored to your requirements.'],
        ['label' => 'Inside pickup and delivery', 'text' => 'Your products are placed where they’re needed, fully protected, with clear communication throughout the process.'],
        ['label' => 'First-mile and final-mile service', 'text' => 'From point of origin to final placement, we coordinate handling, timing, and site-specific requirements to maintain continuity throughout transit and delivery.'],
        ['label' => 'Light assembly and display setup', 'text' => 'Our crews support initial setup to minimize delays and keep your operations moving forward.'],
        ['label' => 'Debris removal', 'text' => 'We leave nothing behind but a clean, ready-to-use space, removing all protective packaging and materials.'],
        ['label' => 'Specialty vehicles and equipment', 'text' => 'Our climate-controlled trucks are equipped with cargo pads, blankets, tie downs, load straps, power lift gates, walk boards, and specialized handling equipment designed to protect even the most fragile shipments.'],
        ['label' => '24/7 logistics visibility', 'text' => 'Real-time access to shipment information provides confidence, transparency, and peace of mind.'],
    ],
];

$confidence = [
    'eyebrow' => 'expertise',
    'image'   => $uploads . '2026/03/fianal-mile-white-glove-inset.jpg',
    'alt'     => 'Aerial view of multiple vehicles, including a large final-mile delivery truck, driving on a multi-lane highway.',
    'title'   => 'Confidence With McCollister’s',
    'paras'   => [
        'At McCollister’s, white-glove service defines how we manage your shipment from start to finish. From initial pickup to final delivery, you can be sure that your asset is in good hands.',
        'Whether you’re deploying high-value medical equipment, supporting hospitality renovations, or managing time-sensitive installations, our dedicated and certified employees execute every detail with care, discretion, and an unwavering commitment to excellence. We don’t just move freight—we manage the details that help keep your operation running smoothly.',
        'Backed by decades of experience, trained in-house teams, and purpose-built equipment, McCollister’s delivers white-glove service across the entire lifecycle of your shipment. Nothing is left to chance, and nothing is left unattended.',
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Final Mile & White Glove',
    'items'   => [
        [
            'q' => 'What is white-glove transportation?',
            'a' => '<p>White-glove transportation is a specialized logistics service designed for shipments that require added care, coordination, and inside handling. At McCollister’s, this practice typically includes multi-person teams, inside pickup and delivery, careful placement, protective handling during transit, and debris removal once items are unpacked.</p>'
                 . '<p>The goal is to ensure your products are not just dropped off, but delivered pristinely, safely, and with minimal disruption to your operations.</p>',
        ],
        [
            'q' => 'Why is it called white-glove delivery?',
            'a' => '<p>The term “white glove” refers to a higher standard of service and attention to detail. It reflects an approach where handling, presentation, and care matter just as much as transportation, similar to the way white gloves have traditionally symbolized precision and professionalism.</p>'
                 . '<p>In logistics, it signals a level of service that goes beyond curbside or dock delivery.</p>',
        ],
        [
            'q' => 'What is the difference between first- and final-mile logistics?',
            'a' => '<p>First-mile logistics focuses on the beginning of a shipment’s journey. It typically refers to managing careful pickup and transfer from the asset’s origin point into the broader transportation network. In addition to these services, first-mile logistics can include tasks such as packaging, labeling, and sorting products prior to loading them onto vehicles for transport.</p>'
                 . '<p>Conversely, final-mile delivery refers to the last stage of the shipment’s journey, from a distribution point or carrier handoff to its destination inside a facility, business, or residence. With McCollister’s final-mile services, this stage often includes inside delivery, placement, coordination with on-site teams, and white-glove handling to ensure products arrive ready for use, installation, or setup.</p>',
        ],
        [
            'q' => 'What information do I need to gather to get a quote for white-glove services?',
            'a' => '<p>To provide an accurate quote, we typically ask for:</p>'
                 . '<ul>'
                 . '<li>Origin and destination locations</li>'
                 . '<li>Requested pickup and delivery dates</li>'
                 . '<li>Item descriptions, dimensions, and weights (if available)</li>'
                 . '<li>Delivery requirements, including inside placement or assembly needs</li>'
                 . '<li>Site access details, arrival windows, and any special considerations</li>'
                 . '<li>Equipment requirements such as dry van, climate-controlled van, or flatbed</li>'
                 . '</ul>'
                 . '<p>This information allows us to plan appropriately and ensure the right level of service from the start.</p>',
        ],
        [
            'q' => 'What types of shipments benefit from white-glove services?',
            'a' => '<p>White-glove delivery is a wise choice for products that require added care, coordination, or inside placement, particularly when presentation, condition, or timing matters. Common examples include:</p>'
                 . '<ul>'
                 . '<li><strong>Medical and laboratory equipment:</strong> Sensitive, oversized, or high-value devices requiring specialized transport.</li>'
                 . '<li><strong>High-value electronic devices:</strong> Technical equipment that benefits from padded transport and controlled handling.</li>'
                 . '<li><strong>Furniture and appliances:</strong> Large commercial or residential items requiring inside delivery and placement.</li>'
                 . '<li><strong>Retail and e-commerce products:</strong> High-value, delicate, or oversized items that exceed standard parcel capabilities and require manual handling at delivery.</li>'
                 . '<li><strong>Data centers:</strong> Servers and other critical infrastructure that require precise handling and coordination.</li>'
                 . '<li><strong>Fine art, antiques, and specialty assets:</strong> Fragile or irreplaceable items where protection, discretion, and attention to detail are essential.</li>'
                 . '<li><strong>Retail displays and fixture installations:</strong> In-store displays, fixtures, and branded environments that demand careful handling and proper placement.</li>'
                 . '<li><strong>Automobiles:</strong> High-end automotive parts, equipment and accessories that need precision, discretion, and hands-on care.</li>'
                 . '<li><strong>Trade show and exhibition materials:</strong> Booths, displays, and event materials requiring coordinated delivery, timing, and placement.</li>'
                 . '</ul>',
        ],
    ],
];
?>
<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="svc-hero" style="background-image: url('<?php echo esc_url($hero['image']); ?>'); background-position: top center;">
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

    <!-- Overview -->
    <section class="svc-section svc-section--tight-top">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $overview['eyebrow'],
                'title'   => $overview['title'],
            ]); ?>
            <div class="svc-prose">
                <p class="svc-prose__lead svc-prose__lead--xl"><?php echo esc_html($overview['lead']); ?></p>
                <?php foreach ($overview['paras'] as $i => $p) : ?>
                    <p<?php echo 0 === $i ? ' class="svc-prose__intro"' : ''; ?>><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Our Capabilities (image + labelled list) -->
    <section class="svc-section svc-avcaps">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $capabilities['title'],
            ]); ?>
            <div class="svc-prose svc-avcaps__intro">
                <?php foreach ($capabilities['intro'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <div class="svc-avcaps__grid svc-avcaps__grid--top">
                <div class="svc-avcaps__media">
                    <img src="<?php echo esc_url($capabilities['image']); ?>" alt="<?php echo esc_attr($capabilities['alt']); ?>" loading="lazy" decoding="async">
                </div>
                <div class="svc-avcaps__content">
                    <h3 class="svc-avcaps__list-title"><?php echo esc_html($capabilities['list_title']); ?></h3>
                    <ul class="svc-fmlist">
                        <?php foreach ($capabilities['items'] as $item) : ?>
                            <li class="svc-fmlist__item">
                                <strong><?php echo esc_html($item['label']); ?>:</strong> <?php echo esc_html($item['text']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Confidence with McCollister's (dark, image band + title + paras) -->
    <section class="svc-freight svc-avconf">
        <div class="svc-freight__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $confidence['eyebrow'],
                'light'   => true,
            ]); ?>
            <div class="svc-avconf__band">
                <img src="<?php echo esc_url($confidence['image']); ?>" alt="<?php echo esc_attr($confidence['alt']); ?>" loading="lazy" decoding="async">
            </div>
            <h2 class="svc-freight__title svc-avconf__title"><?php echo esc_html($confidence['title']); ?></h2>
            <div class="svc-freight__prose">
                <?php foreach ($confidence['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
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
