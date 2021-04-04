<div class="page-entry-header">
  <?php 
  if(is_shop()):
    $thisID = woocommerce_get_page_id('shop');
    $titel = get_field('titel', $thisID);
    $subtitel = get_field('subtitel', $thisID);
    $beschrijving = get_field('beschrijving', $thisID); 
    if( !empty($titel) ) printf('<h1 class="fl-h1">%s</h1>', $titel);
    if( !empty($subtitel) ) printf('<h6 class="fl-h6">%s</h6>', $subtitel);
    if( !empty($beschrijving) ) echo wpautop( $beschrijving );
  ?>
  <?php 
  elseif(is_product_category()): 
    $term = get_queried_object();
    $subtitel = get_field('subtitel', $term);
    $beschrijving = get_field('beschrijving', $term);
    if( !empty($term->name) ) printf('<h1 class="fl-h1">%s</h1>', $term->name);
    if( !empty($subtitel) ) printf('<h6 class="fl-h6">%s</h6>', $subtitel);
    if( !empty($beschrijving) ) echo wpautop( $beschrijving );
  endif;
  ?>
</div>
<div class="secrh-select-cntlr">
    <div class="fl-secrh-cntlr">
      <div class="fl-secrh">
        <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <input type="text" placeholder="Naar welke thee ben jij opzoek?" name="s" value="<?php echo get_search_query(); ?>">
          <button>
            <i><svg class="search-icon" width="21" height="21" viewBox="0 0 21 21" fill="#31304F">
              <use xlink:href="#search-icon"></use> </svg></i>
          </button>
          <input type="hidden" name="post_type" value="product" />
        </form>
      </div>
    </div>
    <div class="xs-filter-btn show-md">
      <i><img src="<?php echo THEME_URI;?>/assets/images/funnel-icon.svg"></i>
      <strong>FILTER</strong>
    </div>
    <div class="fl-select-cntlr">
      <span>Sorteren Op:</span>
      <div class="fl-select">
        <?php do_action('cbv_catalog'); ?>
      </div>
    </div>

    
</div>