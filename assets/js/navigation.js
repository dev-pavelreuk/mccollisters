document.addEventListener("DOMContentLoaded", () => {
	const header = document.querySelector(".site-header");
	const toggle = document.querySelector(".site-header__toggle");
	const navigation = document.querySelector(".site-navigation");
	const submenuParents = document.querySelectorAll(
		".site-navigation .menu-item-has-children"
	);

	if (!header || !toggle || !navigation) {
		return;
	}

	const setHeaderHeightVar = () => {
		// Dropdowns and the mobile panel anchor to the header's bottom edge
		// rather than a fixed offset, so they clear the admin bar (which
		// shifts the header down) and the sticky state.
		document.documentElement.style.setProperty(
			"--mcc-header-bottom",
			`${Math.max(0, header.getBoundingClientRect().bottom)}px`
		);
	};

	// getBoundingClientRect() forces a synchronous layout, so batch it into a
	// single animation frame instead of running it on every scroll tick.
	let headerMeasureQueued = false;

	const queueHeaderMeasure = () => {
		if (headerMeasureQueued) {
			return;
		}

		headerMeasureQueued = true;

		window.requestAnimationFrame(() => {
			headerMeasureQueued = false;
			setHeaderHeightVar();
		});
	};

	setHeaderHeightVar();
	window.addEventListener("resize", queueHeaderMeasure);
	// Header position changes when .is-sticky toggles (padding/shadow shift),
	// so re-measure on scroll too rather than only once on load.
	window.addEventListener("scroll", queueHeaderMeasure, { passive: true });

	// Give every dropdown the same height as the tallest one, so the overlay
	// doesn't resize when moving between Services / Industries / Resources.
	const subMenus = document.querySelectorAll(
		".site-navigation__menu .sub-menu"
	);

	const equalizeSubmenuHeight = () => {
		// Reset first so we measure natural content heights, not a floor
		// applied on a previous run.
		document.documentElement.style.setProperty("--mcc-submenu-height", "auto");

		// Desktop only — on mobile the dropdowns are stacked accordions.
		if (window.innerWidth <= 1024 || !subMenus.length) {
			return;
		}

		let maxHeight = 0;
		subMenus.forEach((menu) => {
			maxHeight = Math.max(maxHeight, menu.offsetHeight);
		});

		if (maxHeight) {
			document.documentElement.style.setProperty(
				"--mcc-submenu-height",
				`${maxHeight}px`
			);
		}
	};

	equalizeSubmenuHeight();
	window.addEventListener("resize", equalizeSubmenuHeight);
	// Re-measure once fonts/images have settled (affects the promo panel).
	window.addEventListener("load", equalizeSubmenuHeight);

	// Newsletter: reveal the Subscribe button once the visitor has typed at
	// least 3 characters. Shared by the header dropdowns (Industries,
	// Resources) and the footer — each form is wired up independently.
	document
		.querySelectorAll(".mcc-newsletter")
		.forEach((form) => {
			const emailInput = form.querySelector('input[type="email"]');
			const reveal = form.querySelector(".mcc-newsletter-reveal");

			if (!emailInput || !reveal) {
				return;
			}

			const syncReveal = () => {
				reveal.classList.toggle(
					"is-visible",
					emailInput.value.trim().length >= 3
				);
			};

			emailInput.addEventListener("input", syncReveal);
			syncReveal();
		});

	// Single-post "print" share button.
	document.querySelectorAll("[data-print]").forEach((btn) => {
		btn.addEventListener("click", () => window.print());
	});

	const closeMenu = () => {
		toggle.setAttribute("aria-expanded", "false");
		toggle.setAttribute("aria-label", "Open main menu");
		navigation.classList.remove("is-open");
		document.body.classList.remove("menu-open");
	};

	toggle.addEventListener("click", () => {
		const isOpen = toggle.getAttribute("aria-expanded") === "true";

		toggle.setAttribute("aria-expanded", String(!isOpen));
		toggle.setAttribute(
			"aria-label",
			isOpen ? "Open main menu" : "Close main menu"
		);

		navigation.classList.toggle("is-open", !isOpen);
		document.body.classList.toggle("menu-open", !isOpen);
	});

	// Keep aria-expanded in sync with the dropdown's actual state. It's
	// rendered as "false" and, without this, never updates — so screen readers
	// announce every dropdown as collapsed even while it's open (WCAG 4.1.2).
	submenuParents.forEach((item) => {
		const parentLink = item.querySelector(":scope > a[aria-haspopup]");

		if (!parentLink) {
			return;
		}

		const setExpanded = (isExpanded) => {
			parentLink.setAttribute("aria-expanded", String(isExpanded));
		};

		item.addEventListener("mouseenter", () => {
			if (window.innerWidth > 1024) {
				setExpanded(true);
			}
		});

		item.addEventListener("mouseleave", () => {
			if (window.innerWidth > 1024) {
				setExpanded(false);
			}
		});

		// Keyboard equivalent of the hover state.
		item.addEventListener("focusin", () => setExpanded(true));

		item.addEventListener("focusout", (event) => {
			if (!item.contains(event.relatedTarget)) {
				setExpanded(false);
			}
		});
	});

	submenuParents.forEach((item) => {
		const link = item.querySelector(":scope > a");

		if (!link) {
			return;
		}

		link.addEventListener("click", (event) => {
			if (window.innerWidth > 1024) {
				return;
			}

			if (!item.classList.contains("is-open")) {
				event.preventDefault();

				submenuParents.forEach((otherItem) => {
					if (otherItem !== item) {
						otherItem.classList.remove("is-open");

						const otherLink = otherItem.querySelector(
							":scope > a[aria-haspopup]"
						);

						if (otherLink) {
							otherLink.setAttribute("aria-expanded", "false");
						}
					}
				});

				item.classList.add("is-open");

				if (link.hasAttribute("aria-haspopup")) {
					link.setAttribute("aria-expanded", "true");
				}
			}
		});
	});

	// Second-level accordion on mobile: Services > Transportation > links.
	// Desktop shows every column expanded, so this only runs at <=1024px.
	const megaColumns = document.querySelectorAll(".mega-column");

	megaColumns.forEach((column) => {
		const heading = column.querySelector(".mega-column__heading");
		const links = column.querySelector(".mega-column__links");

		if (!heading || !links) {
			return;
		}

		heading.addEventListener("click", (event) => {
			if (window.innerWidth > 1024) {
				return;
			}

			event.preventDefault();

			const isOpen = column.classList.contains("is-open");

			megaColumns.forEach((otherColumn) => {
				if (otherColumn !== column) {
					otherColumn.classList.remove("is-open");
				}
			});

			column.classList.toggle("is-open", !isOpen);
		});
	});

	// Sticky header that hides on scroll-down and slides back in on scroll-up.
	let lastScrollY = window.scrollY;
	let headerTicking = false;

	const updateHeaderScroll = () => {
		const y = window.scrollY;
		const sticky = y > 80;
		header.classList.toggle("is-sticky", sticky);

		// Don't hide while the mobile menu is open.
		const menuOpen = document.body.classList.contains("menu-open");

		if (sticky && !menuOpen && y > lastScrollY && y > 100) {
			header.classList.add("is-hidden"); // scrolling down → hide
		} else if (!sticky || y < lastScrollY || menuOpen) {
			header.classList.remove("is-hidden"); // scrolling up / at top → show
		}

		lastScrollY = y;
		headerTicking = false;
	};

	window.addEventListener(
		"scroll",
		() => {
			if (!headerTicking) {
				window.requestAnimationFrame(updateHeaderScroll);
				headerTicking = true;
			}
		},
		{ passive: true }
	);

	window.addEventListener("resize", () => {
		if (window.innerWidth > 1024) {
			closeMenu();

			submenuParents.forEach((item) => {
				item.classList.remove("is-open");
			});

			megaColumns.forEach((column) => {
				column.classList.remove("is-open");
			});
		}
	});

	document.addEventListener("keydown", (event) => {
		if (event.key === "Escape") {
			closeMenu();
		}
	});
});