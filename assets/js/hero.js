/**
 * Homepage hero: cross-fading background slider + typewriter animation for the
 * rotating word in the H1. Reusable components (counters, accordions, sliders)
 * live in components.js, which loads site-wide.
 *
 * Typewriter re-creates the Premium Addons "Fancy Text" (typing) widget: words
 * and timings from the same settings — no cursor, looping.
 */
document.addEventListener("DOMContentLoaded", () => {
	const reduceMotion = window.matchMedia(
		"(prefers-reduced-motion: reduce)"
	).matches;

	// Cross-fading background slider.
	//
	// Only slide 1 has an inline background (it is the LCP element). The rest
	// carry their URL in data-bg so the browser does not fetch ~1.5MB of images
	// nobody sees for five seconds. We apply one slide ahead of the rotation so
	// each image has a full interval to download before it fades in.
	const slides = document.querySelectorAll(".home-hero__slide");

	const applyBg = (slide) => {
		if (!slide || !slide.dataset.bg) {
			return;
		}

		slide.style.backgroundImage = `url('${slide.dataset.bg}')`;
		delete slide.dataset.bg;
	};

	if (slides.length > 1 && !reduceMotion) {
		let current = 0;

		// Warm the second slide only once the page has finished loading, so it
		// never competes with the LCP image for bandwidth.
		const warmNext = () => applyBg(slides[1]);

		if (document.readyState === "complete") {
			warmNext();
		} else {
			window.addEventListener("load", warmNext, { once: true });
		}

		window.setInterval(() => {
			slides[current].classList.remove("is-active");
			current = (current + 1) % slides.length;

			// Safety net if the pre-warm has not run yet.
			applyBg(slides[current]);
			slides[current].classList.add("is-active");

			// Pre-warm the following slide with a full interval of lead time.
			applyBg(slides[(current + 1) % slides.length]);
		}, 5000);
	}

	const target = document.querySelector(".home-hero__typed");

	if (!target) {
		return;
	}

	const words = (target.dataset.words || "")
		.split(",")
		.map((word) => word.trim())
		.filter(Boolean);

	if (words.length === 0) {
		return;
	}

	// Respect the visitor's motion preference — leave the static default word.
	if (reduceMotion) {
		return;
	}

	/**
	 * Reserve the widest word's width on the rotating span.
	 *
	 * The headline is "When <word> Matters" on one line (nowrap from 1025px up),
	 * so without a reserved width every character typed or deleted re-flows the
	 * line and slides "Matters" sideways. At 200ms per character across six
	 * words that is dozens of layout shifts per cycle — the biggest single
	 * contributor to the page's CLS.
	 *
	 * Measured rather than guessed in `ch`, because the words are uppercase and
	 * the heading carries its own letter-spacing.
	 */
	const reserveWidth = () => {
		const styles = window.getComputedStyle(target);
		const probe = document.createElement("span");

		probe.setAttribute("aria-hidden", "true");
		probe.style.cssText =
			"position:absolute;left:-9999px;top:0;white-space:pre;visibility:hidden;";
		probe.style.fontFamily = styles.fontFamily;
		probe.style.fontSize = styles.fontSize;
		probe.style.fontWeight = styles.fontWeight;
		probe.style.fontStyle = styles.fontStyle;
		probe.style.letterSpacing = styles.letterSpacing;
		probe.style.textTransform = styles.textTransform;

		target.parentNode.appendChild(probe);

		let widest = 0;

		words.forEach((word) => {
			probe.textContent = word;
			widest = Math.max(widest, probe.getBoundingClientRect().width);
		});

		probe.remove();

		if (widest > 0) {
			target.style.minWidth = `${Math.ceil(widest)}px`;
		}
	};

	reserveWidth();

	// The web font usually lands after this first pass, and the fallback's
	// metrics differ — re-measure so the reserved width matches real glyphs.
	if (document.fonts && document.fonts.ready) {
		document.fonts.ready.then(reserveWidth).catch(() => {});
	}

	// The heading scales with the viewport, so a resize invalidates the reserved
	// width. Debounced: resize-driven movement is user-initiated and does not
	// count toward CLS, this only keeps the spacing correct.
	let resizeTimer = null;

	window.addEventListener("resize", () => {
		window.clearTimeout(resizeTimer);
		resizeTimer = window.setTimeout(reserveWidth, 150);
	});

	const TYPE_SPEED = 200; // ms per character typed
	const BACK_SPEED = 200; // ms per character deleted
	const START_DELAY = 75; // ms before the first word starts
	const BACK_DELAY = 600; // ms to hold a finished word before deleting

	let wordIndex = 0;
	let charIndex = 0;
	let deleting = false;

	target.textContent = "";

	const step = () => {
		const word = words[wordIndex];

		if (deleting) {
			charIndex -= 1;
			target.textContent = word.slice(0, charIndex);

			if (charIndex === 0) {
				deleting = false;
				wordIndex = (wordIndex + 1) % words.length;
				window.setTimeout(step, TYPE_SPEED);
				return;
			}

			window.setTimeout(step, BACK_SPEED);
			return;
		}

		charIndex += 1;
		target.textContent = word.slice(0, charIndex);

		if (charIndex === word.length) {
			deleting = true;
			window.setTimeout(step, BACK_DELAY);
			return;
		}

		window.setTimeout(step, TYPE_SPEED);
	};

	window.setTimeout(step, START_DELAY);
});
