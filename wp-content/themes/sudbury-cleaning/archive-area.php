<?php
/**
 * Archive: Service Areas.
 */
get_header(); ?>

<section class="section section--blue">
  <div class="container">
    <span class="section__eyebrow"><?php esc_html_e('Where we clean', 'sudbury-cleaning'); ?></span>
    <h1><?php esc_html_e('Service Areas', 'sudbury-cleaning'); ?></h1>
    <p class="lead" style="max-width: 720px;">
      <?php esc_html_e('Proudly serving Greater Sudbury and the surrounding communities of Northern Ontario.', 'sudbury-cleaning'); ?>
    </p>
  </div>
</section>

<section class="section section--white">
  <div class="container">
    <?php if (have_posts()): ?>
      <div class="grid grid--3">
        <?php while (have_posts()): the_post(); ?>
          <article class="card">
            <div class="card__icon"><?php sudbury_print_icon('pin', 28); ?></div>
            <h2 class="card__title"><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></h2>
            <p class="card__body"><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 18)); ?></p>
            <a class="card__link" href="<?php the_permalink(); ?>">
              <span><?php esc_html_e('Cleaning in this area', 'sudbury-cleaning'); ?></span>
              <span class="icon-label__icon"><?php sudbury_print_icon('arrow-right', 12); ?></span>
            </a>
          </article>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="grid grid--3">
        <?php foreach (sudbury_default_areas() as $a): ?>
          <article class="card">
            <div class="card__icon"><?php sudbury_print_icon('pin', 28); ?></div>
            <h2 class="card__title"><?php echo esc_html($a['name']); ?></h2>
            <p class="card__body"><?php printf(esc_html__('Reliable cleaning services in %s and nearby neighborhoods.', 'sudbury-cleaning'), esc_html($a['name'])); ?></p>
            <a class="card__link" href="<?php echo esc_url(home_url('/service-areas/' . $a['slug'] . '/')); ?>">
              <span><?php esc_html_e('Learn more', 'sudbury-cleaning'); ?></span>
              <span class="icon-label__icon"><?php sudbury_print_icon('arrow-right', 12); ?></span>
            </a>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php get_template_part('template-parts/cta-banner'); ?>
<?php get_footer(); ?>
