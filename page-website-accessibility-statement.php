<?php
/**
 * Template Name: Page — Website Accessibility Statement
 *
 * Hard-coded Accessibility Statement page (slug: website-accessibility-statement).
 * Reuses the Terms & Conditions layout/type (.terms* classes) for consistency:
 * a plain header (title + "Last reviewed" line) over named sections, then the
 * CTA cards.
 *
 * @package McCollisters
 */

get_header();

$header = [
    'title'    => 'Website<br>Accessibility<br>Statement',
    'subtitle' => 'Last reviewed: July 7, 2026',
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
    ['title' => 'Our Commitment', 'body' => '<p>McCollister’s Global Services, Inc. is committed to providing an accessible and inclusive digital experience for all users, including individuals with disabilities.</p><p>We are continually working to improve the accessibility and usability of our website and digital services so that visitors can obtain information about McCollister’s and our services in a manner that is convenient, effective, and accessible.</p>'],
    ['title' => 'Accessibility Standard', 'body' => '<p>Our accessibility goal is for the McCollister’s website to conform to the <strong>Web Content Accessibility Guidelines (“WCAG”) 2.2, Level AA</strong>, published by the World Wide Web Consortium.</p><p>WCAG provides guidance for making digital content more accessible to individuals with a wide range of disabilities, including visual, auditory, physical, speech, cognitive, language, learning, and neurological disabilities.</p><p>Our accessibility efforts also take into consideration the applicable technical requirements of <strong>Section 508 of the Rehabilitation Act</strong>, including the WCAG Level A and Level AA success criteria incorporated into the Revised Section 508 Standards.</p>'],
    ['title' => 'Accessibility Measures', 'body' => '<p>As part of our accessibility efforts, McCollister’s seeks to:</p><ul><li>Provide text alternatives for meaningful images and other non-text content;</li><li>Maintain sufficient color contrast between text and backgrounds;</li><li>Support navigation and operation using a keyboard;</li><li>Use headings, labels, links, and page structures that are meaningful and understandable;</li><li>Provide captions or other appropriate alternatives for multimedia content;</li><li>Design forms with accessible labels, instructions, and error messages;</li><li>Support commonly used screen readers, browser accessibility features, voice-recognition software, and other assistive technologies;</li><li>Review new website content and functionality for accessibility; and</li><li>Periodically evaluate the website using automated testing, manual testing, and, where appropriate, testing with assistive technology.</li></ul>'],
    ['title' => 'Compatibility', 'body' => '<p>The McCollister’s website is intended to be compatible with current versions of commonly used web browsers and assistive technologies.</p><p>For the best experience, users should use a current version of their preferred browser, operating system, and assistive technology. Older or unsupported versions may not provide the same level of accessibility or functionality.</p>'],
    ['title' => 'Known Limitations', 'body' => '<p>Although McCollister’s strives to make its website accessible, some content or functionality may not yet fully meet our accessibility goals. Potential limitations may include:</p><ul><li>Certain older PDF documents or other legacy files;</li><li>Content, applications, maps, forms, videos, or other features supplied or hosted by third parties; and</li><li>Content that is in the process of being reviewed, updated, or remediated.</li></ul><p>Third-party content and technology may be subject to accessibility limitations outside McCollister’s immediate control. We nevertheless encourage users to report accessibility problems involving any part of our website.</p><p>When requested, McCollister’s will make reasonable efforts to provide the affected information or service through an accessible alternative method or format.</p>'],
    ['title' => 'Accessibility Assistance and Feedback', 'body' => '<p>We welcome feedback concerning the accessibility of our website. If you experience difficulty accessing any content, feature, document, or service, please contact us:</p><p><strong>Accessibility Coordinator:</strong><br>Stephen Schukraft<br>General Counsel<br>McCollister’s Global Services, Inc.<br><strong>Email:</strong> <a href="mailto:accessibility@mccollisters.com">accessibility@mccollisters.com</a><br><strong>Telephone:</strong> 800-257-9595<br><strong>Online:</strong> <a href="' . $contact_url . '">McCollister’s Contact Us form</a></p><p>When reporting an accessibility problem, please provide, when possible:</p><ul><li>The web address or title of the page;</li><li>A brief description of the problem;</li><li>The browser, device, and assistive technology you were using; and</li><li>Your preferred method of contact.</li></ul><p>Please do not include confidential, medical, or other sensitive personal information unless it is necessary for us to understand and respond to your request.</p><p>McCollister’s will acknowledge accessibility-related communications and will make reasonable efforts to investigate and address reported barriers promptly. The time needed to resolve an issue may depend on its nature, complexity, and whether third-party technology is involved.</p>'],
    ['title' => 'Requesting an Accessible Alternative', 'body' => '<p>If information or a service on this website is not accessible to you, please contact the Accessibility Coordinator using the information above. Please identify the information or service you need and the accessible format or alternative method that would be most useful.</p><p>McCollister’s will make reasonable efforts to provide the information or service through an effective alternative method while the accessibility issue is evaluated.</p>'],
    ['title' => 'Formal Accessibility Complaints', 'body' => '<p>The accessibility feedback process described above is intended to allow McCollister’s to identify and promptly correct accessibility barriers.</p><p>A person who believes an accessibility concern has not been appropriately addressed may submit a formal written complaint to:</p><p><strong>Stephen Schukraft</strong><br>General Counsel and Accessibility Coordinator<br>McCollister’s Global Services, Inc.<br>8 Terri Lane<br>Burlington, New Jersey 08016<br><strong>Email:</strong> <a href="mailto:sschukraft@mccollisters.com">sschukraft@mccollisters.com</a></p><p>The complaint should include:</p><ul><li>The complainant’s name and contact information;</li><li>The webpage, document, feature, or service involved;</li><li>A description of the accessibility barrier;</li><li>The date or approximate date the problem occurred;</li><li>Any prior efforts to report or resolve the problem; and</li><li>The requested resolution or accommodation.</li></ul><p>McCollister’s will review formal accessibility complaints and provide a response within a reasonable period based on the circumstances.</p>'],
    ['title' => 'Employment and Applicant Accommodations', 'body' => '<p>McCollister’s provides reasonable accommodations to qualified applicants and employees with disabilities in accordance with applicable law.</p><p>An applicant who requires an accommodation to access employment information, complete an application, participate in an interview, or otherwise take part in the hiring process should contact McCollister’s Human Resources Department through the contact information provided in the applicable job posting or by calling <strong>800-257-9595</strong> and requesting Human Resources.</p><p>Requests for employment-related accommodations are handled separately from general website accessibility feedback.</p>'],
    ['title' => 'Telecommunications Relay Services', 'body' => '<p>Individuals who are deaf, hard of hearing, deafblind, or who have a speech disability may use a Telecommunications Relay Service to communicate with McCollister’s.</p><p>In the United States, users may generally access a relay service by dialing <strong>7-1-1</strong> or by using an internet-based, video, or other relay-service provider. Relay services are generally available at no additional charge to the user.</p><p>Additional information is available through the Federal Communications Commission’s Telecommunications Relay Services resources.</p>'],
    ['title' => 'Continuing Improvement', 'body' => '<p>Accessibility is an ongoing process. McCollister’s will continue to assess its website, address identified accessibility barriers, and consider accessibility when adding or modifying digital content, features, and services.</p><p>This Website Accessibility Statement will be reviewed periodically and updated to reflect material changes to our website, accessibility standards, or accessibility practices.</p>'],
];
?>
<main id="primary" class="site-main">

    <!-- Header + statement body -->
    <section class="svc-section terms">
        <div class="svc-section__inner">
            <div class="terms__head">
                <h1 class="terms__title"><?php echo wp_kses($header['title'], ['br' => []]); ?></h1>
                <p class="terms__subtitle"><?php echo esc_html($header['subtitle']); ?></p>
            </div>

            <div class="terms__body">
                <?php foreach ($sections as $s) : ?>
                    <div class="terms__section">
                        <h3 class="terms__heading"><?php echo esc_html($s['title']); ?></h3>
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
