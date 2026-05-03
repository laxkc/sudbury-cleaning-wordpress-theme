<?php
/**
 * Latest blog posts (3).
 */
if (!defined('ABSPATH')) { exit; }

$latest = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'ignore_sticky_posts' => 1,
]);

if (!$latest->have_posts()) { return; }
?>
<section class="section section--grey" aria-labelledby="blog-heading">
  <div class="container">
    <header class="section__head">
      <span class="section__eyebrow"><?php esc_html_e('From the blog', 'sudbury-cleaning'); ?></span>
      <h2 id="blog-heading"><?php esc_html_e('Cleaning tips from your Sudbury locals', 'sudbury-cleaning'); ?></h2>
    </header>

    <div class="blog-grid">
      <?php while ($latest->have_posts()): $latest->the_post();
          $cats = get_the_category();
          $cat  = $cats[0] ?? null;
      ?>
        <article class="blog-card">
          <a class="blog-card__media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php if (has_post_thumbnail()): ?>
              <?php the_post_thumbnail('sudbury-card', ['loading' => 'lazy', 'alt' => '']); ?>
            <?php else: ?>
              <div style="width:100%;height:100%;background:linear-gradient(135deg,#1E3A8A,#10B981);"></div>
            <?php endif; ?>
          </a>
          <div class="blog-card__body">
            <?php if ($cat): ?><span class="blog-card__cat"><?php echo esc_html($cat->name); ?></span><?php endif; ?>
            <h3 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="muted"><?php echo esc_html(sudbury_excerpt(18)); ?></p>
            <div class="blog-card__meta"><?php echo esc_html(get_the_date()); ?></div>
          </div>
        </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
