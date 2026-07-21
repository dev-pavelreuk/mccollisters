<?php
/**
 * Empty results content.
 *
 * @package McCollisters
 */
?>
<section class="no-results">
    <h1><?php esc_html_e('Nothing found', 'mccollisters'); ?></h1>
    <p><?php esc_html_e('Try a different search or return to the homepage.', 'mccollisters'); ?></p>
    <?php get_search_form(); ?>
</section>
