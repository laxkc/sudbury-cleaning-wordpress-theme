<?php
/**
 * Theme helpers — small functions used across templates.
 */

if (!defined('ABSPATH')) { exit; }

/**
 * Default site copy fallbacks. Customizer values win when set.
 */
function sudbury_default(string $key): string {
    $defaults = [
        'business_name'    => 'Sudbury Sparkle Cleaning Co.',
        'tagline'          => 'Northern clean. Done right the first time.',
        'phone'            => '(705) 555-0142',
        'email'            => 'hello@sudburysparkle.ca',
        'hours'            => 'Mon–Sat 7:00am–7:00pm',
        'address'          => 'Greater Sudbury, Ontario',
        'service_areas'    => 'Sudbury · Lively · Val Caron · Garson · Lockerby · Hanmer',
        'hero_eyebrow'     => 'Insured · Bonded · 5★ on Google',
        'hero_title'       => 'Sparkling clean homes & offices across Greater Sudbury.',
        'hero_lead'        => 'Locally owned, fully insured, and ready to make your space shine. Same-week bookings available.',
        'hero_cta_text'    => 'Get a Free Quote',
        'hero_cta_url'     => '/contact/',
        'footer_copyright' => 'Sudbury Sparkle Cleaning Co.',
        'social_facebook'  => '',
        'social_instagram' => '',
        'social_google'    => '',
    ];
    return $defaults[$key] ?? '';
}

function sudbury_setting(string $key, string $default = ''): string {
    $val = get_theme_mod('sudbury_' . $key, '');
    if ($val === '' || $val === null) {
        $val = $default !== '' ? $default : sudbury_default($key);
    }
    return (string) $val;
}

function sudbury_phone_link(string $phone = ''): string {
    if ($phone === '') { $phone = sudbury_setting('phone'); }
    return 'tel:' . preg_replace('/[^0-9+]/', '', $phone);
}

function sudbury_quote_url(): string {
    return esc_url(sudbury_setting('hero_cta_url', '/contact/'));
}

/**
 * Inline SVG icons (small, accessible). Returns markup; never echo unsanitized input.
 */
function sudbury_icon(string $name, int $size = 24): string {
    $paths = [
        /* Each path is centered within the 24x24 viewBox so the visible icon's
           bounding box has equal padding on top and bottom. This makes
           align-items: center on flex parents produce true visual alignment
           with text — no per-icon margin patches needed. */
        'check'      => '<path d="M5 13l4 4L19 7"/>',
        'sparkle'    => '<path d="M12 2l1.5 4.5L18 8l-4.5 1.5L12 14l-1.5-4.5L6 8l4.5-1.5L12 2zM5 14l.8 2.4L8 17l-2.2.8L5 20l-.8-2.2L2 17l2.2-.6L5 14zM19 14l.8 2.4L22 17l-2.2.8L19 20l-.8-2.2L16 17l2.2-.6L19 14z"/>',
        'droplet'    => '<path d="M12 3.5s6 7 6 11a6 6 0 1 1-12 0c0-4 6-11 6-11z"/>',
        'star'       => '<path d="M12 2.5l3 6.5 7 .8-5.2 4.7 1.5 7-6.3-3.6-6.3 3.6 1.5-7L2 9.8l7-.8L12 2.5z"/>',
        'leaf'       => '<path d="M3 21c4-12 12-16 18-18-1 8-4 16-15 18-1 0-3-1-3 0z"/>',
        'shield'     => '<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/>',
        'phone'      => '<path d="M5 3.5h4l1.5 4-2 1a12 12 0 006.5 6.5l1-2 4 1.5v3.5a2 2 0 01-2 2h-1A18 18 0 013 6.5v-1a2 2 0 012-2z"/>',
        'mail'       => '<path d="M4 6h16v12H4zM4 6l8 7 8-7"/>',
        'clock'      => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'pin'        => '<path d="M12 21.5s7-7 7-12a7 7 0 10-14 0c0 5 7 12 7 12z"/><circle cx="12" cy="9.5" r="2.5"/>',
        'arrow-right' => '<path d="M5 12h14M13 5l7 7-7 7"/>',
        'menu'       => '<path d="M4 6h16M4 12h16M4 18h16"/>',
        'close'      => '<path d="M6 6l12 12M18 6L6 18"/>',
        'home'       => '<path d="M3 10l9-7 9 7v9a2 2 0 01-2 2h-4v-7H9v7H5a2 2 0 01-2-2v-9z"/>',
        'briefcase'  => '<path d="M3 8h18v12H3zM8 8V6a2 2 0 012-2h4a2 2 0 012 2v2"/>',
        'truck'      => '<path d="M3 5.5h11v8H3zM14 8.5h4l3 3v2h-7zM7 16.5a2 2 0 100-4 2 2 0 000 4zM17 16.5a2 2 0 100-4 2 2 0 000 4z"/>',
        'tools'      => '<path d="M14 7l3-3 3 3-3 3M14 7l-7 7-3 4 4-3 7-7M14 7l3 3"/>',
        'bed'        => '<path d="M3 17v-7h18v7M3 13h18M6 10V7h6v3"/>',
        'spray'      => '<path d="M9 3h4v4H9zM9 9h4l2 6H7l2-6zM10 21v-3M14 17h3M14 13h3"/>',
        'facebook'   => '<path d="M14 9h3V6h-3a3 3 0 00-3 3v2H8v3h3v7h3v-7h3l1-3h-4V9z"/>',
        'instagram'  => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/>',
        'google'     => '<path d="M21 12c0 5-4 9-9 9s-9-4-9-9 4-9 9-9c2.5 0 4.5 1 6 2.5l-2.5 2.5C14.5 7 13.3 6.5 12 6.5 9 6.5 6.5 9 6.5 12s2.5 5.5 5.5 5.5c2.6 0 4.6-1.6 5.1-4H12v-3h9c0 .5 0 1 0 1.5z"/>',
    ];
    $path = $paths[$name] ?? $paths['check'];

    /* No width/height/style attributes — global svg{width:1em;height:1em} in CSS
       sizes every icon to its parent's font-size. No vertical-align hacks. */
    return sprintf(
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%s</svg>',
        $path
    );
}

function sudbury_print_icon(string $name, int $size = 24): void {
    /* Keys MUST be lowercase — wp_kses lowercases attribute names before
       matching against this list, so 'viewBox' (camelCase) gets silently
       stripped. The SVG won't render correctly without viewBox. */
    $allowed = [
        'svg'    => ['xmlns' => true, 'width' => true, 'height' => true, 'viewbox' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true, 'aria-hidden' => true, 'focusable' => true, 'class' => true],
        'path'   => ['d' => true],
        'circle' => ['cx' => true, 'cy' => true, 'r' => true],
        'rect'   => ['x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true],
    ];
    echo wp_kses(sudbury_icon($name, $size), $allowed);
}

/**
 * Excerpt with custom length, fallback to trimmed content.
 */
function sudbury_excerpt(int $words = 22): string {
    $excerpt = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags(get_the_content());
    return wp_trim_words($excerpt, $words, '…');
}

/**
 * Render a fallback nav <ul> when no Primary menu is set.
 * Only links to pages that exist in the database, so links are never dead.
 */
function sudbury_render_fallback_nav(): void {
    $items = [];
    $items[] = ['label' => __('Home', 'sudbury-cleaning'), 'url' => home_url('/')];

    $candidates = [
        'about'         => __('About', 'sudbury-cleaning'),
        'services'      => __('Services', 'sudbury-cleaning'),
        'service-areas' => __('Service Areas', 'sudbury-cleaning'),
        'pricing'       => __('Pricing', 'sudbury-cleaning'),
        'blog'          => __('Blog', 'sudbury-cleaning'),
        'contact'       => __('Contact', 'sudbury-cleaning'),
    ];

    foreach ($candidates as $slug => $label) {
        $page = get_page_by_path($slug);
        if (!$page) { continue; }
        $items[] = ['label' => $label, 'url' => get_permalink($page->ID)];
    }

    echo '<ul>';
    foreach ($items as $item) {
        printf(
            '<li><a href="%s">%s</a></li>',
            esc_url($item['url']),
            esc_html($item['label'])
        );
    }
    echo '</ul>';
}

/* sudbury_default_areas() and sudbury_default_services() are defined by the
   Sparkle Core plugin (wp-content/plugins/sparkle-core/includes/defaults.php).
   The function_exists() guards below provide identical fallbacks so the
   theme keeps rendering even if Sparkle Core hasn't been activated yet.
   Plugins load before themes, so when Sparkle Core IS active, its versions
   are already declared and these blocks are skipped. */

if (!function_exists('sudbury_default_areas')) {
    function sudbury_default_areas(): array {
        return [
            ['name' => 'Sudbury',     'slug' => 'sudbury'],
            ['name' => 'Lively',      'slug' => 'lively'],
            ['name' => 'Val Caron',   'slug' => 'val-caron'],
            ['name' => 'Garson',      'slug' => 'garson'],
            ['name' => 'Lockerby',    'slug' => 'lockerby'],
            ['name' => 'Hanmer',      'slug' => 'hanmer'],
        ];
    }
}

if (!function_exists('sudbury_default_services')) {
    function sudbury_default_services(): array {
        return [
            ['icon' => 'home',      'title' => 'Residential Cleaning',  'body' => 'Weekly, biweekly, or one-time cleans for homes across Greater Sudbury.'],
            ['icon' => 'briefcase', 'title' => 'Office & Commercial',   'body' => 'Reliable evening and weekend cleaning for offices, clinics, and retail.'],
            ['icon' => 'truck',     'title' => 'Move-In / Move-Out',    'body' => 'Get your full deposit back — landlord-approved deep cleans.'],
            ['icon' => 'tools',     'title' => 'Post-Construction',     'body' => 'Dust, debris, and drywall residue removed before you move in.'],
            ['icon' => 'bed',       'title' => 'Airbnb Turnover',       'body' => 'Same-day turnovers with linens, restock, and 5★-ready presentation.'],
            ['icon' => 'spray',     'title' => 'Deep Cleaning',         'body' => 'Top-to-bottom seasonal refresh — baseboards, vents, inside appliances.'],
        ];
    }
}
