<?php
/**
 * Archive: Services.
 */
get_header(); ?>

<section class="section section--blue">
  <div class="container">
    <span class="section__eyebrow"><?php esc_html_e('What we do', 'sudbury-cleaning'); ?></span>
    <h1><?php esc_html_e('Cleaning Services in Greater Sudbury', 'sudbury-cleaning'); ?></h1>
    <p class="lead" style="max-width: 720px;">
      <?php esc_html_e('From homes and offices to move-out and post-construction cleans — we’ve got every kind of space covered.', 'sudbury-cleaning'); ?>
    </p>
  </div>
</section>

<section class="section section--white">
  <div class="container">
    <?php if (have_posts()): ?>
      <div class="grid grid--3">
        <?php while (have_posts()): the_post(); ?>
          <article class="card">
            <div class="card__icon"><?php nova_print_icon('sparkle', 28); ?></div>
            <h2 class="card__title"><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></h2>
            <p class="card__body"><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 22)); ?></p>
            <a class="card__link" href="<?php the_permalink(); ?>">
              <span><?php esc_html_e('Learn more', 'sudbury-cleaning'); ?></span>
              <span class="icon-label__icon"><?php nova_print_icon('arrow-right', 12); ?></span>
            </a>
          </article>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="grid grid--3">
        <?php foreach (nova_default_services() as $svc): ?>
          <article class="card">
            <div class="card__icon"><?php nova_print_icon($svc['icon'], 28); ?></div>
            <h2 class="card__title"><?php echo esc_html($svc['title']); ?></h2>
            <p class="card__body"><?php echo esc_html($svc['body']); ?></p>
            <a class="card__link" href="<?php echo esc_url(nova_quote_url()); ?>">
              <span><?php esc_html_e('Get a quote', 'sudbury-cleaning'); ?></span>
              <span class="icon-label__icon"><?php nova_print_icon('arrow-right', 12); ?></span>
            </a>
          </article>
        <?php endforeach; ?>
      </div>
      <p class="muted" style="text-align:center; margin-top: var(--space-7);">
        <?php esc_html_e('Tip: add Service entries from the WordPress admin to populate this page with real content.', 'sudbury-cleaning'); ?>
      </p>
    <?php endif; ?>
  </div>
</section>

<?php get_template_part('template-parts/cta-banner'); ?>

<?php get_footer(); ?>
