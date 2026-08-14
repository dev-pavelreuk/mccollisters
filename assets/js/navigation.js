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

	// Transform-based INFINITE carousel for the homepage blog slider (mouse +
	// touch), matching the live site's Swiper: drag tracks the pointer 1:1, and
	// on release it animates exactly one slide (500ms CSS transition). The set
	// is cloned before/after so it loops seamlessly; after landing on a clone we
	// jump (no animation) to the matching real slide. Only active on mobile.
	document.querySelectorAll(".home-blog__grid").forEach((track) => {
		const reals = Array.prototype.slice.call(track.children);
		const realCount = reals.length;
		if (realCount <= 1) return;

		// Drag from the whole frame (viewport) so grabbing a card OR the gap
		// between cards both start the swipe.
		const frame = track.parentElement || track;
		const isMobile = () => window.matchMedia("(max-width: 782px)").matches;

		// Clone the whole set after and before the originals.
		const makeClone = (node) => {
			const clone = node.cloneNode(true);
			clone.classList.add("home-blog__card--clone");
			clone.setAttribute("aria-hidden", "true");
			clone.querySelectorAll("a").forEach((a) => a.setAttribute("tabindex", "-1"));
			return clone;
		};
		reals.forEach((node) => track.appendChild(makeClone(node)));
		for (let k = realCount - 1; k >= 0; k--) {
			track.insertBefore(makeClone(reals[k]), track.firstChild);
		}

		let index = realCount; // first real slide (after the leading clones)
		let step = 0; // card width + gap
		let down = false;
		let dragged = false;
		let startX = 0;
		let baseTx = 0;
		let currentTx = 0;

		const measure = () => {
			const first = track.children[0];
			if (!first) return;
			const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
			step = first.getBoundingClientRect().width + gap;
		};

		const setTx = (tx, animate) => {
			currentTx = tx;
			track.style.transition = animate ? "" : "none"; // "" = the 0.5s CSS rule
			track.style.transform = "translateX(" + tx + "px)";
		};

		const goTo = (i) => {
			measure();
			index = i;
			setTx(-index * step, true);
		};

		// After the slide animation, if we're on a clone, snap to the matching
		// real slide with no animation so it loops forever.
		track.addEventListener("transitionend", (e) => {
			if (e.propertyName !== "transform" || !isMobile()) return;
			if (index >= 2 * realCount) {
				index -= realCount;
				setTx(-index * step, false);
			} else if (index < realCount) {
				index += realCount;
				setTx(-index * step, false);
			}
		});

		frame.addEventListener("pointerdown", (e) => {
			if (!isMobile()) return;
			down = true;
			dragged = false;
			startX = e.clientX;
			baseTx = currentTx;
			track.classList.add("is-dragging");
		});

		window.addEventListener("pointermove", (e) => {
			if (!down) return;
			const dx = e.clientX - startX;
			if (Math.abs(dx) > 4) dragged = true;
			setTx(baseTx + dx, false);
		});

		const release = (e) => {
			if (!down) return;
			down = false;
			track.classList.remove("is-dragging");
			measure();
			const dx = (e ? e.clientX : startX) - startX;
			const threshold = step * 0.2;
			let target = index;
			if (dx <= -threshold) target += 1;
			else if (dx >= threshold) target -= 1;
			goTo(target);
		};

		window.addEventListener("pointerup", release);
		window.addEventListener("pointercancel", release);

		// Block native image/link dragging so the pointer drives the carousel.
		frame.addEventListener("dragstart", (e) => e.preventDefault());

		// Swallow the click that follows a real drag so the card link doesn't fire.
		frame.addEventListener(
			"click",
			(e) => {
				if (dragged) {
					e.preventDefault();
					e.stopPropagation();
					dragged = false;
				}
			},
			true
		);

		// Position instantly on load and when crossing the breakpoint / resizing.
		const sync = () => {
			if (isMobile()) {
				measure();
				setTx(-index * step, false);
			} else {
				track.style.transform = "";
				track.style.transition = "";
				currentTx = 0;
			}
		};
		window.addEventListener("resize", sync);
		sync();
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

			// If this column is already open, let the heading's link navigate
			// (e.g. second click on "Transportation" goes to /transportation/).
			if (column.classList.contains("is-open")) {
				return;
			}

			// First click: open this column's links (close the others).
			event.preventDefault();

			megaColumns.forEach((otherColumn) => {
				if (otherColumn !== column) {
					otherColumn.classList.remove("is-open");
				}
			});

			column.classList.add("is-open");
		});
	});

	// Sticky header that hides on scroll-down and slides back in on scroll-up.
	let lastScrollY = window.scrollY;
	let headerTicking = false;

	const updateHeaderScroll = () => {
		const y = window.scrollY;
		const sticky = y > 80;
		header.classList.toggle("is-sticky", sticky);

		// Don't hide while the mobile menu is open, or while a desktop mega-menu
		// overlay is open on hover — hiding the header mid-hover yanks the overlay
		// away and looks glitchy, so keep it put until the menu is unhovered.
		const menuOpen = document.body.classList.contains("menu-open");
		const submenuOpen =
			window.innerWidth > 1024 &&
			!!navigation.querySelector(
				'.menu-item-has-children > a[aria-expanded="true"]'
			);
		const keepVisible = menuOpen || submenuOpen;

		if (sticky && !keepVisible && y > lastScrollY && y > 100) {
			header.classList.add("is-hidden"); // scrolling down → hide
		} else if (!sticky || y < lastScrollY || keepVisible) {
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

	// Suppress transitions while the window is actively resizing so the mobile
	// nav panel doesn't fade in/out (flash) when crossing the desktop/mobile
	// breakpoint.
	let resizeGuardTimer;
	window.addEventListener("resize", () => {
		document.documentElement.classList.add("is-resizing");
		clearTimeout(resizeGuardTimer);
		resizeGuardTimer = setTimeout(() => {
			document.documentElement.classList.remove("is-resizing");
		}, 200);
	});

	document.addEventListener("keydown", (event) => {
		if (event.key === "Escape") {
			closeMenu();
		}
	});

	/* Our Team tabs: click a tab to reveal its group panel (desktop only; on
	   mobile CSS shows every panel, so these clicks are simply inert there). */
	const teamTabs = Array.from(document.querySelectorAll(".team__tab"));
	const teamPanels = Array.from(document.querySelectorAll(".team__group"));
	if (teamTabs.length && teamPanels.length) {
		teamTabs.forEach((tab) => {
			tab.addEventListener("click", () => {
				const index = tab.getAttribute("data-team-tab");
				teamTabs.forEach((t) => {
					const active = t === tab;
					t.classList.toggle("is-active", active);
					t.setAttribute("aria-selected", active ? "true" : "false");
				});
				teamPanels.forEach((panel) => {
					panel.classList.toggle(
						"is-active",
						panel.getAttribute("data-team-panel") === index
					);
				});
			});
		});
	}
});