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

	setHeaderHeightVar();
	window.addEventListener("resize", setHeaderHeightVar);
	// Header height changes when .is-sticky toggles (padding/shadow shift),
	// so re-measure on scroll too rather than only once on load.
	window.addEventListener("scroll", setHeaderHeightVar, { passive: true });

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
					}
				});

				item.classList.add("is-open");
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

	window.addEventListener(
		"scroll",
		() => {
			header.classList.toggle("is-sticky", window.scrollY > 80);
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