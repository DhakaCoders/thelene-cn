<?php 
  $logoObj = get_field('ftlogo', 'options');
  if( is_array($logoObj) ){
    $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
  }else{
    $logo_tag = '';
  }
  $address = get_field('address', 'options');
  $gmurl = get_field('url', 'options');
  $telefoon = get_field('telefoon', 'options');
  $email = get_field('emailadres', 'options');
  $bwt = get_field('btw', 'options');
  $gmaplink = !empty($gmurl)?$gmurl: 'javascript:void()';
  $smedias = get_field('social_media', 'options');
  $copyright_text = get_field('copyright_text', 'options');
?>
<footer class="footer-wrp">
  <div class="ftr-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="ftr-top-inr clearfix">
            <div class="ftr-logo-ctlr">
              <?php if( !empty($logo_tag) ): ?>
              <div class="ftr-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                  <?php echo $logo_tag; ?>
                </a>
              </div>
              <?php endif; ?>
              <?php if(!empty($smedias)):  ?>
              <div class="ftr-social-media hide-sm">
                <ul class="reset-list">
                  <?php foreach($smedias as $smedia): ?>
                  <li>
                    <a target="_blank" href="<?php echo $smedia['url']; ?>">
                        <?php echo $smedia['icon']; ?>
                    </a>
                  </li>
                <?php endforeach; ?>
                </ul>
              </div>
              <?php endif; ?>
            </div>
            <div class="ftr-menu ftr-col-1">
              <h6 class="ftr-menu-title"><?php _e( 'NAVIGATIE', THEME_NAME ); ?></h6>
              <div class="ftr-menu-des">
              <?php 
                $fmenuOptions1 = array( 
                    'theme_location' => 'cbv_fta_menu', 
                    'menu_class' => 'reset-list',
                    'container' => '',
                    'container_class' => ''
                  );
                wp_nav_menu( $fmenuOptions1 );
              ?> 
              </div>
            </div>
            <div class="ftr-menu ftr-col-2 hide-sm">
              <h6 class="ftr-menu-title"><?php _e( 'SHOP', THEME_NAME ); ?></h6>
              <div class="ftr-menu-des">
              <?php 
                $fmenuOptions2 = array( 
                    'theme_location' => 'cbv_ftb_menu', 
                    'menu_class' => 'reset-list',
                    'container' => '',
                    'container_class' => ''
                  );
                wp_nav_menu( $fmenuOptions2 );
              ?> 
              </div>
            </div>
            <div class="ftr-menu ftr-col-3 hide-sm">
              <h6 class="ftr-menu-title"><?php _e( 'ACCOUNT', THEME_NAME ); ?></h6>
              <div class="ftr-menu-des">
                <?php 
                  $fmenuOptions3 = array( 
                      'theme_location' => 'cbv_ftc_menu', 
                      'menu_class' => 'reset-list',
                      'container' => '',
                      'container_class' => ''
                    );
                  wp_nav_menu( $fmenuOptions3 );
                ?> 
              </div>
            </div>
            <div class="ftr-menu ftr-col-4">
              <h6 class="ftr-menu-title"><?php _e( 'CONTACT', THEME_NAME ); ?></h6>
              <div class="ftr-menu-des">
              <?php 
                if( !empty($address) ) printf('<div class="ftr-location"><a href="%s" target="_blank">%s</a></div>', $gmaplink, $address);
                if( !empty($email) ) printf('<div class="ftr-email"><a href="mailto:%s">%s</a></div>', $email, $email); 
                if( !empty($telefoon) ) printf('<div class="ftr-phone"><span>Tel:</span><a href="tel:%s">%s</a></div>', phone_preg($telefoon),  $telefoon); 
                if( !empty($bwt) ) printf('<div class="ftr-vat"><span>BTW: %s</span></div>', $bwt); 
              ?>
              </div>
            </div>
            <?php if(!empty($smedias)):  ?>
            <div class="xs-social-media">
              <div class="ftr-social-media show-sm">
                <ul class="reset-list">
                  <?php foreach($smedias as $smedia): ?>
                  <li>
                    <a target="_blank" href="<?php echo $smedia['url']; ?>">
                        <?php echo $smedia['icon']; ?>
                    </a>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ftr-middle">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="ftr-middle-inr">
            <ul class="reset-list">
              <li><img src="<?php echo THEME_URI; ?>/assets/images/ftr-mdl-01.jpg"></li>
              <li><img src="<?php echo THEME_URI; ?>/assets/images/ftr-mdl-02.jpg"></li>
              <li><img src="<?php echo THEME_URI; ?>/assets/images/ftr-mdl-03.jpg"></li>
              <li><img src="<?php echo THEME_URI; ?>/assets/images/ftr-mdl-04.jpg"></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ftr-btm">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="ftr-btm-inr">
            <div class="ftr-copywrite">
            <?php if( !empty( $copyright_text ) ) printf( '<span>%s</span>', $copyright_text); ?> 
            </div>
            <div class="ftr-btm-menu">
              <?php 
                $copyrightmenu = array( 
                    'theme_location' => 'cbv_copyright_menu', 
                    'menu_class' => 'reset-list',
                    'container' => '',
                    'container_class' => ''
                  );
                wp_nav_menu( $copyrightmenu );
              ?>
            </div>
            <div class="ftr-designby">
              <a href="#">Website laten maken door<strong> Conversal</strong></a>
            </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>