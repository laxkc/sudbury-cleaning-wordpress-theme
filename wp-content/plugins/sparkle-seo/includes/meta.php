<?php
/**
 * Sparkle SEO — meta description, canonical, Open Graph, Twitter Card.
 */

if (!defined('ABSPATH')) { exit; }

add_action('wp_head', 'sparkle_seo_render_meta', 5);

function sparkle_seo_render_meta(): void {
    $description = '';
    $title       = wp_get_document_title();
    $url         = home_url(add_query_arg([], $GLOBALS['wp']->request ?? ''));
    $image       = '';

    if (is_singular()) {
        $description = has_excerpt()
            ? get_the_excerpt()
            : wp_trim_words(wp_strip_all_tags(get_the_content()), 30);
        if (has_post_thumbnail()) {
            $image = get_the_post_thumbnail_url(get_queried_object_id(), 'large') ?: '';
        }
        $url = get_permalink() ?: $url;
    } else {
        $description = function_exists('nova_setting')
            ? nova_setting('hero_lead')
            : get_bloginfo('description');
    }

    $description = wp_strip_all_tags($description);

    printf('<meta name="description" content="%s">' . "\n", esc_attr($description));
    printf('<link rel="canonical" href="%s">' . "\n", esc_url($url));

    /* Open Graph */
    printf('<meta property="og:type" content="%s">' . "\n", is_singular('post') ? 'article' : 'website');
    printf('<meta property="og:title" content="%s">' . "\n", esc_attr($title));
    printf('<meta property="og:description" content="%s">' . "\n", esc_attr($description));
    printf('<meta property="og:url" content="%s">' . "\n", esc_url($url));
    printf('<meta property="og:site_name" content="%s">' . "\n", esc_attr(get_bloginfo('name')));
    if ($image) { printf('<meta property="og:image" content="%s">' . "\n", esc_url($image)); }

    /* Twitter Card */
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    printf('<meta name="twitter:title" content="%s">' . "\n", esc_attr($title));
    printf('<meta name="twitter:description" content="%s">' . "\n", esc_attr($description));
    if ($image) { printf('<meta name="twitter:image" content="%s">' . "\n", esc_url($image)); }
}
