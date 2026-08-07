<?php
/**
 * Global blog sidebar.
 *
 * Shared by the Blog index (page-blog.php), single posts (single.php), and the
 * category/tag/date archives (archive.php). Widgets: search, categories, latest
 * posts, monthly archive, tags, newsletter subscribe.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

$arrow_ext = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

$categories = get_categories(['hide_empty' => true]);
$archives   = wp_get_archives(['type' => 'monthly', 'echo' => false, 'format' => 'custom', 'before' => '<li>', 'after' => '</li>']);
$tags       = get_tags(['hide_empty' => true]);

// Latest posts, excluding the one currently being viewed on a single.
$latest = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
    'post__not_in'        => is_singular('post') ? [get_the_ID()] : [],
]);
?>
<aside class="blog__sidebar" aria-label="<?php esc_attr_e('Blog sidebar', 'mccollisters'); ?>">
    <form class="blog-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" name="s" class="blog-search__input" placeholder="<?php esc_attr_e('Search…', 'mccollisters'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" aria-label="<?php esc_attr_e('Search articles', 'mccollisters'); ?>">
        <button type="submit" class="blog-search__btn" aria-label="<?php esc_attr_e('Search', 'mccollisters'); ?>">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/><path d="m20 20-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
    </form>

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

    <?php if ($latest->have_posts()) : ?>
        <div class="blog-widget">
            <h3 class="blog-widget__title"><?php esc_html_e('Latest Posts', 'mccollisters'); ?><span class="blog-widget__arrow" aria-hidden="true"><?php echo $arrow_ext; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></h3>
            <ul class="blog-latest">
                <?php while ($latest->have_posts()) : $latest->the_post(); ?>
                    <li class="blog-latest__item">
                        <?php if (has_post_thumbnail()) : ?>
                            <a class="blog-latest__thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail('thumbnail', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                            </a>
                        <?php endif; ?>
                        <a class="blog-latest__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>

    <?php if ($archives) : ?>
        <div class="blog-widget">
            <h3 class="blog-widget__title"><?php esc_html_e('Archive', 'mccollisters'); ?><span class="blog-widget__arrow" aria-hidden="true"><?php echo $arrow_ext; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></h3>
            <ul class="blog-widget__list"><?php echo $archives; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></ul>
        </div>
    <?php endif; ?>

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
