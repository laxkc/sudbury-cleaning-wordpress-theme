<?php
/**
 * Plugin Name:       Sparkle SEO
 * Plugin URI:        https://github.com/laxkc/sudbury-cleaning-wordpress-theme
 * Description:       Local-business SEO for Sudbury Sparkle Cleaning. Renders meta description, canonical, Open Graph, Twitter Card, and JSON-LD schema (HouseCleaningService on homepage, Service on service singles, Article on blog posts). Reads contact info and tagline from the theme's Customizer if present, otherwise from sensible defaults.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Laxman KC
 * Author URI:        https://github.com/laxkc
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sparkle-seo
 */

if (!defined('ABSPATH')) { exit; }

define('SPARKLE_SEO_VERSION', '1.0.0');
define('SPARKLE_SEO_DIR', plugin_dir_path(__FILE__));

require SPARKLE_SEO_DIR . 'includes/meta.php';
require SPARKLE_SEO_DIR . 'includes/schema.php';
