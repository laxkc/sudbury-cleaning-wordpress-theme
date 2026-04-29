<?php
/**
 * Final CTA banner — full-bleed Blue.
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="section section--blue cta-banner" aria-label="<?php esc_attr_e('Get in touch', 'sudbury-cleaning'); ?>">
  <div class="container">
    <h2><?php esc_html_e('Ready for a sparkling clean?', 'sudbury-cleaning'); ?></h2>
    <p><?php esc_html_e('Get a free, no-obligation quote in under a minute. Same-week openings often available.', 'sudbury-cleaning'); ?></p>
    <div class="cta-banner__actions">
      <a class="btn btn--primary btn--lg" href="<?php echo esc_url(nova_quote_url()); ?>">
        <span><?php echo esc_html(nova_setting('hero_cta_text')); ?></span>
        <span class="icon-label__icon"><?php nova_print_icon('arrow-right', 14); ?></span>
      </a>
      <a class="btn btn--phone btn--lg" href="<?php echo esc_attr(nova_phone_link()); ?>">
        <span class="icon-label__icon"><?php nova_print_icon('phone', 14); ?></span>
        <span><?php echo esc_html(nova_setting('phone')); ?></span>
      </a>
    </div>
  </div>
</section>
