<?php
/**
 * 404 template.
 *
 * @package McCollisters
 */

get_header();
?>
<main id="primary" class="site-main section error-404">
    <div class="container container--narrow text-center">
        <p class="eyebrow">404</p>
        <h1><?php esc_html_e('Page not found', 'mccollisters'); ?></h1>
        <p><?php esc_html_e('The page may have moved or the address may be incorrect.', 'mccollisters'); ?></p>
        <a class="button button--primary" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Return Home', 'mccollisters'); ?></a>
    </div>
</main>
<?php get_footer(); ?>
