<?php
/**
 * Sparkle SEO — JSON-LD schema generator.
 *   - HouseCleaningService on the homepage
 *   - Service on service singles
 *   - Article on blog posts
 */

if (!defined('ABSPATH')) { exit; }

add_action('wp_footer', 'sparkle_seo_render_jsonld');

function sparkle_seo_render_jsonld(): void {
    $schemas = [];

    if (is_front_page()) {
        $area_names = [];
        if (function_exists('sudbury_default_areas')) {
            $area_names = array_map(static fn($a) => $a['name'], sudbury_default_areas());
        }

        $schemas[] = array_filter([
            '@context'    => 'https://schema.org',
            '@type'       => 'HouseCleaningService',
            'name'        => get_bloginfo('name'),
            'description' => function_exists('sudbury_setting') ? sudbury_setting('hero_lead') : get_bloginfo('description'),
            'url'         => home_url('/'),
            'telephone'   => function_exists('sudbury_setting') ? sudbury_setting('phone') : '',
            'email'       => function_exists('sudbury_setting') ? sudbury_setting('email') : '',
            'priceRange'  => '$$',
            'address'     => [
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Sudbury',
                'addressRegion'   => 'ON',
                'addressCountry'  => 'CA',
            ],
            'areaServed' => $area_names,
            'openingHoursSpecification' => [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'opens'     => '07:00',
                'closes'    => '19:00',
            ],
        ], static fn($v) => $v !== '' && $v !== [] && $v !== null);
    }

    if (is_singular('post')) {
        $schemas[] = [
            '@context'         => 'https://schema.org',
            '@type'            => 'Article',
            'headline'         => get_the_title(),
            'datePublished'    => get_the_date('c'),
            'dateModified'     => get_the_modified_date('c'),
            'author'           => ['@type' => 'Person', 'name' => get_the_author()],
            'image'            => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: '',
            'mainEntityOfPage' => get_permalink(),
        ];
    }

    if (is_singular('service')) {
        $schemas[] = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            'name'        => get_the_title(),
            'description' => get_the_excerpt(),
            'provider'    => ['@type' => 'LocalBusiness', 'name' => get_bloginfo('name')],
            'areaServed'  => 'Greater Sudbury, ON',
        ];
    }

    foreach ($schemas as $schema) {
        echo '<script type="application/ld+json">'
           . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
           . '</script>' . "\n";
    }
}
