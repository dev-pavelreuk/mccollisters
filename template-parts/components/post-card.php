<?php
/**
 * Reusable post card.
 *
 * @package McCollisters
 */
?>
<article <?php post_class('card post-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <a class="post-card__image" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php the_post_thumbnail('mcc-card'); ?>
        </a>
    <?php endif; ?>
    <div class="post-card__body">
        <p class="post-card__meta"><?php echo esc_html(get_the_date()); ?></p>
        <h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
        <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'mccollisters'); ?></a>
    </div>
</article>
