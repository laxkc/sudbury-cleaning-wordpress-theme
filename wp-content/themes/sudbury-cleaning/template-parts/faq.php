<?php
/**
 * FAQ accordion. Accepts $args['topic'] (slug) to filter; defaults to homepage set.
 */
if (!defined('ABSPATH')) { exit; }

$args = $args ?? [];
$topic = $args['topic'] ?? '';
$limit = $args['limit'] ?? 6;

$query_args = [
    'post_type'      => 'faq',
    'posts_per_page' => $limit,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
];
if ($topic) {
    $query_args['tax_query'] = [[
        'taxonomy' => 'faq_topic',
        'field'    => 'slug',
        'terms'    => $topic,
    ]];
}

$faqs = get_posts($query_args);

if (empty($faqs)) {
    $faqs_fallback = [
        ['q' => __('Are your cleaners insured and bonded?', 'sudbury-cleaning'),         'a' => __('Yes — we carry full liability insurance and are WSIB compliant. Every cleaner is background-checked before joining our team.', 'sudbury-cleaning')],
        ['q' => __('What products do you use?', 'sudbury-cleaning'),                     'a' => __('We use eco-friendly, plant-based products that are safe for kids, pets, and Northern Ontario waterways. Specific product allergies? Tell us in the form.', 'sudbury-cleaning')],
        ['q' => __('Do I need to be home during the cleaning?', 'sudbury-cleaning'),     'a' => __('Not at all. Most clients give us a key or door code. We re-lock and confirm by text when we leave.', 'sudbury-cleaning')],
        ['q' => __('How quickly can you book me in?', 'sudbury-cleaning'),               'a' => __('Same-week openings are common. For move-out cleans, please book at least 5 days ahead.', 'sudbury-cleaning')],
        ['q' => __('What’s your satisfaction guarantee?', 'sudbury-cleaning'),           'a' => __('If you’re not happy with anything we cleaned, call within 24 hours and we’ll come back to fix it — free.', 'sudbury-cleaning')],
        ['q' => __('Do you serve [my neighborhood]?', 'sudbury-cleaning'),               'a' => __('We cover Greater Sudbury, Lively, Val Caron, Garson, Lockerby, Hanmer and surrounding areas. Not sure? Send us a message.', 'sudbury-cleaning')],
    ];
}
?>
<section class="section section--white" aria-labelledby="faq-heading">
  <div class="container" style="max-width: 820px;">
    <header class="section__head">
      <span class="section__eyebrow"><?php esc_html_e('Frequently asked', 'sudbury-cleaning'); ?></span>
      <h2 id="faq-heading"><?php esc_html_e('Questions, answered', 'sudbury-cleaning'); ?></h2>
    </header>

    <div class="faq-list">
      <?php
      $idx = 0;
      if ($faqs):
          foreach ($faqs as $f):
              $idx++;
              $panel_id = 'faq-panel-' . $idx;
      ?>
        <div class="faq-item">
          <button class="faq-q" aria-expanded="false" aria-controls="<?php echo esc_attr($panel_id); ?>">
            <span><?php echo esc_html(get_the_title($f)); ?></span>
          </button>
          <div id="<?php echo esc_attr($panel_id); ?>" class="faq-a" hidden>
            <?php echo wp_kses_post(apply_filters('the_content', $f->post_content)); ?>
          </div>
        </div>
      <?php endforeach; else: foreach ($faqs_fallback as $f): $idx++; $panel_id = 'faq-panel-' . $idx; ?>
        <div class="faq-item">
          <button class="faq-q" aria-expanded="false" aria-controls="<?php echo esc_attr($panel_id); ?>">
            <span><?php echo esc_html($f['q']); ?></span>
          </button>
          <div id="<?php echo esc_attr($panel_id); ?>" class="faq-a" hidden>
            <p><?php echo esc_html($f['a']); ?></p>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</section>
