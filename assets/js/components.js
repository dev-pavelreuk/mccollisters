/**
 * Site-wide interactive components. Each is opt-in via markup hooks, so it runs
 * on any page (home or interior) and is a no-op when its hook is absent.
 *
 *   Count-up ....... <span data-count-to="98.8" data-count-from="0"
 *                          data-count-decimals="1">…</span>
 *   Accordion ...... <div data-accordion> <details><summary>…</summary>
 *                          <div>…panel…</div></details> … </div>
 *   Slider ......... <div data-slider> <div data-slider-track>
 *                          <div data-slider-slide>…</div> … </div>
 *                        [<button data-slider-dot></button> …]
 *                        [<span data-slider-current></span>] </div>
 */
(function () {
	"use strict";

	const reduceMotion = window.matchMedia(
		"(prefers-reduced-motion: reduce)"
	).matches;

	/* --- Count-up ---------------------------------------------------------- */
	function initCounters() {
		if (!("IntersectionObserver" in window)) {
			return;
		}

		document.querySelectorAll("[data-count-to]").forEach((counter) => {
			const countTo = parseFloat(counter.dataset.countTo);
			const countFrom = parseFloat(counter.dataset.countFrom || "0");
			const decimals = parseInt(counter.dataset.countDecimals || "0", 10);
			const duration = parseInt(counter.dataset.countDuration || "2000", 10);

			if (reduceMotion || !isFinite(countTo)) {
				return; // leave the static, final value in place
			}

			const format = (value) =>
				value.toLocaleString("en-US", {
					minimumFractionDigits: decimals,
					maximumFractionDigits: decimals,
				});

			const observer = new IntersectionObserver(
				(entries) => {
					entries.forEach((entry) => {
						if (!entry.isIntersecting) {
							return;
						}
						observer.disconnect();

						let startTime = null;
						const tick = (now) => {
							if (startTime === null) {
								startTime = now;
							}
							const progress = Math.min(
								(now - startTime) / duration,
								1
							);
							counter.textContent = format(
								countFrom + (countTo - countFrom) * progress
							);
							if (progress < 1) {
								window.requestAnimationFrame(tick);
							}
						};
						window.requestAnimationFrame(tick);
					});
				},
				{ threshold: 0.4 }
			);

			observer.observe(counter);
		});
	}

	/* --- Accordion --------------------------------------------------------- */
	// Smoothly animate native <details> open/close and keep one row open per
	// [data-accordion] group. The panel is the element after <summary>.
	function initAccordions(root) {
		(root || document).querySelectorAll("[data-accordion]").forEach((group) => {
			const items = Array.from(group.querySelectorAll("details"));
			if (items.length === 0) {
				return;
			}

			const DURATION = reduceMotion ? 0 : 320;

			const controllers = items.map((el) => {
				const summary = el.querySelector("summary");
				const panel = summary ? summary.nextElementSibling : null;
				if (!summary || !panel) {
					return { el, close: () => {} };
				}

				let animation = null;
				let isClosing = false;

				const settle = (open) => {
					el.open = open;
					el.style.height = "";
					el.style.overflow = "";
					animation = null;
					isClosing = false;
				};

				const animateTo = (endHeight, open) => {
					const startHeight = `${el.offsetHeight}px`;
					if (animation) {
						animation.cancel();
					}
					animation = el.animate(
						{ height: [startHeight, endHeight] },
						{ duration: DURATION, easing: "ease" }
					);
					animation.onfinish = () => settle(open);
					animation.oncancel = () => {
						isClosing = false;
					};
				};

				const shrink = () => {
					isClosing = true;
					animateTo(`${summary.offsetHeight}px`, false);
				};

				const expand = () => {
					animateTo(
						`${summary.offsetHeight + panel.offsetHeight}px`,
						true
					);
				};

				const open = () => {
					el.style.height = `${el.offsetHeight}px`;
					el.open = true;
					window.requestAnimationFrame(expand);
				};

				summary.addEventListener("click", (event) => {
					event.preventDefault();
					el.style.overflow = "hidden";

					if (isClosing || !el.open) {
						controllers.forEach((other) => {
							if (other.el !== el) {
								other.close();
							}
						});
						open();
					} else {
						shrink();
					}
				});

				return {
					el,
					close: () => {
						if (el.open && !isClosing) {
							el.style.overflow = "hidden";
							shrink();
						}
					},
				};
			});
		});
	}

	/* --- Slider ------------------------------------------------------------ */
	// Draggable, autoplaying horizontal slider. Live drag follows the pointer;
	// releasing snaps to the nearest slide. Autoplay pauses on hover/focus/drag.
	function initSliders() {
		document.querySelectorAll("[data-slider]").forEach((slider) => {
			const track = slider.querySelector("[data-slider-track]");
			const slides = Array.from(
				slider.querySelectorAll("[data-slider-slide]")
			);
			const dots = Array.from(
				slider.querySelectorAll("[data-slider-dot]")
			);
			const current = slider.querySelector("[data-slider-current]");

			if (!track || slides.length < 2) {
				return;
			}

			const INTERVAL = parseInt(slider.dataset.sliderInterval || "3000", 10);
			const EASE = "transform 0.45s cubic-bezier(0.4, 0, 0.2, 1)";
			let index = 0;
			let timer = null;
			let pointerActive = false;
			let pointerStartX = 0;
			let dragDelta = 0;
			let width = slider.clientWidth;

			const render = (animate) => {
				track.style.transition = animate ? EASE : "none";
				track.style.transform = `translate3d(calc(${-index * 100}% + ${dragDelta}px), 0, 0)`;
			};

			const updateMeta = () => {
				slides.forEach((slide, i) =>
					slide.classList.toggle("is-active", i === index)
				);
				dots.forEach((dot, i) =>
					dot.classList.toggle("is-active", i === index)
				);
				if (current) {
					current.textContent = String(index + 1).padStart(2, "0");
				}
			};

			const goTo = (next, animate = true) => {
				index = (next + slides.length) % slides.length;
				dragDelta = 0;
				render(animate);
				updateMeta();
			};

			const stop = () => {
				if (timer) {
					window.clearInterval(timer);
					timer = null;
				}
			};

			const start = () => {
				if (reduceMotion || pointerActive) {
					return;
				}
				stop();
				timer = window.setInterval(() => goTo(index + 1), INTERVAL);
			};

			dots.forEach((dot, i) => {
				dot.addEventListener("click", () => {
					goTo(i);
					start();
				});
			});

			slider.addEventListener("mouseenter", stop);
			slider.addEventListener("mouseleave", start);
			slider.addEventListener("focusin", stop);
			slider.addEventListener("focusout", start);

			window.addEventListener("resize", () => {
				width = slider.clientWidth;
				render(false);
			});

			slider.addEventListener("pointerdown", (event) => {
				if (event.pointerType === "mouse" && event.button !== 0) {
					return;
				}
				pointerActive = true;
				pointerStartX = event.clientX;
				dragDelta = 0;
				stop();
				slider.setPointerCapture(event.pointerId);
				slider.classList.add("is-dragging");
			});

			slider.addEventListener("pointermove", (event) => {
				if (!pointerActive) {
					return;
				}
				dragDelta = event.clientX - pointerStartX;
				render(false);
			});

			const endDrag = (event) => {
				if (!pointerActive) {
					return;
				}
				pointerActive = false;
				slider.classList.remove("is-dragging");
				if (slider.hasPointerCapture(event.pointerId)) {
					slider.releasePointerCapture(event.pointerId);
				}

				const threshold = Math.min(width * 0.25, 120);
				if (dragDelta <= -threshold) {
					goTo(index + 1);
				} else if (dragDelta >= threshold) {
					goTo(index - 1);
				} else {
					dragDelta = 0;
					render(true);
				}

				start();
			};

			slider.addEventListener("pointerup", endDrag);
			slider.addEventListener("pointercancel", endDrag);
			slider.addEventListener("dragstart", (event) =>
				event.preventDefault()
			);

			render(false);
			updateMeta();
			start();
		});
	}

	/* --- Tabs -------------------------------------------------------------- */
	// Click a [data-tabs-tab="i"] to reveal the matching [data-tabs-panel="i"].
	function initTabs() {
		document.querySelectorAll("[data-tabs]").forEach((group, gi) => {
			const tabs = Array.from(
				group.querySelectorAll("[data-tabs-tab]")
			);
			const panels = Array.from(
				group.querySelectorAll("[data-tabs-panel]")
			);
			if (tabs.length === 0) {
				return;
			}

			// Give each tab/panel an id and cross-link them so assistive tech
			// can name the panel by its tab (WCAG 1.3.1 tabpanel name, 4.1.2).
			const gid = "svc-tabs-" + gi;
			panels.forEach((panel) => {
				const key = panel.dataset.tabsPanel;
				const tab = tabs.find((t) => t.dataset.tabsTab === key);
				if (!panel.id) {
					panel.id = gid + "-panel-" + key;
				}
				if (tab) {
					if (!tab.id) {
						tab.id = gid + "-tab-" + key;
					}
					panel.setAttribute("aria-labelledby", tab.id);
					tab.setAttribute("aria-controls", panel.id);
				}
			});

			const activate = (key) => {
				tabs.forEach((tab) => {
					const on = tab.dataset.tabsTab === key;
					tab.classList.toggle("is-active", on);
					tab.setAttribute("aria-selected", on ? "true" : "false");
				});
				panels.forEach((panel) => {
					const on = panel.dataset.tabsPanel === key;
					panel.classList.toggle("is-active", on);
					panel.hidden = !on;
				});
			};

			tabs.forEach((tab) => {
				tab.addEventListener("click", () =>
					activate(tab.dataset.tabsTab)
				);
			});

			// Deep-link support: /warehousing/#asset-recovery (and the other
			// anchors) opens the matching tab — or accordion item on mobile —
			// and scrolls to it. Works both on load and when the hash changes
			// while already on the page.
			const applyHash = (smooth) => {
				const anchor = decodeURIComponent(
					(window.location.hash || "").replace(/^#/, "")
				);
				if (!anchor) {
					return;
				}
				const tab = tabs.find(
					(t) => t.id === anchor || t.dataset.tabAnchor === anchor
				);
				if (!tab) {
					return;
				}
				activate(tab.dataset.tabsTab);
				tab.scrollIntoView({
					behavior: smooth ? "smooth" : "auto",
					block: "start",
				});
			};

			window.addEventListener("hashchange", () => applyHash(true));
			// Defer the initial run so layout (and the browser's own hash jump)
			// has settled before we re-scroll to the opened tab.
			window.requestAnimationFrame(() => applyHash(false));
		});
	}

	/**
	 * Heading letter-reveal. Splits every section <h2> into per-letter spans
	 * (preserving <br> line breaks) and plays a staggered fade + rise as the
	 * heading scrolls into view — the site-wide entrance effect. Global: it
	 * targets h2 elements whose content is plain text/<br> only, so it never
	 * disturbs headings that contain other markup.
	 */
	function initHeadingReveal() {
		var reduce = window.matchMedia(
			"(prefers-reduced-motion: reduce)"
		).matches;
		if (reduce) {
			return;
		}

		// CTA card titles are excluded from the reveal globally.
		var headings = document.querySelectorAll("main h2:not(.cta-card__title)");
		var targets = [];

		headings.forEach(function (h2) {
			if (h2.dataset.mccReveal) {
				return;
			}

			// Only split headings made of text + <br>; skip anything richer so
			// links/spans inside a heading are never destroyed.
			var ok = Array.prototype.every.call(h2.childNodes, function (node) {
				return (
					node.nodeType === 3 ||
					(node.nodeType === 1 && node.tagName === "BR")
				);
			});
			if (!ok || h2.textContent.trim() === "") {
				return;
			}

			var frag = document.createDocumentFragment();
			var delay = 0;

			Array.prototype.forEach.call(h2.childNodes, function (node) {
				if (node.nodeType === 1 && node.tagName === "BR") {
					// Clone (not recreate) so conditional-break classes like
					// br--mobile / br--desktop survive the letter split.
					frag.appendChild(node.cloneNode(false));
					return;
				}
				node.textContent.split(/(\s+)/).forEach(function (part) {
					if (part === "") {
						return;
					}
					if (/^\s+$/.test(part)) {
						frag.appendChild(document.createTextNode(part));
						return;
					}
					var word = document.createElement("span");
					word.className = "mcc-reveal__word";
					Array.prototype.forEach.call(part, function (ch) {
						var letter = document.createElement("span");
						letter.className = "mcc-reveal__letter";
						letter.textContent = ch;
						letter.style.animationDelay = delay.toFixed(2) + "s";
						delay += 0.02;
						word.appendChild(letter);
					});
					frag.appendChild(word);
				});
			});

			h2.textContent = "";
			h2.appendChild(frag);
			h2.classList.add("mcc-reveal");
			h2.dataset.mccReveal = "1";
			targets.push(h2);
		});

		if (!targets.length) {
			return;
		}

		if (!("IntersectionObserver" in window)) {
			targets.forEach(function (h2) {
				h2.classList.add("is-revealed");
			});
			return;
		}

		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add("is-revealed");
						observer.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.2, rootMargin: "0px 0px -8% 0px" }
		);

		targets.forEach(function (h2) {
			observer.observe(h2);
		});
	}

	/**
	 * Brand-logo marquees, driven by requestAnimationFrame instead of a CSS
	 * animation. rAF is suspended while the tab is hidden, so there is no clock
	 * to "catch up" on return — the strip resumes exactly where it left off with
	 * no twitch. Matches the seamless behaviour of a JS slider plugin.
	 *
	 * Each strip holds two identical .svc-logos__group elements; the track loops
	 * by adding one group's width back once it has scrolled past it. Speed is
	 * derived from the group width so one group passes in ~40s (as before).
	 * Pauses on hover/focus; honours prefers-reduced-motion.
	 */
	function initMarquee() {
		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}

		const instances = [];

		document.querySelectorAll(".svc-logos").forEach((slider) => {
			const track = slider.querySelector(".svc-logos__track");
			const group = track
				? track.querySelector(".svc-logos__group")
				: null;
			if (!track || !group) {
				return;
			}

			const inst = { track, group, offset: 0, paused: false, last: null };
			const pause = () => {
				inst.paused = true;
			};
			const resume = () => {
				inst.paused = false;
			};
			slider.addEventListener("mouseenter", pause);
			slider.addEventListener("mouseleave", resume);
			slider.addEventListener("focusin", pause);
			slider.addEventListener("focusout", resume);
			instances.push(inst);
		});

		if (!instances.length) {
			return;
		}

		const frame = (ts) => {
			instances.forEach((inst) => {
				if (inst.last === null) {
					inst.last = ts;
					return;
				}
				// Clamp dt so a stray long frame can never produce a big jump.
				const dt = Math.min((ts - inst.last) / 1000, 0.05);
				inst.last = ts;
				if (inst.paused) {
					return;
				}
				const width = inst.group.offsetWidth;
				if (width <= 0) {
					return;
				}
				inst.offset -= (width / 40) * dt;
				while (-inst.offset >= width) {
					inst.offset += width;
				}
				inst.track.style.transform = `translate3d(${inst.offset.toFixed(
					2
				)}px, 0, 0)`;
			});
			window.requestAnimationFrame(frame);
		};
		window.requestAnimationFrame(frame);

		// On returning to the tab, resync each clock so the first frame after the
		// gap doesn't advance the offset (belt-and-suspenders with the dt clamp).
		document.addEventListener("visibilitychange", () => {
			if (!document.hidden) {
				instances.forEach((inst) => {
					inst.last = null;
				});
			}
		});
	}

	/**
	 * Interactive history timeline. One slide is active at a time; the year list
	 * and up/down arrows switch slides with a smooth cross-fade. Keyboard: the
	 * year buttons are real <button>s, and Left/Right/Up/Down move when focus is
	 * inside the slider.
	 */
	function initHistorySlider() {
		document.querySelectorAll("[data-hist-slider]").forEach((slider) => {
			const stage = slider.querySelector(".hist-slider__stage");
			const slides = Array.from(
				slider.querySelectorAll("[data-hist-slide]")
			);
			const years = Array.from(slider.querySelectorAll("[data-hist-go]"));
			const prev = slider.querySelector("[data-hist-prev]");
			const next = slider.querySelector("[data-hist-next]");
			if (slides.length === 0) {
				return;
			}

			let current = 0;

			// Below 782px the track is laid out as a row (see hist-slider__stage
			// in service.css), so it slides horizontally; above, it's a column
			// and slides vertically.
			const horizontalMq = window.matchMedia("(max-width: 782px)");

			const go = (index) => {
				current = Math.max(0, Math.min(slides.length - 1, index));
				// Slide the track to the active year (side to side on mobile,
				// up/down on larger screens).
				if (stage) {
					stage.style.transform =
						"translate" +
						(horizontalMq.matches ? "X" : "Y") +
						"(" + -current * 100 + "%)";
				}
				slides.forEach((slide, i) => {
					const on = i === current;
					slide.classList.toggle("is-active", on);
					if (on) {
						slide.removeAttribute("aria-hidden");
					} else {
						slide.setAttribute("aria-hidden", "true");
					}
				});
				years.forEach((year, i) => {
					const on = i === current;
					year.classList.toggle("is-active", on);
					// aria-pressed (not aria-selected) is the valid state for a
					// <button>; aria-selected is only for tab/option roles (4.1.2).
					year.setAttribute("aria-pressed", on ? "true" : "false");
				});
				// Only light up an arrow when there's a year to move to.
				if (prev) {
					prev.disabled = current === 0;
				}
				if (next) {
					next.disabled = current === slides.length - 1;
				}
			};

			years.forEach((year, i) => {
				year.addEventListener("click", () => go(i));
			});
			if (prev) {
				prev.addEventListener("click", () => go(current - 1));
			}
			if (next) {
				next.addEventListener("click", () => go(current + 1));
			}
			slider.addEventListener("keydown", (event) => {
				if (event.key === "ArrowLeft" || event.key === "ArrowUp") {
					event.preventDefault();
					go(current - 1);
				} else if (
					event.key === "ArrowRight" ||
					event.key === "ArrowDown"
				) {
					event.preventDefault();
					go(current + 1);
				}
			});

			// Re-apply the transform on the correct axis when crossing the
			// mobile breakpoint.
			horizontalMq.addEventListener("change", () => go(current));

			// Set the initial arrow availability (first slide → prev disabled).
			go(0);
		});
	}

	/* --- Third-party plugin a11y patches ---------------------------------- */
	// Patch accessibility gaps in markup we can't edit (store locator, cookie
	// banner). Runs once on load and again whenever those plugins inject their
	// UI (both build DOM after load / on interaction), guarded by :not() so each
	// element is only touched once.
	function initVendorA11y() {
		const patch = () => {
			// Agile Store Locator icon-only buttons: the search "clear" button
			// and the "×" close button on the store-detail modal (injected only
			// when a marker is clicked) — no accessible name (WCAG 4.1.2).
			document
				.querySelectorAll(".asl-clear-btn:not([aria-label])")
				.forEach((b) => b.setAttribute("aria-label", "Clear search"));
			document
				.querySelectorAll(".agile-modal-header button:not([aria-label])")
				.forEach((b) => b.setAttribute("aria-label", "Close"));

			// Complianz cookie-banner category toggles aren't wrapped in a
			// heading. Expose each header wrapper as a heading so screen-reader
			// heading navigation works (WCAG 1.3.1). EqualWeb accepts this as
			// the fix for a trigger it can't wrap in an <h3>.
			document
				.querySelectorAll(".cmplz-category-header:not([role])")
				.forEach((h) => {
					h.setAttribute("role", "heading");
					h.setAttribute("aria-level", "3");
				});

			// Complianz cookie-policy nests a consent checkbox inside an
			// interactive <summary> — invalid HTML / nested interactive controls
			// (WCAG 4.1.2). Lift it out to sit right after the <summary> (still
			// inside its <details>). Its id and data-* are untouched, so the
			// for-labelled toggle and Complianz's own handlers keep working.
			document
				.querySelectorAll("summary input.cmplz-accept-service")
				.forEach((input) => {
					const summary = input.closest("summary");
					const details = summary && summary.parentElement;
					if (summary && details && details.tagName === "DETAILS") {
						summary.insertAdjacentElement("afterend", input);
					}
				});
		};
		patch();
		if (window.MutationObserver) {
			new MutationObserver(patch).observe(document.body, {
				childList: true,
				subtree: true,
			});
		}
	}

	document.addEventListener("DOMContentLoaded", () => {
		initCounters();
		initAccordions();
		initSliders();
		initTabs();
		initHeadingReveal();
		initMarquee();
		initHistorySlider();
		initVendorA11y();
	});

	// Exposed so dynamically injected content (e.g. the FAQs industry modal)
	// can get the same smooth accordion animation. Pass a root element to scope.
	window.mccInitAccordions = initAccordions;
})();
