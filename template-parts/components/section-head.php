<?php
/**
 * Section head: "/ eyebrow /" + uppercase heading (+ optional lead).
 *
 * Usage:
 *   get_template_part('template-parts/components/section-head', null, [
 *       'eyebrow' => 'services',
 *       'title'   => 'Streamlined Logistics, Seamless Delivery',
 *       'lead'    => 'Optional supporting sentence.',   // optional
 *       'light'   => true,                              // on dark backgrounds
 *       'tag'     => 'h2',                              // heading tag, default h2
 *       'class'   => 'home-services__head',            // extra wrapper class
 *   ]);
 *
 * @package McCollisters
 */

$mcc_eyebrow = isset($args['eyebrow']) ? $args['eyebrow'] : '';
$mcc_title   = isset($args['title']) ? $args['title'] : '';
$mcc_lead    = isset($args['lead']) ? $args['lead'] : '';
$mcc_light   = !empty($args['light']);
$mcc_tag     = isset($args['tag']) ? $args['tag'] : 'h2';
$mcc_extra   = isset($args['class']) ? $args['class'] : '';

if ($mcc_title === '' && $mcc_eyebrow === '') {
    return;
}

$mcc_allowed_tags = ['h1', 'h2', 'h3', 'p'];
if (!in_array($mcc_tag, $mcc_allowed_tags, true)) {
    $mcc_tag = 'h2';
}

$mcc_classes = 'section-head';
if ($mcc_light) {
    $mcc_classes .= ' section-head--light';
}
if ($mcc_extra !== '') {
    $mcc_classes .= ' ' . $mcc_extra;
}
?>
<div class="<?php echo esc_attr($mcc_classes); ?>">
    <?php if ($mcc_eyebrow !== '') : ?>
        <p class="section-head__eyebrow">/ <?php echo esc_html($mcc_eyebrow); ?> /</p>
    <?php endif; ?>

    <?php if ($mcc_title !== '') : ?>
        <?php // Allow <br> (with an optional class for responsive breaks); everything else is stripped. ?>
        <<?php echo esc_html($mcc_tag); ?> class="section-head__title"><?php echo wp_kses($mcc_title, ['br' => ['class' => true]]); ?></<?php echo esc_html($mcc_tag); ?>>
    <?php endif; ?>

    <?php if ($mcc_lead !== '') : ?>
        <p class="section-head__lead"><?php echo esc_html($mcc_lead); ?></p>
    <?php endif; ?>
</div>
