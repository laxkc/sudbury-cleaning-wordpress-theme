<?php
/**
 * Enqueue styles and scripts.
 * Fonts loaded from Google Fonts CDN with preconnect (no self-host binaries shipped in repo).
 */

if (!defined('ABSPATH')) { exit; }

add_action('wp_enqueue_scripts', function () {
    $base = NOVA_THEME_URI . '/assets';
    $dir  = NOVA_THEME_DIR . '/assets';

    // Google Fonts: Poppins (600,700) + Inter (400,500,600)
    wp_enqueue_style(
        'nova-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap',
        [],
        null
    );

    // Theme stylesheets
    wp_enqueue_style(
        'nova-base',
        get_stylesheet_uri(),
        ['nova-fonts'],
        file_exists(NOVA_THEME_DIR . '/style.css') ? filemtime(NOVA_THEME_DIR . '/style.css') : NOVA_THEME_VERSION
    );

    wp_enqueue_style(
        'nova-layout',
        $base . '/css/layout.css',
        ['nova-base'],
        file_exists($dir . '/css/layout.css') ? filemtime($dir . '/css/layout.css') : NOVA_THEME_VERSION
    );

    wp_enqueue_style(
        'nova-components',
        $base . '/css/components.css',
        ['nova-layout'],
        file_exists($dir . '/css/components.css') ? filemtime($dir . '/css/components.css') : NOVA_THEME_VERSION
    );

    wp_enqueue_style(
        'nova-responsive',
        $base . '/css/responsive.css',
        ['nova-components'],
        file_exists($dir . '/css/responsive.css') ? filemtime($dir . '/css/responsive.css') : NOVA_THEME_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'nova-main',
        $base . '/js/main.js',
        [],
        file_exists($dir . '/js/main.js') ? filemtime($dir . '/js/main.js') : NOVA_THEME_VERSION,
        true
    );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});

/* Preconnect to Google Fonts */
add_filter('wp_resource_hints', function ($hints, $relation) {
    if ('preconnect' === $relation) {
        $hints[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin'];
    }
    return $hints;
}, 10, 2);

/* Defer non-critical JS */
add_filter('script_loader_tag', function ($tag, $handle) {
    if ('nova-main' === $handle) {
        return str_replace(' src=', ' defer src=', $tag);
    }
    return $tag;
}, 10, 2);

/* Inject brand color overrides from Customizer */
add_action('wp_head', function () {
    $blue   = get_theme_mod('nova_brand_blue', '#1E3A8A');
    $orange = get_theme_mod('nova_brand_orange', '#F59E0B');
    $mint   = get_theme_mod('nova_brand_mint', '#10B981');
    if ($blue === '#1E3A8A' && $orange === '#F59E0B' && $mint === '#10B981') {
        return;
    }
    printf(
        '<style id="nova-brand-overrides">:root{--brand-blue:%s;--brand-orange:%s;--brand-mint:%s;}</style>',
        esc_html($blue), esc_html($orange), esc_html($mint)
    );
}, 20);
