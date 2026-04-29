<?php
/**
 * Sudbury Cleaning theme bootstrap.
 *
 * Functionality previously bundled in this theme has been split out:
 *   - Sparkle Core    → CPTs (service, area, testimonial, faq, quote_request) + content defaults
 *   - Sparkle Forms   → [sparkle_quote_form] shortcode + handler
 *   - Sparkle SEO     → meta tags + JSON-LD schema
 *
 * The theme now contains presentation only: templates, styling, Customizer.
 */

if (!defined('ABSPATH')) { exit; }

define('NOVA_THEME_VERSION', '1.0.0');
define('NOVA_THEME_DIR', get_template_directory());
define('NOVA_THEME_URI', get_template_directory_uri());

require NOVA_THEME_DIR . '/inc/theme-setup.php';
require NOVA_THEME_DIR . '/inc/enqueue.php';
require NOVA_THEME_DIR . '/inc/helpers.php';
require NOVA_THEME_DIR . '/inc/customizer.php';
