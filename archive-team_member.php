<?php
/**
 * Team Members archive -> the Our Team page (slug: leadership).
 *
 * The `team_member` CPT (registered by CPT UI) has an archive at /leadership/,
 * and the "Back to Our Team" button on every member page points there. Without
 * this template WordPress fell back to archive.php, so that URL rendered a
 * generic blog-style list headed "Archives: Team Members". It now renders the
 * designed Our Team layout instead; the document title and breadcrumb are set
 * in inc/template-functions.php, the same way the Locations archive does it.
 *
 * @package McCollisters
 */

get_header();

get_template_part('template-parts/team/team-listing');

get_footer();
