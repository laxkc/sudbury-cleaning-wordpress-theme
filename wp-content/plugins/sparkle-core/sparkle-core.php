<?php
/**
 * Plugin Name:       Sparkle Core
 * Plugin URI:        https://github.com/laxkc/sudbury-cleaning-wordpress-theme
 * Description:       Content backbone for Sudbury Sparkle Cleaning. Registers all custom post types (services, areas, testimonials, FAQs, quote requests) and shared content helpers. Required by the Sudbury Cleaning theme.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Laxman KC
 * Author URI:        https://github.com/laxkc
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sparkle-core
 */

if (!defined('ABSPATH')) { exit; }

define('SPARKLE_CORE_VERSION', '1.0.0');
define('SPARKLE_CORE_DIR', plugin_dir_path(__FILE__));

require SPARKLE_CORE_DIR . 'includes/cpts.php';
require SPARKLE_CORE_DIR . 'includes/quote-request.php';
require SPARKLE_CORE_DIR . 'includes/defaults.php';

/* Activation: register CPTs, then flush rewrites so /services/ and /service-areas/ work immediately. */
register_activation_hook(__FILE__, function () {
    sparkle_core_register_cpts();
    flush_rewrite_rules();
});

/* Deactivation: flush only — never delete data. */
register_deactivation_hook(__FILE__, 'flush_rewrite_rules');
