<?php
/**
 * Single blog post.
 *
 * Article layout mirroring the live site: a "View All Posts" link, title,
 * sub-head (the post excerpt), date + category + share row, featured image,
 * the Gutenberg body, prev/next navigation, and the global blog sidebar. Then
 * the shared CTA cards.
 *
 * @package McCollisters
 */

get_header();

$blog_url = home_url('/blog/');

while (have_posts()) :
    the_post();

    $cats = get_the_category();
    $cat  = $cats ? $cats[0] : null;

    $permalink = get_permalink();
    $share_fb  = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode($permalink);
    $share_in  = 'https://www.linkedin.com/sharing/share-offsite/?url=' . rawurlencode($permalink);
    $share_ml  = 'mailto:?subject=' . rawurlencode(get_the_title()) . '&body=' . rawurlencode($permalink);
    ?>
    <main id="primary" class="site-main">

        <section class="svc-section single-post">
            <div class="svc-section__inner">
                <div class="blog__inner">
                    <article <?php post_class('single-post__main'); ?>>
                        <?php get_template_part('template-parts/blog/view-all-posts'); ?>

                        <header class="single-post__head">
                            <h1 class="single-post__title"><?php the_title(); ?></h1>

                            <?php
                            // Sub-head from the ACF field (falls back to the [sub-head] shortcode).
                            $mcc_subhead = '';
                            if (function_exists('get_field')) {
                                $mcc_subhead = trim((string) get_field('sub_head'));
                                if ($mcc_subhead === '') {
                                    $mcc_subhead = trim((string) get_field('sub-head'));
                                }
                            }
                            if ($mcc_subhead === '') {
                                $mcc_shortcoded = trim(do_shortcode('[sub-head]'));
                                if ($mcc_shortcoded !== '' && strpos($mcc_shortcoded, '[sub-head]') === false) {
                                    $mcc_subhead = $mcc_shortcoded;
                                }
                            }
                            ?>
                            <?php if ($mcc_subhead !== '') : ?>
                                <p class="single-post__subhead"><?php echo esc_html($mcc_subhead); ?></p>
                            <?php endif; ?>

                            <div class="single-post__meta">
                                <div class="single-post__meta-info">
                                    <time class="single-post__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('m.d.Y')); ?></time>
                                    <?php if ($cat) : ?>
                                        <span class="single-post__dot" aria-hidden="true"></span>
                                        <a class="single-post__cat" href="<?php echo esc_url(get_category_link($cat)); ?>"><?php echo esc_html($cat->name); ?></a>
                                    <?php endif; ?>
                                </div>

                                <div class="single-post__share">
                                    <a class="single-post__share-btn" href="<?php echo esc_url($share_fb); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Share on Facebook', 'mccollisters'); ?>">
                                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12c0-6.627-5.373-12-12-12S0 5.373 0 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874V12h3.328l-.532 3.469h-2.796v8.385C19.612 22.954 24 17.99 24 12z"/></svg>
                                    </a>
                                    <a class="single-post__share-btn" href="<?php echo esc_url($share_in); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Share on LinkedIn', 'mccollisters'); ?>">
                                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/></svg>
                                    </a>
                                    <a class="single-post__share-btn" href="<?php echo esc_url($share_ml); ?>" aria-label="<?php esc_attr_e('Share by email', 'mccollisters'); ?>">
                                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 4H2C.9 4 0 4.9 0 6v12c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-.4 3.25-8.55 5.34a2 2 0 0 1-2.1 0L2.4 7.25a.85.85 0 1 1 .9-1.44L12 11.2l8.7-5.39a.85.85 0 1 1 .9 1.44z"/></svg>
                                    </a>
                                    <button type="button" class="single-post__share-btn" data-print aria-label="<?php esc_attr_e('Print this article', 'mccollisters'); ?>">
                                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 3H6v4h12V3zm1 5H5a3 3 0 0 0-3 3v6h4v4h12v-4h4v-6a3 3 0 0 0-3-3zm-3 11H8v-5h8v5zm3-6.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="single-post__media">
                                <?php the_post_thumbnail('large', ['loading' => 'eager', 'decoding' => 'async']); ?>
                            </figure>
                        <?php endif; ?>

                        <?php if (has_excerpt()) : ?>
                            <div class="single-post__excerpt"><?php echo wp_kses_post(wpautop(get_the_excerpt())); ?></div>
                        <?php endif; ?>

                        <div class="single-post__content post-content">
                            <?php the_content(); ?>
                        </div>

                        <?php
                        $prev = get_previous_post();
                        $next = get_next_post();
                        if ($prev || $next) : ?>
                            <nav class="single-post__nav" aria-label="<?php esc_attr_e('Post navigation', 'mccollisters'); ?>">
                                <div class="single-post__nav-prev">
                                    <?php if ($prev) : ?>
                                        <a href="<?php echo esc_url(get_permalink($prev)); ?>">
                                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m14 6-6 6 6 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            <span class="single-post__nav-inner">
                                                <span class="single-post__nav-label"><?php esc_html_e('Previous', 'mccollisters'); ?></span>
                                                <span class="single-post__nav-title"><?php echo esc_html(get_the_title($prev)); ?></span>
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="single-post__nav-next">
                                    <?php if ($next) : ?>
                                        <a href="<?php echo esc_url(get_permalink($next)); ?>">
                                            <span class="single-post__nav-inner">
                                                <span class="single-post__nav-label"><?php esc_html_e('Next', 'mccollisters'); ?></span>
                                                <span class="single-post__nav-title"><?php echo esc_html(get_the_title($next)); ?></span>
                                            </span>
                                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m10 6 6 6-6 6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </nav>
                        <?php endif; ?>
                    </article>

                    <?php get_template_part('template-parts/blog/sidebar'); ?>
                </div>
            </div>
        </section>

        <!-- CTA cards -->
        <?php get_template_part('template-parts/components/cta-cards'); ?>

    </main>
<?php endwhile; ?>
<?php get_footer(); ?>
