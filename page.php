<?php
/**
 * Standard page template.
 *
 * @package McCollisters
 */

get_header();
?>
<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <header class="page-hero section section--light">
            <div class="container container--narrow">
                <h1><?php the_title(); ?></h1>
            </div>
        </header>
        <article <?php post_class('page-content section'); ?>>
            <div class="container container--narrow entry-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
