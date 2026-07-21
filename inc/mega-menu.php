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
		$indexed[$item->ID] = [
			'id'          => (int) $item->ID,
			'title'       => $item->title,
			'url'         => $item->url,
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
	$recent = new WP_Query([
		'posts_per_page'      => 3,
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
	]);
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
			<form class="menu-promo__newsletter-form" action="#" method="post">
				<label class="screen-reader-text" for="menu-promo-email"><?php esc_html_e('Email', 'mccollisters'); ?></label>
				<input type="email" id="menu-promo-email" name="email" placeholder="Email" required>
				<button type="submit"><?php esc_html_e('Subscribe', 'mccollisters'); ?></button>
			</form>
			<div class="menu-promo__social">
				<a href="https://www.instagram.com/mccollisters1945/" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
				<a href="https://www.facebook.com/McCollisters/" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
				<a href="https://www.linkedin.com/company/mccollister's-transportation/" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
				<a href="https://www.youtube.com/@Mccollisters" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<?php
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
			?>
			<li class="<?php echo esc_attr(implode(' ', $li_classes)); ?>">
				<a
					href="<?php echo esc_url($item['url']); ?>"
					<?php echo $has_children ? ' aria-haspopup="true" aria-expanded="false"' : ''; ?>
				>
					<?php echo esc_html($item['title']); ?>
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
									<div class="sub-menu__links-grid">
										<?php foreach ($item['children'] as $link) : ?>
											<a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title']); ?></a>
										<?php endforeach; ?>
									</div>
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
	<?php
}
