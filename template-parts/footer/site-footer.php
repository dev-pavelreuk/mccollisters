<?php
/**
 * Main site footer markup.
 *
 * Link columns are driven by the footer_* nav menu locations registered in
 * theme-setup.php. Each column renders with no heading, matching the design.
 *
 * @package McCollisters
 */

$phone           = mcc_get_theme_option('mcc_phone', '609-386-0600');
$phone_secondary = mcc_get_theme_option('mcc_phone_secondary', '800-257-9595');
$email           = mcc_get_theme_option('mcc_email', 'info@mccollisters.com');
$address         = mcc_get_theme_option('mcc_address', "8 Terri Lane\nBurlington, NJ  08016");
$usdot           = mcc_get_theme_option('mcc_usdot', "USDOT 805405, MC-358185\nUSDOT 2213118, MC-182358");

$social_links = [
    ['https://www.instagram.com/mccollisters1945/', 'Instagram', 'instagram'],
    ['https://www.facebook.com/McCollisters/', 'Facebook', 'facebook-f'],
    ['https://www.linkedin.com/company/mccollister\'s-transportation/', 'LinkedIn', 'linkedin-in'],
    ['https://www.youtube.com/@Mccollisters', 'YouTube', 'youtube'],
];
?>
<footer class="site-footer">
    <div class="site-footer__inner">

        <?php // Caps come from the copy itself — the spec sets text-transform: none. ?>
        <h2 class="site-footer__tagline">
            <?php esc_html_e('EXCELLENCE', 'mccollisters'); ?>
            <span><?php esc_html_e('DELIVERED', 'mccollisters'); ?></span>
        </h2>

        <div class="site-footer__grid">

            <div class="site-footer__brand">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a class="site-footer__title" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                <?php endif; ?>

                <ul class="site-footer__social">
                    <?php foreach ($social_links as $link) : ?>
                        <li>
                            <a
                                href="<?php echo esc_url($link[0]); ?>"
                                aria-label="<?php echo esc_attr($link[1]); ?>"
                                target="_blank"
                                rel="noopener"
                            >
                                <?php echo mcc_icon($link[2]); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <p class="site-footer__phones">
                    <a href="tel:<?php echo esc_attr(mcc_phone_href($phone)); ?>"><?php echo esc_html($phone); ?></a>
                    <?php if ($phone_secondary !== '') : ?>
                        <a href="tel:<?php echo esc_attr(mcc_phone_href($phone_secondary)); ?>"><?php echo esc_html($phone_secondary); ?></a>
                    <?php endif; ?>
                </p>

                <?php if ($address !== '') : ?>
                    <address class="site-footer__address">
                        <span class="site-footer__address-label"><?php esc_html_e('Headquarters', 'mccollisters'); ?></span>
                        <?php echo nl2br(esc_html($address)); ?>
                    </address>
                <?php endif; ?>

                <p class="site-footer__email">
                    <a href="mailto:<?php echo esc_attr(antispambot($email)); ?>"><?php echo esc_html(antispambot($email)); ?></a>
                </p>

                <a
                    class="site-footer__bbb"
                    href="https://www.bbb.org/us/nj/burlington/profile/moving-companies/mccollisters-global-services-0221-80001208"
                    target="_blank"
                    rel="noopener"
                    aria-label="<?php esc_attr_e('Visit McCollister’s BBB profile', 'mccollisters'); ?>"
                >
                    <svg viewBox="0 0 553 859.3" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="M438.8,531.6h-316l-11.4,37.8h84.3l16,52.1H350l16.1-52.1h84.2L438.8,531.6z M174.4,319.5c-24.2,33.4-16.8,80.1,16.6,104.3l75.7,55c8.4,6.1,10.3,17.8,4.1,26.1l11.3,8.2l40-55.1c9.3-12.7,14.3-28,14.3-43.7c0-4-0.4-8-1-11.9c-3-19.5-13.7-37.1-29.6-48.7l-75.6-54.9c-4.2-2.8-7.1-7.2-7.9-12.2c-0.1-1-0.1-2,0-3c0-3.9,1.3-7.8,3.6-11l-11.3-8.3L174.4,319.5z M220,98.7c-13.4,18.4-20.6,40.6-20.6,63.3c0,5.8,0.4,11.6,1.4,17.3c4.4,28.4,20,53.8,43.3,70.6l95.1,69.1c12.5,9,20.8,22.6,23.2,37.8c0.5,3.1,0.8,6.2,0.8,9.3c0,12.1-4,24-11.1,33.7l9.2,6.6l74.9-103.5c35-48.5,24.2-116.1-24.2-151.3L297.1,68.3c-7.2-5.2-12-13-13.3-21.8c-1.5-8.7,0.7-17.7,5.9-24.9l-9.1-6.6L220,98.7z M25.8,653.1h86.6c17.8-1.2,35.3,4.7,48.7,16.5c8.4,8.4,13,19.8,12.7,31.7v0.6c0.5,17-9.1,32.8-24.5,40.2c21.5,8.3,34.8,20.8,34.8,45.9c0,34.1-27.6,51.2-69.8,51.2H25.7L25.8,653.1z M103.9,728.5c18.1,0,29.6-5.9,29.6-19.7c0-12.3-9.9-19.7-26.9-19.7H65.8v39.5L103.9,728.5z M114.8,803.6c18.2,0,29-6.4,29-19.7v-0.6c0-12.4-9.3-19.7-30.3-19.7H65.8v41L114.8,803.6z M202.6,653.1h86.6c17.8-1.2,35.3,4.7,48.7,16.5c8.4,8.4,13,19.8,12.6,31.7v0.6c0.5,17-9.1,32.8-24.5,40.2c21.6,8.3,34.9,20.8,34.9,45.9c0,34.1-27.7,51.2-69.9,51.2h-88.6L202.6,653.1z M280.5,728.5c18.1,0,29.6-5.9,29.6-19.7c0-12.3-9.9-19.7-26.8-19.7h-41.1v39.5L280.5,728.5z M291.3,803.6c18.2,0,29-6.4,29-19.7v-0.6c0-12.4-9.3-19.7-30.3-19.7h-48v41L291.3,803.6z M378.4,653.1h86.6c17.8-1.2,35.3,4.7,48.7,16.5c8.4,8.4,13,19.8,12.7,31.7v0.6c0.5,17-9.1,32.8-24.5,40.2c21.6,8.3,34.9,20.8,34.9,45.9c0,34.1-27.7,51.2-69.9,51.2h-88.8L378.4,653.1z M456.3,728.5c18.1,0,29.6-5.9,29.6-19.7c0-12.3-9.9-19.7-26.8-19.7h-40.7v39.5L456.3,728.5z M467.1,803.6c18.2,0,29.1-6.4,29.1-19.7v-0.6c0-12.4-9.4-19.7-30.4-19.7h-47.5v41L467.1,803.6z"/></svg>
                </a>

                <?php if ($usdot !== '') : ?>
                    <p class="site-footer__usdot"><?php echo nl2br(esc_html($usdot)); ?></p>
                <?php endif; ?>
            </div>

            <div class="site-footer__col">
                <?php mcc_footer_menu('footer_services'); ?>
                <?php mcc_footer_menu('footer_company'); ?>
            </div>

            <div class="site-footer__col">
                <?php mcc_footer_menu('footer_industries'); ?>
            </div>

            <div class="site-footer__col">
                <?php mcc_footer_menu('footer_resources'); ?>

                <div class="site-footer__newsletter">
                    <p class="site-footer__newsletter-label"><?php esc_html_e('Subscribe to our newsletter:', 'mccollisters'); ?></p>
                    <!-- TODO: wire to a real ESP (Mailchimp / HubSpot / etc.) — markup only. -->
                    <form class="site-footer__newsletter-form mcc-newsletter" action="#" method="post">
                        <label class="screen-reader-text" for="footer-newsletter-email"><?php esc_html_e('Email', 'mccollisters'); ?></label>
                        <input type="email" id="footer-newsletter-email" name="email" placeholder="Email" required>

                        <?php // Revealed by navigation.js at 3+ characters. No consent copy here. ?>
                        <div class="mcc-newsletter-reveal">
                            <button type="submit" class="mcc-subscribe"><?php esc_html_e('Subscribe', 'mccollisters'); ?></button>
                        </div>
                    </form>
                </div>

                <p class="site-footer__since">
                    <span>since</span><span>1945</span>
                </p>
            </div>
        </div>

        <div class="site-footer__bottom">
            <p class="site-footer__copyright">
                &copy;<?php bloginfo('name'); ?> <?php echo esc_html(wp_date('Y')); ?>. <?php esc_html_e('All rights reserved.', 'mccollisters'); ?>
            </p>

            <?php
            // Appended as a final <li> so it wraps in the same flex row as the
            // legal links; as a sibling of the <ul> it was forced onto its own
            // line. Being a list item also picks up the `li + li` separator.
            $credit_item = sprintf(
                '<li><a class="site-footer__credit" href="%1$s" target="_blank" rel="noopener">%2$s</a></li>',
                esc_url('https://threeccreative.com'),
                esc_html__('Website by Three C Creative', 'mccollisters')
            );

            wp_nav_menu([
                'theme_location' => 'footer_legal',
                'container'      => false,
                'menu_class'     => 'footer-legal-menu',
                'fallback_cb'    => false,
                'depth'          => 1,
                'items_wrap'     => '<ul class="%2$s">%3$s' . $credit_item . '</ul>',
            ]);
            ?>
        </div>
    </div>
</footer>
