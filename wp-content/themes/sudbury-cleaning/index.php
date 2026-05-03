<?php get_header(); ?>

<section class="section section--white">
  <div class="container">
    <header class="section__head">
      <h1><?php single_post_title(); ?></h1>
    </header>

    <?php if (have_posts()): ?>
      <div class="blog-grid">
        <?php while (have_posts()): the_post(); ?>
          <article class="blog-card">
            <a class="blog-card__media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
              <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('sudbury-card', ['loading' => 'lazy', 'alt' => '']); ?>
              <?php else: ?>
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#1E3A8A,#10B981);"></div>
              <?php endif; ?>
            </a>
            <div class="blog-card__body">
              <?php $cats = get_the_category(); if (!empty($cats)): ?>
                <span class="blog-card__cat"><?php echo esc_html($cats[0]->name); ?></span>
              <?php endif; ?>
              <h2 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <p class="muted"><?php echo esc_html(sudbury_excerpt(20)); ?></p>
              <div class="blog-card__meta"><?php echo esc_html(get_the_date()); ?></div>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <nav class="pagination" aria-label="<?php esc_attr_e('Posts pagination', 'sudbury-cleaning'); ?>">
        <?php echo paginate_links(['prev_text' => '←', 'next_text' => '→']); ?>
      </nav>
    <?php else: ?>
      <p class="lead"><?php esc_html_e('No posts found yet — check back soon.', 'sudbury-cleaning'); ?></p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
