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
	function initAccordions() {
		document.querySelectorAll("[data-accordion]").forEach((group) => {
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
		document.querySelectorAll("[data-tabs]").forEach((group) => {
			const tabs = Array.from(
				group.querySelectorAll("[data-tabs-tab]")
			);
			const panels = Array.from(
				group.querySelectorAll("[data-tabs-panel]")
			);
			if (tabs.length === 0) {
				return;
			}

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
		});
	}

	document.addEventListener("DOMContentLoaded", () => {
		initCounters();
		initAccordions();
		initSliders();
		initTabs();
	});
})();
