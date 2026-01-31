<?php
/**
 * Search form template
 *
 * @package Saloni
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="input-group">
        <input type="search" class="form-control"
            placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'saloni'); ?>"
            value="<?php echo get_search_query(); ?>" name="s" />
        <div class="input-group-append">
            <button type="submit" class="site-button"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>