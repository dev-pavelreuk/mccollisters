# McCollister's Custom Theme Foundation

This package is a clean custom WordPress theme foundation.

## Build order

1. Configure brand fonts, colors, container widths, and spacing in `assets/css/variables.css`.
2. Match the desktop and mobile header in `template-parts/header/site-header.php` and `assets/css/header.css`.
3. Match the footer in `template-parts/footer/site-footer.php` and `assets/css/footer.css`.
4. Replace each homepage placeholder in `front-page.php` with a reusable template part.
5. Build reusable components inside `template-parts/components/`.
6. Build service, industry, location, blog, contact, search, and 404 templates.
7. Add custom fields or block patterns only after the visual components are stable.

## Initial WordPress setup

- Upload and activate the theme on staging.
- Set a static homepage under Settings > Reading.
- Upload the site logo under Appearance > Customize > Site Identity.
- Create and assign menus under Appearance > Menus.
- Add a newsletter form/widget to the Footer Newsletter widget area.
- Save Settings > Permalinks once after activation.

## Main file structure

- `functions.php`: loads modular theme functions.
- `inc/theme-setup.php`: theme support and menus.
- `inc/enqueue.php`: CSS and JavaScript loading.
- `header.php` / `footer.php`: document wrappers.
- `template-parts/header/`: header markup.
- `template-parts/footer/`: footer markup.
- `front-page.php`: homepage foundation.
- `assets/css/variables.css`: colors, fonts, widths, spacing.
- `assets/css/header.css`: desktop header/navigation.
- `assets/css/footer.css`: footer.
- `assets/css/responsive.css`: mobile/tablet behavior.

The placeholder homepage intentionally does not attempt to copy the complete live site. Build and approve one global component at a time.
