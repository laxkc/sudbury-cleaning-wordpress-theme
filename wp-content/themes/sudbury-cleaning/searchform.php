<?php
/**
 * Search form.
 */
?>
<form class="form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="form-field">
    <label class="screen-reader-text" for="s"><?php esc_html_e('Search', 'sudbury-cleaning'); ?></label>
    <input id="s" name="s" type="search" placeholder="<?php esc_attr_e('Search the site…', 'sudbury-cleaning'); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
  </div>
  <button type="submit" class="btn btn--outline"><?php esc_html_e('Search', 'sudbury-cleaning'); ?></button>
</form>
