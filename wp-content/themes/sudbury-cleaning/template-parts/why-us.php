<?php
/**
 * Why Sudbury Sparkle — 4-up checklist.
 */
if (!defined('ABSPATH')) { exit; }

$reasons = [
    ['title' => __('Local & locally owned', 'sudbury-cleaning'), 'body' => __('Born and based in Greater Sudbury — we know our neighborhoods.', 'sudbury-cleaning')],
    ['title' => __('Vetted, background-checked staff', 'sudbury-cleaning'), 'body' => __('Every cleaner is interviewed, trained, and screened.', 'sudbury-cleaning')],
    ['title' => __('Eco-friendly products', 'sudbury-cleaning'), 'body' => __('Plant-based supplies, safer for kids, pets, and Northern lakes.', 'sudbury-cleaning')],
    ['title' => __('100% satisfaction guarantee', 'sudbury-cleaning'), 'body' => __('If you’re not happy, we re-clean — no questions asked.', 'sudbury-cleaning')],
];
?>
<section class="section section--white" aria-labelledby="why-heading">
  <div class="container">
    <header class="section__head">
      <span class="section__eyebrow"><?php esc_html_e('Why Sudbury Sparkle', 'sudbury-cleaning'); ?></span>
      <h2 id="why-heading"><?php esc_html_e('A cleaning team you can actually trust', 'sudbury-cleaning'); ?></h2>
    </header>

    <div class="why-grid">
      <?php foreach ($reasons as $r): ?>
        <div class="why-item">
          <span class="icon-label__icon"><?php sudbury_print_icon('check', 16); ?></span>
          <div>
            <h4><?php echo esc_html($r['title']); ?></h4>
            <p class="muted"><?php echo esc_html($r['body']); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
