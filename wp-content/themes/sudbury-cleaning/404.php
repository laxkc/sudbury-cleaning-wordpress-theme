<?php get_header(); ?>

<section class="section section--white" style="text-align:center; padding-block: var(--space-9);">
  <div class="container" style="max-width: 640px;">
    <div class="icon-xl" style="color: var(--brand-mint); margin-bottom: var(--space-4);">
      <?php sudbury_print_icon('sparkle'); ?>
    </div>
    <h1 style="font-size: clamp(3rem, 6vw, 5rem); margin-bottom: var(--space-3);">404</h1>
    <h2 style="font-weight: 600; margin-bottom: var(--space-4);"><?php esc_html_e('We couldn’t find that page', 'sudbury-cleaning'); ?></h2>
    <p class="lead" style="margin-bottom: var(--space-6);">
      <?php esc_html_e('The page may have moved or never existed. Let’s get you back on track.', 'sudbury-cleaning'); ?>
    </p>
    <div class="cta-banner__actions">
      <a class="btn btn--primary btn--lg" href="<?php echo esc_url(home_url('/')); ?>">
        <?php esc_html_e('Back home', 'sudbury-cleaning'); ?>
      </a>
      <a class="btn btn--outline btn--lg" href="<?php echo esc_url(sudbury_quote_url()); ?>">
        <?php esc_html_e('Get a quote', 'sudbury-cleaning'); ?>
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
