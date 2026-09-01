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
