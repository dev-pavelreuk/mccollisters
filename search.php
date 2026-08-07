<?php
/**
 * Search results.
 *
 * Reuses the Blog index layout: a header (crumb + "Search results" title), a
 * 2-up result grid with pagination, and the global blog sidebar, then the CTA
 * cards.
 *
 * @package McCollisters
 */

get_header();

/* translators: %s: search query. */
$heading = sprintf(__('Search results for “%s”', 'mccollisters'), get_search_query());
?>
<main id="primary" class="site-main">

    <section class="svc-section blog">
        <div class="svc-section__inner">
            <p class="blog__crumb">/ <?php esc_html_e('search', 'mccollisters'); ?> /</p>
            <h1 class="blog__title"><?php echo esc_html($heading); ?></h1>

            <div class="blog__inner">
                <div class="blog__main">
                    <div class="blog__grid">
                        <?php if (have_posts()) : ?>
                            <?php while (have_posts()) : the_post(); ?>
                                <?php $cats = get_the_category(); $cat = $cats ? $cats[0] : null; ?>
                                <article <?php post_class('blog-card'); ?>>
                                    <div class="blog-card__meta">
                                        <time class="blog-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('m.d.Y')); ?></time>
                                        <?php if ($cat) : ?>
                                            <span class="blog-card__dot" aria-hidden="true"></span>
                                            <a class="blog-card__cat" href="<?php echo esc_url(get_category_link($cat)); ?>"><?php echo esc_html($cat->name); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="blog-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a class="blog-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                            <?php the_post_thumbnail('large', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                                        </a>
                                    <?php endif; ?>
                                </article>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p class="blog__empty"><?php esc_html_e('No results found. Try a different search.', 'mccollisters'); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php
                    $links = paginate_links([
                        'type'      => 'array',
                        'mid_size'  => 3,
                        'end_size'  => 1,
                        'prev_text' => __('Previous', 'mccollisters'),
                        'next_text' => __('Next', 'mccollisters'),
                    ]);
                    if ($links) : ?>
                        <nav class="blog__pagination" aria-label="<?php esc_attr_e('Results pagination', 'mccollisters'); ?>">
                            <?php foreach ($links as $link) { echo $link; /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ } ?>
                        </nav>
                    <?php endif; ?>
                </div>

                <?php get_template_part('template-parts/blog/sidebar'); ?>
            </div>
        </div>
    </section>

    <!-- CTA cards -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
