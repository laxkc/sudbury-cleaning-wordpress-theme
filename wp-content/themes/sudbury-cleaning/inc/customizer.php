<?php
/**
 * Customizer settings — Sparkle Site Settings, Trust Bar, Brand colors.
 */

if (!defined('ABSPATH')) { exit; }

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {

    /* =====================================================
       PANEL: Sparkle Theme
       ===================================================== */
    $wp_customize->add_panel('nova_sparkle', [
        'title'    => __('Sparkle Theme', 'sudbury-cleaning'),
        'priority' => 30,
    ]);

    /* ---------- Section: Site Settings ---------- */
    $wp_customize->add_section('nova_site', [
        'title' => __('Site Settings', 'sudbury-cleaning'),
        'panel' => 'nova_sparkle',
    ]);

    $site_fields = [
        'tagline'          => ['label' => __('Tagline', 'sudbury-cleaning'),                 'type' => 'text'],
        'phone'            => ['label' => __('Phone', 'sudbury-cleaning'),                   'type' => 'text'],
        'email'            => ['label' => __('Email', 'sudbury-cleaning'),                   'type' => 'email'],
        'hours'            => ['label' => __('Business Hours', 'sudbury-cleaning'),          'type' => 'text'],
        'address'          => ['label' => __('Address / Service Area Note', 'sudbury-cleaning'), 'type' => 'text'],
        'service_areas'    => ['label' => __('Service Areas (display)', 'sudbury-cleaning'), 'type' => 'text'],
        'social_facebook'  => ['label' => __('Facebook URL', 'sudbury-cleaning'),            'type' => 'url'],
        'social_instagram' => ['label' => __('Instagram URL', 'sudbury-cleaning'),           'type' => 'url'],
        'social_google'    => ['label' => __('Google Business Profile URL', 'sudbury-cleaning'), 'type' => 'url'],
        'footer_copyright' => ['label' => __('Footer Copyright', 'sudbury-cleaning'),        'type' => 'text'],
        'quote_email'      => ['label' => __('Quote Notification Email', 'sudbury-cleaning'), 'type' => 'email'],
    ];

    foreach ($site_fields as $key => $cfg) {
        $wp_customize->add_setting('nova_' . $key, [
            'default'           => nova_default($key),
            'sanitize_callback' => $cfg['type'] === 'email' ? 'sanitize_email' : ($cfg['type'] === 'url' ? 'esc_url_raw' : 'sanitize_text_field'),
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control('nova_' . $key, [
            'label'   => $cfg['label'],
            'section' => 'nova_site',
            'type'    => $cfg['type'],
        ]);
    }

    /* ---------- Section: Hero ---------- */
    $wp_customize->add_section('nova_hero', [
        'title' => __('Homepage Hero', 'sudbury-cleaning'),
        'panel' => 'nova_sparkle',
    ]);

    $hero_fields = [
        'hero_eyebrow'  => ['label' => __('Eyebrow text', 'sudbury-cleaning'),      'type' => 'text'],
        'hero_title'    => ['label' => __('Hero headline', 'sudbury-cleaning'),     'type' => 'textarea'],
        'hero_lead'     => ['label' => __('Hero subhead', 'sudbury-cleaning'),      'type' => 'textarea'],
        'hero_cta_text' => ['label' => __('Primary CTA text', 'sudbury-cleaning'),  'type' => 'text'],
        'hero_cta_url'  => ['label' => __('Primary CTA URL', 'sudbury-cleaning'),   'type' => 'url'],
    ];

    foreach ($hero_fields as $key => $cfg) {
        $wp_customize->add_setting('nova_' . $key, [
            'default'           => nova_default($key),
            'sanitize_callback' => $cfg['type'] === 'url' ? 'esc_url_raw' : 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control('nova_' . $key, [
            'label'   => $cfg['label'],
            'section' => 'nova_hero',
            'type'    => $cfg['type'],
        ]);
    }

    /* Hero image */
    $wp_customize->add_setting('nova_hero_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'nova_hero_image', [
        'label'   => __('Hero image', 'sudbury-cleaning'),
        'section' => 'nova_hero',
    ]));

    /* ---------- Section: Trust Bar ---------- */
    $wp_customize->add_section('nova_trust', [
        'title' => __('Trust Bar', 'sudbury-cleaning'),
        'panel' => 'nova_sparkle',
    ]);

    $trust_defaults = [
        1 => ['icon' => 'star',    'text' => '4.9 on Google (120+ reviews)'],
        2 => ['icon' => 'shield',  'text' => 'Insured & WSIB compliant'],
        3 => ['icon' => 'leaf',    'text' => 'Eco-friendly products'],
        4 => ['icon' => 'clock',   'text' => 'Same-week service'],
    ];

    foreach ($trust_defaults as $i => $defaults) {
        $wp_customize->add_setting("nova_trust_{$i}_icon", [
            'default'           => $defaults['icon'],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("nova_trust_{$i}_icon", [
            'label'    => sprintf(__('Trust item %d — icon', 'sudbury-cleaning'), $i),
            'section'  => 'nova_trust',
            'type'     => 'select',
            'choices'  => [
                'star'    => 'Star',
                'shield'  => 'Shield',
                'leaf'    => 'Leaf',
                'clock'   => 'Clock',
                'check'   => 'Check',
                'sparkle' => 'Sparkle',
            ],
        ]);

        $wp_customize->add_setting("nova_trust_{$i}_text", [
            'default'           => $defaults['text'],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("nova_trust_{$i}_text", [
            'label'   => sprintf(__('Trust item %d — text', 'sudbury-cleaning'), $i),
            'section' => 'nova_trust',
            'type'    => 'text',
        ]);
    }

    /* ---------- Section: Brand Colors ---------- */
    $wp_customize->add_section('nova_brand', [
        'title' => __('Brand Colors', 'sudbury-cleaning'),
        'panel' => 'nova_sparkle',
    ]);

    $colors = [
        'nova_brand_blue'   => ['label' => __('Primary (Deep Blue)', 'sudbury-cleaning'),   'default' => '#1E3A8A'],
        'nova_brand_mint'   => ['label' => __('Secondary (Mint Green)', 'sudbury-cleaning'), 'default' => '#10B981'],
        'nova_brand_orange' => ['label' => __('Accent (Soft Orange)', 'sudbury-cleaning'),  'default' => '#F59E0B'],
    ];

    foreach ($colors as $id => $cfg) {
        $wp_customize->add_setting($id, [
            'default'           => $cfg['default'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $id, [
            'label'   => $cfg['label'],
            'section' => 'nova_brand',
        ]));
    }
});
