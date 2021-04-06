<?php 
	$cta = get_field('cta', 'options');
	if( $cta ):
?>
<li class="fl-product-grd-full show-sm">
	<div class="dfp-cta-module clearfix">
	<div class="cta-ctlr inline-bg" style="background-image: url('<?php echo THEME_URI; ?>/assets/images/cta-bg.jpg');">
	<?php 
		if( !empty($cta['titel']) ) printf('<h4 class="cta-title fl-h4">%s</h4>', $cta['titel']);
		if( !empty($cta['beschrijving']) ) echo wpautop( $cta['beschrijving'] );
		$knop = $cta['knop'];
		if( is_array( $knop ) &&  !empty( $knop['url'] ) ){
		  printf('<div class="cta-btn"><a href="%s" target="%s">%s</a></div>', $knop['url'], $knop['target'], $knop['title']); 
		}
	?>

	</div>
	</div>
</li>
<?php endif; ?>