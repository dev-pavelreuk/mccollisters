<?php
/**
 * Single team_member — the "leadership" detail page.
 *
 * Two-column layout: the featured headshot on the left, and on the right the
 * "/ our team /" crumb, the post title, the ACF job_title, a gold divider, the
 * ACF bio, and a "Back to Our Team" button. Then the shared CTA cards.
 *
 * Fields come straight from the post: featured image, post title, and the ACF
 * fields `job_title` and `bio`.
 *
 * @package McCollisters
 */

get_header();

$arrow = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

while (have_posts()) :
    the_post();

    $post_id   = get_the_ID();
    $job_title = function_exists('get_field') ? (string) get_field('job_title') : (string) get_post_meta($post_id, 'job_title', true);
    $bio       = function_exists('get_field') ? (string) get_field('bio') : (string) get_post_meta($post_id, 'bio', true);
    ?>
    <main id="primary" class="site-main">

        <section class="svc-section team-single">
            <div class="svc-section__inner team-single__grid">

                <div class="team-single__media">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('2048x2048', ['class' => 'team-single__img', 'loading' => 'eager', 'decoding' => 'async', 'alt' => esc_attr(get_the_title())]); ?>
                    <?php else : ?>
                        <span class="team-single__img team-single__img--placeholder" aria-hidden="true"></span>
                    <?php endif; ?>
                </div>

                <div class="team-single__body">
                    <p class="loc-head__crumb">/ <?php esc_html_e('our team', 'mccollisters'); ?> /</p>
                    <h1 class="loc-head__title team-single__title"><?php the_title(); ?></h1>

                    <?php if ($job_title !== '') : ?>
                        <p class="team-single__role"><?php echo esc_html($job_title); ?></p>
                    <?php endif; ?>

                    <?php if ($bio !== '') : ?>
                        <div class="team-single__bio"><?php echo wp_kses_post($bio); ?></div>
                    <?php endif; ?>

                    <a class="mcc-btn mcc-btn--on-light team-single__back" href="<?php echo esc_url(get_post_type_archive_link('team_member') ?: home_url('/leadership/')); ?>">
                        <span class="mcc-btn__label"><?php esc_html_e('Back to Our Team', 'mccollisters'); ?></span>
                        <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
                    </a>
                </div>

            </div>
        </section>

        <!-- CTA cards -->
        <?php get_template_part('template-parts/components/cta-cards'); ?>

    </main>
<?php endwhile; ?>
<?php get_footer(); ?>
