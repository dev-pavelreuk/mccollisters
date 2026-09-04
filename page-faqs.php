<?php
/**
 * Template Name: Page — FAQs (General Questions)
 *
 * Hard-coded FAQs page (slug: faqs). The General Questions accordion sits beside
 * a "By Industry" list; selecting an industry opens a modal with that industry's
 * FAQ accordion plus Download (PDF) and Print actions. Industry FAQ content is
 * shared from inc/faq-data.php (mcc_industry_faqs), so it stays in sync with the
 * service pages. Reuses the [data-accordion] FAQ component, svc-integrated, and
 * cta-cards.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);

// Diagonal arrow (down-right closed → up-right open handled by CSS rotation).
$faq_arrow  = '<svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$dl_icon    = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$print_icon = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9V3h12v6M6 18H4a1 1 0 0 1-1-1v-5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5a1 1 0 0 1-1 1h-2M6 14h12v7H6z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';

$faq_kses = [
    'p'      => [],
    'ul'     => [],
    'li'     => [],
    'strong' => [],
    'br'     => [],
    'span'   => [],
    'a'      => ['href' => [], 'target' => [], 'rel' => [], 'aria-label' => []],
];

/* -- Editable content (→ ACF later) --------------------------------------- */

$header = [
    'crumb' => 'faqs',
    'title' => 'General Questions',
];

$general = mcc_faqs_for('general');

$industries = function_exists('mcc_industry_faqs') ? mcc_industry_faqs() : [];

$more = [
    'title' => 'More About<br>McCollister’s',
    'cards' => [
        ['icon' => $uploads . '2026/06/About-Us-Our-Team-i.png', 'title' => 'About Us', 'url' => home_url('/about-us/'), 'text' => 'Learn more about who we are, who we serve, and what we do.'],
        ['icon' => $uploads . '2026/06/Certifications-About-Us-i.png', 'title' => 'Certifications', 'url' => home_url('/forms-certifications-documents/'), 'text' => 'Find important forms, certifications, and helpful guides.'],
        ['icon' => $uploads . '2026/06/Careers-About-Us-i.png', 'title' => 'Careers', 'url' => home_url('/careers/'), 'text' => 'Learn more about working for McCollister’s and view open positions.'],
        ['icon' => $uploads . '2026/06/ESG-Practices-About-Us-i.png', 'title' => 'ESG Practices', 'url' => home_url('/esg/'), 'text' => 'Explore the principles that guide our company and commitment to customers.'],
    ],
];

/**
 * Render one FAQ accordion (<details> list) from [{q,a}] items; first item open.
 */
$render_accordion = static function (array $items) use ($faq_arrow, $faq_kses): void {
    echo '<div class="svc-faqs__list" data-accordion>';
    foreach ($items as $i => $item) {
        echo '<details class="svc-faq"' . (0 === $i ? ' open' : '') . '>';
        echo '<summary class="svc-faq__summary">';
        echo '<span class="svc-faq__q">' . wp_kses($item['q'], []) . '</span>';
        echo '<span class="svc-faq__icon" aria-hidden="true">' . $faq_arrow . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '</summary>';
        echo '<div class="svc-faq__panel">' . wp_kses($item['a'], $faq_kses) . '</div>';
        echo '</details>';
    }
    echo '</div>';
};
?>
<?php mcc_faq_schema($general); ?>
<main id="primary" class="site-main">

    <!-- Header -->
    <section class="svc-section hist-head faqs-head">
        <div class="svc-section__inner">
            <p class="hist-head__crumb">/ <?php echo esc_html($header['crumb']); ?> /</p>
            <h1 class="hist-head__title"><?php echo esc_html($header['title']); ?></h1>
        </div>
    </section>

    <!-- General Questions + By Industry -->
    <section class="svc-section faqs-main">
        <div class="svc-section__inner faqs-main__inner">
            <div class="faqs-main__questions">
                <?php $render_accordion($general); ?>
            </div>

            <aside class="faqs-industries" aria-label="FAQs by industry">
                <p class="faqs-industries__label">By Industry</p>
                <ul class="faqs-industries__list">
                    <?php foreach ($industries as $slug => $ind) : ?>
                        <li>
                            <button type="button" class="faqs-industries__link" data-faqs-open="<?php echo esc_attr($slug); ?>">
                                <?php echo esc_html($ind['label']); ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
    </section>

    <!-- More About McCollister's (icon cards) -->
    <section class="svc-section svc-integrated">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $more['title'],
            ]); ?>
            <div class="svc-integrated__grid">
                <?php foreach ($more['cards'] as $card) : ?>
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

    <!-- Industry FAQ templates (cloned into the modal on demand) -->
    <?php foreach ($industries as $slug => $ind) : ?>
        <template data-faqs-tpl="<?php echo esc_attr($slug); ?>"
                  data-title="<?php echo esc_attr($ind['label'] . ' FAQs'); ?>"
                  data-pdf="<?php echo esc_url($uploads . '2026/05/' . $ind['pdf']); ?>">
            <?php $render_accordion($ind['items']); ?>
        </template>
    <?php endforeach; ?>

    <!-- Industry FAQ modal -->
    <div class="faqs-modal" id="faqs-modal" hidden>
        <div class="faqs-modal__overlay" data-faqs-close></div>
        <div class="faqs-modal__box" role="dialog" aria-modal="true" aria-labelledby="faqs-modal-title">
            <div class="faqs-modal__head">
                <h2 class="faqs-modal__title" id="faqs-modal-title" data-faqs-title></h2>
                <div class="faqs-modal__actions">
                    <a class="faqs-modal__action" data-faqs-download href="#" target="_blank" rel="noopener" download>
                        <span class="faqs-modal__action-icon"><?php echo $dl_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>Download
                    </a>
                    <button type="button" class="faqs-modal__action" data-faqs-print>
                        <span class="faqs-modal__action-icon"><?php echo $print_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>Print
                    </button>
                    <button type="button" class="faqs-modal__close" data-faqs-close aria-label="Close">&times;</button>
                </div>
            </div>
            <div class="faqs-modal__body" data-faqs-body></div>
        </div>
    </div>

    <script>
        (function () {
            var modal = document.getElementById('faqs-modal');
            if (!modal) { return; }
            var body = modal.querySelector('[data-faqs-body]');
            var titleEl = modal.querySelector('[data-faqs-title]');
            var dlEl = modal.querySelector('[data-faqs-download]');

            function openModal(slug) {
                var tpl = document.querySelector('[data-faqs-tpl="' + slug + '"]');
                if (!tpl) { return; }
                body.innerHTML = '';
                body.appendChild(tpl.content.cloneNode(true));
                titleEl.textContent = tpl.getAttribute('data-title');
                dlEl.setAttribute('href', tpl.getAttribute('data-pdf'));
                // Smooth height-animated, single-open accordion (same as the page).
                if (window.mccInitAccordions) { window.mccInitAccordions(body); }
                modal.hidden = false;
                document.body.style.overflow = 'hidden';
            }
            function closeModal() {
                modal.hidden = true;
                body.innerHTML = '';
                document.body.style.overflow = '';
            }

            document.querySelectorAll('[data-faqs-open]').forEach(function (btn) {
                btn.addEventListener('click', function () { openModal(btn.getAttribute('data-faqs-open')); });
            });
            modal.querySelectorAll('[data-faqs-close]').forEach(function (el) {
                el.addEventListener('click', closeModal);
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !modal.hidden) { closeModal(); }
            });

            var printBtn = modal.querySelector('[data-faqs-print]');
            if (printBtn) {
                printBtn.addEventListener('click', function () {
                    // Open every answer so the print captures the full FAQ.
                    body.querySelectorAll('details').forEach(function (d) { d.open = true; });
                    document.body.classList.add('faqs-printing');
                    window.print();
                    document.body.classList.remove('faqs-printing');
                });
            }
        })();
    </script>

</main>
<?php get_footer(); ?>
