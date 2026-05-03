<?php
/**
 * Homepage hero.
 */
if (!defined('ABSPATH')) { exit; }
$hero_image = get_theme_mod('sudbury_hero_image', '');
?>
<section class="hero">
  <div class="container">
    <div class="hero__grid">
      <div class="hero__copy">
        <span class="hero__eyebrow">
          <span class="icon-label__icon"><?php sudbury_print_icon('sparkle', 12); ?></span>
          <span><?php echo esc_html(sudbury_setting('hero_eyebrow')); ?></span>
        </span>
        <h1 class="hero__title"><?php echo esc_html(sudbury_setting('hero_title')); ?></h1>
        <p class="hero__lead"><?php echo esc_html(sudbury_setting('hero_lead')); ?></p>

        <div class="hero__actions">
          <a class="btn btn--primary btn--lg" href="<?php echo esc_url(sudbury_quote_url()); ?>">
            <span><?php echo esc_html(sudbury_setting('hero_cta_text')); ?></span>
            <span class="icon-label__icon"><?php sudbury_print_icon('arrow-right', 14); ?></span>
          </a>
          <a class="btn btn--outline btn--lg" href="<?php echo esc_attr(sudbury_phone_link()); ?>">
            <span class="icon-label__icon"><?php sudbury_print_icon('phone', 14); ?></span>
            <span><?php echo esc_html(sudbury_setting('phone')); ?></span>
          </a>
        </div>

        <div class="hero__trust">
          <span class="icon-label">
            <span class="icon-label__icon"><?php sudbury_print_icon('check', 12); ?></span>
            <span><?php esc_html_e('Insured & WSIB', 'sudbury-cleaning'); ?></span>
          </span>
          <span class="icon-label">
            <span class="icon-label__icon"><?php sudbury_print_icon('check', 12); ?></span>
            <span><?php esc_html_e('Eco-friendly', 'sudbury-cleaning'); ?></span>
          </span>
          <span class="icon-label">
            <span class="icon-label__icon"><?php sudbury_print_icon('check', 12); ?></span>
            <span><?php esc_html_e('Same-week service', 'sudbury-cleaning'); ?></span>
          </span>
        </div>
      </div>

      <div class="hero__media">
        <?php if ($hero_image): ?>
          <img src="<?php echo esc_url($hero_image); ?>" alt="<?php esc_attr_e('Sparkling clean home interior', 'sudbury-cleaning'); ?>" loading="eager" fetchpriority="high">
        <?php else: ?>
          <div class="hero__media-fallback">
            <span><?php esc_html_e('Add your hero image in Customizer → Sparkle Theme → Homepage Hero', 'sudbury-cleaning'); ?></span>
          </div>
        <?php endif; ?>
        <div class="hero__badge">
          <span class="icon-label__icon"><?php sudbury_print_icon('star', 16); ?></span>
          <span><strong>4.9</strong> &middot; <?php esc_html_e('120+ Google reviews', 'sudbury-cleaning'); ?></span>
        </div>
      </div>
    </div>
  </div>
</section>
