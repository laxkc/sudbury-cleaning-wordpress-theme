<?php
/**
 * Sparkle Core — fallback content used when CPT entries don't exist yet.
 * Theme template-parts call these to render the homepage / page templates
 * even before any service/area entries have been created in admin.
 *
 * Function names and signatures kept identical to the originals in the
 * theme so existing template-parts keep working without modification.
 */

if (!defined('ABSPATH')) { exit; }

if (!function_exists('nova_default_areas')) {
    function nova_default_areas(): array {
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

if (!function_exists('nova_default_services')) {
    function nova_default_services(): array {
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
