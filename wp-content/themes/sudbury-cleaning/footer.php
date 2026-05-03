</main>

<footer class="site-footer" role="contentinfo">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" style="margin-bottom: 1rem;">
          <span class="site-logo__icon"><?php sudbury_print_icon('droplet', 32); ?></span>
          <span class="site-logo__text">
            <?php bloginfo('name'); ?>
            <span class="site-logo__sub"><?php esc_html_e('Cleaning Co.', 'sudbury-cleaning'); ?></span>
          </span>
        </a>
        <p><?php echo esc_html(sudbury_setting('tagline')); ?></p>
        <ul class="social-list" aria-label="<?php esc_attr_e('Social links', 'sudbury-cleaning'); ?>">
          <?php
          $socials = [
              'facebook'  => sudbury_setting('social_facebook'),
              'instagram' => sudbury_setting('social_instagram'),
              'google'    => sudbury_setting('social_google'),
          ];
          foreach ($socials as $name => $url) {
              if (empty($url)) { continue; }
              printf(
                  '<li><a href="%s" rel="noopener" aria-label="%s">%s</a></li>',
                  esc_url($url),
                  esc_attr(ucfirst($name)),
                  sudbury_icon($name, 18)
              );
          }
          ?>
        </ul>
      </div>

      <div class="footer-col">
        <h4><?php esc_html_e('Services', 'sudbury-cleaning'); ?></h4>
        <ul>
          <?php
          $services = get_posts(['post_type' => 'service', 'posts_per_page' => 6, 'orderby' => 'menu_order title', 'order' => 'ASC']);
          if ($services) {
              foreach ($services as $svc) {
                  printf('<li><a href="%s">%s</a></li>', esc_url(get_permalink($svc)), esc_html(get_the_title($svc)));
              }
          } else {
              foreach (sudbury_default_services() as $svc) {
                  printf('<li><a href="%s">%s</a></li>', esc_url(home_url('/services/')), esc_html($svc['title']));
              }
          }
          ?>
        </ul>
      </div>

      <div class="footer-col">
        <h4><?php esc_html_e('Service Areas', 'sudbury-cleaning'); ?></h4>
        <ul>
          <?php
          foreach (sudbury_default_areas() as $a) {
              printf('<li><a href="%s">%s</a></li>',
                  esc_url(home_url('/service-areas/' . $a['slug'] . '/')),
                  esc_html($a['name'])
              );
          }
          ?>
        </ul>
      </div>

      <div class="footer-col">
        <h4><?php esc_html_e('Contact', 'sudbury-cleaning'); ?></h4>
        <ul>
          <li><a href="<?php echo esc_attr(sudbury_phone_link()); ?>"><?php echo esc_html(sudbury_setting('phone')); ?></a></li>
          <li><a href="mailto:<?php echo esc_attr(sudbury_setting('email')); ?>"><?php echo esc_html(sudbury_setting('email')); ?></a></li>
          <li><?php echo esc_html(sudbury_setting('hours')); ?></li>
          <li><?php echo esc_html(sudbury_setting('address')); ?></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo esc_html(date('Y')); ?> <?php echo esc_html(sudbury_setting('footer_copyright')); ?>. <?php esc_html_e('All rights reserved.', 'sudbury-cleaning'); ?></p>
      <?php
      if (has_nav_menu('footer')) {
          wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'depth' => 1, 'menu_class' => 'footer-bottom__nav']);
      }
      ?>
    </div>
  </div>
</footer>

<div class="bottom-cta" role="region" aria-label="<?php esc_attr_e('Quick contact', 'sudbury-cleaning'); ?>">
  <a class="btn btn--outline" href="<?php echo esc_attr(sudbury_phone_link()); ?>">
    <span class="icon-label__icon"><?php sudbury_print_icon('phone', 14); ?></span>
    <span class="screen-reader-text"><?php esc_html_e('Call', 'sudbury-cleaning'); ?></span>
    <span aria-hidden="true"><?php esc_html_e('Call', 'sudbury-cleaning'); ?></span>
  </a>
  <a class="btn btn--primary" href="<?php echo esc_url(sudbury_quote_url()); ?>">
    <span><?php echo esc_html(sudbury_setting('hero_cta_text', 'Get a Free Quote')); ?></span>
  </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
