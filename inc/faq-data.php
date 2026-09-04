<?php
/**
 * FAQ content — the single source for every FAQ on the site.
 *
 * Each service page renders its own group; /faqs/ renders all of them. Editing
 * a question here changes it everywhere it appears, which is the point: the
 * previous setup duplicated the same text across sixteen template files and
 * this file, and the two had already drifted apart.
 *
 * Content supplied by Julia, September 2026, replacing the previous set in full.
 *
 * Answers may contain @TOKENS@ for internal links; mcc_faq_link_tokens() swaps
 * them for real URLs at render time so the paths survive a domain change.
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Every FAQ group, keyed by slug.
 */
function mcc_faq_groups(): array
{
    static $groups = null;

    if ($groups !== null) {
        return $groups;
    }

    $groups = [
        'general' => [
            'label' => 'General',
            'items' => [
                ['q' => 'How long has McCollister’s been in business?', 'a' => '<p>McCollister’s was founded in 1945 in Burlington, New Jersey, and remains a privately held, family-owned company operating under third-generation leadership.</p>'],
                ['q' => 'Where is McCollister’s headquartered?', 'a' => '<p>McCollister’s is headquartered in Burlington, New Jersey, with company-operated locations across the United States.</p>'],
                ['q' => 'What does asset-based mean?', 'a' => '<p>An asset-based logistics company owns its own trucks, trailers, warehouses, and equipment rather than relying entirely on third-party contractors. McCollister’s operates a company-owned fleet and facilities nationwide, giving clients direct operational control, accountability, and consistency that broker-only companies cannot offer.</p>'],
                ['q' => 'Is McCollister’s a broker or a carrier?', 'a' => '<p>McCollister’s holds dual FMCSA authority as both a motor carrier and a freight broker. Depending on the service, shipments may travel on McCollister’s own fleet or through vetted carrier partners, and the capacity used is disclosed on every order confirmation.</p>'],
                ['q' => 'Does McCollister’s work with individuals or only businesses?', 'a' => '<p>McCollister’s serves both commercial and individual clients. Businesses rely on McCollister’s for corporate supply chains, project-based logistics, warehousing, and distribution programs. Individuals use McCollister’s for residential relocations, personal vehicle transport, and home fitness equipment installation.</p>'],
                ['q' => 'What industries does McCollister’s serve?', 'a' => '<p>McCollister’s serves aerospace, aviation, automotive, banking and finance, fitness, healthcare and medical devices, commercial real estate, retail, entertainment, hospitality, data centers, telecommunications, and government and defense.</p>'],
                ['q' => 'What does your UniGroup affiliation mean?', 'a' => '<p>McCollister’s affiliation with UniGroup, United Van Lines, and Mayflower Transit strengthens our national network while maintaining personalized service and operational accountability.</p>'],
                ['q' => 'How do I get a quote?', 'a' => '<p>Click the <a href="@TALK@"><strong>Talk to an Expert</strong></a> button on any page to access our intake form. Provide your shipment details, including origin, destination, dimensions, weight, service type, and timeline. A McCollister’s logistics specialist will follow up with customized pricing.</p>'],
                ['q' => 'What determines pricing?', 'a' => '<p>Pricing is based on distance, route, size, weight, equipment type, service level, handling complexity, insurance requirements, timeline, and market conditions. Every quote is customized for transparency and accuracy.</p>'],
                ['q' => 'How do I track my shipment?', 'a' => '<p>McCollister’s provides proactive shipment updates throughout transit using GPS technology and the Samsara platform. Select business units may also provide direct tracking links when available.</p>'],
                ['q' => 'What tracking technology do you use?', 'a' => '<p>McCollister’s uses SkyBitz asset tracking, Samsara fleet monitoring, real-time reporting systems, and integrated communication tools to maintain visibility on every shipment.</p>'],
                ['q' => 'What are your billing options?', 'a' => '<p>Billing options include cash on delivery (COD), prepaid, and national account with 30-day terms pending credit approval. McCollister’s also supports API and EDI digital invoicing integration for automated billing connectivity.</p>'],
                ['q' => 'What payment methods do you accept?', 'a' => '<p>McCollister’s accepts ACH, wire transfer, certified check, and major credit cards. All payments must be processed through official McCollister’s billing channels. Representatives will review payment options prior to booking.</p>'],
                ['q' => 'What is your geographic coverage?', 'a' => '<p>McCollister’s operates company-run locations across the United States and partners with 500+ agents through UniGroup to extend transportation, warehousing, and specialized logistics into Canada. International service is available based on project scope.</p>'],
                ['q' => 'What insurance coverage do you carry?', 'a' => '<p>McCollister’s maintains comprehensive cargo and liability insurance across transportation, warehousing, and handling operations. Coverage limits can be adjusted based on shipment value. Certificates of insurance, additional insured endorsements, and extended coverage options are available upon request.</p>'],
                ['q' => 'What is the claims process?', 'a' => '<p>In the unlikely event of damage, notify your account representative, submit the required claim form, and provide supporting documentation. The McCollister’s claims team will inspect, investigate, and resolve the matter promptly.</p>'],
                ['q' => 'Do you provide dedicated account management?', 'a' => '<p>Yes. Every client is supported by experienced logistics professionals who provide coordination and proactive problem resolution. For larger or complex projects, McCollister’s assembles cross-functional teams for operational oversight.</p>'],
                ['q' => 'Can your services scale with my business?', 'a' => '<p>Yes. McCollister’s offers scalable transportation and warehousing that adapts to business growth, seasonal demand, and project-based requirements.</p>'],
                ['q' => 'Do you provide specialized and mission-critical transportation?', 'a' => '<p>Yes. McCollister’s delivers high-touch, specialized logistics backed by an asset-based fleet. Capabilities include over-dimensional and heavy-haul transport, white-glove and inside delivery, temperature-controlled shipments, air-ride equipment, enclosed auto transport, and enhanced security protocols.</p>'],
                ['q' => 'Do you offer warehousing and distribution services?', 'a' => '<p>Yes. McCollister’s provides secure warehouse locations, WMS inventory tracking, scalable storage, cross-docking, inventory management, and coordinated distribution services.</p>'],
                ['q' => 'Are you licensed and compliant?', 'a' => '<p>Yes. McCollister’s maintains all required operating authorities and complies with federal and state regulations, including FMCSA requirements. McCollister’s holds an A+ rating with the Better Business Bureau.</p>'],
                ['q' => 'How do you ensure cargo safety?', 'a' => '<p>McCollister’s employs skilled drivers trained in proper loading and securement, comprehensive cargo insurance, GPS-enabled tracking, routine inspections, emergency response planning, and ongoing driver training.</p>'],
                ['q' => 'How do you maintain quality standards?', 'a' => '<p>McCollister’s maintains structured regulatory compliance, ongoing staff training, risk management protocols, internal audits, and continuous monitoring to ensure consistent operational performance.</p>'],
                ['q' => 'What transportation services does McCollister’s offer?', 'a' => '<p>McCollister’s offers full truckload, less-than-truckload, expedited, dry van, temperature-controlled, intermodal, over-dimensional, and air cargo transportation, along with warehousing and cross-docking.</p>'],
                ['q' => 'How do you vet transportation, warehousing, installation, and logistics partners?', 'a' => '<p>All partners must maintain active operating authority, verified insurance, acceptable safety ratings, and ongoing compliance verification. McCollister’s oversight ensures alignment with company safety and operational standards.</p>'],
                ['q' => 'Can you manage my entire supply chain?', 'a' => '<p>Yes. McCollister’s provides integrated transportation, warehousing, and distribution under a coordinated logistics strategy.</p>'],
                ['q' => 'What is McCollister’s approach to sustainability?', 'a' => '<p>McCollister’s sustainability efforts include route optimization, fleet efficiency monitoring, preventative maintenance, fuel performance tracking, and participation in the EPA SmartWay Transport Partnership. Visit our <a href="@ESG@"><strong>ESG page</strong></a> for more information.</p>'],
                ['q' => 'How do you manage service disruptions?', 'a' => '<p>Through GPS visibility, structured contingency planning, and operational oversight, McCollister’s responds quickly to weather events, equipment issues, or capacity shifts to minimize impact and maintain delivery performance.</p>'],
            ],
        ],
        'aerospace' => [
            'label' => 'Aerospace',
            'pdf'   => 'FAQs-Page-Aerospace.pdf',
            'items' => [
                ['q' => 'What is aerospace transportation and logistics?', 'a' => '<p>Aerospace transportation and logistics refers to the specialized movement, handling, and support of spacecraft, aircraft, aerospace components, and related materials. Because aerospace parts are extremely high-value, oversized, and time-critical, this sector combines advanced logistical practices with industry-specific engineering and safety standards.</p>'],
                ['q' => 'What are the risks associated with improper aerospace transportation?', 'a' => '<p>Improper aerospace transportation can lead to damaged or contaminated parts, safety hazards, and regulatory violations under the FAA, ITAR, or EAR. These mistakes cause production delays, documentation failures, environmental incidents, financial losses, and reputational harm. Some of these costs may not be covered by insurance.</p>'],
                ['q' => 'What considerations go into mapping out the safest and most effective route for aerospace transport?', 'a' => '<p>McCollister’s evaluates road dimensions, weight limits, infrastructure capability, regulatory permits, safety risks, weather, security requirements, and timing to ensure safe delivery. Every aerospace move includes a detailed physical route survey to verify the safest and most efficient path.</p>'],
                ['q' => 'What security measures need to be put in place for aerospace transport?', 'a' => '<p>Aerospace transport security requires controlled access, real-time GPS and sensor monitoring, tamper-evident containers, trained escorts for high-risk loads, chain-of-custody documentation, ITAR compliance, and contingency planning for theft, tampering, or emergencies.</p>'],
                ['q' => 'When should aerospace companies first contact transportation and logistics companies?', 'a' => '<p>As early as possible, ideally during the design or pre-production phase, before manufacturing begins. Early engagement allows for route planning, equipment specification, permitting, and compliance review, all of which prevent costly delays later in the project timeline.</p>'],
                ['q' => 'What certifications does McCollister’s hold for aerospace transport?', 'a' => '<p>McCollister’s is certified by the Department of Defense to provide Classified Transportation Protective Services (TPS). The company also maintains C-TPAT certification, ISO 13485 compliance, and membership in the Commercial Space Federation and the National Defense Transportation Association.</p>'],
                ['q' => 'What types of aerospace hardware does McCollister’s transport?', 'a' => '<p>McCollister’s transports loaded spacecraft containers, ground support equipment, rocket motors, satellite components, launch hardware, flight-critical assemblies, and defense assets. Each move is managed under a customized transportation plan with shipment-specific operating procedures.</p>'],
                ['q' => 'What tracking technology does McCollister’s use for aerospace moves?', 'a' => '<p>McCollister’s uses Samsara, Qualcomm, SkyBitz, and multilayer tracking systems to provide real-time visibility during aerospace transport. Mobile command centers and dedicated communication channels keep all stakeholders informed throughout transit.</p>'],
                ['q' => 'Can McCollister’s transport oversized aerospace components on public roads?', 'a' => '<p>Yes. McCollister’s conducts feasibility studies and physical route surveys, secures all necessary permits, and coordinates with authorities for oversized loads. Escort and pilot cars, mobile command centers, and identified safe havens are part of every oversized aerospace move.</p>'],
            ],
        ],
        'auto-transport' => [
            'label' => 'Auto Transport',
            'pdf'   => 'FAQs-Auto-Transport.pdf',
            'items' => [
                ['q' => 'What are the major risks associated with improper auto transportation?', 'a' => '<p>Improper auto transportation can result in vehicle damage, theft, hidden fees, poor communication, delayed delivery, and inadequate insurance coverage. For dealers and OEMs, the consequences extend to lost revenue, strained client relationships, missed marketing windows, and increased per-vehicle costs. Choosing a reputable partner minimizes these risks.</p>'],
                ['q' => 'What does white-glove delivery mean for auto transport?', 'a' => '<p>White-glove delivery is McCollister’s platinum package for classic, luxury, antique, and exotic vehicles. It includes fully enclosed company-owned carriers, soft-strap securing, air-ride suspension, hydraulic liftgates for low-clearance vehicles, a dedicated customer relations contact, and real-time GPS tracking throughout transit.</p>'],
                ['q' => 'How far in advance should auto transport be booked?', 'a' => '<p>For gold and silver packages, McCollister’s can typically provide transport within three days, depending on season and weather. Pickup windows of one, three, five, and seven days are available through our booking platform. For platinum white-glove service, allow two to three weeks and contact us directly.</p>'],
                ['q' => 'How do I prepare my vehicle for transport?', 'a' => '<p>Clean the vehicle inside and out, remove personal belongings, document its condition with photos, check the battery and tires, reduce fuel to one-quarter tank, disable alarms, and remove active toll tags. For a complete checklist, download our <a href="@PREPGUIDE@" target="_blank" rel="noopener"><strong>vehicle preparation guide</strong></a>.</p>'],
                ['q' => 'What is a 3PL?', 'a' => '<p>3PL stands for third-party logistics, referring to companies McCollister’s contracts with to haul on our behalf. These partners are thoroughly vetted for appropriate insurance coverage, DOT compliance, and adherence to McCollister’s operational standards and values.</p>'],
                ['q' => 'What types of vehicles do you transport?', 'a' => '<p>McCollister’s transports all vehicle types, makes, and models, including sedans, SUVs, trucks, luxury vehicles, electric vehicles, classic cars, antique cars, and exotic cars.</p>'],
                ['q' => 'What factors influence the cost of dealer auto transport?', 'a' => '<p>Pricing is based on route distance, vehicle quantity, and timing requirements. Contact McCollister’s for an accurate quote tailored to your dealership’s needs.</p>'],
                ['q' => 'What types of OEM clients do you work with?', 'a' => '<p>McCollister’s works with car manufacturers, automotive suppliers, EV companies, and global logistics partners needing white-label or branded shipping services.</p>'],
                ['q' => 'What factors influence the cost of OEM auto transport?', 'a' => '<p>OEM transport rates are structured around specific logistics needs, volumes, seasonal demand, and market capacity. Contact McCollister’s dedicated OEM logistics team for an accurate quote.</p>'],
                ['q' => 'Does McCollister’s offer open and enclosed auto transport?', 'a' => '<p>Yes. McCollister’s offers three service tiers: silver (open carrier through vetted 3PL partners), gold (enclosed transport through vetted 3PL partners), and platinum (enclosed white-glove transport on McCollister’s own company-owned fleet).</p>'],
                ['q' => 'Is McCollister’s a broker or a carrier?', 'a' => '<p>McCollister’s holds dual FMCSA authority as both a motor carrier and a freight broker. Depending on the service tier, vehicles may travel on McCollister’s own fleet or through vetted 3PL carrier partners. The capacity used is disclosed on every order confirmation.</p>'],
            ],
        ],
        'aviation' => [
            'label' => 'Aviation',
            'pdf'   => 'FAQs-Aviation.pdf',
            'items' => [
                ['q' => 'What are the risks of not using a specialized aviation logistics provider?', 'a' => '<p>Aviation shipments involve tight timelines, sensitive components, and strict handling requirements. Using a general provider increases the risk of delays, improper handling, asset damage, and extended aircraft downtime, all of which carry significant operational and financial consequences.</p>'],
                ['q' => 'What is aircraft-on-ground (AOG) transportation?', 'a' => '<p>AOG transportation supports situations where an aircraft is grounded due to mechanical issues or missing components. These shipments are time-critical and require immediate coordination to restore operations as quickly as possible.</p>'],
                ['q' => 'Can McCollister’s support time-critical aviation shipments?', 'a' => '<p>Yes. McCollister’s provides 24/7/365 pickup, delivery, and support for time-sensitive aviation moves, including AOG requests and scheduled critical shipments.</p>'],
                ['q' => 'How does McCollister’s ensure the safety of aviation components?', 'a' => '<p>Aviation shipments are handled by trained drivers using specialized equipment and secure loading practices. All shipments are GPS-tracked to provide visibility and accountability throughout transit.</p>'],
                ['q' => 'How do I get started with McCollister’s for my aviation project?', 'a' => '<p>Contact McCollister’s to speak with an aviation logistics expert. The team will assess your requirements and coordinate a transportation plan built around your timeline, asset, and operational needs.</p>'],
                ['q' => 'What types of aviation components does McCollister’s transport?', 'a' => '<p>McCollister’s transports aviation components at every stage of their lifecycle, whether newly removed from service, aged out, or moving for inspection, repair, or overhaul. Shipments regularly move between operators, MRO providers, manufacturers, and storage locations.</p>'],
                ['q' => 'Does McCollister’s coordinate with MRO facilities and airlines directly?', 'a' => '<p>Yes. McCollister’s works directly with maintenance, repair, and overhaul facilities, airlines, and parts distributors to coordinate pickup, delivery, and return logistics for aviation components and assemblies.</p>'],
                ['q' => 'What is the difference between aviation and aerospace logistics?', 'a' => '<p>Aviation logistics focuses on active aircraft operations, including engine swaps, AOG recovery, and MRO parts movement. Aerospace logistics typically involves spacecraft, satellites, launch hardware, and defense assets that require longer planning cycles, classified handling, and specialized route engineering.</p>'],
            ],
        ],
        'commercial-relocation' => [
            'label' => 'Commercial Relocation',
            'pdf'   => 'FAQs-Commercial-Relocation.pdf',
            'items' => [
                ['q' => 'What are the risks of using an inexperienced company for a commercial office move?', 'a' => '<p>Inexperienced providers often lack the planning, communication, and coordination required for complex office environments. The result can be damaged assets, extended downtime, poor employee experience, cost overruns, and last-minute disruptions. McCollister’s specializes in structured commercial moves designed to prevent these outcomes.</p>'],
                ['q' => 'How are computers, monitors, and phone systems handled during an office move?', 'a' => '<p>McCollister’s packs and protects employee desk-level technology using anti-static monitor protection and organized grouping for keyboards, cables, mice, and phones. Disconnection, reconnection, and rebooting can also be coordinated through McCollister’s Technical Services to reduce downtime.</p>'],
                ['q' => 'Do you coordinate technology and data infrastructure moves?', 'a' => '<p>Yes. McCollister’s coordinates commercial relocations with our <a href="@TECHSERV@"><strong>in-house technical services team</strong></a>, allowing organizations to manage furniture, desk-level technology, and complex IT assets under one integrated plan. This approach eliminates coordination gaps between vendors.</p>'],
                ['q' => 'What information is needed to get a quote for a commercial relocation project?', 'a' => '<p>McCollister’s typically needs the project scope, estimated size, locations involved, and desired timeline. For complex relocations, a site walk or planning call may be conducted to ensure the quote reflects the full scope of work.</p>'],
                ['q' => 'When should we contact McCollister’s about our office move?', 'a' => '<p>The earlier, the better. Engaging McCollister’s early in the planning process allows us to help design the move, identify risks, and create a realistic timeline. Early involvement leads to smoother execution, fewer disruptions, and greater confidence throughout the relocation.</p>'],
                ['q' => 'Can McCollister’s handle a phased or multi-floor commercial relocation?', 'a' => '<p>Yes. McCollister’s regularly manages phased relocations where different floors, departments, or business units move on separate schedules. Each phase is planned and staffed independently while maintaining coordination across the full project timeline.</p>'],
                ['q' => 'Does McCollister’s handle furniture disposal and recycling during a commercial move?', 'a' => '<p>Yes. McCollister’s coordinates the decommissioning, removal, and responsible disposal of furniture and equipment that will not transfer to the new location. Recycling and certified destruction services are available depending on the asset type.</p>'],
                ['q' => 'How does McCollister’s minimize employee disruption during an office move?', 'a' => '<p>McCollister’s works with the project lead to develop employee communication plans, clear labeling and packing protocols, and a move schedule designed to minimize time away from productive work. The goal is a Monday morning that feels like nothing happened.</p>'],
            ],
        ],
        'finance-banking' => [
            'label' => 'Finance & Banking',
            'pdf'   => 'FAQs-Finance-and-Banking.pdf',
            'items' => [
                ['q' => 'What types of ATM installations does McCollister’s support?', 'a' => '<p>McCollister’s supports through-the-wall (TTW) ATMs, drive-through and island construction, and free-standing lobby ATM kiosks, including challenging rigging and installations aligned to customer quality control and compliance standards.</p>'],
                ['q' => 'Will I have a dedicated project manager and consistent updates?', 'a' => '<p>Yes. McCollister’s project managers and rigging experts work with customers through each project phase. Managers are responsible for planning, permitting, and construction and can meet client-dictated update cadences.</p>'],
                ['q' => 'How do you address ADA compliance risk?', 'a' => '<p>McCollister’s verifies ATM installations for ADA compliance, including required height, wheelchair access, and access pathways, helping reduce exposure to alleged violations.</p>'],
                ['q' => 'Can you support multi-site deployments?', 'a' => '<p>Yes. McCollister’s provides programmatic deployment and installation with logistics support, including nationwide warehousing, staging, distribution, reverse logistics, and disposal. The program is designed for repeat deployments across multiple locations.</p>'],
                ['q' => 'Do you support decommissioning or certified destruction?', 'a' => '<p>Yes. McCollister’s offers PCI destruction and NPI decommissioning services with documentation supporting confidentiality and proper handling.</p>'],
                ['q' => 'Does McCollister’s handle vault construction and modification?', 'a' => '<p>Yes. McCollister’s builds, moves, upgrades, and modifies vaults for banks, jewelry stores, and pharmacy applications. Services include structural reinforcement, rigging, and coordination with security and compliance requirements.</p>'],
                ['q' => 'Can McCollister’s respond to ATM vandalism?', 'a' => '<p>Yes. McCollister’s provides 24/7 vandalism response and remediation, including board-ups, debris removal, site cleanup, electrical termination, and detailed photographic documentation of the incident.</p>'],
                ['q' => 'Does McCollister’s provide CAD and permitting support for ATM projects?', 'a' => '<p>Yes. McCollister’s provides soft sketches and CAD drawings for design and landlord verification, along with site plans, construction documents, licensing requirements, and complete permit packages for larger programs.</p>'],
            ],
        ],
        'fitness' => [
            'label' => 'Fitness',
            'pdf'   => 'FAQs-Fitness.pdf',
            'items' => [
                ['q' => 'What are the risks associated with improper fitness installation?', 'a' => '<p>Improper installation can cause equipment downtime, return trips, delayed openings, and strained relationships with end users and partners. In premium environments, even small missteps can undermine trust and brand perception. The real cost is rarely just the invoice. It is the long-term impact on reputation.</p>'],
                ['q' => 'How does McCollister’s handle complex or multi-phase fitness projects?', 'a' => '<p>Every project is treated as a unique environment, not a repeatable task. McCollister’s plans early, coordinates across stakeholders, adapts when schedules shift, and deploys experienced teams who anticipate challenges rather than react to them.</p>'],
                ['q' => 'Do you support both large facilities and smaller installations?', 'a' => '<p>Yes. McCollister’s supports the full spectrum, from single-unit residential or corporate gym installs to large, multi-story facilities and nationwide rollouts. The same attention to detail applies regardless of scale.</p>'],
                ['q' => 'Why does white-glove and final-mile service matter so much in fitness?', 'a' => '<p>Fitness equipment enters active spaces, finished environments, and brand-defining moments. White-glove service ensures proper handling, placement, assembly, and presentation. The result is reduced risk, eliminated rework, and a protected client experience from day one.</p>'],
                ['q' => 'Does McCollister’s offer fitness equipment repair and maintenance?', 'a' => '<p>Yes. McCollister’s offers on-site fitness equipment repair and maintenance for commercial gyms, studios, residential communities, and corporate fitness centers, supporting both cardio and strength equipment.</p>'],
                ['q' => 'What types of fitness equipment does McCollister’s install?', 'a' => '<p>McCollister’s installs cardio machines, strength equipment, functional training rigs, recovery systems, and digitally connected equipment. Capabilities also include flooring, turf installation, and specialty anchoring for wall-mounted and ceiling-mounted systems.</p>'],
                ['q' => 'Does McCollister’s work directly with fitness equipment manufacturers?', 'a' => '<p>Yes. McCollister’s maintains long-standing relationships with leading fitness equipment OEMs and serves as a delivery, installation, and service partner for manufacturer-direct programs and dealer distribution channels nationwide.</p>'],
                ['q' => 'How early should McCollister’s be involved in a fitness facility project?', 'a' => '<p>As early as possible, ideally during the design phase. McCollister’s provides early-stage technical input on equipment placement, flooring specifications, electrical requirements, wall clearances, anchoring points, and equipment flow to prevent costly downstream adjustments.</p>'],
                ['q' => 'Can McCollister’s support a nationwide fitness rollout across multiple locations?', 'a' => '<p>Yes. McCollister’s manages multi-site fitness rollouts with centralized project management, standardized installation protocols, and local execution teams. Each location receives the same quality and attention regardless of geography.</p>'],
            ],
        ],
        'installation' => [
            'label' => 'Installation',
            'pdf'   => 'FAQs-Installation.pdf',
            'items' => [
                ['q' => 'What types of projects are best suited for McCollister’s installation services?', 'a' => '<p>McCollister’s installation services are designed for projects involving high-value, specialized, or operationally critical equipment, especially when coordination across transportation, storage, and on-site installation is required.</p>'],
                ['q' => 'Do you support multi-location or phased rollouts?', 'a' => '<p>Yes. McCollister’s regularly manages installations across multiple locations, supporting phased deployments, scheduled rollouts, and site-specific requirements through centralized project management.</p>'],
                ['q' => 'How does project management factor into installation services?', 'a' => '<p>Each installation project is supported by experienced project managers who coordinate timelines, site readiness, transportation, staging, and on-site execution to ensure consistency and accountability.</p>'],
                ['q' => 'Can installation services be bundled with transportation and warehousing?', 'a' => '<p>Yes. Installation services are frequently bundled with transportation and warehousing to create an end-to-end program that minimizes delays, reduces risk, and improves overall project efficiency.</p>'],
                ['q' => 'What industries does McCollister’s provide installation services for?', 'a' => '<p>McCollister’s provides installation services for financial institutions, data centers, fitness facilities, retail environments, and commercial offices. Each industry has distinct site conditions, equipment types, and compliance requirements that McCollister’s teams are trained to manage.</p>'],
                ['q' => 'Does McCollister’s handle decommissioning and equipment removal?', 'a' => '<p>Yes. McCollister’s manages the safe removal, decommissioning, and disposal of existing equipment as part of an installation project, including certified data destruction and recycling where required.</p>'],
                ['q' => 'How does McCollister’s ensure installations meet compliance standards?', 'a' => '<p>McCollister’s project managers verify that installations meet applicable compliance standards, including ADA requirements, manufacturer specifications, and site-specific safety and permitting requirements. Documentation is maintained throughout the project.</p>'],
                ['q' => 'How do I get a quote for an installation project?', 'a' => '<p>Contact McCollister’s with the project scope, location, equipment details, and timeline. For complex projects, a site walk or planning call may be conducted to ensure the quote reflects the full scope of work.</p>'],
            ],
        ],
        'logistics' => [
            'label' => 'Logistics',
            'pdf'   => 'FAQs-Logistics.pdf',
            'items' => [
                ['q' => 'What is the difference between logistics and transportation services?', 'a' => '<p>Transportation focuses on moving assets from one location to another. Logistics encompasses the broader planning, coordination, and management of transportation, warehousing, handling, and delivery activities to ensure shipments move efficiently from origin through final destination.</p>'],
                ['q' => 'When should I use a logistics provider instead of a single carrier?', 'a' => '<p>A logistics provider is best suited for shipments that involve multiple service components, specialized handling, tight timelines, or operational complexity. Logistics support helps reduce coordination burden, improve visibility, and manage risk when moves require more than standard transportation.</p>'],
                ['q' => 'What types of shipments typically require logistics coordination?', 'a' => '<p>Logistics coordination is commonly used for high-value, oversized, time-critical, multi-location, or project-based shipments. These moves often require advance planning, specialized equipment, multiple handoffs, or integration with warehousing and final-mile services.</p>'],
                ['q' => 'Can McCollister’s logistics services support urgent or time-sensitive shipments?', 'a' => '<p>Yes. McCollister’s logistics services support urgent and time-critical shipments by coordinating equipment availability, routing, handling requirements, and communication across all service components to meet aggressive timelines while maintaining shipment integrity.</p>'],
                ['q' => 'How does McCollister’s manage visibility across complex logistics projects?', 'a' => '<p>McCollister’s maintains visibility through centralized coordination, proactive communication, and tracking technologies that span transportation, handling, and delivery stages. Customers stay informed while logistics teams manage execution and issue resolution.</p>'],
                ['q' => 'Can McCollister’s logistics services scale as my needs change?', 'a' => '<p>Yes. McCollister’s logistics services are built to scale with changing needs, including fluctuating volumes, seasonal demand, and project-based requirements. Service scope and resources adjust without disrupting operations.</p>'],
                ['q' => 'Does McCollister’s offer freight brokerage services?', 'a' => '<p>Yes. McCollister’s holds FMCSA freight broker authority and coordinates shipments through a vetted network of carrier partners when project requirements exceed the capacity of our own asset-based fleet.</p>'],
                ['q' => 'Can McCollister’s handle heavy haul and oversized shipments?', 'a' => '<p>Yes. McCollister’s logistics team coordinates heavy haul and over-dimensional shipments including route surveys, permitting, escort vehicles, and specialized equipment. These moves are managed under dedicated project plans with real-time tracking and communication.</p>'],
            ],
        ],
        'residential-relocation' => [
            'label' => 'Residential Relocation',
            'pdf'   => 'FAQs-Residential-Relocation.pdf',
            'items' => [
                ['q' => 'What types of residential relocations does McCollister’s support?', 'a' => '<p>McCollister’s supports employee and corporate relocations, military family moves, and private household moves. Each relocation is planned based on the specific scope, timing, and priorities of the move.</p>'],
                ['q' => 'How is McCollister’s different from a traditional household moving company?', 'a' => '<p>McCollister’s operates as an asset-based transportation and logistics provider. Residential relocations are managed as coordinated projects, supported by trained professionals, established safety standards, and a single point of contact throughout the move.</p>'],
                ['q' => 'Can McCollister’s support complex or high-value household moves?', 'a' => '<p>Yes. McCollister’s regularly supports residential relocations that involve high-value items, specialty furnishings, or unique handling requirements. Each move is evaluated individually to ensure the appropriate level of planning, protection, and coordination.</p>'],
                ['q' => 'Is storage available as part of a residential relocation?', 'a' => '<p>Yes. Short-term or long-term storage can be incorporated into a residential relocation when timelines or circumstances require flexibility, supporting transitions between residences or changing move schedules.</p>'],
                ['q' => 'Who will I work with during my residential relocation?', 'a' => '<p>Residential relocations are supported by a dedicated point of contact who coordinates planning, communication, and execution. This approach provides clarity, accountability, and consistent support from start to finish.</p>'],
                ['q' => 'Is my shipment covered for loss or damage during my relocation?', 'a' => '<p>Yes. McCollister’s offers full-value protection options for household goods during a residential relocation. Your sales consultant can walk you through available coverage options and help you select the appropriate level of protection.</p>'],
                ['q' => 'Does McCollister’s handle auto transport as part of a residential relocation?', 'a' => '<p>Yes. McCollister’s offers enclosed and open auto transport alongside household goods relocation, allowing families to coordinate vehicle and home moves through a single provider.</p>'],
                ['q' => 'What is included in a residential relocation quote?', 'a' => '<p>Quotes typically account for distance, volume, packing and unpacking needs, specialty item handling, storage requirements, and delivery timeline. A McCollister’s consultant will conduct a virtual or on-site survey to ensure accuracy.</p>'],
            ],
        ],
        'technical-services' => [
            'label' => 'Technical Services',
            'pdf'   => 'FAQs-Technical-Services.pdf',
            'items' => [
                ['q' => 'What are the risks associated with trusting an inexperienced company for my data center project?', 'a' => '<p>Inexperienced providers often cause project delays, equipment damage from improper packing and handling, compliance failures, and cost overruns. They may lack the ability to conduct thorough site surveys, properly protect optics and cabling, or manage the security requirements of enterprise IT environments.</p>'],
                ['q' => 'What is data center relocation?', 'a' => '<p>Data center relocation refers to moving an organization’s existing data center infrastructure from one environment to another. The process can include server removal from racking, serialized inventory, secure packing with security tape, and coordinated transfer to the new location.</p>'],
                ['q' => 'What is data center decommissioning?', 'a' => '<p>Data center decommissioning is the process of properly disposing of IT assets that have reached end of life, according to industry standards and governmental regulations. McCollister’s Technical Services provides device removal, rack removal, cable removal, data destruction services, and ITAD buyback options.</p>'],
                ['q' => 'What information do I need to gather to get a quote for data center services?', 'a' => '<p>For an initial conversation, McCollister’s Technical Services needs the general scope of your project, how much material is involved, where the work will take place, and when you need it completed. Smaller projects can often be quoted through a quick email exchange; larger projects begin with a planning call.</p>'],
                ['q' => 'When should I first contact McCollister’s to discuss my data center project?', 'a' => '<p>As early as possible. McCollister’s Technical Services is often fully booked three or more weeks in advance, even for simple projects. Early engagement allows for site surveys, project design, and proper resource planning, maximizing safety and efficiency while minimizing business disruption.</p>'],
                ['q' => 'Does McCollister’s provide certified data destruction?', 'a' => '<p>Yes. McCollister’s Technical Services offers on-site and off-site data destruction services that comply with NIST 800-88 standards. Certificates of destruction are provided for every asset processed, supporting regulatory compliance and audit documentation.</p>'],
                ['q' => 'Can McCollister’s handle a full data center migration to a new facility?', 'a' => '<p>Yes. McCollister’s Technical Services manages end-to-end data center migrations, from pre-move site surveys and detailed project planning through physical relocation, rack-and-stack installation, cabling, and post-move verification at the destination facility.</p>'],
                ['q' => 'Does McCollister’s provide IT asset disposition (ITAD) services?', 'a' => '<p>Yes. McCollister’s Technical Services offers ITAD services including asset auditing, data sanitization, remarketing, and certified recycling. Buyback options are available for equipment that retains market value, helping offset decommissioning costs.</p>'],
            ],
        ],
        'transportation' => [
            'label' => 'Transportation',
            'pdf'   => 'FAQs-Transportation.pdf',
            'items' => [
                ['q' => 'How is McCollister’s transportation different from standard freight services?', 'a' => '<p>McCollister’s specializes in transportation for assets that demand more planning, protection, and accountability than typical freight. Equipment, handling methods, and routing are tailored to the specific asset and environment involved.</p>'],
                ['q' => 'Do you handle both simple and complex transportation moves?', 'a' => '<p>Yes. McCollister’s supports everything from straightforward point-to-point moves to highly complex, time-sensitive, or high-value shipments. Every move is managed with the same disciplined approach and attention to detail.</p>'],
                ['q' => 'How do you determine the right transportation approach for a move?', 'a' => '<p>Each move is evaluated individually. Teams consider asset characteristics, access conditions, timing, and risk factors to align the appropriate equipment, handling protocols, and routing. McCollister’s does not default to a one-size-fits-all approach.</p>'],
                ['q' => 'Can transportation plans be customized for different industries or asset types?', 'a' => '<p>Yes. Many industries have distinct transportation requirements, and McCollister’s applies industry-specific knowledge where it matters. Every transportation plan is customized to the asset itself, ensuring the approach fits both the environment and the expectations involved.</p>'],
                ['q' => 'What happens if transportation needs change mid-move?', 'a' => '<p>If conditions, timelines, or scope change, McCollister’s adapts while maintaining continuity and accountability. Teams coordinate adjustments without introducing unnecessary handoffs or disruption.</p>'],
                ['q' => 'What specialized equipment does McCollister’s own?', 'a' => '<p>McCollister’s operates company-owned flatbeds, tractors, customized trailers, climate-controlled vehicles, air-ride equipment, retractable Conestoga trailers, and enclosed auto carriers. Specialized equipment is matched to each shipment’s requirements.</p>'],
                ['q' => 'Does McCollister’s provide escort and pilot car services for oversized loads?', 'a' => '<p>Yes. McCollister’s coordinates escort and pilot car services, permit acquisition, route surveys, and authority coordination for oversized and over-dimensional shipments as part of a comprehensive transportation plan.</p>'],
                ['q' => 'Is McCollister’s an asset-based carrier?', 'a' => '<p>Yes. McCollister’s operates its own fleet of trucks, trailers, and specialized equipment from company-owned facilities nationwide. This asset-based model provides direct operational control, accountability, and flexibility that broker-only companies cannot match.</p>'],
            ],
        ],
        'warehousing' => [
            'label' => 'Warehousing',
            'pdf'   => 'FAQs-Warehousing.pdf',
            'items' => [
                ['q' => 'What are the risks associated with improper warehousing?', 'a' => '<p>Operational risks include fire hazards from overcrowded storage, inventory damage, reduced productivity from inefficient layouts, and potential regulatory fines for non-compliance with safety standards.</p>'],
                ['q' => 'What are the key functions of a warehouse?', 'a' => '<p>Core warehouse functions include receiving and inspecting inbound shipments, strategic inventory storage, accurate order picking, professional packing and shipping, real-time inventory management, and value-added services such as kitting, labeling, and light assembly.</p>'],
                ['q' => 'How can efficient warehousing support my overall logistics operations?', 'a' => '<p>Efficient warehousing aligns supply with customer demand, supports faster order fulfillment, enables just-in-time strategies, and reduces carrying costs. Practices such as cross-docking and transloading move goods quickly from inbound to outbound transportation, improving supply chain agility.</p>'],
                ['q' => 'What is a 3PL warehouse?', 'a' => '<p>A 3PL (third-party logistics) warehouse is a facility managed by an external provider that handles warehousing, inventory management, and order fulfillment for other companies. These warehouses receive inventory, store it, and pick, pack, and ship orders on behalf of clients.</p>'],
                ['q' => 'Is third-party logistics the same as drop shipping?', 'a' => '<p>No. Drop shipping is an inventory-free model where suppliers ship directly to customers. Third-party logistics involves a provider managing inventory storage, packing, and shipping on behalf of the client. This model offers higher control, faster delivery, and better branding, but requires upfront inventory investment.</p>'],
                ['q' => 'What certifications does McCollister’s warehousing hold?', 'a' => '<p>McCollister’s warehousing certifications include <a href="https://www.iso.org/iso-13485-medical-devices.html" target="_blank" rel="noopener"><strong>ISO 13485</strong></a> for medical device handling, FDA-registered facilities, <a href="https://www.cbp.gov/border-security/ports-entry/cargo-security/ctpat" target="_blank" rel="noopener"><strong>C-TPAT</strong></a> for supply chain security, and <a href="https://www.epa.gov/smartway" target="_blank" rel="noopener"><strong>EPA SmartWay</strong></a> partnership for environmental stewardship. Certification availability varies by location. Contact McCollister’s to confirm capabilities at a specific facility.</p>'],
                ['q' => 'Does McCollister’s offer climate-controlled warehousing?', 'a' => '<p>Yes. Select McCollister’s facilities offer climate-controlled and temperature-monitored storage for products that require specific environmental conditions, including medical devices, pharmaceuticals, and sensitive electronic equipment.</p>'],
                ['q' => 'Can McCollister’s provide asset recovery and e-waste recycling?', 'a' => '<p>Yes. McCollister’s offers asset recovery services for end-of-life equipment, including inventory auditing, secure storage, remarketing, and certified e-waste recycling in compliance with environmental regulations.</p>'],
            ],
        ],
        'final-mile-white-glove' => [
            'label' => 'White Glove & Final Mile',
            'pdf'   => 'FAQs-Final-Mile-and-White-Glove.pdf',
            'items' => [
                ['q' => 'What is white-glove transportation?', 'a' => '<p>White-glove transportation is a specialized logistics service designed for shipments that require added care, coordination, and inside handling. At McCollister’s, this typically includes multi-person teams, inside pickup and delivery, careful placement, protective handling during transit, and debris removal.</p>'],
                ['q' => 'Why is it called white-glove delivery?', 'a' => '<p>The term “white glove” reflects a higher standard of service and attention to detail, where handling, presentation, and care matter as much as transportation. In logistics, it signals a level of service that goes beyond curbside or dock delivery.</p>'],
                ['q' => 'What is the difference between first- and final-mile logistics?', 'a' => '<p>First-mile logistics manages the pickup and transfer from the origin point into the transportation network, including packaging and sorting. Final-mile delivery covers the last stage, moving shipments from a distribution point to the destination, and often includes inside delivery, placement, and white-glove handling.</p>'],
                ['q' => 'What information do I need to gather to get a quote for white-glove services?', 'a' => '<p>McCollister’s typically needs origin and destination locations, requested dates, item descriptions with dimensions and weights, inside delivery or assembly needs, site access details, and equipment requirements such as dry van, climate-controlled van, or flatbed.</p>'],
                ['q' => 'What types of shipments benefit from white-glove services?', 'a' => '<p>White-glove delivery is recommended for medical and laboratory equipment, high-value electronics, commercial furniture and appliances, data center infrastructure, fine art and antiques, retail displays and fixture installations, and trade show materials. Any shipment where condition, placement, and timing are critical is a candidate for white-glove service.</p>'],
                ['q' => 'Does McCollister’s provide assembly and installation as part of white-glove delivery?', 'a' => '<p>Yes. McCollister’s white-glove services can include on-site assembly, placement, leveling, and basic installation as part of the delivery. Debris removal and packaging disposal are also standard with white-glove service.</p>'],
                ['q' => 'Can McCollister’s deliver to upper floors, basements, or restricted-access areas?', 'a' => '<p>Yes. McCollister’s white-glove teams are equipped to navigate elevators, stairwells, loading docks, security checkpoints, and tight access corridors. Pre-delivery site assessments ensure the team arrives prepared for the specific access conditions at the destination.</p>'],
            ],
        ],
    ];

    // Resolve internal-link tokens once, on first use.
    foreach ($groups as $slug => $group) {
        foreach ($group['items'] as $i => $item) {
            $groups[$slug]['items'][$i]['a'] = mcc_faq_link_tokens($item['a']);
        }
    }

    return $groups;
}

/**
 * Swap @TOKEN@ placeholders in an answer for real URLs.
 *
 * Kept out of the content so the answers stay portable: home_url() resolves to
 * whatever environment the theme is running in, rather than baking a domain in.
 */
function mcc_faq_link_tokens(string $answer): string
{
    return strtr($answer, [
        '@TALK@'      => esc_url(home_url('/talk-to-an-expert/')),
        '@ESG@'       => esc_url(home_url('/esg-practices/')),
        '@TECHSERV@'  => esc_url(home_url('/technical-services/')),
        '@PREPGUIDE@' => esc_url(home_url('/downloads/How-to-Prepare-Your-Vehicle-for-Transport.pdf')),
    ]);
}

/**
 * The items for one group, or an empty array if the slug is unknown.
 */
function mcc_faqs_for(string $group): array
{
    $groups = mcc_faq_groups();

    return $groups[$group]['items'] ?? [];
}

/**
 * The industry groups only — everything except General.
 *
 * Kept for the /faqs/ page, which renders General as its main accordion and the
 * rest as per-industry modals with a PDF download.
 */
function mcc_industry_faqs(): array
{
    $groups = mcc_faq_groups();

    unset($groups['general']);

    return $groups;
}
