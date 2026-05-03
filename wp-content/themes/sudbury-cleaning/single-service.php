<?php
/**
 * Single Service.
 */
get_header();

while (have_posts()): the_post();
    $included     = get_post_meta(get_the_ID(), '_sudbury_service_included', true);
    $not_included = get_post_meta(get_the_ID(), '_sudbury_service_not_included', true);
    $price_from   = get_post_meta(get_the_ID(), '_sudbury_service_price_from', true);
?>

  <section class="section section--blue">
    <div class="container">
      <span class="section__eyebrow"><?php esc_html_e('Service', 'sudbury-cleaning'); ?></span>
      <h1><?php the_title(); ?></h1>
      <?php if (has_excerpt()): ?>
        <p class="lead" style="max-width: 720px;"><?php echo esc_html(get_the_excerpt()); ?></p>
      <?php endif; ?>
      <div class="cta-banner__actions" style="justify-content: flex-start; margin-top: var(--space-5);">
        <a class="btn btn--primary btn--lg" href="<?php echo esc_url(sudbury_quote_url()); ?>">
          <span><?php esc_html_e('Get a free quote', 'sudbury-cleaning'); ?></span>
        </a>
        <a class="btn btn--phone btn--lg" href="<?php echo esc_attr(sudbury_phone_link()); ?>">
          <span class="icon-label__icon"><?php sudbury_print_icon('phone', 14); ?></span>
          <span><?php echo esc_html(sudbury_setting('phone')); ?></span>
        </a>
      </div>
    </div>
  </section>

  <section class="section section--white">
    <div class="container" style="max-width: 880px;">
      <article class="article" style="padding-block: 0;">
        <?php if (has_post_thumbnail()): ?>
          <?php the_post_thumbnail('sudbury-hero', ['style' => 'border-radius: var(--radius); margin-bottom: var(--space-6);']); ?>
        <?php endif; ?>
        <div class="article__content">
          <?php the_content(); ?>
        </div>

        <?php if ($included): ?>
          <h2 style="margin-top: var(--space-8);"><?php esc_html_e('What’s included', 'sudbury-cleaning'); ?></h2>
          <ul style="list-style: none; padding: 0; display: grid; gap: var(--space-2); grid-template-columns: 1fr 1fr;">
            <?php foreach (preg_split('/\r?\n/', (string) $included) as $item):
                $item = trim($item);
                if ($item === '') continue;
            ?>
              <li class="icon-label icon-label--start" style="display:flex; gap: var(--space-2); align-items:flex-start;">
                <span class="icon-label__icon"><?php sudbury_print_icon('check', 12); ?></span>
                <span><?php echo esc_html($item); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if ($not_included): ?>
          <h3 style="margin-top: var(--space-7);"><?php esc_html_e('What’s not included', 'sudbury-cleaning'); ?></h3>
          <p class="muted"><?php echo esc_html($not_included); ?></p>
        <?php endif; ?>

        <?php if ($price_from): ?>
          <div class="card" style="margin-top: var(--space-6);">
            <h3 style="margin-bottom: var(--space-2);"><?php esc_html_e('Pricing', 'sudbury-cleaning'); ?></h3>
            <p class="muted"><?php printf(esc_html__('Starting from %s. Final price depends on size, condition, and frequency.', 'sudbury-cleaning'), esc_html($price_from)); ?></p>
            <a class="btn btn--primary" href="<?php echo esc_url(sudbury_quote_url()); ?>"><?php esc_html_e('Get exact quote', 'sudbury-cleaning'); ?></a>
          </div>
        <?php endif; ?>
      </article>
    </div>
  </section>

  <?php get_template_part('template-parts/testimonials'); ?>
  <?php get_template_part('template-parts/cta-banner'); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
