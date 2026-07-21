<?php
/**
 * Front page foundation.
 * Replace each placeholder section as the custom build progresses.
 *
 * @package McCollisters
 */

get_header();
?>
<main id="primary" class="site-main">
    <section class="home-hero section section--dark">
        <div class="container home-hero__inner">
            <div class="home-hero__content">
                <p class="eyebrow"><?php esc_html_e('When Matters', 'mccollisters'); ?></p>
                <h1><?php esc_html_e('Transportation and logistics solutions built around what matters most.', 'mccollisters'); ?></h1>
                <p class="lead"><?php esc_html_e('This is the homepage foundation. Replace it section by section while matching the current McCollister’s website.', 'mccollisters'); ?></p>
                <div class="button-group">
                    <a class="button button--primary" href="<?php echo esc_url(home_url('/contact-us/')); ?>"><?php esc_html_e('Talk to an Expert', 'mccollisters'); ?></a>
                    <a class="button button--outline-light" href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Explore Services', 'mccollisters'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <?php
    $sections = [
        ['services', __('Services Overview', 'mccollisters')],
        ['facility-search', __('Facility Search', 'mccollisters')],
        ['about', __('About McCollister’s', 'mccollisters')],
        ['industries', __('Industries', 'mccollisters')],
        ['statistics', __('Statistics', 'mccollisters')],
        ['testimonials', __('Testimonials', 'mccollisters')],
        ['news', __('Latest News', 'mccollisters')],
        ['cta', __('Call to Action', 'mccollisters')],
    ];

    foreach ($sections as [$slug, $title]) :
    ?>
        <section class="section home-placeholder home-placeholder--<?php echo esc_attr($slug); ?>">
            <div class="container">
                <p class="eyebrow"><?php esc_html_e('Build Next', 'mccollisters'); ?></p>
                <h2><?php echo esc_html($title); ?></h2>
                <p><?php esc_html_e('Replace this placeholder with the matching custom-coded section from the existing site.', 'mccollisters'); ?></p>
            </div>
        </section>
    <?php endforeach; ?>
</main>
<?php get_footer(); ?>
