<?php
/**
 * Main site header.
 *
 * No utility bar — confirmed against live-site screenshots, the header is
 * just: logo, primary nav (Services / Industries / Resources / Careers),
 * account icon, CTA button.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<header id="masthead" class="site-header">
	<div class="site-header__inner">

		<div class="site-header__branding">
			<?php if (has_custom_logo()) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a
					class="site-header__site-name"
					href="<?php echo esc_url(home_url('/')); ?>"
					aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>"
				>
					<?php echo esc_html(get_bloginfo('name')); ?>
				</a>
			<?php endif; ?>
		</div>

		<button
			class="site-header__toggle"
			type="button"
			aria-expanded="false"
			aria-controls="primary-navigation"
			aria-label="<?php esc_attr_e('Open main menu', 'mccollisters'); ?>"
		>
			<span class="site-header__toggle-line"></span>
			<span class="site-header__toggle-line"></span>
			<span class="site-header__toggle-line"></span>
		</button>

		<nav
			id="primary-navigation"
			class="site-navigation"
			aria-label="<?php esc_attr_e('Primary navigation', 'mccollisters'); ?>"
		>
			<?php mcc_render_primary_navigation(); ?>

			<?php // CTA + locations below are mobile-only (hidden at desktop widths). ?>
			<div class="site-navigation__cta-wrap">
				<a
					class="site-navigation__cta"
					href="<?php echo esc_url(home_url('/talk-to-an-expert/')); ?>"
				>
					<?php esc_html_e('Talk to an Expert', 'mccollisters'); ?>
				</a>
			</div>

			<?php mcc_render_mobile_locations(); ?>
		</nav>

		<div class="site-header__actions">
			<a
				class="site-header__account"
				href="https://mccollisters.vendors.striven.com/account/sign-in?ReturnUrl=%2F"
				aria-label="<?php esc_attr_e('Customer account', 'mccollisters'); ?>"
			>
				<?php echo mcc_icon('user'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
			</a>

			<a
				class="site-header__cta"
				href="<?php echo esc_url(home_url('/talk-to-an-expert/')); ?>"
			>
				<span><?php esc_html_e('Talk to an Expert', 'mccollisters'); ?></span>
			</a>
		</div>

	</div>
</header>
