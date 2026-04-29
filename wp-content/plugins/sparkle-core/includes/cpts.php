<?php
/**
 * Sparkle Core — Custom Post Types and Taxonomies.
 */

if (!defined('ABSPATH')) { exit; }

add_action('init', 'sparkle_core_register_cpts');

function sparkle_core_register_cpts(): void {

    /* ---------- Service ---------- */
    register_post_type('service', [
        'labels' => [
            'name'          => __('Services', 'sparkle-core'),
            'singular_name' => __('Service', 'sparkle-core'),
            'add_new_item'  => __('Add New Service', 'sparkle-core'),
            'edit_item'     => __('Edit Service', 'sparkle-core'),
        ],
        'public'        => true,
        'has_archive'   => 'services',
        'rewrite'       => ['slug' => 'services', 'with_front' => false],
        'menu_icon'     => 'dashicons-sparkles',
        'menu_position' => 20,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'show_in_rest'  => true,
    ]);

    register_taxonomy('service_type', 'service', [
        'labels' => [
            'name'          => __('Service Types', 'sparkle-core'),
            'singular_name' => __('Service Type', 'sparkle-core'),
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'service-type'],
        'show_in_rest' => true,
    ]);

    /* ---------- Service Area ---------- */
    register_post_type('area', [
        'labels' => [
            'name'          => __('Service Areas', 'sparkle-core'),
            'singular_name' => __('Service Area', 'sparkle-core'),
            'add_new_item'  => __('Add New Area', 'sparkle-core'),
        ],
        'public'        => true,
        'has_archive'   => 'service-areas',
        'rewrite'       => ['slug' => 'service-areas', 'with_front' => false],
        'menu_icon'     => 'dashicons-location-alt',
        'menu_position' => 21,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'show_in_rest'  => true,
    ]);

    /* ---------- Testimonial ---------- */
    register_post_type('testimonial', [
        'labels' => [
            'name'          => __('Testimonials', 'sparkle-core'),
            'singular_name' => __('Testimonial', 'sparkle-core'),
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'publicly_queryable' => false,
        'has_archive'        => false,
        'rewrite'            => false,
        'menu_icon'          => 'dashicons-format-quote',
        'menu_position'      => 22,
        'supports'           => ['title', 'editor', 'thumbnail'],
        'show_in_rest'       => true,
    ]);

    /* ---------- FAQ ---------- */
    register_post_type('faq', [
        'labels' => [
            'name'          => __('FAQs', 'sparkle-core'),
            'singular_name' => __('FAQ', 'sparkle-core'),
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'publicly_queryable' => false,
        'has_archive'        => false,
        'rewrite'            => false,
        'menu_icon'          => 'dashicons-editor-help',
        'menu_position'      => 23,
        'supports'           => ['title', 'editor', 'page-attributes'],
        'show_in_rest'       => true,
    ]);

    register_taxonomy('faq_topic', 'faq', [
        'labels' => [
            'name'          => __('FAQ Topics', 'sparkle-core'),
            'singular_name' => __('FAQ Topic', 'sparkle-core'),
        ],
        'public'       => false,
        'show_ui'      => true,
        'hierarchical' => true,
        'rewrite'      => false,
        'show_in_rest' => true,
    ]);

    /* ---------- Quote Request (private storage) ---------- */
    register_post_type('quote_request', [
        'labels' => [
            'name'          => __('Quote Requests', 'sparkle-core'),
            'singular_name' => __('Quote Request', 'sparkle-core'),
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'has_archive'         => false,
        'rewrite'             => false,
        'menu_icon'           => 'dashicons-email-alt',
        'menu_position'       => 24,
        'supports'            => ['title', 'editor', 'custom-fields'],
        'capability_type'     => 'post',
    ]);
}
