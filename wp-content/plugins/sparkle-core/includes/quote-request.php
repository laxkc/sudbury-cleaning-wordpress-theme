<?php
/**
 * Quote Request — admin meta box that displays submitted form fields.
 * Reads meta keys with `_nova_` prefix (kept for backward-compat with
 * existing submissions stored under that prefix).
 */

if (!defined('ABSPATH')) { exit; }

add_action('add_meta_boxes', function () {
    add_meta_box(
        'sparkle_quote_details',
        __('Submission Details', 'sparkle-core'),
        'sparkle_render_quote_meta',
        'quote_request',
        'normal',
        'high'
    );
});

function sparkle_render_quote_meta($post): void {
    $fields = [
        'name', 'email', 'phone', 'service_type', 'property_type',
        'sqft', 'bedrooms', 'bathrooms', 'frequency', 'preferred_date',
        'service_area', 'submitted_ip', 'submitted_at',
    ];
    echo '<table class="form-table"><tbody>';
    foreach ($fields as $key) {
        $value = get_post_meta($post->ID, '_nova_' . $key, true);
        if ($value === '' || $value === null) { continue; }
        printf(
            '<tr><th style="text-align:left;width:160px;">%s</th><td>%s</td></tr>',
            esc_html(ucwords(str_replace('_', ' ', $key))),
            esc_html($value)
        );
    }
    echo '</tbody></table>';
}
