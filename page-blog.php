<?php
/**
 * Template Name: Page — Blog
 *
 * Hard-coded Blog index (slug: blog). Lists posts newest→oldest, 6 per page,
 * with numbered/prev-next pagination, beside a sidebar (search, categories,
 * archive, tags, newsletter). Then the CTA cards.
 *
 * @package McCollisters
 */

get_header();

$arrow_ext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

// On a static Page used as a listing, /blog/page/2/ populates the `page` var.
$paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));

$blog_query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 6,
    'paged'               => $paged,
    'ignore_sticky_posts' => true,
]);
?>
<main id="primary" class="site-main">

    <section class="svc-section blog">
        <div class="svc-section__inner">
            <p class="blog__crumb">/ blog /</p>
            <h1 class="blog__title"><?php echo wp_kses(__('See the Latest<br>Articles From Our<br>Company', 'mccollisters'), ['br' => []]); ?></h1>

            <div class="blog__inner">
                <div class="blog__main">
                    <div class="blog__grid">
                        <?php if ($blog_query->have_posts()) : ?>
                            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
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
                            <p class="blog__empty"><?php esc_html_e('No articles found.', 'mccollisters'); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php
                    $links = paginate_links([
                        'base'      => trailingslashit(get_permalink()) . 'page/%#%/',
                        'format'    => '',
                        'current'   => $paged,
                        'total'     => $blog_query->max_num_pages,
                        'type'      => 'array',
                        'mid_size'  => 3,
                        'end_size'  => 1,
                        'prev_text' => __('Previous', 'mccollisters'),
                        'next_text' => __('Next', 'mccollisters'),
                    ]);
                    if ($links) : ?>
                        <nav class="blog__pagination" aria-label="<?php esc_attr_e('Articles pagination', 'mccollisters'); ?>">
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
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
