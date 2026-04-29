<?php
/**
 * Template Name: Thank You
 */
get_header();

while (have_posts()): the_post(); ?>

  <section class="section section--white" style="text-align:center; padding-block: var(--space-9);">
    <div class="container" style="max-width: 640px;">
      <div class="icon-xl" style="color: var(--brand-mint); margin-bottom: var(--space-4);">
        <?php nova_print_icon('sparkle'); ?>
      </div>
      <h1><?php the_title(); ?></h1>
      <div class="article__content">
        <?php
        if (get_the_content()) {
            the_content();
        } else {
            echo '<p class="lead">' . esc_html__('Thanks for reaching out — we received your request and will reply within one business day.', 'sudbury-cleaning') . '</p>';
        }
        ?>
      </div>
      <div class="cta-banner__actions" style="margin-top: var(--space-6);">
        <a class="btn btn--primary btn--lg" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back home', 'sudbury-cleaning'); ?></a>
      </div>
    </div>
  </section>

<?php endwhile; ?>

<?php get_footer(); ?>
