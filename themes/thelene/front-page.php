<?php get_header(); ?>
<?php  
  $hbanner = get_field('home_banner', HOMEID);
  if($hbanner):
    $bannerposter = !empty($hbanner['afbeelding'])? cbv_get_image_src( $hbanner['afbeelding'], 'hmbanner' ): '';
?>
<section class="hm-banner plr-37">
  <div class="hm-bnr-bg-img inline-bg" style="background: url('<?php echo $bannerposter; ?>');">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="hm-banner-cntlr">
            <div class="hm-banner-desc">
              <div>
                <h1 class="fl-f1 hm-banner-title">
                <?php 
                  if( !empty($hbanner['titel']) ) printf( '<span>%s</span>', $hbanner['titel'] );
                  if( !empty($hbanner['subtitel']) ) printf( '%s', $hbanner['subtitel'] );
                ?>
               </h1>
                <?php if( !empty($hbanner['beschrijving']) ) echo wpautop( $hbanner['beschrijving'] ); ?>
                <?php 
                  $hbknop = $hbanner['knop'];
                  if( is_array( $hbknop ) &&  !empty( $hbknop['url'] ) ){
                      printf('<div class="hm-banner-btn"><a href="%s" target="%s"><i><svg class="white-right-arrow-icon" width="36" height="18" viewBox="0 0 36 18" fill="#fff"><use xlink:href="#white-right-arrow-icon"></use> </svg></i></a></div>', $hbknop['url'], $hbknop['target']); 
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php  
  $showhide_products = get_field('showhide_products', HOMEID);
  if($showhide_products): 
?>
<section class="hm-products-section">
<?php 
  $hproduct = get_field('homeproduct');
  if( $hproduct ): 
?>
  <span class="hm-pro-section-flower">
    <img src="<?php echo THEME_URI; ?>/assets/images/hm-pro-section-flower.svg">
  </span>
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="sec-entry-hdr hm-product-sec-hdr">
            <?php 
              if( !empty($hproduct['titel']) ) printf('<h2 class="fl-h2 entry-sec-title">%s</h2>', $hproduct['titel']);
              if( !empty($hproduct['beschrijving']) ) echo wpautop( $hproduct['beschrijving'] );
            ?>          </div> 
        </div>
          <?php 
          $productIDS = $hproduct['products'];
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
            $pQuery = new WP_Query(array(
              'post_type' => 'product',
              'posts_per_page'=> 9,
              'orderby' => 'date',
              'order'=> 'desc',

            ));
          }
          if( $pQuery->have_posts() ):
          ?>
        <div class="col-md-12">
          <div class="hm-products-grd-cntlr">
            <div class="hdr-cart show-sm">
              <a href="#">
                <span>4</span>
                <i><svg class="cart-icon" width="30" height="30" viewBox="0 0 30 30" fill="#fff">
                  <use xlink:href="#cart-icon"></use> </svg>
                </i>
              </a>
            </div>
            <div class="hm-product-grds hmProdctGrdsSlider">
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
                $gridtag = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'pgrid' );
              ?>
              <div class="hmProdctGrdsSlideItme">
                <?php 
                  echo '<div class="fl-product-grd mHc">';
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
            <div class="hm-all-products-btn hide-sm">
              <a href="<?php echo get_permalink( get_option( 'woocommerce_shop_page_id' ) );?>" class="fl-btn blg-btn">ALLE PRODUCTEN</a>
            </div>
          </div>
        </div>
        <?php endif; wp_reset_postdata(); ?>
      </div>
  </div> 
<?php endif; ?> 
</section>
<?php endif; ?>
<?php  
  $showhide_cats = get_field('showhide_cats', HOMEID);
  if($showhide_cats): 
    $categories = get_field('product_categories', HOMEID);
    if($categories):
?>
<section class="category-sec plr-37">
  <div class="category-sec-cntrl">
    <ul class="clearfix reset-list">
      <?php foreach( $categories as $cat ):?>
      <li>
        <div class="cate-grid-img">
          <?php 
           if($cat['selecteer_categorie']) printf('<a href="%s" class="overlay-link"></a>', get_term_link($cat['selecteer_categorie'])); 
           if(!empty($cat['afbeelding'])) echo cbv_get_image_tag($cat['afbeelding'], 'hmcat'); 
           if( !empty($cat['titel']) ) printf('<span>%s</span>', $cat['titel']); 
          ?>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>

<?php  
  $showhide_welkom = get_field('showhide_welkom', HOMEID);
  if($showhide_welkom): 
    $welkom = get_field('welkomsec', HOMEID);
    if($welkom):
?>
<section class="welcome-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="welcome-sec-cntlr">

          <div class="welcome-sec-lft">
            <div class="welcome-sec-img-module">
              <?php if(!empty($welkom['afbeelding_1'])){ $afbeelding_1 = cbv_get_image_src($welkom['afbeelding_1']); ?>
              <div class="welcome-sec-img-module-left">
                <div class="img-module-left inline-bg hide-sm" style="background-image:url(<?php echo $afbeelding_1; ?>);"></div>
                <div class="img-module-left inline-bg show-sm" style="background-image:url(<?php echo $afbeelding_1; ?>);"></div>
                <div class="welcome-sec-sqr"></div>
              </div>
              <?php } ?>
              <?php if(!empty($welkom['afbeelding_2'])){ $afbeelding_2 = cbv_get_image_src($welkom['afbeelding_2']); ?>
              <div class="welcome-sec-img-module-rgt">
                <div class="img-module-rgt inline-bg hide-sm" style="background-image:url(<?php echo $afbeelding_2; ?>);"></div>
                <div class="img-module-rgt inline-bg show-sm" style="background-image:url(<?php echo $afbeelding_2; ?>);"></div>
                <span></span>
              </div>
              <?php } ?>
            </div>
          </div>

          <div class="welcome-sec-rgt">
            <div class="welcome-sec-rgt-cntlr">
              <div class="welcome-sec-rgt-des">
                <i>
                  <svg class="wle-sec-icon-svg" width="102" height="64" viewBox="0 0 102 64" fill="#8CCC0C"><use xlink:href="#wle-sec-icon-svg"></use> 
                  </svg>
                </i>
                <?php 
                    if( !empty($welkom['titel']) ) printf('<h2 class="fl-h1 welcome-sec-des-title">%s</h2>', $welkom['titel']); 
                    if( !empty($welkom['beschrijving']) ) echo wpautop($welkom['beschrijving']); 
                    $wknop = $welkom['knop'];
                    if( is_array( $wknop ) &&  !empty( $wknop['url'] ) ){
                        printf('<a class="fl-trnsprnt-btn" href="%s" target="%s">%s</a>', $wknop['url'], $wknop['target'], $wknop['title']); 
                    }
                ?>
              </div>
              <span><img src="<?php echo THEME_URI; ?>/assets/images/wlc-sec-rgt-bg.svg"></span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>

<?php  
  $showhide_blog = get_field('showhide_blog', HOMEID);
  if($showhide_blog): 
    $blog = get_field('blogsec', HOMEID);
    if($blog):
?>
<section class="blog-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="blog-sec-cntrl">
          <div class="sec-entry-hdr blog-sec-hdr">
            <?php 
              if( !empty($blog['titel']) ) printf('<h2 class="fl-h2 entry-sec-title blog-sec-title">%s</h2>', $blog['titel']); 
              if( !empty($blog['beschrijving']) ) echo wpautop($blog['beschrijving']); 
            ?>
          </div> 
            <?php 
            $blogIDS = $blog['selecteer_posts'];
            if( !empty($blogIDS) ){
              $count = count($blogIDS);
              $blogQuery = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page'=> $count,
                'post__in' => $blogIDS,
                'orderby' => 'date',
                'order'=> 'asc',

              ));
                  
            }else{
              $blogQuery = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page'=> 9,
                'orderby' => 'date',
                'order'=> 'desc',

              ));
            }
            if( $blogQuery->have_posts() ):
            ?>
          <div class="blog-grids-cntrl">
            <div class="blg-grds-item">
              <div class="blg-grd-items BlogGridSlider">
              <?php 
                  while($blogQuery->have_posts()): $blogQuery->the_post(); 
                  global $post;
                  $blogimgID = get_post_thumbnail_id(get_the_ID());
                  $blog_imgsrc = !empty($blogimgID)? cbv_get_image_src($imgID, 'blog_grid'): THEME_URI.'/assets/images/blog-img-teapot.jpg';
                ?>
                <div class="BlogGridSlide">
                  <div class="blog-grd-itm">
                    <div class="blog-grd-img">
                      <a href="<?php the_permalink(); ?>" class="overlay-link"></a>
                      <div class="bgi-img inline-bg" style="background-image: url('<?php echo $blog_imgsrc; ?>');">                  
                      </div>
                    </div>  
                    <div class="blog-grd-des mHc">
                      <h5 class="fl-h5 bgi-title mHc1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                      <span class="post-date"><?php echo get_the_date('d F Y'); ?></span>
                      <div class="bgi-des mHc2">
                        <?php the_excerpt(); ?>
                      </div>  
                      <a href="<?php the_permalink(); ?>" class="fl-trnsprnt-btn">LEES MEER</a>
                    </div>  
                  </div>
                </div>  
                <?php endwhile; ?>
              </div>
              <?php 
                $blgknop = $blog['knop'];
                if( is_array( $blgknop ) &&  !empty( $blgknop['url'] ) ){
                    printf('<div class="more-btn"><a class="fl-btn blg-btn" href="%s" target="%s">%s</a></div>', $blgknop['url'], $blgknop['target'], $blgknop['title']); 
                }
              ?>
            </div>
          </div>
          <?php endif; wp_reset_postdata(); ?>
        </div>
      </div>  
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>