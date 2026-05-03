<?php
/**
 * Services grid — pulls from `service` CPT or falls back to defaults.
 */
if (!defined('ABSPATH')) { exit; }

$services = get_posts([
    'post_type'      => 'service',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
]);
?>
<section class="section section--white" aria-labelledby="services-heading">
  <div class="container">
    <header class="section__head">
      <span class="section__eyebrow"><?php esc_html_e('What we do', 'sudbury-cleaning'); ?></span>
      <h2 id="services-heading"><?php esc_html_e('Cleaning services for every space in Sudbury', 'sudbury-cleaning'); ?></h2>
      <p class="lead"><?php esc_html_e('From weekly home cleans to one-time deep cleans, we’ve got Greater Sudbury covered.', 'sudbury-cleaning'); ?></p>
    </header>

    <div class="grid grid--3">
      <?php if ($services): foreach ($services as $svc): ?>
        <article class="card">
          <div class="card__icon"><?php sudbury_print_icon('sparkle', 28); ?></div>
          <h3 class="card__title"><?php echo esc_html(get_the_title($svc)); ?></h3>
          <p class="card__body"><?php echo esc_html(wp_trim_words(get_the_excerpt($svc) ?: get_the_content(null, false, $svc), 18)); ?></p>
          <a class="card__link" href="<?php echo esc_url(get_permalink($svc)); ?>">
            <span><?php esc_html_e('Learn more', 'sudbury-cleaning'); ?></span>
            <span class="icon-label__icon"><?php sudbury_print_icon('arrow-right', 12); ?></span>
          </a>
        </article>
      <?php endforeach; else: foreach (sudbury_default_services() as $svc): ?>
        <article class="card">
          <div class="card__icon"><?php sudbury_print_icon($svc['icon'], 28); ?></div>
          <h3 class="card__title"><?php echo esc_html($svc['title']); ?></h3>
          <p class="card__body"><?php echo esc_html($svc['body']); ?></p>
          <a class="card__link" href="<?php echo esc_url(home_url('/services/')); ?>">
            <span><?php esc_html_e('Learn more', 'sudbury-cleaning'); ?></span>
            <span class="icon-label__icon"><?php sudbury_print_icon('arrow-right', 12); ?></span>
          </a>
        </article>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
