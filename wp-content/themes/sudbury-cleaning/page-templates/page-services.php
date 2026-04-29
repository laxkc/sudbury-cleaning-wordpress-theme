<?php
/**
 * Template Name: Services Overview
 */
get_header();

while (have_posts()): the_post(); ?>

  <section class="section section--blue">
    <div class="container">
      <span class="section__eyebrow"><?php esc_html_e('What we do', 'sudbury-cleaning'); ?></span>
      <h1><?php the_title(); ?></h1>
      <?php if (has_excerpt()): ?>
        <p class="lead" style="max-width: 720px;"><?php echo esc_html(get_the_excerpt()); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <?php get_template_part('template-parts/services-grid'); ?>

  <?php if (get_the_content()): ?>
    <section class="section section--white">
      <div class="container article">
        <div class="article__content"><?php the_content(); ?></div>
      </div>
    </section>
  <?php endif; ?>

  <?php get_template_part('template-parts/why-us'); ?>
  <?php get_template_part('template-parts/cta-banner'); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
