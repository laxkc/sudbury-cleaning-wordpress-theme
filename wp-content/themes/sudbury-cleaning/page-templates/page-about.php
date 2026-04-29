<?php
/**
 * Template Name: About
 */
get_header();

while (have_posts()): the_post(); ?>

  <section class="section section--blue">
    <div class="container">
      <span class="section__eyebrow"><?php esc_html_e('About us', 'sudbury-cleaning'); ?></span>
      <h1><?php the_title(); ?></h1>
      <p class="lead" style="max-width: 720px;">
        <?php
        $excerpt = get_the_excerpt();
        echo esc_html($excerpt ?: __('Locally owned. Insured. Trusted by Sudbury homes and businesses since 2018.', 'sudbury-cleaning'));
        ?>
      </p>
    </div>
  </section>

  <section class="section section--white">
    <div class="container" style="max-width: 800px;">
      <article class="article" style="padding-block: 0;">
        <?php if (has_post_thumbnail()): ?>
          <?php the_post_thumbnail('nova-hero', ['style' => 'border-radius: var(--radius); margin-bottom: var(--space-6);']); ?>
        <?php endif; ?>
        <div class="article__content">
          <?php
          if (get_the_content()) {
              the_content();
          } else {
              echo '<p>' . esc_html__('Sudbury Sparkle Cleaning Co. was started by a Sudbury family who couldn’t find a cleaning service they trusted. Today we’re a small, locally owned team committed to reliable, eco-friendly cleaning across Greater Sudbury.', 'sudbury-cleaning') . '</p>';
              echo '<p>' . esc_html__('Edit this page in the WordPress admin to add your own story, values, and team photos.', 'sudbury-cleaning') . '</p>';
          }
          ?>
        </div>
      </article>
    </div>
  </section>

  <?php get_template_part('template-parts/why-us'); ?>
  <?php get_template_part('template-parts/testimonials'); ?>
  <?php get_template_part('template-parts/cta-banner'); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
