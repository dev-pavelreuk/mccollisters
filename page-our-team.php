<?php
/**
 * Template Name: Page — Our Team
 *
 * Hard-coded Our Team page (slug: our-team). A "Powered by People" header +
 * founder quote, then the CPT-UI `team_member` posts grouped by the `team_group`
 * taxonomy (Executives, Division Leaders, …). Each card shows a colour headshot
 * that greyscales on hover while the corner "+" turns brand-blue. Then the
 * shared "More About" cards and the CTA cards.
 *
 * NOTE: the team CPT/fields live on the production/staging DB, not locally.
 * Post type = team_member, grouping taxonomy = team_group. The position and
 * LinkedIn values are read from the first matching meta key below — adjust the
 * key lists once the real Meta Box keys are confirmed on staging.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);

$plus_icon = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>';
$in_icon   = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.94 5a1.94 1.94 0 1 1-3.88 0 1.94 1.94 0 0 1 3.88 0zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91l.04-1.68z"/></svg>';

$header = [
    'crumb' => 'our team',
    'title' => 'Powered by<br>People',
    'intro' => [
        'McCollister’s takes great pride in our team of seasoned transportation and logistics professionals who makes it possible for us to deliver excellence every day.',
    ],
    'quote' => [
        'text' => 'The most valuable asset we have is our people. Without their efforts and commitment to serve our customers, we would not be successful.',
        'name' => 'H. Daniel McCollister',
        'role' => 'Chairman Emeritus',
    ],
];

// Note: not named $more — that's a WordPress loop global that the_post() clobbers.
$more_about = [
    'title' => 'More About<br>McCollister’s',
    'cards' => [
        ['icon' => $uploads . '2026/06/Our-History-About-Us-i.png', 'title' => 'Our History', 'url' => home_url('/history/'), 'text' => 'Discover how we became the McCollister’s we are today.'],
        ['icon' => $uploads . '2026/06/About-Us-Our-Team-i.png', 'title' => 'About Us', 'url' => home_url('/about-us/'), 'text' => 'Learn more about who we are, who we serve, and what we do.'],
        ['icon' => $uploads . '2026/06/Careers-About-Us-i.png', 'title' => 'Careers', 'url' => home_url('/careers/'), 'text' => 'Explore opportunities to grow your career with our team.'],
        ['icon' => $uploads . '2026/06/ESG-Practices-About-Us-i.png', 'title' => 'ESG Practices', 'url' => home_url('/esg-practices/'), 'text' => 'Explore the principles that guide our company and commitment to customers.'],
    ],
];

/* Read the first non-empty value across a list of likely meta keys. */
if (!function_exists('mcc_team_meta')) {
    function mcc_team_meta($post_id, array $keys)
    {
        foreach ($keys as $key) {
            $value = get_post_meta($post_id, $key, true);
            if (!empty($value)) {
                return $value;
            }
        }
        return '';
    }
}

/* Render one team-member card. */
if (!function_exists('mcc_team_card')) {
    function mcc_team_card($post_id, $plus_icon, $in_icon)
    {
        $name     = get_the_title($post_id);
        $slug     = get_post_field('post_name', $post_id);
        $position = mcc_team_meta($post_id, ['team_member_position', '_team_member_position', 'position', 'job_title', 'jobtitle', 'title', 'role', 'team_position']);
        if ($position === '') {
            $position = get_the_excerpt($post_id);
        }

        // The shared 'large' size is a 1:1 square crop; for members whose head
        // sits high in the frame that crop clips the head, so use the taller
        // aspect-preserving size and let object-fit handle the box.
        $tall_crops = ['tyler-m-yoos'];
        $img_size   = in_array($slug, $tall_crops, true) ? '2048x2048' : 'large';
        ?>
        <article class="team-card team-card--<?php echo esc_attr($slug); ?>">
            <a class="team-card__media" href="<?php echo esc_url(get_permalink($post_id)); ?>" aria-label="<?php echo esc_attr($name); ?>">
                <span class="team-card__plus" aria-hidden="true"><?php echo $plus_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                <?php if (has_post_thumbnail($post_id)) : ?>
                    <?php echo get_the_post_thumbnail($post_id, $img_size, ['class' => 'team-card__img', 'loading' => 'lazy', 'decoding' => 'async', 'alt' => esc_attr($name)]); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php else : ?>
                    <span class="team-card__img team-card__img--placeholder" aria-hidden="true"></span>
                <?php endif; ?>
            </a>
            <h3 class="team-card__name"><a href="<?php echo esc_url(get_permalink($post_id)); ?>"><?php echo esc_html($name); ?></a></h3>
            <?php if ($position) : ?>
                <p class="team-card__role"><?php echo esc_html($position); ?></p>
            <?php endif; ?>
        </article>
        <?php
    }
}

// Groups (Executives, Division Leaders, …); fall back to one flat list.
$groups = get_terms([
    'taxonomy'   => 'team_group',
    'hide_empty' => true,
    'orderby'    => 'term_order',
    'order'      => 'ASC',
]);
if (is_wp_error($groups)) {
    $groups = [];
}

// Groups that actually have members (taxonomy order preserved); each group's
// members ordered by the date they were added (oldest first).
$team_groups = [];
foreach ($groups as $group) {
    $q = new WP_Query([
        'post_type'      => 'team_member',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'ASC',
        'tax_query'      => [[
            'taxonomy' => 'team_group',
            'field'    => 'term_id',
            'terms'    => $group->term_id,
        ]],
    ]);
    if ($q->have_posts()) {
        $team_groups[] = ['name' => $group->name, 'query' => $q];
    }
}
?>
<main id="primary" class="site-main">

    <!-- Header + founder quote -->
    <section class="svc-section loc-head team-head">
        <div class="svc-section__inner team-head__grid">
            <div class="team-head__main">
                <p class="loc-head__crumb">/ <?php echo esc_html($header['crumb']); ?> /</p>
                <h1 class="loc-head__title"><?php echo wp_kses($header['title'], ['br' => []]); ?></h1>
                <div class="team-head__intro">
                    <?php foreach ($header['intro'] as $p) : ?>
                        <p><?php echo esc_html($p); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>

            <figure class="team-quote">
                <img class="team-quote__mark" src="<?php echo esc_url($uploads . '2026/05/Quotation-Marks-Yellow.svg'); ?>" alt="" aria-hidden="true" width="513" height="402" loading="lazy" decoding="async">

                <div class="team-quote__body">
                    <p class="team-quote__text">“<?php echo esc_html($header['quote']['text']); ?>”</p>
                    <figcaption class="team-quote__by"><?php echo esc_html($header['quote']['name'] . ', ' . $header['quote']['role']); ?></figcaption>
                </div>
            </figure>
        </div>
    </section>

    <!-- Team members: tabs on desktop, stacked labelled sections on mobile. -->
    <section class="svc-section team">
        <div class="svc-section__inner">
            <?php if (!empty($team_groups)) : ?>
                <div class="team__tabs" role="tablist" aria-label="<?php esc_attr_e('Team groups', 'mccollisters'); ?>">
                    <?php foreach ($team_groups as $i => $tg) : ?>
                        <button type="button" class="team__tab<?php echo $i === 0 ? ' is-active' : ''; ?>" data-team-tab="<?php echo esc_attr($i); ?>" aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"><?php echo esc_html($tg['name']); ?></button>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($team_groups as $i => $tg) : ?>
                    <div class="team__group<?php echo $i === 0 ? ' is-active' : ''; ?>" data-team-panel="<?php echo esc_attr($i); ?>">
                        <h3 class="team__group-title"><?php echo esc_html($tg['name']); ?></h3>
                        <div class="team__grid">
                            <?php while ($tg['query']->have_posts()) : $tg['query']->the_post(); ?>
                                <?php mcc_team_card(get_the_ID(), $plus_icon, $in_icon); ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else :
                $members = new WP_Query([
                    'post_type'      => 'team_member',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);
                ?>
                <?php if ($members->have_posts()) : ?>
                    <div class="team__grid">
                        <?php while ($members->have_posts()) : $members->the_post(); ?>
                            <?php mcc_team_card(get_the_ID(), $plus_icon, $in_icon); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                <?php else : ?>
                    <p class="team__empty"><?php esc_html_e('Team members will appear here soon.', 'mccollisters'); ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- More About McCollister's (icon cards) -->
    <section class="svc-section svc-integrated">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $more_about['title'],
            ]); ?>
            <div class="svc-integrated__grid">
                <?php foreach ($more_about['cards'] as $card) : ?>
                    <div class="svc-integrated__card">
                        <div class="svc-integrated__icon">
                            <img src="<?php echo esc_url($card['icon']); ?>" alt="" loading="lazy" decoding="async">
                        </div>
                        <h3 class="svc-integrated__title">
                            <a href="<?php echo esc_url($card['url']); ?>"><?php echo esc_html($card['title']); ?></a>
                        </h3>
                        <p class="svc-integrated__text"><?php echo esc_html($card['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA cards -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
