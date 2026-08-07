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

                <aside class="blog__sidebar" aria-label="<?php esc_attr_e('Blog sidebar', 'mccollisters'); ?>">
                    <form class="blog-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" name="s" class="blog-search__input" placeholder="<?php esc_attr_e('Search…', 'mccollisters'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" aria-label="<?php esc_attr_e('Search articles', 'mccollisters'); ?>">
                        <button type="submit" class="blog-search__btn" aria-label="<?php esc_attr_e('Search', 'mccollisters'); ?>">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/><path d="m20 20-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </button>
                    </form>

                    <?php $categories = get_categories(['hide_empty' => true]); ?>
                    <?php if ($categories) : ?>
                        <div class="blog-widget">
                            <h3 class="blog-widget__title"><?php esc_html_e('Categories', 'mccollisters'); ?><span class="blog-widget__arrow" aria-hidden="true"><?php echo $arrow_ext; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></h3>
                            <ul class="blog-widget__list blog-widget__list--counted">
                                <?php foreach ($categories as $c) : ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_category_link($c)); ?>"><?php echo esc_html($c->name); ?></a>
                                        <span class="blog-widget__count">(<?php echo esc_html($c->count); ?>)</span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php $archives = wp_get_archives(['type' => 'monthly', 'echo' => false, 'format' => 'custom', 'before' => '<li>', 'after' => '</li>']); ?>
                    <?php if ($archives) : ?>
                        <div class="blog-widget">
                            <h3 class="blog-widget__title"><?php esc_html_e('Archive', 'mccollisters'); ?><span class="blog-widget__arrow" aria-hidden="true"><?php echo $arrow_ext; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></h3>
                            <ul class="blog-widget__list"><?php echo $archives; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></ul>
                        </div>
                    <?php endif; ?>

                    <?php $tags = get_tags(['hide_empty' => true]); ?>
                    <?php if ($tags) : ?>
                        <div class="blog-widget">
                            <h3 class="blog-widget__title"><?php esc_html_e('Tags', 'mccollisters'); ?><span class="blog-widget__arrow" aria-hidden="true"><?php echo $arrow_ext; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></h3>
                            <div class="blog-tags">
                                <?php foreach ($tags as $t) : ?>
                                    <a class="blog-tag" href="<?php echo esc_url(get_tag_link($t)); ?>"><?php echo esc_html($t->name); ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="blog-widget blog-subscribe">
                        <h3 class="blog-widget__title"><?php esc_html_e('Subscribe to our newsletter', 'mccollisters'); ?><span class="blog-widget__arrow" aria-hidden="true"><?php echo $arrow_ext; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></h3>
                        <p class="blog-subscribe__text"><?php esc_html_e('Get industry insights, project highlights, and company updates delivered straight to your inbox.', 'mccollisters'); ?></p>
                        <form class="blog-subscribe__form mcc-newsletter" action="#" method="post">
                            <label class="screen-reader-text" for="blog-newsletter-email"><?php esc_html_e('Email', 'mccollisters'); ?></label>
                            <input type="email" id="blog-newsletter-email" name="email" placeholder="<?php esc_attr_e('Email', 'mccollisters'); ?>" required>

                            <?php // Revealed by navigation.js once 3+ characters are typed. ?>
                            <div class="mcc-newsletter-reveal">
                                <button type="submit" class="mcc-subscribe"><?php esc_html_e('Subscribe', 'mccollisters'); ?></button>
                            </div>
                        </form>
                        <p class="blog-subscribe__consent"><?php esc_html_e('You can withdraw consent at any time.', 'mccollisters'); ?><br><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'mccollisters'); ?></a></p>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- CTA cards -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
