<?php get_header(); ?>

<section class="section section--blue">
  <div class="container">
    <h1><?php printf(esc_html__('Search results for: %s', 'sudbury-cleaning'), '<em>' . esc_html(get_search_query()) . '</em>'); ?></h1>
  </div>
</section>

<section class="section section--white">
  <div class="container">
    <?php if (have_posts()): ?>
      <div class="blog-grid">
        <?php while (have_posts()): the_post(); ?>
          <article class="blog-card">
            <a class="blog-card__media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
              <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('nova-card', ['loading' => 'lazy', 'alt' => '']); ?>
              <?php else: ?>
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#1E3A8A,#10B981);"></div>
              <?php endif; ?>
            </a>
            <div class="blog-card__body">
              <span class="blog-card__cat"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?></span>
              <h2 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <p class="muted"><?php echo esc_html(nova_excerpt(20)); ?></p>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
      <nav class="pagination"><?php echo paginate_links(['prev_text' => '←', 'next_text' => '→']); ?></nav>
    <?php else: ?>
      <p class="lead"><?php esc_html_e('No results found. Try different keywords.', 'sudbury-cleaning'); ?></p>
      <?php get_search_form(); ?>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
