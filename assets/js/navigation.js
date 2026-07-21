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
		document.documentElement.style.setProperty(
			"--mcc-header-height",
			`${header.offsetHeight}px`
		);
	};

	setHeaderHeightVar();
	window.addEventListener("resize", setHeaderHeightVar);
	// Header height changes when .is-sticky toggles (padding/shadow shift),
	// so re-measure on scroll too rather than only once on load.
	window.addEventListener("scroll", setHeaderHeightVar, { passive: true });

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
		}
	});

	document.addEventListener("keydown", (event) => {
		if (event.key === "Escape") {
			closeMenu();
		}
	});
});