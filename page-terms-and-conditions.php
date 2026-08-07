<?php
/**
 * Template Name: Page — Website Terms & Conditions
 *
 * Hard-coded Terms & Conditions page (slug: terms-and-conditions). A plain
 * header (title + subtitle) over 21 numbered sections, then the CTA cards.
 * Reuses the global type tokens and cta-cards component.
 *
 * @package McCollisters
 */

get_header();

$header = [
    'title'    => 'Website Terms<br>&amp; Conditions',
    'subtitle' => 'McCollister’s Global Services, Inc.',
];

$terms_kses = [
    'p'      => [],
    'ul'     => [],
    'li'     => [],
    'strong' => [],
    'br'     => [],
    'a'      => ['href' => [], 'target' => [], 'rel' => []],
];

$sections = [
    ['num' => '01', 'title' => 'Acceptance of Terms', 'body' => '<p>By accessing or using this website (the “Site”), you agree to be legally bound by these Terms &amp; Conditions (“Terms”). If you do not agree, you are prohibited from accessing or using the Site.</p>'],
    ['num' => '02', 'title' => 'Permitted Use', 'body' => '<p>The Site is provided solely for informational purposes related to McCollister’s Global Services, Inc. (“Company”).</p><p><strong>You shall not:</strong></p><ul><li>Use the Site for any unlawful or unauthorized purpose</li><li>Interfere with or disrupt Site functionality</li><li>Attempt to gain unauthorized access to any systems, networks, or data</li><li>Use any automated means (including scraping, bots, or crawlers) without prior written consent</li></ul><p>The Company reserves the right to suspend or terminate access at any time, without notice.</p>'],
    ['num' => '03', 'title' => 'No Offer; No Contract; No Reliance', 'body' => '<p>The Site does not constitute:</p><ul><li>An offer to provide services</li><li>A binding quote, estimate, or proposal</li><li>A commitment regarding pricing, timing, or availability</li></ul><p>All information on the Site is for general informational purposes only and may not be relied upon for any business, legal, or operational decision.</p><p>Any services provided by the Company are governed exclusively by separate written agreements, tariffs, rate confirmations, or bills of lading, which shall control in all circumstances.</p>'],
    ['num' => '04', 'title' => 'Transportation &amp; Logistics Disclaimer', 'body' => '<p>To the extent applicable, all transportation services are subject to:</p><ul><li>The Carmack Amendment (49 U.S.C. § 14706)</li><li>Applicable tariffs, bills of lading, and service agreements</li></ul><p>Nothing on this Site modifies or supplements those terms.</p>'],
    ['num' => '05', 'title' => 'Intellectual Property', 'body' => '<p>All content on the Site—including text, graphics, logos, images, and software—is the exclusive property of the Company or its licensors and is protected by applicable intellectual property laws.</p><p>Unauthorized use, reproduction, or distribution is strictly prohibited and may result in legal action.</p>'],
    ['num' => '06', 'title' => 'Privacy &amp; Data Use', 'body' => '<p>Your use of the Site is subject to the Company’s Privacy Policy: <a href="' . esc_url(home_url('/privacy-policy/')) . '">https://www.mccollisters.com/privacy-policy/</a></p><p>By using the Site, you acknowledge and consent to the collection, use, and disclosure of information as described therein.</p>'],
    ['num' => '07', 'title' => 'Data Submission; No Confidentiality', 'body' => '<p>Any information submitted through the Site:</p><ul><li>Shall be deemed non-confidential and non-proprietary</li><li>Must not violate any third-party rights or applicable laws</li></ul><p>The Company shall have no obligation to protect or restrict use of such information and may use it for any lawful purpose.</p>'],
    ['num' => '08', 'title' => 'Electronic Communications Consent', 'body' => '<p>By submitting information through the Site, you expressly consent to receive communications from the Company.</p>'],
    ['num' => '09', 'title' => 'Disclaimer of Warranties', 'body' => '<p>THE SITE AND ALL CONTENT ARE PROVIDED “AS IS” AND “AS AVAILABLE,” WITHOUT WARRANTIES OF ANY KIND.</p>'],
    ['num' => '10', 'title' => 'Limitation of Liability', 'body' => '<p>TO THE MAXIMUM EXTENT PERMITTED BY LAW:</p><ul><li>THE COMPANY SHALL NOT BE LIABLE FOR ANY INDIRECT OR CONSEQUENTIAL DAMAGES.</li><li>TOTAL LIABILITY SHALL NOT EXCEED $100.</li></ul>'],
    ['num' => '11', 'title' => 'Third-Party Content &amp; Links', 'body' => '<p>The Company disclaims all responsibility for third-party content.</p>'],
    ['num' => '12', 'title' => 'Cybersecurity &amp; Unauthorized Access', 'body' => '<p>The Company disclaims all responsibility for third-party content.</p>'],
    ['num' => '13', 'title' => 'Indemnification', 'body' => '<p>You agree to indemnify and hold harmless the Company from all claims arising out of your use of the Site.</p>'],
    ['num' => '14', 'title' => 'Export Controls &amp; Sanctions Compliance', 'body' => '<p>You agree not to use the Site in violation of U.S. export control or sanctions laws.</p>'],
    ['num' => '15', 'title' => 'Accessibility Disclaimer', 'body' => '<p>The Company disclaims liability related to accessibility limitations.</p>'],
    ['num' => '16', 'title' => 'Governing Law &amp; Venue', 'body' => '<p>These Terms shall be governed by the laws of the State of New Jersey.</p>'],
    ['num' => '17', 'title' => 'Waiver of Jury Trial', 'body' => '<p>You waive any right to a trial by jury.</p>'],
    ['num' => '18', 'title' => 'Modifications', 'body' => '<p>The Company may modify these Terms at any time.</p>'],
    ['num' => '19', 'title' => 'Severability', 'body' => '<p>If any provision is invalid, the remainder shall remain in effect.</p>'],
    ['num' => '20', 'title' => 'Entire Agreement', 'body' => '<p>These Terms constitute the entire agreement regarding use of the Site.</p>'],
    ['num' => '21', 'title' => 'Contact Information', 'body' => '<p><strong>McCollister’s Global Services, Inc.<br>Headquarters</strong><br>8 Terri Lane<br>Burlington, NJ 08016<br><a href="mailto:info@mccollisters.com">info@mccollisters.com</a><br>609-386-0600<br>800-257-9595</p>'],
];
?>
<main id="primary" class="site-main">

    <!-- Header + terms body -->
    <section class="svc-section terms">
        <div class="svc-section__inner">
            <div class="terms__head">
                <h1 class="terms__title"><?php echo wp_kses($header['title'], ['br' => []]); ?></h1>
                <p class="terms__subtitle"><?php echo esc_html($header['subtitle']); ?></p>
            </div>

            <div class="terms__body">
                <?php foreach ($sections as $s) : ?>
                    <div class="terms__section">
                        <h3 class="terms__heading"><?php echo esc_html($s['num']); ?>. <?php echo wp_kses($s['title'], []); ?></h3>
                        <?php echo wp_kses($s['body'], $terms_kses); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA cards -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
