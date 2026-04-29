<?php
/**
 * How it works — 3 numbered steps.
 */
if (!defined('ABSPATH')) { exit; }

$steps = [
    ['n' => '01', 'title' => __('Get a free quote', 'sudbury-cleaning'),    'body' => __('Fill out a short form or call us — we’ll reply within one business day.', 'sudbury-cleaning')],
    ['n' => '02', 'title' => __('Pick a time that works', 'sudbury-cleaning'), 'body' => __('Choose a one-time clean or a recurring schedule. Same-week openings often available.', 'sudbury-cleaning')],
    ['n' => '03', 'title' => __('Relax — we handle the rest', 'sudbury-cleaning'), 'body' => __('Our vetted, insured team arrives on time and leaves your space sparkling.', 'sudbury-cleaning')],
];
?>
<section class="section section--grey" aria-labelledby="how-heading">
  <div class="container">
    <header class="section__head">
      <span class="section__eyebrow"><?php esc_html_e('Booking is easy', 'sudbury-cleaning'); ?></span>
      <h2 id="how-heading"><?php esc_html_e('Three simple steps to a sparkling space', 'sudbury-cleaning'); ?></h2>
    </header>

    <div class="steps">
      <?php foreach ($steps as $step): ?>
        <div class="step">
          <span class="step__num"><?php echo esc_html($step['n']); ?></span>
          <h3><?php echo esc_html($step['title']); ?></h3>
          <p class="muted"><?php echo esc_html($step['body']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="cta-banner__actions" style="margin-top: var(--space-7);">
      <a class="btn btn--primary btn--lg" href="<?php echo esc_url(nova_quote_url()); ?>">
        <span><?php esc_html_e('Get my free quote', 'sudbury-cleaning'); ?></span>
        <span class="icon-label__icon"><?php nova_print_icon('arrow-right', 14); ?></span>
      </a>
    </div>
  </div>
</section>
