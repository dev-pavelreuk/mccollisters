<?php
/**
 * Template Name: Service Page — Technical Services
 *
 * Hard-coded service page (slug: technical-services). Editable content lives in
 * the variables up top so it can later map to ACF. Reuses the global components:
 * .section-head, .mcc-btn, [data-accordion], the .svc-avcaps image+checklist and
 * the .svc-freight dark section — and service.css.
 *
 * @package McCollisters
 */

get_header();

$uploads = trailingslashit(wp_get_upload_dir()['baseurl']);
$arrow   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$check   = '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 10 17.5 19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

/* -- Editable content (→ ACF later) --------------------------------------- */

$hero = [
    'image'    => $uploads . '2026/01/data-center3.jpg',
    'title'    => 'Technical Services',
    'subtitle' => 'The IT professional services division of McCollister’s',
    'buttons'  => [
        ['label' => 'Commercial Relocation', 'url' => home_url('/commercial-relocation/')],
        ['label' => 'Locations', 'url' => home_url('/locations/')],
    ],
];

$overview = [
    'eyebrow' => 'overview',
    'title'   => 'Expert-Led Data<br>Center Projects<br>From Start To Finish',
    'paras'   => [
        'Every company relies on data to function. With data breaches continually on the rise and regulatory requirements growing more stringent, following best practices for data management is fundamental for business success. While organizations may have strong data governance related to data collection and storage, proper data center migration and decommissioning are often overlooked.',
        'For businesses who want to ensure their data center project is managed delicately, deftly, and securely, McCollister’s Technical Services (MTS) offers expertly performed IT asset disposition (ITAD) and enterprise IT services. Our reliable and highly trained technicians and project managers have the specific knowledge and equipment required to complete your project efficiently, effectively, and responsibly — a capability most logistics companies lack. We specialize in several core services: data center relocation, physical migration, consolidation, and decommissioning; cabling services within the data center; secure data destruction; tape library decommissioning; e-waste disposal; and IT enterprise new product deployment.',
    ],
];

$capabilities = [
    'title'      => 'Our<br>Capabilities',
    'intro'      => [
        'At MTS, we strive to make your experience as straightforward and stress-free as possible. When you choose MTS for your data center project, we assign a dedicated project manager to oversee and manage the entire process from beginning to end. We treat each project as crucial, with a focus on information gathering, planning, execution, and post-move assistance. As part of McCollister’s nationwide logistics network, MTS also provides access to specialized transportation services, warehousing, packing, and storage across the country. By integrating our best-in-class technical services with McCollister’s logistical prowess, we provide our clients with effortless turnkey solutions designed with their individual needs in mind.',
    ],
    'image'      => $uploads . '2026/03/arranging-wires-1000x1020.jpg',
    'alt'        => 'A man in a white shirt works on a server rack filled with numerous cables, illuminated by blue and red lights, in a data center.',
    'list_title' => 'Our services include:',
    'items'      => [
        'On-site and remote consultation and site surveys',
        'End-to-end enterprise hardware relocation services',
        'On-site and off-site secure data destruction',
        'Certified green disposal with certificate of destruction (COD)',
        'OEM and vendor management',
        'Secure chain-of-custody logistics (HIPAA and ISO compliant)',
        'Enclosed, GPS-tracked fleet with air-ride suspension and climate control',
        'Armed and unarmed security escort options',
        'Server, storage, and network deinstallation/reinstallation',
        'Patch cabling (Ethernet, Fiber, Twinax, power, etc.)',
        'Custom crating and specialized packaging',
        'Secure warehouse facilities with 24/7 monitoring',
        'Full rack relocations',
        'Domestic and international logistics and reverse logistics',
        'Hardware storage and deployment services',
        'Critical and expedited shipment options',
    ],
];

$confidence = [
    'eyebrow' => 'expertise',
    'image'   => $uploads . '2026/03/technology-blue-background-wallpaper.jpg',
    'alt'     => 'Abstract digital art featuring overlapping translucent blue rectangles and lines on a dark background.',
    'title'   => 'Confidence With McCollister’s',
    'intro'   => 'Data centers are a critical element of modern society, interconnecting technology platforms to enable users and companies to perform a vast array of critical services that shape contemporary life. For businesses to operate successfully, they must take great care to ensure that their data is accessible and secure when they need it and appropriately destroyed when they no longer do. Partnering with a reputable and experienced technical services provider like McCollister’s for your data center projects can help instill clarity and confidence that your data—and your organization—is well-protected.',
    'cols'    => [
        [
            'title' => 'Data Center Relocation & Physical Migration',
            'text'  => 'To limit any interruption in operations and frustrations, MTS utilizes an expansive network of data center technicians and project managers, who are specially trained in data center migrations and enterprise IT services. These team members work in collaboration with our logistics fleet and experienced packers, movers, and drivers; to offer a seamless, end-to-end data center migration project. We take pride in delivering a turnkey approach with due consideration given to your schedule, security concerns, OEM contracts, and business needs. By employing this model, we are confident in our ability to deliver an environment that meets all your requirements and reduce your stress throughout the process.',
        ],
        [
            'title' => 'Secure Data Destruction',
            'text'  => 'To help organizations reduce the risks and liabilities posed by improper hardware decommission and data disposal procedures, MTS offers an array of customizable on-site and off-site solutions, including wiping, degaussing, and shredding. End of life equipment and shred remains are processed in green facilities and these services come with a certificate of destruction (COD). Our services are fully auditable, meet nationally and internationally recognized standards for data protection, destruction, and disposal, and are secure from end to end to ensure integrity throughout the process. MTS can handle projects of various sizes and be your single point of contact for any decommissioning projects inside the data center. Whichever method of data destruction you choose, MTS will work with you to meet your satisfaction.',
        ],
    ],
];

$faqs = [
    'eyebrow' => 'faqs',
    'title'   => 'Technical <br>Services',
    'items'   => [
        [
            'q' => 'What are the risks associated with trusting an inexperienced company for my data center project?',
            'a' => '<p>Data center projects are typically costly and time-consuming. You may be tempted to save some money by trusting your project to the lowest bidder or attempting it yourself. Unfortunately, many logistics companies that offer professional IT services do so only as a secondary business. Therefore, going with a company that is not especially qualified to handle this type of work will almost certainly have huge negative consequences for your business. It will likely lead to project delays caused by poor planning or low skill, damage from bad packing/handling, and poor workmanship due to lack of training and ownership. For instance, when dealing with enterprise IT equipment, inept logistics teams will not know how to adequately protect your gear and optics, watch out for faceplates, properly handle rail kits, treat expensive DAC and SAS cabling, among a dozen other examples.</p>'
                 . '<p>Additionally, logistics companies that do not specialize in data center projects will likely lack the ability to do thorough site surveys, increasing your risk of business disruption and downtime, compliance and security failures, cost overruns and scope creep.</p>'
                 . '<p>McCollister’s Technical Services (MTS) has the expert knowledge, appropriate materials, and specialized workforce necessary to ensure your project is properly designed and strategized, your gear is handled safely, the right personnel are onsite, and the environment matches the planned documentation.</p>',
        ],
        [
            'q' => 'What is data center relocation?',
            'a' => '<p>Data center relocation or migration refers to moving an organization’s existing data center infrastructure from one environment to another. This process can include removing servers from the racking as well as serialized inventory, packing and securing boxes with security tape for transfer.</p>',
        ],
        [
            'q' => 'What is data center decommissioning?',
            'a' => '<p>Typically done when IT assets inside a data center have reached the end of their lifecycle, data center decommissioning is the process of properly disposing of the outdated equipment, according to industry standards, business need, and governmental regulations. MTS can provide many end-of-life services for decommissioning your data center, such as device removal, rack removal, cable removal, data destruction services, along with ITAD buyback options.</p>',
        ],
        [
            'q' => 'What information do I need to gather to get a quote for data center relocation, migration, decommissioning and/or secure data disposal services?',
            'a' => '<p>For an initial conversation with MTS, we would need to know the general scope of your proposed project (i.e., what you want to have done), how much material is involved (i.e., a general device list or count); where you want it done; and when you want it done. By giving us this information, we can often provide you with a quote for smaller projects through a quick email exchange. For larger and more detailed projects, we can use that information as a springboard to launch a productive planning call for your quote.</p>',
        ],
        [
            'q' => 'When should I first contact McCollister’s to discuss my data center project?',
            'a' => '<p>Organizations interested in undertaking a data center project should contact MTS as early as possible. If you involve us in your planning discussions, we can help design your project from start to finish, conduct consultations and site surveys, and address any challenges or concerns. Collaborating with us from the outset will give you confidence in the feasibility of your project and allow you to plan your resources appropriately. MTS is often fully booked out in multiple regions for even simple projects three or more weeks in advance. By contacting us at the start of your project planning, you can maximize safety, security, and efficiency, while minimizing business interruption.</p>',
        ],
    ],
];
?>
<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="svc-hero" style="background-image: url('<?php echo esc_url($hero['image']); ?>');">
        <div class="svc-hero__inner">
            <h1 class="svc-hero__title"><?php echo esc_html($hero['title']); ?></h1>
            <p class="svc-hero__subtitle"><?php echo esc_html($hero['subtitle']); ?></p>
            <div class="svc-hero__actions">
                <?php foreach ($hero['buttons'] as $btn) : ?>
                    <a class="mcc-btn" href="<?php echo esc_url($btn['url']); ?>">
                        <span class="mcc-btn__label"><?php echo esc_html($btn['label']); ?></span>
                        <span class="mcc-btn__arrow" aria-hidden="true"><?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Overview -->
    <section class="svc-section svc-section--tight-top">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $overview['eyebrow'],
                'title'   => $overview['title'],
            ]); ?>
            <div class="svc-prose">
                <?php foreach ($overview['paras'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Our Capabilities (image + checklist) -->
    <section class="svc-section svc-avcaps">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'title' => $capabilities['title'],
            ]); ?>
            <div class="svc-prose svc-avcaps__intro">
                <?php foreach ($capabilities['intro'] as $p) : ?>
                    <p><?php echo esc_html($p); ?></p>
                <?php endforeach; ?>
            </div>
            <div class="svc-avcaps__grid svc-avcaps__grid--top">
                <div class="svc-avcaps__media">
                    <img src="<?php echo esc_url($capabilities['image']); ?>" alt="<?php echo esc_attr($capabilities['alt']); ?>" loading="lazy" decoding="async">
                </div>
                <div class="svc-avcaps__content">
                    <h3 class="svc-avcaps__list-title"><?php echo esc_html($capabilities['list_title']); ?></h3>
                    <ul class="svc-avcaps__list">
                        <?php foreach ($capabilities['items'] as $item) : ?>
                            <li>
                                <span class="svc-avcaps__check" aria-hidden="true"><?php echo $check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                <span><?php echo esc_html($item); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Confidence with McCollister's (dark, image band + title + intro + 2 columns) -->
    <section class="svc-freight svc-avconf">
        <div class="svc-freight__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $confidence['eyebrow'],
                'light'   => true,
            ]); ?>
            <div class="svc-avconf__band">
                <img src="<?php echo esc_url($confidence['image']); ?>" alt="<?php echo esc_attr($confidence['alt']); ?>" loading="lazy" decoding="async">
            </div>
            <h2 class="svc-freight__title svc-avconf__title"><?php echo esc_html($confidence['title']); ?></h2>
            <div class="svc-freight__prose">
                <p><?php echo esc_html($confidence['intro']); ?></p>
            </div>
            <div class="svc-avconf__cols">
                <?php foreach ($confidence['cols'] as $col) : ?>
                    <div class="svc-avconf__col">
                        <h3 class="svc-avconf__col-title"><?php echo esc_html($col['title']); ?></h3>
                        <p><?php echo esc_html($col['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FAQs -->
    <section class="svc-section svc-faqs">
        <div class="svc-section__inner">
            <?php get_template_part('template-parts/components/section-head', null, [
                'eyebrow' => $faqs['eyebrow'],
                'title'   => $faqs['title'],
            ]); ?>
            <div class="svc-faqs__list" data-accordion>
                <?php foreach ($faqs['items'] as $item) : ?>
                    <details class="svc-faq">
                        <summary class="svc-faq__summary">
                            <span class="svc-faq__q"><?php echo esc_html($item['q']); ?></span>
                            <span class="svc-faq__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 18 18 6M9 6H18V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </summary>
                        <div class="svc-faq__panel">
                            <?php echo wp_kses($item['a'], ['p' => [], 'ul' => [], 'li' => [], 'strong' => []]); ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA cards (reusable component; defaults to the standard two cards) -->
    <?php get_template_part('template-parts/components/cta-cards'); ?>

</main>
<?php get_footer(); ?>
