<?php
/**
 * Service areas — chip grid linking to per-neighborhood pages.
 */
if (!defined('ABSPATH')) { exit; }

$areas = get_posts([
    'post_type'      => 'area',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
]);
$using_defaults = empty($areas);
?>
<section class="section section--grey" aria-labelledby="areas-heading">
  <div class="container">
    <header class="section__head">
      <span class="section__eyebrow"><?php esc_html_e('Where we clean', 'sudbury-cleaning'); ?></span>
      <h2 id="areas-heading"><?php esc_html_e('Proudly serving Greater Sudbury', 'sudbury-cleaning'); ?></h2>
      <p class="lead"><?php esc_html_e('From downtown Sudbury to Hanmer — we cover the neighborhoods you call home.', 'sudbury-cleaning'); ?></p>
    </header>

    <div class="area-chips">
      <?php if ($using_defaults): foreach (sudbury_default_areas() as $a): ?>
        <a class="area-chip" href="<?php echo esc_url(home_url('/service-areas/' . $a['slug'] . '/')); ?>">
          <span class="icon-label__icon"><?php sudbury_print_icon('pin', 12); ?></span>
          <span><?php echo esc_html($a['name']); ?></span>
        </a>
      <?php endforeach; else: foreach ($areas as $a): ?>
        <a class="area-chip" href="<?php echo esc_url(get_permalink($a)); ?>">
          <span class="icon-label__icon"><?php sudbury_print_icon('pin', 12); ?></span>
          <span><?php echo esc_html(get_the_title($a)); ?></span>
        </a>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
