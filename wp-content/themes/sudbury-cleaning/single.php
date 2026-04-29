<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>

  <section class="section section--white">
    <div class="container">
      <article class="article">
        <?php $cats = get_the_category(); if (!empty($cats)): ?>
          <span class="blog-card__cat" style="margin-bottom: var(--space-3); display:inline-block;"><?php echo esc_html($cats[0]->name); ?></span>
        <?php endif; ?>

        <h1 class="article__title"><?php the_title(); ?></h1>
        <p class="article__meta">
          <?php
          printf(
              esc_html__('By %1$s · %2$s', 'sudbury-cleaning'),
              esc_html(get_the_author()),
              esc_html(get_the_date())
          );
          ?>
        </p>

        <?php if (has_post_thumbnail()): ?>
          <?php the_post_thumbnail('nova-hero', ['loading' => 'eager', 'style' => 'border-radius: var(--radius); margin-bottom: var(--space-6);']); ?>
        <?php endif; ?>

        <div class="article__content">
          <?php the_content(); ?>
        </div>

        <?php if (comments_open() || get_comments_number()): ?>
          <hr>
          <?php comments_template(); ?>
        <?php endif; ?>
      </article>
    </div>
  </section>

<?php endwhile; ?>

<?php get_template_part('template-parts/cta-banner'); ?>

<?php get_footer(); ?>
