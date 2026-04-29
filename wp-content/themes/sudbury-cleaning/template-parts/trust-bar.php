<?php
/**
 * Trust bar — 4 items, icon + text, configured in Customizer.
 */
if (!defined('ABSPATH')) { exit; }

$items = [];
for ($i = 1; $i <= 4; $i++) {
    $items[] = [
        'icon' => get_theme_mod("nova_trust_{$i}_icon", ['star', 'shield', 'leaf', 'clock'][$i - 1]),
        'text' => get_theme_mod("nova_trust_{$i}_text", ['4.9 on Google (120+ reviews)', 'Insured & WSIB compliant', 'Eco-friendly products', 'Same-week service'][$i - 1]),
    ];
}
?>
<section class="trust-bar" aria-label="<?php esc_attr_e('Why our customers trust us', 'sudbury-cleaning'); ?>">
  <div class="container">
    <div class="trust-bar__row">
      <?php foreach ($items as $item): ?>
        <div class="trust-item">
          <span class="icon-label__icon"><?php nova_print_icon($item['icon'], 14); ?></span>
          <span><?php echo esc_html($item['text']); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
