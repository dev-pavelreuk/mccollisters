<?php
/**
 * CTA cards — two full-bleed image cards shown before the footer on most pages
 * ("We are here to help" / "We have 15 US locations").
 *
 * Usage (defaults shown below are used when no args are passed):
 *   get_template_part('template-parts/components/cta-cards');
 *
 * Override:
 *   get_template_part('template-parts/components/cta-cards', null, [
 *       'cards' => [
 *           ['title' => '…', 'image' => '…', 'button' => ['label' => '…', 'url' => '…']],
 *           …
 *       ],
 *   ]);
 *
 * @package McCollisters
 */

$mcc_uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$mcc_arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

$mcc_cards = isset($args['cards']) && is_array($args['cards']) ? $args['cards'] : [
    [
        'title'  => __('We are here<br>to help', 'mccollisters'),
        'image'  => $mcc_uploads . '2025/12/mega-menu-art-logistics-automotive-2.jpg',
        'button' => ['label' => __('Talk to an Expert', 'mccollisters'), 'url' => home_url('/talk-to-an-expert/')],
    ],
    [
        'title'  => __('We have 15<br>US locations', 'mccollisters'),
        'image'  => $mcc_uploads . '2024/11/mccollister-warehousing.jpg',
        'button' => ['label' => __('Find Your Facility', 'mccollisters'), 'url' => home_url('/locations/')],
    ],
];
?>
<section class="cta-cards">
    <div class="cta-cards__grid">
        <?php foreach ($mcc_cards as $mcc_card) : ?>
            <div class="cta-card">
                <div class="cta-card__bg" style="background-image: url('<?php echo esc_url($mcc_card['image']); ?>');"></div>
                <h2 class="cta-card__title"><?php echo wp_kses($mcc_card['title'], ['br' => []]); ?></h2>
                <a class="mcc-btn cta-card__btn" href="<?php echo esc_url($mcc_card['button']['url']); ?>">
                    <span class="mcc-btn__label"><?php echo esc_html($mcc_card['button']['label']); ?></span>
                    <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $mcc_arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
