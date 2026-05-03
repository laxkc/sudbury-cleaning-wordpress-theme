<?php
/**
 * Theme setup: menus, supports, image sizes.
 */

if (!defined('ABSPATH')) { exit; }

add_action('after_setup_theme', function () {
    load_theme_textdomain('sudbury-cleaning', SUDBURY_THEME_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', [
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script',
    ]);
    add_theme_support('custom-logo', [
        'height'      => 64,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('align-wide');

    register_nav_menus([
        'primary' => __('Primary Navigation', 'sudbury-cleaning'),
        'footer'  => __('Footer Navigation', 'sudbury-cleaning'),
    ]);

    add_image_size('sudbury-hero', 1600, 1000, true);
    add_image_size('sudbury-card', 800, 600, true);
    add_image_size('sudbury-square', 600, 600, true);
});

/* Footer widget areas */
add_action('widgets_init', function () {
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar([
            'name'          => sprintf(__('Footer Column %d', 'sudbury-cleaning'), $i),
            'id'            => 'footer-' . $i,
            'before_widget' => '<div class="footer-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>',
        ]);
    }
});

/* Body classes for branding context */
add_filter('body_class', function ($classes) {
    $classes[] = 'sudbury';
    return $classes;
});

/**
 * Required-plugin dependency notice.
 * Theme is split into 3 plugins (Sparkle Core / Forms / SEO). If any are
 * missing or inactive, show a single admin notice listing the missing ones.
 */
add_action('admin_notices', function () {
    /* is_plugin_active() lives in wp-admin/includes/plugin.php which
       isn't always loaded by the time admin_notices fires. Load it
       defensively, and bail silently if anything's still missing. */
    if (!function_exists('is_plugin_active')) {
        $plugin_file = ABSPATH . 'wp-admin/includes/plugin.php';
        if (!file_exists($plugin_file)) { return; }
        require_once $plugin_file;
    }
    if (!function_exists('is_plugin_active')) { return; }

    $required = [
        'Sparkle Core'  => 'sparkle-core/sparkle-core.php',
        'Sparkle Forms' => 'sparkle-forms/sparkle-forms.php',
        'Sparkle SEO'   => 'sparkle-seo/sparkle-seo.php',
    ];

    $missing = [];
    foreach ($required as $name => $plugin_file) {
        if (!is_plugin_active($plugin_file)) {
            $missing[] = $name;
        }
    }

    if (empty($missing)) { return; }

    printf(
        '<div class="notice notice-warning"><p><strong>%s</strong> %s <code>%s</code></p></div>',
        esc_html__('Sudbury Cleaning theme:', 'sudbury-cleaning'),
        esc_html__('the following companion plugin(s) are required and currently inactive —', 'sudbury-cleaning'),
        esc_html(implode(', ', $missing))
    );
});

/**
 * Auto-provision starter pages on theme switch.
 * Each page is created only if no page with that slug exists yet.
 * Pages are assigned the matching custom template so they look right immediately.
 */
add_action('after_switch_theme', 'sudbury_provision_starter_pages');

/* One-shot provisioner for users who activated the theme before this code existed. */
add_action('admin_init', function () {
    if (get_option('sudbury_starter_provisioned')) { return; }
    sudbury_provision_starter_pages();
    update_option('sudbury_starter_provisioned', 1);
});

function sudbury_provision_starter_pages(): void {
    $pages = [
        'about'         => ['title' => 'About',         'template' => 'page-templates/page-about.php'],
        'services'      => ['title' => 'Services',      'template' => 'page-templates/page-services.php'],
        'pricing'       => ['title' => 'Pricing',       'template' => 'page-templates/page-pricing.php'],
        'contact'       => ['title' => 'Contact',       'template' => 'page-templates/page-contact.php'],
        'service-areas' => ['title' => 'Service Areas', 'template' => 'page-templates/page-service-areas.php'],
        'thank-you'     => ['title' => 'Thank You',     'template' => 'page-templates/page-thank-you.php'],
        'blog'          => ['title' => 'Blog',          'template' => ''],
    ];

    foreach ($pages as $slug => $cfg) {
        $existing = get_page_by_path($slug);
        if ($existing) { continue; }

        $page_id = wp_insert_post([
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_title'   => $cfg['title'],
            'post_name'    => $slug,
            'post_content' => '',
        ]);

        if (!is_wp_error($page_id) && $page_id && $cfg['template']) {
            update_post_meta($page_id, '_wp_page_template', $cfg['template']);
        }
    }

    /* Set front page to display latest posts on /blog/ if user wants — leave home as latest_posts default. */
    $blog = get_page_by_path('blog');
    if ($blog && !get_option('page_for_posts')) {
        update_option('page_for_posts', $blog->ID);
        update_option('show_on_front', 'posts'); // keep front-page.php active for the home URL
    }

    /* Build a default Primary menu pointing to those pages, if no menu exists. */
    sudbury_provision_default_menu();

    flush_rewrite_rules();
}

function sudbury_provision_default_menu(): void {
    $locations = get_theme_mod('nav_menu_locations', []);
    if (!empty($locations['primary'])) { return; }

    $menu_name = 'Primary Menu';
    $menu_id   = wp_create_nav_menu($menu_name);
    if (is_wp_error($menu_id)) { return; }

    $items = [
        ['title' => 'Home',     'slug' => null,             'url' => home_url('/')],
        ['title' => 'About',    'slug' => 'about'],
        ['title' => 'Services', 'slug' => 'services'],
        ['title' => 'Pricing',  'slug' => 'pricing'],
        ['title' => 'Blog',     'slug' => 'blog'],
        ['title' => 'Contact',  'slug' => 'contact'],
    ];

    foreach ($items as $i => $item) {
        $args = [
            'menu-item-title'   => $item['title'],
            'menu-item-status'  => 'publish',
            'menu-item-position'=> $i + 1,
        ];
        if (!empty($item['slug'])) {
            $page = get_page_by_path($item['slug']);
            if (!$page) { continue; }
            $args['menu-item-object']    = 'page';
            $args['menu-item-object-id'] = $page->ID;
            $args['menu-item-type']      = 'post_type';
        } else {
            $args['menu-item-url']  = $item['url'];
            $args['menu-item-type'] = 'custom';
        }
        wp_update_nav_menu_item($menu_id, 0, $args);
    }

    set_theme_mod('nav_menu_locations', array_merge(
        $locations,
        ['primary' => $menu_id]
    ));
}
