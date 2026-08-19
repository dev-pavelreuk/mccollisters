<?php
/**
 * Full-screen brand preloader.
 *
 * A black overlay with the McCollister's "M" mark that pulses with a slow
 * heartbeat until the page has finished loading, then fades out and is removed.
 * The mark is inlined (no extra request) and the overlay is styled by the
 * render-blocking base.css, so it paints on the first frame with no content
 * flash. The mark SVG is the site's M-Traced-solid mark (brand blue #0069CB).
 *
 * @package McCollisters
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="mcc-preloader" class="mcc-preloader" role="status" aria-label="<?php esc_attr_e('Loading', 'mccollisters'); ?>">
    <svg class="mcc-preloader__logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 181.7 137.82" fill="#0069CB" aria-hidden="true" focusable="false">
        <path d="M3.92,126.47l22.5-114.39c0,0,0.41-3.32,2.24-4.74c1.83-1.42,3.52-1.22,3.52-1.22l28.56,0.47c0,0,2.76,0.18,3.6,1.28c0.84,1.11,1.75,3.38,1.75,3.38l22.98,56.27c0,0,0.83,1.55,1.27,1.61c0.84,0.12,1.44-0.66,1.44-0.66l49.59-61.07c0,0,1.34-1.6,2.67-1.72c1.34-0.12,2.94-0.06,2.94-0.06l27.46,0.45c0,0,0.81,0.04,1.31,0.48c0.49,0.44,0.27,1.75,0.27,1.75l-21.59,120.42c0,0-0.18,1.01-0.5,1.36c-0.28,0.31-1.13,0.35-1.13,0.35l-36.68-0.17c0,0-1.08,0.02-1.42-0.43c-0.51-0.68-0.3-2.06-0.25-1.95l7.28-43.68c0,0,0.14-0.84-0.34-1.13c-0.37-0.23-1.01,0.46-1.01,0.46l-27.88,35.11c0,0-0.7,0.8-1.06,0.96c-0.37,0.16-1.54,0.07-1.54,0.07l-16.7-0.58c0,0-0.69-0.02-1.17-0.48c-0.48-0.46-0.84-1.16-1.08-1.93l-14.4-35.13c0,0-0.69-1.97-2.11-1.97c-2.1,0-2.24,2.06-2.24,2.06l-8.5,46.2c0,0-0.25,1.31-1.08,2.03c-1.08,0.95-2.15,1.11-2.15,1.11l-35.2-0.26c0,0-1.22-0.2-1.49-1.29S3.92,126.47,3.92,126.47z"/>
    </svg>
</div>
<script>
(function () {
    var el = document.getElementById('mcc-preloader');
    if (!el) { return; }

    var done = false;

    function hide() {
        if (done) { return; }
        done = true;
        el.classList.add('is-loaded');
        // Remove after the fade so it never traps focus/clicks.
        window.setTimeout(function () {
            if (el && el.parentNode) { el.parentNode.removeChild(el); }
        }, 700);
    }

    if (document.readyState === 'complete') {
        hide();
    } else {
        window.addEventListener('load', hide);
    }

    // Safety cap: never leave the loader up if an asset stalls.
    window.setTimeout(hide, 6000);
})();
</script>
