<?php
/**
 * Main site footer markup.
 *
 * @package McCollisters
 */

$phone = mcc_get_theme_option('mcc_phone', '609-386-0600');
$email = mcc_get_theme_option('mcc_email', 'info@mccollisters.com');
?>
<footer class="site-footer">
    <div class="site-footer__main">
        <div class="container site-footer__grid">
            <div class="site-footer__brand">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a class="site-footer__title" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                <?php endif; ?>
                <p><?php esc_html_e('Transportation, warehousing, logistics and specialized solutions delivered with confidence.', 'mccollisters'); ?></p>
                <a href="tel:<?php echo esc_attr(mcc_phone_href($phone)); ?>"><?php echo esc_html($phone); ?></a><br>
                <a href="mailto:<?php echo esc_attr(antispambot($email)); ?>"><?php echo esc_html(antispambot($email)); ?></a>
            </div>

            <?php
            $footer_menus = [
                'footer_services'   => __('Services', 'mccollisters'),
                'footer_company'    => __('Company', 'mccollisters'),
                'footer_industries' => __('Industries', 'mccollisters'),
                'footer_resources'  => __('Resources', 'mccollisters'),
            ];

            foreach ($footer_menus as $location => $title) :
            ?>
                <div class="site-footer__column">
                    <h2 class="site-footer__heading"><?php echo esc_html($title); ?></h2>
                    <?php
                    wp_nav_menu([
                        'theme_location' => $location,
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ]);
                    ?>
                </div>
            <?php endforeach; ?>

            <div class="site-footer__newsletter">
                <?php if (is_active_sidebar('footer-newsletter')) : ?>
                    <?php dynamic_sidebar('footer-newsletter'); ?>
                <?php else : ?>
                    <h2 class="site-footer__heading"><?php esc_html_e('Stay Connected', 'mccollisters'); ?></h2>
                    <p><?php esc_html_e('Add the newsletter form widget here.', 'mccollisters'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="site-footer__bottom">
        <div class="container site-footer__bottom-inner">
            <p>&copy; <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'mccollisters'); ?></p>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer_legal',
                'container'      => false,
                'menu_class'     => 'footer-legal-menu',
                'fallback_cb'    => false,
                'depth'          => 1,
            ]);
            ?>
        </div>
    </div>
</footer>
