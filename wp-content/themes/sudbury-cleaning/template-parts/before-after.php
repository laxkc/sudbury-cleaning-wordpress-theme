<?php
/**
 * Before / after — placeholder pairs (replace with real images).
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="section section--white" aria-labelledby="ba-heading">
  <div class="container">
    <header class="section__head">
      <span class="section__eyebrow"><?php esc_html_e('Real results', 'sudbury-cleaning'); ?></span>
      <h2 id="ba-heading"><?php esc_html_e('See the Sparkle difference', 'sudbury-cleaning'); ?></h2>
    </header>

    <div class="ba-row">
      <?php for ($i = 1; $i <= 3; $i++): ?>
        <div class="ba-pair">
          <figure>
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#9CA3AF,#6B7280);"></div>
            <figcaption><?php esc_html_e('Before', 'sudbury-cleaning'); ?></figcaption>
          </figure>
          <figure>
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#34D399,#10B981);"></div>
            <figcaption><?php esc_html_e('After', 'sudbury-cleaning'); ?></figcaption>
          </figure>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>
