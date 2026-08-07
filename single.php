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
                        <a class="single-post__back" href="<?php echo esc_url($blog_url); ?>">
                            <span class="single-post__back-text"><?php esc_html_e('View All Posts', 'mccollisters'); ?></span>
                            <span class="single-post__back-arrow" aria-hidden="true">
                                <svg class="single-post__back-arrow-diagonal" viewBox="0 0 24 24" fill="none"><path d="M7 17 17 7M8 7h9v9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <svg class="single-post__back-arrow-chevron" viewBox="0 0 24 24" fill="none"><path d="m9 6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </a>

                        <header class="single-post__head">
                            <h1 class="single-post__title"><?php the_title(); ?></h1>

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
                                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1V7.9c0-.9.25-1.5 1.55-1.5H17V3.6c-.29-.04-1.3-.12-2.46-.12-2.44 0-4.11 1.49-4.11 4.22v2.35H7.7V13h2.73v8h3.07z"/></svg>
                                    </a>
                                    <a class="single-post__share-btn" href="<?php echo esc_url($share_in); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Share on LinkedIn', 'mccollisters'); ?>">
                                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.94 5a1.94 1.94 0 1 1-3.88 0 1.94 1.94 0 0 1 3.88 0zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91l.04-1.68z"/></svg>
                                    </a>
                                    <a class="single-post__share-btn" href="<?php echo esc_url($share_ml); ?>" aria-label="<?php esc_attr_e('Share by email', 'mccollisters'); ?>">
                                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="2"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                    <button type="button" class="single-post__share-btn" data-print aria-label="<?php esc_attr_e('Print this article', 'mccollisters'); ?>">
                                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 9V3h10v6" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><rect x="4" y="9" width="16" height="8" rx="1.5" stroke="currentColor" stroke-width="2"/><path d="M7 14h10v6H7z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
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
