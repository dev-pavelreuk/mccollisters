<?php
/**
 * Mega menu — tree builder + renderer.
 *
 * Based on live-site screenshots, the "primary" menu has two distinct
 * dropdown shapes, not one:
 *
 *   - Services: 3 levels deep. Depth-1 items (Transportation, Warehousing,
 *     Logistics, Installation) are column headings; depth-2 items are the
 *     links inside each column. Full-width, no promo panel.
 *
 *   - Industries / Resources: 2 levels deep only. Depth-1 items are flat
 *     links laid out in two columns, alongside a shared promo panel
 *     (3 recent posts + newsletter signup + social icons).
 *
 *   - Careers: no children, renders as a plain link.
 *
 * Rather than requiring editors to manually tag menu items, this is
 * detected structurally: a top-level item is treated as "mega" if any of
 * its children has children of its own.
 *
 * The optional per-item "Description" field (enable it under Screen
 * Options on Appearance > Menus) is used as the small eyebrow label
 * above each dropdown — e.g. the live site shows "INDUSTRY" (singular)
 * as the eyebrow for the "Industries" tab. Leave it blank to fall back
 * to the item's title in caps.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Warehousing-expertise deep links. These menu items (in the header mega menu
 * and the footer) point to the warehousing page and open the matching
 * tab/accordion via the #anchor (handled in components.js). Mapped by title so
 * the behaviour works without editing the menu URLs in wp-admin.
 *
 * Returns the /warehousing/#anchor URL for a matching title, or null.
 */
function mcc_warehousing_anchor_url(string $title): ?string
{
	static $map = [
		'asset recovery'    => 'asset-recovery',
		'e-waste recycling' => 'e-waste-recycling',
		'medical devices'   => 'medical-devices',
		'solar'             => 'solar',
		'solar experts'     => 'solar',
	];

	$key = strtolower(trim($title));

	return isset($map[$key]) ? home_url('/warehousing/') . '#' . $map[$key] : null;
}

/**
 * Rewrite footer (wp_nav_menu) links for the warehousing deep-link items, the
 * same way the header mega menu does in mcc_get_menu_tree().
 */
function mcc_footer_warehousing_anchors(array $items): array
{
	foreach ($items as $item) {
		$url = mcc_warehousing_anchor_url((string) $item->title);
		if ($url !== null) {
			$item->url = $url;
		}
	}

	return $items;
}
add_filter('wp_nav_menu_objects', 'mcc_footer_warehousing_anchors');

/**
 * Fetch a nav menu location's items as a nested tree instead of a flat list.
 */
function mcc_get_menu_tree(string $location): array
{
	$locations = get_nav_menu_locations();

	if (empty($locations[$location])) {
		return [];
	}

	$items = wp_get_nav_menu_items($locations[$location]);

	if (!$items) {
		return [];
	}

	$indexed = [];

	foreach ($items as $item) {
		// Warehousing-expertise deep links open the matching tab/accordion (see
		// mcc_warehousing_anchor_url + components.js).
		$url = mcc_warehousing_anchor_url((string) $item->title) ?? $item->url;

		$indexed[$item->ID] = [
			'id'          => (int) $item->ID,
			'title'       => $item->title,
			'url'         => $url,
			'description' => trim((string) $item->description),
			'classes'     => !empty($item->classes) ? array_values(array_filter((array) $item->classes)) : [],
			'parent'      => (int) $item->menu_item_parent,
			'children'    => [],
		];
	}

	$tree = [];

	foreach ($indexed as $id => &$node) {
		if ($node['parent'] && isset($indexed[$node['parent']])) {
			$indexed[$node['parent']]['children'][] = &$node;
		} else {
			$tree[] = &$node;
		}
	}
	unset($node);

	return $tree;
}

/**
 * True if any of this item's children themselves have children
 * (i.e. it needs the mega-columns layout, not the flat+promo layout).
 */
function mcc_menu_item_is_mega(array $item): bool
{
	foreach ($item['children'] as $child) {
		if (!empty($child['children'])) {
			return true;
		}
	}
	return false;
}

/**
 * The shared promo panel (recent posts + newsletter + social) shown
 * alongside the flat link list on non-Services dropdowns.
 */
function mcc_menu_promo_panel(): void
{
	// This panel renders once per split dropdown (Industries, Resources), so
	// give each email field a unique id to keep <label for> valid.
	static $instance = 0;
	$email_id = 'menu-promo-email-' . ++$instance;

	// Cached across calls: the panel renders once per split dropdown, so this
	// would otherwise run the identical query twice on every page load.
	static $recent = null;

	if ($recent === null) {
		$recent = new WP_Query([
			'posts_per_page'      => 3,
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
			'update_post_term_cache' => false,
		]);
	}

	$recent->rewind_posts();
	?>
	<div class="menu-promo">
		<div class="menu-promo__posts">
			<?php while ($recent->have_posts()) : $recent->the_post(); ?>
				<a class="menu-promo__post" href="<?php the_permalink(); ?>">
					<span class="menu-promo__post-image"><?php the_post_thumbnail('thumbnail'); ?></span>
					<span class="menu-promo__post-body">
						<span class="menu-promo__post-title"><?php the_title(); ?></span>
						<span class="menu-promo__post-link"><?php esc_html_e('Read More »', 'mccollisters'); ?></span>
					</span>
				</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<div class="menu-promo__newsletter">
			<p class="menu-promo__newsletter-label"><?php esc_html_e('Subscribe to our newsletter:', 'mccollisters'); ?></p>
			<!-- TODO: wire to a real ESP (Mailchimp / HubSpot / etc.) — this is markup only. -->
			<form class="menu-promo__newsletter-form mcc-newsletter" action="#" method="post">
				<div class="menu-promo__newsletter-field">
					<label class="screen-reader-text" for="<?php echo esc_attr($email_id); ?>"><?php esc_html_e('Email', 'mccollisters'); ?></label>
					<input type="email" id="<?php echo esc_attr($email_id); ?>" name="email" placeholder="Email" required>
				</div>
				<?php // Revealed by navigation.js once 3+ characters are typed. ?>
				<div class="menu-promo__newsletter-reveal mcc-newsletter-reveal">
					<button type="submit" class="mcc-subscribe"><?php esc_html_e('Subscribe', 'mccollisters'); ?></button>
					<p class="menu-promo__newsletter-consent">
						<?php esc_html_e('You can withdraw consent at any time.', 'mccollisters'); ?>
						<a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy policy.', 'mccollisters'); ?></a>
					</p>
				</div>
			</form>
			<div class="menu-promo__social">
				<a href="https://www.instagram.com/mccollisters1945/" aria-label="Instagram"><?php echo mcc_icon('instagram'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></a>
				<a href="https://www.facebook.com/McCollisters/" aria-label="Facebook"><?php echo mcc_icon('facebook'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></a>
				<a href="https://www.linkedin.com/company/mccollister's-transportation/" aria-label="LinkedIn"><?php echo mcc_icon('linkedin'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></a>
				<a href="https://www.youtube.com/@Mccollisters" aria-label="YouTube"><?php echo mcc_icon('youtube'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></a>
			</div>
		</div>
	</div>
	<?php
}

/**
 * State shortcuts pinned to the bottom of the mobile menu.
 *
 * Kept in code rather than a nav menu location so the row always renders even
 * when the menu list grows and scrolls. Swap to a registered menu later if
 * editors need to manage it.
 */
function mcc_render_mobile_locations(): void
{
	$states = ['CA', 'FL', 'GA', 'IL', 'MI', 'MO', 'NJ', 'NY', 'PA', 'TX', 'VA'];
	?>
	<div class="site-navigation__locations">
		<ul>
			<?php foreach ($states as $state) : ?>
				<li>
					<a href="<?php echo esc_url(home_url('/locations/#' . strtolower($state))); ?>">
						<?php echo esc_html($state); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}

/**
 * Menu labels for the split dropdowns (Industries/Resources) are stored in
 * ALL CAPS in wp-admin. Render them in title case so they match the Services
 * sub-items and the live site. Only fully-uppercase labels are transformed,
 * and a couple of acronyms are preserved.
 */
function mcc_menu_label(string $title): string
{
	$title = trim($title);

	if ($title === '' || mb_strtoupper($title, 'UTF-8') !== $title) {
		return $title; // Not all-caps — respect the author's casing.
	}

	$label = mb_convert_case(mb_strtolower($title, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');

	return strtr($label, ['Esg' => 'ESG', 'Faqs' => 'FAQs']);
}

/**
 * Render the full primary navigation.
 */
function mcc_render_primary_navigation(): void
{
	$tree = mcc_get_menu_tree('primary');

	if (empty($tree)) {
		return;
	}
	?>
	<ul class="site-navigation__menu">
		<?php foreach ($tree as $item) :
			$has_children = !empty($item['children']);
			$is_mega      = $has_children && mcc_menu_item_is_mega($item);
			$eyebrow      = $item['description'] !== '' ? $item['description'] : strtoupper($item['title']);
			?>
			<?php
			$li_classes = $has_children ? ['menu-item-has-children'] : [];
			$li_classes = array_merge($li_classes, $item['classes']);

			// "Find a Facility" is a mobile-only nav item: hidden on desktop,
			// shown in the hamburger menu (see .mobile-only-item in header.css).
			// Tagged here so it works without an editor adding the CSS class
			// in Appearance > Menus, and without duplicating the menu item.
			if (strcasecmp(trim($item['title']), 'Find a Facility') === 0) {
				$li_classes[] = 'mobile-only-item';
			}
			?>
			<li class="<?php echo esc_attr(implode(' ', $li_classes)); ?>">
				<a
					href="<?php echo esc_url($item['url']); ?>"
					<?php echo $has_children ? ' aria-haspopup="true" aria-expanded="false"' : ''; ?>
				>
					<?php echo esc_html($item['title']); ?>
					<?php if ($has_children) : ?>
						<span class="site-navigation__arrow" aria-hidden="true"></span>
					<?php endif; ?>
				</a>

				<?php if ($has_children) : ?>
					<div class="sub-menu <?php echo $is_mega ? 'sub-menu--mega' : 'sub-menu--split'; ?>">
						<?php if ($is_mega) : ?>

							<div class="sub-menu__eyebrow"><?php echo esc_html($eyebrow); ?></div>
							<div class="mega-columns">
								<?php foreach ($item['children'] as $column) : ?>
									<div class="mega-column">
										<a class="mega-column__heading" href="<?php echo esc_url($column['url']); ?>">
											<?php echo esc_html($column['title']); ?>
											<?php if (!empty($column['children'])) : ?>
												<?php // Mobile-only accordion indicator (hidden at desktop widths). ?>
												<span class="mega-column__arrow" aria-hidden="true"></span>
											<?php endif; ?>
										</a>
										<?php if (!empty($column['children'])) : ?>
											<ul class="mega-column__links">
												<?php foreach ($column['children'] as $link) : ?>
													<li><a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title']); ?></a></li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>

						<?php else : ?>

							<div class="sub-menu__split">
								<div class="sub-menu__split-links">
									<div class="sub-menu__eyebrow"><?php echo esc_html($eyebrow); ?></div>
									<ul class="mega-column__links sub-menu__split-list">
										<?php foreach ($item['children'] as $link) : ?>
											<li><a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html(mcc_menu_label($link['title'])); ?></a></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="sub-menu__split-promo">
									<?php mcc_menu_promo_panel(); ?>
								</div>
							</div>

						<?php endif; ?>
					</div>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php // Shared persistent dropdown frame (desktop only). The per-item panels
	      // render transparently over this, so moving between menu items swaps
	      // the content without the panel itself disappearing and reappearing.
	      // Hidden on mobile, where the sub-menus are stacked accordions. ?>
	<div class="site-navigation__panel" aria-hidden="true"></div>
	<?php
}
