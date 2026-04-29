<?php
/**
 * Single Service Area — local SEO landing page.
 */
get_header();

while (have_posts()): the_post(); ?>

  <section class="section section--blue">
    <div class="container">
      <span class="section__eyebrow"><?php esc_html_e('Service Area', 'sudbury-cleaning'); ?></span>
      <h1><?php printf(esc_html__('Cleaning Services in %s, ON', 'sudbury-cleaning'), esc_html(get_the_title())); ?></h1>
      <p class="lead" style="max-width: 720px;">
        <?php
        $excerpt = get_the_excerpt();
        echo esc_html($excerpt ?: sprintf(__('Trusted, insured residential and commercial cleaning for homes and businesses in %s.', 'sudbury-cleaning'), get_the_title()));
        ?>
      </p>
      <div class="cta-banner__actions" style="justify-content: flex-start; margin-top: var(--space-5);">
        <a class="btn btn--primary btn--lg" href="<?php echo esc_url(nova_quote_url()); ?>">
          <?php esc_html_e('Get a free quote', 'sudbury-cleaning'); ?>
        </a>
      </div>
    </div>
  </section>

  <section class="section section--white">
    <div class="container" style="max-width: 880px;">
      <article class="article" style="padding-block: 0;">
        <div class="article__content">
          <?php
          if (get_the_content()) {
              the_content();
          } else {
              printf(
                  '<p>%s</p>',
                  esc_html(sprintf(
                      __('We proudly serve homes and businesses in %s with reliable, eco-friendly cleaning. Whether you need a one-time deep clean or a recurring schedule, our local team can be there same-week.', 'sudbury-cleaning'),
                      get_the_title()
                  ))
              );
              echo '<p>' . esc_html__('Add custom local content for this neighborhood from the WordPress admin (Service Areas → Edit). Mention nearby streets, weather, and what makes this area unique to win local search rankings.', 'sudbury-cleaning') . '</p>';
          }
          ?>
        </div>
      </article>
    </div>
  </section>

  <?php get_template_part('template-parts/services-grid'); ?>
  <?php get_template_part('template-parts/testimonials'); ?>
  <?php get_template_part('template-parts/cta-banner'); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
