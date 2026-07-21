<?php
/**
 * Single post template.
 *
 * @package McCollisters
 */

get_header();
?>
<main id="primary" class="site-main section">
    <div class="container container--narrow">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('single-post'); ?>>
                <header class="entry-header">
                    <p class="eyebrow"><?php echo esc_html(get_the_date()); ?></p>
                    <h1><?php the_title(); ?></h1>
                </header>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-featured-image"><?php the_post_thumbnail('large'); ?></div>
                <?php endif; ?>
                <div class="entry-content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>
