<?php
/**
 * Template Name: Service Areas Overview
 */
get_header();

while (have_posts()): the_post(); ?>

  <section class="section section--blue">
    <div class="container">
      <span class="section__eyebrow"><?php esc_html_e('Where we clean', 'sudbury-cleaning'); ?></span>
      <h1><?php the_title(); ?></h1>
      <p class="lead" style="max-width: 720px;">
        <?php esc_html_e('Reliable cleaning services across Greater Sudbury and surrounding communities.', 'sudbury-cleaning'); ?>
      </p>
    </div>
  </section>

  <?php get_template_part('template-parts/service-areas'); ?>

  <section class="section section--white">
    <div class="container">
      <div class="grid grid--3">
        <?php
        $areas = get_posts(['post_type' => 'area', 'posts_per_page' => -1, 'orderby' => 'menu_order title', 'order' => 'ASC']);
        if ($areas):
            foreach ($areas as $a):
        ?>
          <article class="card">
            <div class="card__icon"><?php sudbury_print_icon('pin', 28); ?></div>
            <h3 class="card__title"><a href="<?php echo esc_url(get_permalink($a)); ?>" style="color:inherit;"><?php echo esc_html(get_the_title($a)); ?></a></h3>
            <p class="card__body"><?php echo esc_html(wp_trim_words(get_the_excerpt($a) ?: get_the_content(null, false, $a), 18)); ?></p>
            <a class="card__link" href="<?php echo esc_url(get_permalink($a)); ?>">
              <span><?php esc_html_e('Cleaning in this area', 'sudbury-cleaning'); ?></span>
              <span class="icon-label__icon"><?php sudbury_print_icon('arrow-right', 12); ?></span>
            </a>
          </article>
        <?php endforeach; else: foreach (sudbury_default_areas() as $a): ?>
          <article class="card">
            <div class="card__icon"><?php sudbury_print_icon('pin', 28); ?></div>
            <h3 class="card__title"><?php echo esc_html($a['name']); ?></h3>
            <p class="card__body"><?php printf(esc_html__('House and office cleaning across %s and nearby Sudbury neighborhoods.', 'sudbury-cleaning'), esc_html($a['name'])); ?></p>
            <a class="card__link" href="<?php echo esc_url(home_url('/service-areas/' . $a['slug'] . '/')); ?>">
              <span><?php esc_html_e('Learn more', 'sudbury-cleaning'); ?></span>
              <span class="icon-label__icon"><?php sudbury_print_icon('arrow-right', 12); ?></span>
            </a>
          </article>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </section>

  <?php if (get_the_content()): ?>
    <section class="section section--grey">
      <div class="container article">
        <div class="article__content"><?php the_content(); ?></div>
      </div>
    </section>
  <?php endif; ?>

  <?php get_template_part('template-parts/cta-banner'); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
