/**
 * Conversion tracking — GTM dataLayer events.
 *
 * Pushes the GA4 events that the Google Ads conversion actions are built on.
 * Everything here is delegated off `document` and matched on href / semantic
 * hooks rather than on CSS classes, because selector-based GTM triggers are
 * what broke the last time the site markup changed.
 *
 * Transport — the site currently loads GA4 through Site Kit's gtag.js with NO
 * GTM container, so this sends events both ways depending on what is present:
 *
 *   GTM container loaded -> dataLayer.push({event: "name", ...}), GTM's format.
 *   gtag.js only          -> gtag("event", "name", {...}), GA4's command format.
 *
 * That distinction is not cosmetic: gtag.js treats window.dataLayer as a command
 * queue and silently ignores plain {event: ...} objects, which are GTM's trigger
 * format. Sending the wrong shape means the events fire and nothing records them.
 *
 * Exactly one of the two is sent per event, so adding a GTM container later
 * cannot double-count. If neither library has executed yet (NitroPack delays
 * scripts on this site), the gtag command still queues on dataLayer and GA4
 * drains it on load — so no events are lost.
 *
 * GTM setup, if a container is added: one GA4 Event tag per name in EVENTS
 * below, each on a Custom Event trigger matching that name. No DOM selectors.
 *
 * Escape hatch: put `data-mcc-event="my_event"` on any element and a click on
 * it pushes that name verbatim, ahead of every rule below. Add
 * `data-mcc-event-label="..."` to set the `link_text` param.
 *
 * One event per click, first match wins, in the order listed in `resolve()`.
 * Quote and contact clicks are matched first on purpose: they are the Primary
 * bidding conversions and must never be shadowed by a broader rule.
 */
(function () {

	/**
	 * Logical name -> GA4 event name.
	 *
	 * The lowercase/underscore names that look misspelled are NOT typos on our
	 * side: they match the existing Google Ads conversion actions exactly, so
	 * the actions can be re-imported instead of rebuilt. Renaming one here means
	 * creating a new conversion action in Ads and losing its history.
	 */
	const EVENTS = {
		quote:      "get_a_quote_button_click",
		contact:    "Contactus_cta_click",
		locations:  "locations_cta_click",   // new
		call:       "Cick_to_call",          // sic - existing Ads action name
		email:      "click_to_email",        // new
		directions: "google_map_directions",
		social:     "Social_button_click",
		download:   "file_download",
		blogCta:    "blog_cta_click",        // new
		newsletter: "newsletter_subscribe",  // new
		video:      "video_play",            // replaces the legacy `youtube` action
		bookOrder:  "book_order_submission",
	};

	/**
	 * GA4 Enhanced Measurement already fires `file_download` on its own. Leave
	 * this false unless that setting is turned off in the GA4 data stream,
	 * otherwise every download counts twice.
	 */
	const TRACK_DOWNLOADS = false;

	/** Origin of the auto-transport quote/book iframe (see page-auto-transport.php). */
	const BOOKING_ORIGIN = "https://dogqvekvr5n1p.cloudfront.net";

	/** Set to true in the console to log every dataLayer push while testing. */
	window.mccTrackingDebug = window.mccTrackingDebug || false;

	const SOCIAL_HOSTS = [
		"linkedin.com",
		"facebook.com",
		"instagram.com",
		"youtube.com",
		"youtu.be",
		"twitter.com",
		"x.com",
		"tiktok.com",
	];

	const MAP_HOSTS = [
		"google.com/maps",
		"maps.google.",
		"goo.gl/maps",
		"maps.app.goo.gl",
	];

	const DOWNLOAD_EXTENSIONS =
		/\.(pdf|docx?|xlsx?|pptx?|zip|csv|txt|rtf)(\?|#|$)/i;

	window.dataLayer = window.dataLayer || [];

	/** Coarse page bucket, sent on every event so GA4 can segment without extra tags. */
	const pageType = () => {
		if (!document.body) {
			return "page";
		}

		const body = document.body.classList;

		if (body.contains("single-post") || body.contains("blog")) {
			return "blog";
		}

		if (body.contains("home")) {
			return "home";
		}

		if (body.contains("post-type-archive-facility")) {
			return "locations";
		}

		return "page";
	};

	/**
	 * True only when a real GTM container is on the page.
	 *
	 * window.google_tag_manager is NOT a usable test on its own — gtag.js sets it
	 * too. It is an object keyed by tag id, so look for a GTM- prefixed key.
	 */
	const hasGtmContainer = () => {
		const containers = window.google_tag_manager;

		if (!containers) {
			return false;
		}

		try {
			return Object.keys(containers).some(
				(key) => key.indexOf("GTM-") === 0
			);
		} catch (error) {
			return false;
		}
	};

	// Standard gtag shim. Defining it is safe when Site Kit has not printed its
	// own yet: the implementation is identical and both target window.dataLayer.
	const gtag = function () {
		window.dataLayer.push(arguments);
	};

	const push = (name, params) => {
		if (!name) {
			return;
		}

		const detail = Object.assign({ page_type: pageType() }, params || {});

		if (hasGtmContainer()) {
			window.dataLayer.push(Object.assign({ event: name }, detail));
		} else if (typeof window.gtag === "function") {
			window.gtag("event", name, detail);
		} else {
			gtag("event", name, detail);
		}

		if (window.mccTrackingDebug) {
			console.log(
				"[mcc-tracking]",
				hasGtmContainer() ? "gtm" : "gtag",
				name,
				detail
			);
		}
	};

	// Shared entry point, also used by the Gravity Forms tracker in functions.php.
	window.mccTrack = push;

	const hostOf = (url) => {
		try {
			return new URL(url, window.location.href).hostname.replace(/^www\./, "");
		} catch (error) {
			return "";
		}
	};

	const pathOf = (url) => {
		try {
			return new URL(url, window.location.href).pathname;
		} catch (error) {
			return "";
		}
	};

	const isInternal = (url) => hostOf(url) === hostOf(window.location.href);

	const matchesHost = (url, list) => {
		const full = String(url).toLowerCase();

		return list.some((needle) => full.indexOf(needle) !== -1);
	};

	/**
	 * Decide which single event a link click represents.
	 * Order matters — see the file header.
	 */
	const resolve = (link, href) => {
		const path = isInternal(href) ? pathOf(href).toLowerCase() : "";

		if (href.indexOf("tel:") === 0) {
			return EVENTS.call;
		}

		if (href.indexOf("mailto:") === 0) {
			return EVENTS.email;
		}

		// Money events first: these are the Primary conversions Ads bids on.
		if (path.indexOf("/talk-to-an-expert") === 0) {
			return EVENTS.quote;
		}

		if (path.indexOf("/contact-us") === 0 || path.indexOf("/contact") === 0) {
			return EVENTS.contact;
		}

		if (path.indexOf("/locations") === 0) {
			return EVENTS.locations;
		}

		if (matchesHost(href, MAP_HOSTS)) {
			return EVENTS.directions;
		}

		if (matchesHost(href, SOCIAL_HOSTS) && !isInternal(href)) {
			return EVENTS.social;
		}

		if (TRACK_DOWNLOADS && DOWNLOAD_EXTENSIONS.test(href)) {
			return EVENTS.download;
		}

		// Fallback: any other call-to-action button inside blog templates
		// (subscribe prompts, related-post buttons, sidebar promos).
		if (pageType() === "blog" && link.closest(".mcc-btn, .blog-widget, .cta-cards")) {
			return EVENTS.blogCta;
		}

		return "";
	};

	document.addEventListener("click", (event) => {
		const target = event.target;

		if (!target || typeof target.closest !== "function") {
			return;
		}

		// Explicit override wins over every rule below.
		const tagged = target.closest("[data-mcc-event]");

		if (tagged) {
			push(tagged.getAttribute("data-mcc-event"), {
				link_text:
					tagged.getAttribute("data-mcc-event-label") ||
					(tagged.textContent || "").trim().slice(0, 100),
				link_url: tagged.getAttribute("href") || "",
			});

			return;
		}

		const link = target.closest("a[href]");

		if (!link) {
			return;
		}

		const href = link.getAttribute("href") || "";

		if (!href || href.charAt(0) === "#") {
			return;
		}

		const name = resolve(link, href);

		if (!name) {
			return;
		}

		push(name, {
			link_url: href,
			link_text:
				(link.textContent || "").trim().slice(0, 100) ||
				link.getAttribute("aria-label") ||
				"",
		});
	});

	/**
	 * Newsletter signups (footer + blog sidebar).
	 *
	 * NOTE: both forms currently post to "#" and are not wired to an ESP, so
	 * this fires on intent, not on a confirmed subscription. Once the real
	 * endpoint is connected, move this to the success response.
	 */
	document.addEventListener("submit", (event) => {
		const form = event.target;

		if (!form || typeof form.closest !== "function") {
			return;
		}

		if (!form.closest(".mcc-newsletter")) {
			return;
		}

		push(EVENTS.newsletter, {
			form_location: form.closest(".site-footer") ? "footer" : "blog_sidebar",
		});
	});

	// Vimeo modal opens (about-us, careers). The legacy `youtube` conversion
	// action has no equivalent on this site — the videos are Vimeo now.
	document.addEventListener("click", (event) => {
		const trigger =
			event.target &&
			typeof event.target.closest === "function" &&
			event.target.closest("[data-video-open]");

		if (!trigger) {
			return;
		}

		push(EVENTS.video, {
			video_provider: "vimeo",
			video_title: document.title,
		});
	});

	/**
	 * Auto-transport quote/book iframe.
	 *
	 * The embed already postMessages layout events (height, scroll). We do not
	 * yet know the message shape it sends on a completed booking, so match the
	 * likely candidates and log anything unrecognised while debug is on — that
	 * log is how we find the real payload to match on.
	 */
	window.addEventListener("message", (event) => {
		if (event.origin !== BOOKING_ORIGIN) {
			return;
		}

		const data = event.data;

		if (!data) {
			return;
		}

		const name = typeof data === "string" ? data : data.event || data.type || "";
		const known = /(^|_|\.)(submit|submitted|booking|book_order|order|complete|success|confirmation)/i;

		if (name && known.test(name)) {
			push(EVENTS.bookOrder, {
				source: "banner_quote_embed",
				message_name: String(name).slice(0, 100),
			});

			return;
		}

		if (window.mccTrackingDebug && name !== "height" && name !== "scroll") {
			console.log("[mcc-tracking] unmatched booking message:", data);
		}
	});
})();
