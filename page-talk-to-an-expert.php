<?php
/**
 * Template Name: Page — Talk to an Expert
 *
 * Hard-coded Talk to an Expert page (slug: talk-to-an-expert). A plain header
 * (breadcrumb + title + intro) over the Gravity Forms "Talk to an expert" form
 * (id 3) in a dark rounded panel, then the CTA cards.
 *
 * @package McCollisters
 */

get_header();

$header = [
    'crumb'  => 'get a quote',
    'title'  => 'Talk to an Expert',
    'intro'  => [
        'Looking to discuss a transportation, logistics, warehousing, or installation need with a specialist? Whether you have a defined scope or are exploring options, McCollister’s connects you with experts who understand your industry and operational challenges.',
        'Share some details below, and we’ll route your request to the right expert to continue the conversation and discuss next steps.',
    ],
];

$form = '[gravityform id="3" title="false"]';
?>
<main id="primary" class="site-main">

    <!-- Header -->
    <section class="svc-section loc-head tte-head">
        <div class="svc-section__inner">
            <p class="loc-head__crumb">/ <?php echo esc_html($header['crumb']); ?> /</p>
            <h1 class="loc-head__title"><?php echo esc_html($header['title']); ?></h1>
            <div class="tte-head__intro">
                <?php foreach ($header['intro'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Talk to an Expert form (Gravity Forms id 3) -->
    <section class="tte">
        <div class="tte__inner">
            <div class="tte__form">
                <?php echo do_shortcode($form); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
        </div>
    </section>

    <!-- CTA cards -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
