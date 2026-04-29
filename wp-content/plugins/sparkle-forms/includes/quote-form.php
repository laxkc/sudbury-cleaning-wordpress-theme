<?php
/**
 * Sparkle Forms — Quote / Contact form.
 * Shortcode: [sparkle_quote_form]
 * Form posts to admin-post.php with action=nova_quote_submit.
 *
 * Meta keys are kept under the `_nova_` prefix and transient/action names
 * under the `nova_` prefix for backward compatibility with submissions and
 * rate-limit counters created before the plugin split.
 */

if (!defined('ABSPATH')) { exit; }

add_shortcode('sparkle_quote_form', 'sparkle_render_quote_form');

function sparkle_render_quote_form($atts = []): string {
    $atts = shortcode_atts(['title' => __('Get a Free Quote', 'sparkle-forms')], $atts, 'sparkle_quote_form');

    $status = isset($_GET['quote']) ? sanitize_key($_GET['quote']) : '';
    $errors = get_transient('nova_quote_errors_' . sparkle_form_client_key());
    if ($errors) { delete_transient('nova_quote_errors_' . sparkle_form_client_key()); }

    ob_start();
    ?>
    <div class="quote-form-wrap">
        <h3><?php echo esc_html($atts['title']); ?></h3>
        <p class="muted"><?php esc_html_e('Tell us about your space — we’ll reply within one business day with a free, no-obligation quote.', 'sparkle-forms'); ?></p>

        <?php if ($status === 'success'): ?>
            <div class="form-success" role="status">
                <strong><?php esc_html_e('Thanks!', 'sparkle-forms'); ?></strong>
                <?php esc_html_e('We received your request and will be in touch shortly.', 'sparkle-forms'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="form-error-banner" role="alert">
                <strong><?php esc_html_e('Please fix the errors below.', 'sparkle-forms'); ?></strong>
            </div>
        <?php endif; ?>

        <form class="form quote-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" novalidate>
            <input type="hidden" name="action" value="nova_quote_submit">
            <?php wp_nonce_field('nova_quote_submit', 'nova_quote_nonce'); ?>
            <input type="hidden" name="nova_form_started" value="<?php echo esc_attr(time()); ?>">

            <div class="form-honeypot" aria-hidden="true">
                <label>Website (leave blank)
                    <input type="text" name="website_url" tabindex="-1" autocomplete="off">
                </label>
            </div>

            <div class="form-row">
                <div class="form-field <?php echo isset($errors['name']) ? 'form-field--invalid' : ''; ?>">
                    <label for="qf-name"><?php esc_html_e('Full name', 'sparkle-forms'); ?> <span class="req">*</span></label>
                    <input id="qf-name" name="name" type="text" required>
                    <?php if (!empty($errors['name'])): ?><span class="form-error"><?php echo esc_html($errors['name']); ?></span><?php endif; ?>
                </div>
                <div class="form-field <?php echo isset($errors['email']) ? 'form-field--invalid' : ''; ?>">
                    <label for="qf-email"><?php esc_html_e('Email', 'sparkle-forms'); ?> <span class="req">*</span></label>
                    <input id="qf-email" name="email" type="email" required>
                    <?php if (!empty($errors['email'])): ?><span class="form-error"><?php echo esc_html($errors['email']); ?></span><?php endif; ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field <?php echo isset($errors['phone']) ? 'form-field--invalid' : ''; ?>">
                    <label for="qf-phone"><?php esc_html_e('Phone', 'sparkle-forms'); ?> <span class="req">*</span></label>
                    <input id="qf-phone" name="phone" type="tel" required>
                </div>
                <div class="form-field">
                    <label for="qf-service"><?php esc_html_e('Service type', 'sparkle-forms'); ?></label>
                    <select id="qf-service" name="service_type">
                        <option value=""><?php esc_html_e('Select a service…', 'sparkle-forms'); ?></option>
                        <?php foreach (sparkle_form_service_options() as $slug => $label): ?>
                            <option value="<?php echo esc_attr($slug); ?>"><?php echo esc_html($label); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row form-row--3">
                <div class="form-field">
                    <label for="qf-property"><?php esc_html_e('Property type', 'sparkle-forms'); ?></label>
                    <select id="qf-property" name="property_type">
                        <?php foreach (['House', 'Apartment', 'Condo', 'Office', 'Airbnb'] as $opt): ?>
                            <option value="<?php echo esc_attr($opt); ?>"><?php echo esc_html($opt); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-field">
                    <label for="qf-sqft"><?php esc_html_e('Square footage', 'sparkle-forms'); ?></label>
                    <input id="qf-sqft" name="sqft" type="number" min="0" step="50">
                </div>
                <div class="form-field">
                    <label for="qf-frequency"><?php esc_html_e('Frequency', 'sparkle-forms'); ?></label>
                    <select id="qf-frequency" name="frequency">
                        <option value="one-time"><?php esc_html_e('One-time', 'sparkle-forms'); ?></option>
                        <option value="weekly"><?php esc_html_e('Weekly', 'sparkle-forms'); ?></option>
                        <option value="biweekly"><?php esc_html_e('Bi-weekly', 'sparkle-forms'); ?></option>
                        <option value="monthly"><?php esc_html_e('Monthly', 'sparkle-forms'); ?></option>
                    </select>
                </div>
            </div>

            <div class="form-row form-row--3">
                <div class="form-field">
                    <label for="qf-bedrooms"><?php esc_html_e('Bedrooms', 'sparkle-forms'); ?></label>
                    <select id="qf-bedrooms" name="bedrooms">
                        <?php foreach (['', '1', '2', '3', '4', '5+'] as $opt): ?>
                            <option value="<?php echo esc_attr($opt); ?>"><?php echo $opt === '' ? esc_html__('Select…', 'sparkle-forms') : esc_html($opt); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-field">
                    <label for="qf-bathrooms"><?php esc_html_e('Bathrooms', 'sparkle-forms'); ?></label>
                    <select id="qf-bathrooms" name="bathrooms">
                        <?php foreach (['', '1', '2', '3', '4+'] as $opt): ?>
                            <option value="<?php echo esc_attr($opt); ?>"><?php echo $opt === '' ? esc_html__('Select…', 'sparkle-forms') : esc_html($opt); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-field">
                    <label for="qf-date"><?php esc_html_e('Preferred date', 'sparkle-forms'); ?></label>
                    <input id="qf-date" name="preferred_date" type="date">
                </div>
            </div>

            <div class="form-field">
                <label for="qf-area"><?php esc_html_e('Service area', 'sparkle-forms'); ?></label>
                <select id="qf-area" name="service_area">
                    <option value=""><?php esc_html_e('Select your neighborhood…', 'sparkle-forms'); ?></option>
                    <?php foreach (sparkle_form_area_options() as $slug => $label): ?>
                        <option value="<?php echo esc_attr($slug); ?>"><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-field">
                <label for="qf-message"><?php esc_html_e('Tell us a bit more', 'sparkle-forms'); ?></label>
                <textarea id="qf-message" name="message" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn--primary btn--lg btn--block"><?php esc_html_e('Send my free quote request', 'sparkle-forms'); ?></button>
        </form>
    </div>
    <?php
    return ob_get_clean();
}

function sparkle_form_service_options(): array {
    $items = get_posts([
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    ]);
    if (empty($items)) {
        $defaults = function_exists('nova_default_services') ? nova_default_services() : [];
        $out = [];
        foreach ($defaults as $svc) {
            $slug = sanitize_title($svc['title']);
            $out[$slug] = $svc['title'];
        }
        return $out;
    }
    $out = [];
    foreach ($items as $p) { $out[$p->post_name] = $p->post_title; }
    return $out;
}

function sparkle_form_area_options(): array {
    $items = get_posts([
        'post_type'      => 'area',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    ]);
    if (empty($items)) {
        $defaults = function_exists('nova_default_areas') ? nova_default_areas() : [];
        $out = [];
        foreach ($defaults as $a) { $out[$a['slug']] = $a['name']; }
        return $out;
    }
    $out = [];
    foreach ($items as $p) { $out[$p->post_name] = $p->post_title; }
    return $out;
}

function sparkle_form_client_key(): string {
    $ip = isset($_SERVER['REMOTE_ADDR']) ? (string) $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    return md5($ip);
}

/**
 * Form handler — registered on admin_post hooks (action=nova_quote_submit).
 * The action name is preserved from pre-split for backward-compat.
 */
add_action('admin_post_nova_quote_submit',        'sparkle_handle_quote_submit');
add_action('admin_post_nopriv_nova_quote_submit', 'sparkle_handle_quote_submit');

function sparkle_handle_quote_submit(): void {
    $referer = wp_get_referer() ?: home_url('/');

    /* Nonce */
    if (!isset($_POST['nova_quote_nonce']) || !wp_verify_nonce($_POST['nova_quote_nonce'], 'nova_quote_submit')) {
        wp_safe_redirect(add_query_arg('quote', 'error', $referer));
        exit;
    }

    /* Honeypot */
    if (!empty($_POST['website_url'])) {
        wp_safe_redirect(add_query_arg('quote', 'success', $referer));
        exit;
    }

    /* Timestamp gate (3 seconds minimum) */
    $started = isset($_POST['nova_form_started']) ? (int) $_POST['nova_form_started'] : 0;
    if ($started > 0 && (time() - $started) < 3) {
        wp_safe_redirect(add_query_arg('quote', 'success', $referer));
        exit;
    }

    /* Rate limit: 3 per hour per IP */
    $rate_key = 'nova_quote_rate_' . sparkle_form_client_key();
    $count    = (int) get_transient($rate_key);
    if ($count >= 3) {
        wp_safe_redirect(add_query_arg('quote', 'rate', $referer));
        exit;
    }

    $data = [
        'name'           => sanitize_text_field($_POST['name'] ?? ''),
        'email'          => sanitize_email($_POST['email'] ?? ''),
        'phone'          => sanitize_text_field($_POST['phone'] ?? ''),
        'service_type'   => sanitize_text_field($_POST['service_type'] ?? ''),
        'property_type'  => sanitize_text_field($_POST['property_type'] ?? ''),
        'sqft'           => absint($_POST['sqft'] ?? 0),
        'bedrooms'       => sanitize_text_field($_POST['bedrooms'] ?? ''),
        'bathrooms'      => sanitize_text_field($_POST['bathrooms'] ?? ''),
        'frequency'      => sanitize_text_field($_POST['frequency'] ?? ''),
        'preferred_date' => sanitize_text_field($_POST['preferred_date'] ?? ''),
        'service_area'   => sanitize_text_field($_POST['service_area'] ?? ''),
        'message'        => sanitize_textarea_field($_POST['message'] ?? ''),
    ];

    $errors = [];
    if ($data['name'] === '')      { $errors['name']  = __('Please enter your name.', 'sparkle-forms'); }
    if (!is_email($data['email'])) { $errors['email'] = __('Please enter a valid email address.', 'sparkle-forms'); }
    if ($data['phone'] === '')     { $errors['phone'] = __('Please enter a phone number.', 'sparkle-forms'); }

    if (!empty($errors)) {
        set_transient('nova_quote_errors_' . sparkle_form_client_key(), $errors, 60);
        wp_safe_redirect(add_query_arg('quote', 'invalid', $referer));
        exit;
    }

    /* Save as quote_request CPT (private). Requires Sparkle Core for the post type. */
    $post_id = wp_insert_post([
        'post_type'    => 'quote_request',
        'post_status'  => 'publish',
        'post_title'   => sprintf('%s — %s', $data['name'], current_time('Y-m-d H:i')),
        'post_content' => $data['message'],
    ]);

    if (!is_wp_error($post_id) && $post_id) {
        foreach ($data as $key => $val) {
            update_post_meta($post_id, '_nova_' . $key, $val);
        }
        update_post_meta($post_id, '_nova_submitted_ip', isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '');
        update_post_meta($post_id, '_nova_submitted_at', current_time('mysql'));
    }

    /* Email owner — read configured destination from theme Customizer if present, else admin email. */
    $to      = function_exists('nova_setting') ? nova_setting('quote_email', get_option('admin_email')) : get_option('admin_email');
    $subject = sprintf('[%s] New quote request — %s', get_bloginfo('name'), $data['name']);
    $body    = "New quote request:\n\n";
    foreach ($data as $key => $val) {
        $body .= ucwords(str_replace('_', ' ', $key)) . ": " . $val . "\n";
    }
    wp_mail($to, $subject, $body);

    /* Auto-reply to customer */
    if (is_email($data['email'])) {
        wp_mail(
            $data['email'],
            sprintf(__('We received your request — %s', 'sparkle-forms'), get_bloginfo('name')),
            sprintf(
                "Hi %s,\n\nThanks for reaching out to %s. We received your quote request and will reply within one business day.\n\n— The Sparkle Team",
                $data['name'],
                get_bloginfo('name')
            )
        );
    }

    /* Update rate limit */
    set_transient($rate_key, $count + 1, HOUR_IN_SECONDS);

    wp_safe_redirect(add_query_arg('quote', 'success', $referer));
    exit;
}
