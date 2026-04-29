<?php
/**
 * Pricing teaser — 3 tiers.
 */
if (!defined('ABSPATH')) { exit; }

$tiers = [
    [
        'name'     => __('Standard Clean', 'sudbury-cleaning'),
        'price'    => '$129',
        'unit'     => __('starting / visit', 'sudbury-cleaning'),
        'features' => [__('All living areas + kitchen + bathrooms', 'sudbury-cleaning'), __('Dust, vacuum, mop, sanitize', 'sudbury-cleaning'), __('Trash & recycling out', 'sudbury-cleaning'), __('Up to 3 hours', 'sudbury-cleaning')],
        'featured' => false,
    ],
    [
        'name'     => __('Deep Clean', 'sudbury-cleaning'),
        'price'    => '$249',
        'unit'     => __('starting / visit', 'sudbury-cleaning'),
        'features' => [__('Everything in Standard', 'sudbury-cleaning'), __('Baseboards, vents, light fixtures', 'sudbury-cleaning'), __('Inside microwave & oven', 'sudbury-cleaning'), __('Detailed bathroom scrub', 'sudbury-cleaning'), __('Up to 5 hours', 'sudbury-cleaning')],
        'featured' => true,
    ],
    [
        'name'     => __('Move-Out', 'sudbury-cleaning'),
        'price'    => '$299',
        'unit'     => __('starting / visit', 'sudbury-cleaning'),
        'features' => [__('Everything in Deep Clean', 'sudbury-cleaning'), __('Inside cabinets & drawers', 'sudbury-cleaning'), __('Inside fridge & freezer', 'sudbury-cleaning'), __('Wall spot cleaning', 'sudbury-cleaning'), __('Landlord-ready guarantee', 'sudbury-cleaning')],
        'featured' => false,
    ],
];
?>
<section class="section section--white" aria-labelledby="pricing-heading">
  <div class="container">
    <header class="section__head">
      <span class="section__eyebrow"><?php esc_html_e('Transparent pricing', 'sudbury-cleaning'); ?></span>
      <h2 id="pricing-heading"><?php esc_html_e('Simple, fair prices', 'sudbury-cleaning'); ?></h2>
      <p class="lead"><?php esc_html_e('Final price depends on size and condition. Use the form for an exact quote.', 'sudbury-cleaning'); ?></p>
    </header>

    <div class="price-grid">
      <?php foreach ($tiers as $t): ?>
        <div class="price-card <?php echo $t['featured'] ? 'price-card--featured' : ''; ?>">
          <?php if ($t['featured']): ?><span class="price-card__ribbon"><?php esc_html_e('Most popular', 'sudbury-cleaning'); ?></span><?php endif; ?>
          <h3 class="price-card__name"><?php echo esc_html($t['name']); ?></h3>
          <div class="price-card__price"><?php echo esc_html($t['price']); ?> <small><?php echo esc_html($t['unit']); ?></small></div>
          <ul>
            <?php foreach ($t['features'] as $f): ?>
              <li class="icon-label icon-label--start"><span class="icon-label__icon"><?php nova_print_icon('check', 12); ?></span><span><?php echo esc_html($f); ?></span></li>
            <?php endforeach; ?>
          </ul>
          <a class="btn <?php echo $t['featured'] ? 'btn--primary' : 'btn--outline'; ?>" href="<?php echo esc_url(nova_quote_url()); ?>">
            <?php esc_html_e('Get exact quote', 'sudbury-cleaning'); ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
