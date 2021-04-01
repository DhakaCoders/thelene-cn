<?php 
/*Template Name: Over Ons*/
get_header();
$thisID = get_the_ID(); 
get_template_part('templates/breadcrumbs');
?>
<?php  
  $intro = get_field('introsec', $thisID);
  if($intro):
    $introimg = !empty($intro['afbeelding'])? cbv_get_image_src( $intro['afbeelding'] ): '';
?>
<section class="over-ons-intro-section">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="over-ons-intro-sec-cntlr">
            <div class="over-ons-intro-sec-des">
              <div class="over-ons-intro-sec-des-cntlr">
                <?php 
                  if( !empty($intro['titel']) ) printf( '<h1 class="over-ons-intro-sec-title fl-h1">%s</h1>', $intro['titel'] );
                  if( !empty($intro['subtitel']) ) printf( '<h5 class="over-ons-intro-sub-title">%s</h5>', $intro['subtitel'] );
                  if( !empty($intro['beschrijving']) ) echo wpautop( $intro['beschrijving'] );
                ?>
              </div>
            </div>
            <div class="over-ons-intro-sec-img-module">
              <div class="over-ons-intro-sec-img-mdul-cntlr">
                <div class="over-ons-intro-mdul-img inline-bg" style="background-image:url(<?php echo $introimg; ?>);"></div>
                <div class="over-ons-intro-sqr"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>    
</section>
<?php endif; ?>
<?php  
  $showhide_intro2 = get_field('showhide_intro2', $thisID);
  if($showhide_intro2): 
    $welkom = get_field('introsec2', $thisID);
    if($welkom):
?>
<section class="welcome-sec over-ons-welcom-sec">
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
  $showhide_intro3 = get_field('showhide_intro3', $thisID);
  if($showhide_intro3): 
    $intro3 = get_field('introsec3', $thisID);
    if($intro3):
?>
<section class="over-ons-intro2-section">
  <div class="container">
      <div class="row">
        <div class="col-md-12">

          <div class="over-ons-intro2-sec-cntlr">

            <div class="over-ons-intro2-sec-des">
              <div class="over-ons-intro2-sec-des-cntlr">
              <?php 
                  if( !empty($intro3['titel']) ) printf('<h2 class="over-ons-intro2-sec-title fl-h2">%s</h2>', $intro3['titel']); 
                  if( !empty($intro3['beschrijving']) ) echo wpautop($intro3['beschrijving']); 
              ?>
              </div>
            </div>

            <div class="over-ons-intro2-sec-img-module">
              <div class="over-ons-intro2-sec-img-mdul-cntlr">
                <?php if(!empty($intro3['afbeelding_1'])){ $in_afbeelding_1 = cbv_get_image_src($intro3['afbeelding_1']); ?>
                <div class="over-ons-intro2-lft-mdul-img-cntlr">
                  <div class="over-ons-intro2-lft-mdul-img inline-bg" style="background-image:url(<?php echo $in_afbeelding_1; ?>);"></div>
                </div>
                <?php } ?>
                <?php if(!empty($intro3['afbeelding_2'])){ $in_afbeelding_2 = cbv_get_image_src($intro3['afbeelding_2']); ?>
                <div class="over-ons-intro2-rgt-mdul-img-cntlr">
                  <div class="over-ons-intro2-rgt-mdul-img inline-bg" style="background-image:url(<?php echo $in_afbeelding_2; ?>);"></div>
                </div>
                <?php } ?>
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
  $showhide_cta = get_field('showhide_cta', $thisID);
  if($showhide_cta): 
    $cta = get_field('ctasec', $thisID);
    if($cta):
?>
<section class="over-ons-cta-module-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
         <div class="dfp-cta-module clearfix">
            <div class="cta-ctlr inline-bg" style="background-image: url('<?php echo THEME_URI; ?>/assets/images/cta-bg.jpg');">
              <?php 
                  if( !empty($cta['titel']) ) printf('<h4 class="cta-title fl-h4">%s</h4>', $cta['titel']); 
                  if( !empty($cta['beschrijving']) ) echo wpautop($cta['beschrijving']); 
                  $ctaknop = $cta['knop'];
                  if( is_array( $ctaknop ) &&  !empty( $ctaknop['url'] ) ){
                      printf('<div class="cta-btn"><a class="fl-trnsprnt-btn" href="%s" target="%s">%s</a></div>', $ctaknop['url'], $ctaknop['target'], $ctaknop['title']); 
                  }
              ?>
            </div>
          </div> 
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>