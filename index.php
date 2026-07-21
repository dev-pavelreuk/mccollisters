<?php
/**
 * Fallback template.
 *
 * @package McCollisters
 */

get_header();
?>
<main id="primary" class="site-main section">
    <div class="container">
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
