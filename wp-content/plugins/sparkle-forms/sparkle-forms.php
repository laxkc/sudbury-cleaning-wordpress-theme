<?php
/**
 * Plugin Name:       Sparkle Forms
 * Plugin URI:        https://github.com/laxkc/sudbury-cleaning-wordpress-theme
 * Description:       Custom quote-request contact form for Sudbury Sparkle Cleaning. Provides the [sparkle_quote_form] shortcode with full server-side validation, honeypot, rate limiting, CPT storage, owner notification and customer auto-reply. Requires Sparkle Core (for the quote_request post type).
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Laxman KC
 * Author URI:        https://github.com/laxkc
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sparkle-forms
 */

if (!defined('ABSPATH')) { exit; }

define('SPARKLE_FORMS_VERSION', '1.0.0');
define('SPARKLE_FORMS_DIR', plugin_dir_path(__FILE__));

require SPARKLE_FORMS_DIR . 'includes/quote-form.php';
