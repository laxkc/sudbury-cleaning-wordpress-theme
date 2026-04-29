<?php
/**
 * Template Name: Pricing
 */
get_header();

while (have_posts()): the_post(); ?>

  <section class="section section--blue">
    <div class="container">
      <span class="section__eyebrow"><?php esc_html_e('Pricing', 'sudbury-cleaning'); ?></span>
      <h1><?php the_title(); ?></h1>
      <p class="lead" style="max-width: 720px;">
        <?php esc_html_e('Honest, transparent prices. Final cost depends on size, condition, and frequency — use the form for an exact quote.', 'sudbury-cleaning'); ?>
      </p>
    </div>
  </section>

  <?php get_template_part('template-parts/pricing-preview'); ?>

  <section class="section section--grey">
    <div class="container">
      <header class="section__head">
        <h2><?php esc_html_e('What affects your price', 'sudbury-cleaning'); ?></h2>
      </header>

      <div class="why-grid">
        <div class="why-item">
          <span class="icon-label__icon"><?php nova_print_icon('home', 16); ?></span>
          <div>
            <h4><?php esc_html_e('Size of your space', 'sudbury-cleaning'); ?></h4>
            <p class="muted"><?php esc_html_e('Square footage and number of rooms.', 'sudbury-cleaning'); ?></p>
          </div>
        </div>
        <div class="why-item">
          <span class="icon-label__icon"><?php nova_print_icon('spray', 16); ?></span>
          <div>
            <h4><?php esc_html_e('Condition', 'sudbury-cleaning'); ?></h4>
            <p class="muted"><?php esc_html_e('First-time deep cleans take longer than maintenance visits.', 'sudbury-cleaning'); ?></p>
          </div>
        </div>
        <div class="why-item">
          <span class="icon-label__icon"><?php nova_print_icon('clock', 16); ?></span>
          <div>
            <h4><?php esc_html_e('Frequency', 'sudbury-cleaning'); ?></h4>
            <p class="muted"><?php esc_html_e('Weekly 15% off · Bi-weekly 10% · Monthly 5%.', 'sudbury-cleaning'); ?></p>
          </div>
        </div>
        <div class="why-item">
          <span class="icon-label__icon"><?php nova_print_icon('check', 16); ?></span>
          <div>
            <h4><?php esc_html_e('Add-ons', 'sudbury-cleaning'); ?></h4>
            <p class="muted"><?php esc_html_e('Inside oven, fridge, windows, laundry — pay only for what you need.', 'sudbury-cleaning'); ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section section--white">
    <div class="container" style="max-width: 760px;">
      <header class="section__head">
        <h2><?php esc_html_e('Get your exact price', 'sudbury-cleaning'); ?></h2>
      </header>
      <?php echo do_shortcode('[sparkle_quote_form]'); ?>
    </div>
  </section>

  <?php if (get_the_content()): ?>
    <section class="section section--grey">
      <div class="container article">
        <div class="article__content"><?php the_content(); ?></div>
      </div>
    </section>
  <?php endif; ?>

<?php endwhile; ?>

<?php get_template_part('template-parts/cta-banner'); ?>
<?php get_footer(); ?>
