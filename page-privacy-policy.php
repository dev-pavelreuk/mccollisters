<?php
/**
 * Template Name: Page — Privacy Policy
 *
 * Hard-coded Privacy Policy page (slug: privacy-policy). Reuses the Terms &
 * Conditions layout/type (.terms* classes) for consistency: a plain header over
 * numbered sections, then the CTA cards.
 *
 * @package McCollisters
 */

get_header();

$header = [
    'title' => 'Our Privacy<br>Policy',
];

$terms_kses = [
    'p'      => [],
    'ul'     => [],
    'li'     => [],
    'strong' => [],
    'br'     => [],
    'a'      => ['href' => [], 'target' => [], 'rel' => []],
];

$contact_url = esc_url(home_url('/contact-us/'));

$sections = [
    ['num' => '01', 'title' => 'Information collected', 'body' => '<p>When contacting us you may provide McCollister’s with personal contact information, such as your name, company name, address, phone number, and email address. When purchasing services McCollister’s may also require you to provide billing information, such as billing name and address, credit card number (“Billing Information”). This Billing Information and any other information you submit to McCollister’s or submit through the course of our relationship are referred to collectively as “Data.”</p>'],
    ['num' => '02', 'title' => 'Use of data', 'body' => '<p>McCollister’s uses Data about its Customers to perform the services requested. McCollister’s may also use Data about its Customers for marketing purposes such as sending you information regarding the Services. McCollister’s uses credit card information solely to collect payment from its Customers.</p>'],
    ['num' => '03', 'title' => 'Sharing of information collected', 'body' => '<p>McCollister’s does not share, sell, rent, or trade any Data with third parties. McCollister’s reserves the right to use or disclose information provided if required by law or if McCollister’s reasonably believes that use or disclosure is necessary to protect McCollister’s rights and/or to comply with a judicial proceeding, court order, or legal process.</p>'],
    ['num' => '04', 'title' => 'Customer Data', 'body' => '<p>McCollister’s Customers may provide information regarding their employees and computer systems throughout the course of utilizing the McCollister’s services (“Customer Data”). McCollister’s may access Customer Data only for providing or maintaining the services or addressing service or technical problems or as may be required by law. McCollister’s Customers can send a complete deletion instruction through our Contact Us Form at <strong><a href="' . $contact_url . '">https://www.mccollisters.com/contact/</a></strong> or by emailing <strong><a href="mailto:ithelp@mccollisters.com">ithelp@mccollisters.com</a></strong> or by calling <strong>800-257-9595</strong> and speaking to data protection and security team, and information technology executive manager.</p>'],
    ['num' => '05', 'title' => 'Security', 'body' => '<p>McCollister’s uses numerous security measures to protect the Data and Customer Data.</p>'],
    ['num' => '06', 'title' => 'Changes to this Privacy Policy', 'body' => '<p>McCollister’s reserves the right to change this Privacy Policy. Material changes to this Privacy Policy will be communicated through the McCollister’s website at least thirty (30) business days prior to the change taking effect.</p>'],
    ['num' => '07', 'title' => 'Questions', 'body' => '<p>Please contact us regarding any question about this Privacy Policy by phone or web form located at <strong><a href="' . $contact_url . '">https://www.mccollisters.com/contact-us/</a></strong> or <strong>800-257-9595</strong>.</p>'],
];
?>
<main id="primary" class="site-main">

    <!-- Header + policy body -->
    <section class="svc-section terms">
        <div class="svc-section__inner">
            <div class="terms__head">
                <h1 class="terms__title"><?php echo wp_kses($header['title'], ['br' => []]); ?></h1>
            </div>

            <div class="terms__body">
                <?php foreach ($sections as $s) : ?>
                    <div class="terms__section">
                        <h3 class="terms__heading"><?php echo esc_html($s['num']); ?>. <?php echo esc_html($s['title']); ?></h3>
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
