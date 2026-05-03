<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#1E3A8A">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'sudbury-cleaning'); ?></a>

<header class="site-header" role="banner">
  <div class="container">
    <?php if (has_custom_logo()): ?>
      <?php the_custom_logo(); ?>
    <?php else: ?>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
        <span class="site-logo__icon"><?php sudbury_print_icon('droplet', 32); ?></span>
        <span class="site-logo__text">
          <?php bloginfo('name'); ?>
          <span class="site-logo__sub"><?php esc_html_e('Cleaning Co.', 'sudbury-cleaning'); ?></span>
        </span>
      </a>
    <?php endif; ?>

    <nav class="primary-nav" aria-label="<?php esc_attr_e('Primary', 'sudbury-cleaning'); ?>">
      <?php
      if (has_nav_menu('primary')) {
          wp_nav_menu([
              'theme_location' => 'primary',
              'container'      => false,
              'depth'          => 2,
          ]);
      } else {
          sudbury_render_fallback_nav();
      }
      ?>
    </nav>

    <div class="header-actions">
      <a class="btn btn--primary btn--sm header-cta" href="<?php echo esc_url(sudbury_quote_url()); ?>">
        <?php echo esc_html(sudbury_setting('hero_cta_text', 'Get a Free Quote')); ?>
      </a>

      <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-drawer" aria-label="<?php esc_attr_e('Toggle menu', 'sudbury-cleaning'); ?>">
        <span class="icon-open"><?php sudbury_print_icon('menu', 22); ?></span>
        <span class="icon-close"><?php sudbury_print_icon('close', 22); ?></span>
      </button>
    </div>
  </div>
</header>

<div id="mobile-drawer" class="mobile-drawer" aria-hidden="true">
  <?php
  if (has_nav_menu('primary')) {
      wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'depth' => 1]);
  } else {
      sudbury_render_fallback_nav();
  }
  ?>
  <a class="btn btn--primary btn--block" href="<?php echo esc_url(sudbury_quote_url()); ?>">
    <?php echo esc_html(sudbury_setting('hero_cta_text', 'Get a Free Quote')); ?>
  </a>
</div>

<main id="main" class="site-main">
