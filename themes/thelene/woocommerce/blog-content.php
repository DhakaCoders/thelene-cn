<?php 
	$blogshop = get_field('blogfor_shop', 'options');
	if( $blogshop ):
?>
<li class="fl-product-grd-2 hide-sm">
	<div class="fl-product-grd mHc" style="">
	  <div class="fl-product-grd-inr">
	  	<?php 
	  		if( !empty($blogshop['titel']) ) printf('<h4 class="fl-h4">%s</h4>', $blogshop['titel']);
	  		if( !empty($blogshop['beschrijving']) ) echo wpautop( $blogshop['beschrijving'] );
	  		if( !empty($blogshop['knop']) ) printf('<a target="_blank" class="fl-trnsprnt-btn" href="%s">%s</a>', $blogshop['knop'], esc_html__( 'MEER INFO', 'woocommerce' ));
	  	?>
	      
	  </div>
	</div>
</li>
<?php endif; ?>