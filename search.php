<?php
/**
 * Search results template.
 *
 * @package McCollisters
 */

get_header();
?>
<main id="primary" class="site-main section">
    <div class="container">
        <header class="archive-header">
            <h1><?php printf(esc_html__('Search results for: %s', 'mccollisters'), '<span>' . esc_html(get_search_query()) . '</span>'); ?></h1>
        </header>
        <?php if (have_posts()) : ?>
            <div class="content-grid content-grid--posts">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/components/post', 'card'); ?>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <?php get_template_part('template-parts/components/content', 'none'); ?>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
