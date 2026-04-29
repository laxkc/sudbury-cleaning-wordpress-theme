<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>

  <section class="section section--blue">
    <div class="container">
      <h1><?php the_title(); ?></h1>
    </div>
  </section>

  <section class="section section--white">
    <div class="container">
      <article class="article">
        <div class="article__content">
          <?php the_content(); ?>
        </div>
      </article>
    </div>
  </section>

<?php endwhile; ?>

<?php get_footer(); ?>
