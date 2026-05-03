<?php
/**
 * Template Name: Contact
 */
get_header();

while (have_posts()): the_post(); ?>

  <section class="section section--blue">
    <div class="container">
      <span class="section__eyebrow"><?php esc_html_e('Get in touch', 'sudbury-cleaning'); ?></span>
      <h1><?php the_title(); ?></h1>
      <p class="lead" style="max-width: 720px;">
        <?php esc_html_e('Tell us about your space and we’ll send you a free, no-obligation quote within one business day.', 'sudbury-cleaning'); ?>
      </p>
    </div>
  </section>

  <section class="section section--white">
    <div class="container">
      <div class="grid grid--2" style="gap: var(--space-7); align-items: start;">
        <div>
          <?php echo do_shortcode('[sparkle_quote_form]'); ?>
        </div>

        <aside class="card" style="background: var(--bg-grey);">
          <h3 style="margin-bottom: var(--space-4);"><?php esc_html_e('Reach us directly', 'sudbury-cleaning'); ?></h3>

          <div class="contact-info">
            <div class="contact-info__item">
              <span class="contact-info__icon"><?php sudbury_print_icon('phone', 18); ?></span>
              <div class="contact-info__body">
                <strong><?php esc_html_e('Phone', 'sudbury-cleaning'); ?></strong><br>
                <a href="<?php echo esc_attr(sudbury_phone_link()); ?>"><?php echo esc_html(sudbury_setting('phone')); ?></a>
              </div>
            </div>

            <div class="contact-info__item">
              <span class="contact-info__icon"><?php sudbury_print_icon('mail', 18); ?></span>
              <div class="contact-info__body">
                <strong><?php esc_html_e('Email', 'sudbury-cleaning'); ?></strong><br>
                <a href="mailto:<?php echo esc_attr(sudbury_setting('email')); ?>"><?php echo esc_html(sudbury_setting('email')); ?></a>
              </div>
            </div>

            <div class="contact-info__item">
              <span class="contact-info__icon"><?php sudbury_print_icon('clock', 18); ?></span>
              <div class="contact-info__body">
                <strong><?php esc_html_e('Hours', 'sudbury-cleaning'); ?></strong><br>
                <?php echo esc_html(sudbury_setting('hours')); ?>
              </div>
            </div>

            <div class="contact-info__item">
              <span class="contact-info__icon"><?php sudbury_print_icon('pin', 18); ?></span>
              <div class="contact-info__body">
                <strong><?php esc_html_e('Service area', 'sudbury-cleaning'); ?></strong><br>
                <?php echo esc_html(sudbury_setting('address')); ?>
              </div>
            </div>
          </div>
        </aside>
      </div>

      <?php if (get_the_content()): ?>
        <div class="article__content" style="margin-top: var(--space-8); max-width: 720px;">
          <?php the_content(); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

<?php endwhile; ?>

<?php get_footer(); ?>
