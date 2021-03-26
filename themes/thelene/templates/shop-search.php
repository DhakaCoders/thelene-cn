<div class="sec-entry-hdr">
  <?php 
  if(is_shop()):
    $thisID = woocommerce_get_page_id('shop');
    $titel = get_field('titel', $thisID);
    $beschrijving = get_field('beschrijving', $thisID); 
    if( !empty($titel) ) printf('<h2 class="sec-entry-hdr-title">%s</h2>', $titel);
    if( !empty($beschrijving) ) echo wpautop( $beschrijving );
  ?>
  <?php 
  elseif(is_product_category()): 
    $term = get_queried_object();
    $titel = get_field('custom_titel', $term);
    $beschrijving = get_field('beschrijving', $term); 
    if( !empty($titel) ) printf('<h2 class="sec-entry-hdr-title">%s</h2>', $titel);
    if( !empty($beschrijving) ) echo wpautop( $beschrijving );
  endif;
  ?>
  <form action="" class="bnr-search pro-overview-srch">
    <input type="text" placeholder="Zoeken Producten" name="keyword" value="<?php echo get_search_query(); ?>">
    <button type="submit">
      <i>
        <svg class="bnr-srch-icon-svg" width="30" height="30" viewBox="0 0 30 30" fill="#A61916">
          <use xlink:href="#bnr-srch-icon-svg"></use>
        </svg>
      </i>
    </button>
  </form>
</div>