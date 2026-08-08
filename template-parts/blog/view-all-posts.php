<?php
/**
 * "View All Posts" back-link — the animated underline/chevron link shown above
 * single-post, archive, and search titles. Points at the Blog index.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<a class="single-post__back" href="<?php echo esc_url(home_url('/blog/')); ?>">
    <span class="single-post__back-text"><?php esc_html_e('View All Posts', 'mccollisters'); ?></span>
    <span class="single-post__back-arrow" aria-hidden="true">
        <svg class="single-post__back-arrow-diagonal" viewBox="0 0 24 24" fill="none"><path d="M7 17 17 7M8 7h9v9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <svg class="single-post__back-arrow-chevron" viewBox="0 0 24 24" fill="none"><path d="m9 6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </span>
</a>
