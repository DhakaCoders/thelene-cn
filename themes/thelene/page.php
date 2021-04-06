<?php 
get_header(); 
$thisID = get_the_ID(); 
if( !is_cart() )
get_template_part('templates/breadcrumbs');
?>
<section class="innerpage-con-wrap">
    <?php if(have_rows('inhoud')){  ?>
    <article class="default-page-con">
    <?php while ( have_rows('inhoud') ) : the_row();  ?>
    <?php 
    if( get_row_layout() == 'introductietekst' ){ 
    $title = get_sub_field('titel');
    $afbeelding = get_sub_field('afbeelding');
    ?>
    <div class="block-955">
    <div class="dfp-promo-module clearfix">
      <?php 
        if( !empty($title) ) printf('<div class="pgTitleBlock"><h1 class="dfp-promo-module-title fl-h1">%s</h1></div>', $title); 
        if( !empty($afbeelding) ){
          echo '<div class="dfp-plate-one-img-bx">'. cbv_get_image_tag($afbeelding).'</div>';
        }
      ?>
    </div>
    </div>
    <?php 
    }elseif( get_row_layout() == 'teksteditor' ){ 
    $beschrijving = get_sub_field('fc_teksteditor');
    ?>
    <div class="block-955">
    <div class="dfp-text-module clearfix">
    <?php if( !empty( $beschrijving ) ) echo wpautop($beschrijving); ?>
    </div>
    </div>
    <?php }elseif( get_row_layout() == 'galerij' ){ 
    $galleries = get_sub_field('fc_afbeeldingen');
    $lightbox = get_sub_field('lightbox');
    $kolom = get_sub_field('kolom');
    if( $galleries ): 
    ?>
    <div class="block-955">
    <div class="gallery-wrap clearfix">
    <div class="gallery gallery-columns-<?php echo $kolom; ?>">
    <?php foreach( $galleries as $image ): ?>
    <figure class="gallery-item">
      <div class="gallery-icon portrait">
        <?php 
          if( $lightbox ){
            echo "<a data-fancybox='gallery' href='{$image['url']}'>";
            echo cbv_get_image_tag( $image, 'dfpageg1' );
            echo "</a>";
          }else{
            echo cbv_get_image_tag( $image, 'dfpageg1' );
          }
        ?>
      </div>
    </figure>
    <?php endforeach; ?>
    </div>
    </div>
    </div>
    <?php endif; ?>
    <?php }elseif( get_row_layout() == 'poster' ){     
    $poster = get_sub_field('afbeeldingen');
    $video_url = get_sub_field('fc_videourl');
    $postersrc = !empty($poster)? cbv_get_image_src($poster, 'dft_poster'): '';
    ?> 
    <div class="block-955">
    <div class="ac-fancy-module" >
    <div class="fancy-img inline-bg" style="background-image: url(<?php echo $postersrc; ?>);"></div>
    <?php if( $video_url ): ?>
    <a class="overlay-link" data-fancybox href="<?php echo $video_url; ?>"></a>
    <div class="fancy-border"></div>
    <span class="ms-video-play-cntlr">
      <i><img src="<?php echo THEME_URI; ?>/assets/images/play-icon.svg" alt=""></i>
    </span>
    <?php endif; ?>
    </div>
    </div>

    <?php }elseif( get_row_layout() == 'cta' ){ 
    $fc_titel = get_sub_field('fc_titel');
    $fc_tekst = get_sub_field('fc_tekst');
    $fc_knop = get_sub_field('fc_knop');
    ?>
    <div class="block-955">
    <div class="dfp-cta-module clearfix">
    <div class="cta-ctlr inline-bg" style="background-image: url('<?php echo THEME_URI; ?>/assets/images/cta-bg.jpg');">
      <?php 
         if( !empty($fc_titel) ) printf('<h4 class="cta-title fl-h4">%s</h4>', $fc_titel);
        if( !empty($fc_tekst) ) echo wpautop( $fc_tekst );

        if( is_array( $fc_knop ) &&  !empty( $fc_knop['url'] ) ){
          printf('<div class="cta-btn"><a class="fl-trnsprnt-btn" href="%s" target="%s">%s</a></div>', $fc_knop['url'], $fc_knop['target'], $fc_knop['title']); 
        }
      ?>
    </div>
    </div>
    </div>
    <?php }elseif( get_row_layout() == 'products' ){
    $productIDS = get_sub_field('fc_products');
    if( !empty($productIDS) ){
    $count = count($productIDS);
    $pIDS = ( $count > 1 )? $productIDS: $productIDS;
    $pQuery = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page'=> $count,
    'post__in' => $pIDS,
    'orderby' => 'date',
    'order'=> 'asc',

    ));

    }else{
    $pQuery = new WP_Query(array());
    }
    if( $pQuery->have_posts() ):
    ?>
    <div class="block-1440">
    <div class="hm-product-module hide-sm">
    <div class="hm-product-grds clearfix">
    <?php 
      while($pQuery->have_posts()): $pQuery->the_post(); 
      global $product, $woocommerce, $post;
      switch ( $product->get_type() ) {
      case "pw-gift-card" :
        $label  = __('selecteer bedrag', 'woocommerce');
      break;
      default :
        $label  = __('MEER INFO', 'woocommerce');
      break;
      }
      $seller_flash = get_field('seller_flash', $product->get_id());
      $gridtag = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'pgrid' );
    ?>
      <div class="hmProdctGrdsSlideItme">
        <?php 
          echo '<div class="fl-product-grd mHc">';
          if( !empty($seller_flash) ) printf('<span class="seller-flash">%s</span>', $seller_flash); 
          wc_get_template_part('loop/sale-flash');
          echo '<div class="fl-product-grd-inr">';
          echo '<div class="fl-pro-grd-img-cntlr mHc1">';
          echo '<a class="overlay-link" href="'.get_permalink( $product->get_id() ).'"></a>';
          echo $gridtag;
          echo '</div>';/*end loop image*/
          echo '<h3 class="fl-h5 mHc2 fl-pro-grd-title"><a href="'.get_permalink( $product->get_id() ).'">'.get_the_title().'</a></h3>';
          echo '<div class="fl-pro-grd-price">';
          echo $product->get_price_html();
          echo '</div>';/*end loop price*/
          echo '<div><a class="fl-trnsprnt-btn" href="'.get_permalink( $product->get_id() ).'">'.$label.'</a></div>';
          echo '</div>';
          echo '</div>';
        ?>
      </div>
    <?php endwhile; ?>
    </div>
    </div>
    </div>
    <?php endif; wp_reset_postdata(); ?>
    <?php }elseif( get_row_layout() == 'table' ){
    $fc_table = get_sub_field('fc_tafel');
    $fc_titel = !empty(get_sub_field('fc_titel'))?get_sub_field('fc_titel'):'';
    echo '<div class="block-955">';
    cbv_table($fc_table, $fc_titel);
    echo '</div>';
    ?>
    <?php }elseif( get_row_layout() == 'afbeeldingen_slider' ){ 
    $fc_afbeeldingen = get_sub_field('afbeeldingen');
    if( $fc_afbeeldingen ):
    ?>
    <div class="block-955">
    <div class="dfp-slider-module">
    <div class="dfp-slider-ctlr">
    <div class="dfp-slider dfpSlider">
      <?php 
        foreach( $fc_afbeeldingen as $fcafbeeldingID ): 
        $fcslideImg = !empty($fcafbeeldingID)? cbv_get_image_tag( $fcafbeeldingID, 'about_slide' ):''; 
      ?>
      <div class="dfp-slider-grd">
        <div class="dfp-slider-grd-img">
          <?php echo $fcslideImg; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    </div>
    </div>
    <hr>
    </div>
    <?php endif; ?>
    <?php }elseif( get_row_layout() == 'afbeelding' ){ 
        $afbeelding1 = get_sub_field('fc_afbeelding1');
        $afbeelding2 = get_sub_field('fc_afbeelding2');
        $fullafbeelding = get_sub_field('fc_full_afbeelding');
    ?>
    <div class="block-955">
      <div class="gallery-wrap clearfix">
        <div class="gallery gallery-columns-2">
          <?php if( !empty($afbeelding1) ): ?>
          <figure class="gallery-item">
            <div class="gallery-icon portrait">
              <?php echo cbv_get_image_tag($afbeelding1, 'about_gallery'); ?>
            </div>
          </figure>
          <?php endif; ?>
          <?php if( !empty($afbeelding2) ): ?>
          <figure class="gallery-item">
            <div class="gallery-icon portrait">
              <?php echo cbv_get_image_tag($afbeelding2, 'about_gallery'); ?>
            </div>
          </figure>
          <?php endif; ?>
        </div>
      </div>
      <?php if( !empty($fullafbeelding) ): ?>
      <div class="dfp-single-img-module">
        <div class="dfp-single-img">
          <?php echo cbv_get_image_tag($fullafbeelding, 'verblijf_full'); ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php }elseif( get_row_layout() == 'fcknop' ){
    $zwart_knop = get_sub_field('zwart_knop');
    $witte_knop = get_sub_field('witte_knop');
    ?> 
    <div class="block-955">
      <div class="dfp-btn-module">
        <?php 
        if( is_array( $zwart_knop ) &&  !empty( $zwart_knop['url'] ) ){
          printf('<div class="dfp-btn-int"><a class="fl-blue-btn pb-bg" href="%s" target="%s">%s</a></div>', $zwart_knop['url'], $zwart_knop['target'], $zwart_knop['title']); 
        }
        if( is_array( $witte_knop ) &&  !empty( $witte_knop['url'] ) ){
          printf('<div class="dfp-btn-int"><a class="fl-trnsprnt-btn" href="%s" target="%s">%s</a></div>', $witte_knop['url'], $witte_knop['target'], $witte_knop['title']); 
        }
        ?>
      </div>
    </div>
    <?php }elseif( get_row_layout() == 'notify_bar' ){
    $fc_titel = get_sub_field('fc_titel');
    ?>
    <div class="block-955">
      <div class="dfp-con-bar-module">
        <div class="pn-con-bar">
          <?php if( !empty($fc_titel) ): ?>
            <i><img src="<?php echo THEME_URI; ?>/assets/images/pn-con-bar-icon.svg"></i>
            <strong><?php echo $fc_titel; ?></strong>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php }elseif( get_row_layout() == 'gap' ){
    $fc_gap = get_sub_field('fc_gap');
    ?>
    <div class="block-955">
    <div style="height:<?php echo $fc_gap; ?>px"></div>
    </div>
    <?php }elseif( get_row_layout() == 'horizontal_line' ){ ?>
    <div class="block-955">
    <hr>
    </div>
    <?php } ?>
    <?php endwhile; ?>
    </article>
    <?php }else{ ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <article class="default-page-con">
            <?php if( is_account_page() && !is_user_logged_in()){ ?>
            <div class="page-title">
            <h1><?php the_title(); ?></h1>
            </div>
            <?php }elseif( !is_account_page() && !is_checkout()){ ?>
            <div class="page-title">
            <h1><?php the_title(); ?></h1>
            </div>
            <?php } ?>
            <?php the_content(); ?>
          </article>
        </div>
      </div>
    </div>
    <?php } ?>
</section>
<?php get_footer(); ?>