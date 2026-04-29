<?php
/**
 * Testimonials — pulls from `testimonial` CPT or shows defaults.
 */
if (!defined('ABSPATH')) { exit; }

$items = get_posts([
    'post_type'      => 'testimonial',
    'posts_per_page' => 3,
    'orderby'        => 'rand',
]);

if (empty($items)) {
    $defaults = [
        ['name' => 'Jennifer M.', 'where' => 'Lively, ON', 'quote' => 'After two failed cleaning services, Sparkle showed up on time, did everything right, and my house has never looked better. Worth every dollar.'],
        ['name' => 'Marc P.',     'where' => 'Garson, ON', 'quote' => 'We use Sparkle for our office every Friday. Reliable, professional, and the team actually pays attention to the small details.'],
        ['name' => 'Sarah K.',    'where' => 'Val Caron', 'quote' => 'Booked a move-out clean to get my deposit back — landlord said it was the cleanest unit he’d seen in 10 years. Highly recommend.'],
    ];
}
?>
<section class="section section--grey" aria-labelledby="testimonials-heading">
  <div class="container">
    <header class="section__head">
      <span class="section__eyebrow"><?php esc_html_e('What clients say', 'sudbury-cleaning'); ?></span>
      <h2 id="testimonials-heading"><?php esc_html_e('Loved by Sudbury homes & businesses', 'sudbury-cleaning'); ?></h2>
    </header>

    <div class="grid grid--3">
      <?php if (!empty($items)): foreach ($items as $t):
          $where = get_post_meta($t->ID, '_nova_testimonial_location', true) ?: '';
      ?>
        <blockquote class="testimonial">
          <p class="testimonial__quote"><?php echo esc_html(wp_strip_all_tags(get_the_content(null, false, $t))); ?></p>
          <div class="testimonial__name"><?php echo esc_html(get_the_title($t)); ?></div>
          <?php if ($where): ?><div class="testimonial__meta"><?php echo esc_html($where); ?></div><?php endif; ?>
        </blockquote>
      <?php endforeach; else: foreach ($defaults as $t): ?>
        <blockquote class="testimonial">
          <p class="testimonial__quote"><?php echo esc_html($t['quote']); ?></p>
          <div class="testimonial__name"><?php echo esc_html($t['name']); ?></div>
          <div class="testimonial__meta"><?php echo esc_html($t['where']); ?></div>
        </blockquote>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
