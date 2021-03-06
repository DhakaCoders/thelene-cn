<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
<head> 
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $favicon = get_theme_mod('favicon'); if(!empty($favicon)) { ?> 
  <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
  <?php } ?>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->	
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="bdoverlay"></div>
  <svg style="display: none;">
    <!-- <svg class="id-name" width="16" height="16" viewBox="0 0 16 16" fill="#FF5C26">
      <use xlink:href="#id-name"></use> </svg> -->
      <!-- start of Noyon -->
      <symbol id="user-icon" width="20" height="24" viewBox="0 0 20 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.75 10.5C10.7884 10.5 11.8034 10.1921 12.6667 9.61522C13.5301 9.03834 14.203 8.2184 14.6004 7.25909C14.9977 6.29978 15.1017 5.24418 14.8991 4.22578C14.6966 3.20738 14.1965 2.27192 13.4623 1.53769C12.7281 0.803466 11.7926 0.303452 10.7742 0.10088C9.75583 -0.101693 8.70023 0.00227474 7.74091 0.399635C6.7816 0.796995 5.96166 1.4699 5.38478 2.33326C4.80791 3.19662 4.5 4.21165 4.5 5.25C4.5 6.64239 5.05312 7.97775 6.03769 8.96232C7.02226 9.94688 8.35761 10.5 9.75 10.5ZM9.75 1.5C10.4917 1.5 11.2167 1.71994 11.8334 2.13199C12.4501 2.54405 12.9307 3.12972 13.2146 3.81494C13.4984 4.50016 13.5726 5.25416 13.4279 5.98159C13.2833 6.70902 12.9261 7.37721 12.4017 7.90166C11.8772 8.4261 11.209 8.78326 10.4816 8.92795C9.75416 9.07265 9.00016 8.99838 8.31494 8.71455C7.62971 8.43073 7.04404 7.95008 6.63199 7.33339C6.21993 6.71671 6 5.99168 6 5.25C6 4.25544 6.39509 3.30161 7.09835 2.59835C7.80161 1.89509 8.75544 1.5 9.75 1.5Z"/>
        <path d="M9.75 12C7.16536 12.004 4.68771 13.0325 2.86009 14.8601C1.03247 16.6877 0.00396723 19.1654 0 21.75C7.96647e-05 22.2984 0.0502884 22.8457 0.15 23.385C0.181503 23.5572 0.272227 23.7129 0.406459 23.8252C0.540691 23.9375 0.709978 23.9994 0.885001 24H18.615C18.79 23.9994 18.9593 23.9375 19.0935 23.8252C19.2278 23.7129 19.3185 23.5572 19.35 23.385C19.4497 22.8457 19.4999 22.2984 19.5 21.75C19.496 19.1654 18.4675 16.6877 16.6399 14.8601C14.8123 13.0325 12.3346 12.004 9.75 12ZM17.97 22.5H1.47C1.45749 22.2502 1.45749 21.9998 1.47 21.75C1.47 19.562 2.3392 17.4635 3.88637 15.9164C5.43355 14.3692 7.53197 13.5 9.72 13.5C11.908 13.5 14.0065 14.3692 15.5536 15.9164C17.1008 17.4635 17.97 19.562 17.97 21.75C17.9825 21.9998 17.9825 22.2502 17.97 22.5Z"/>
      </symbol>

      <symbol id="cart-icon" width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
        <path d="M14.9998 0.9375C13.508 0.9375 12.0773 1.53013 11.0224 2.58502C9.96747 3.63992 9.37483 5.07066 9.37483 6.5625V7.5H8.59671C7.80744 7.49917 7.04827 7.80278 6.47723 8.34762C5.90619 8.89247 5.56729 9.63656 5.53108 10.425L4.79046 25.8469C4.77147 26.2616 4.83666 26.6758 4.98208 27.0647C5.1275 27.4535 5.35014 27.8089 5.6366 28.1093C5.92305 28.4098 6.26738 28.6492 6.64883 28.813C7.03028 28.9768 7.44095 29.0617 7.85608 29.0625H22.1436C22.5587 29.0617 22.9694 28.9768 23.3508 28.813C23.7323 28.6492 24.0766 28.4098 24.3631 28.1093C24.6495 27.8089 24.8722 27.4535 25.0176 27.0647C25.163 26.6758 25.2282 26.2616 25.2092 25.8469L24.4686 10.425C24.4324 9.63656 24.0935 8.89247 23.5224 8.34762C22.9514 7.80278 22.1922 7.49917 21.403 7.5H20.6248V6.5625C20.6248 5.07066 20.0322 3.63992 18.9773 2.58502C17.9224 1.53013 16.4917 0.9375 14.9998 0.9375ZM11.2498 6.5625C11.2498 5.56794 11.6449 4.61411 12.3482 3.91085C13.0514 3.20759 14.0053 2.8125 14.9998 2.8125C15.9944 2.8125 16.9482 3.20759 17.6515 3.91085C18.3547 4.61411 18.7498 5.56794 18.7498 6.5625V7.5H11.2498V6.5625ZM22.5936 10.5094L23.3342 25.9406C23.3401 26.1019 23.3141 26.2627 23.2578 26.4139C23.2015 26.5651 23.116 26.7037 23.0061 26.8219C22.8939 26.9371 22.7598 27.0288 22.6117 27.0916C22.4636 27.1544 22.3044 27.187 22.1436 27.1875H7.85608C7.69523 27.187 7.53609 27.1544 7.38799 27.0916C7.23989 27.0288 7.10581 26.9371 6.99358 26.8219C6.88368 26.7037 6.79814 26.5651 6.74184 26.4139C6.68554 26.2627 6.65958 26.1019 6.66546 25.9406L7.40608 10.5094C7.42055 10.2035 7.55235 9.91487 7.77409 9.70361C7.99583 9.49235 8.29044 9.37466 8.59671 9.375H21.403C21.7092 9.37466 22.0038 9.49235 22.2256 9.70361C22.4473 9.91487 22.5791 10.2035 22.5936 10.5094Z"/>
        <path d="M10.6498 12.3656C11.1676 12.3656 11.5873 11.9459 11.5873 11.4281C11.5873 10.9103 11.1676 10.4906 10.6498 10.4906C10.1321 10.4906 9.71232 10.9103 9.71232 11.4281C9.71232 11.9459 10.1321 12.3656 10.6498 12.3656Z"/>
        <path d="M19.3499 12.3656C19.8676 12.3656 20.2874 11.9459 20.2874 11.4281C20.2874 10.9103 19.8676 10.4906 19.3499 10.4906C18.8321 10.4906 18.4124 10.9103 18.4124 11.4281C18.4124 11.9459 18.8321 12.3656 19.3499 12.3656Z"/>
      </symbol>

      <symbol id="white-right-arrow-icon" width="36" height="18" viewBox="0 0 36 18" xmlns="http://www.w3.org/2000/svg">
        <path d="M26.2496 0.695441C25.7018 1.24592 25.7039 2.13628 26.2543 2.68416L31.1876 7.59365L1.40625 7.59365C0.629578 7.59365 -4.15057e-07 8.22323 -3.81108e-07 8.9999C-3.47158e-07 9.77657 0.629578 10.4061 1.40625 10.4061L31.1877 10.4061L26.2543 15.3156C25.7038 15.8635 25.7017 16.7539 26.2496 17.3044C26.7975 17.8549 27.6879 17.8569 28.2383 17.3091L35.5863 9.99664C35.5868 9.99622 35.5871 9.99573 35.5876 9.99531C36.1366 9.44743 36.1384 8.55418 35.5876 8.00448C35.5871 8.00406 35.5868 8.00357 35.5864 8.00315L28.2384 0.690659C27.688 0.142926 26.7976 0.144824 26.2496 0.695441Z"/>
      </symbol>

       <symbol id="search-icon" width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.93945 0.931305C4.98074 0.931305 0.941406 4.97063 0.941406 9.92937C0.941406 14.8881 4.98074 18.9353 9.93945 18.9353C12.0575 18.9353 14.0054 18.193 15.5449 16.9606L19.293 20.7067C19.4821 20.888 19.7347 20.988 19.9967 20.9854C20.2587 20.9827 20.5093 20.8775 20.6947 20.6924C20.8801 20.5073 20.9856 20.2569 20.9886 19.9949C20.9917 19.7329 20.892 19.4802 20.7109 19.2908L16.9629 15.5427C18.1963 14.0008 18.9395 12.0498 18.9395 9.92937C18.9395 4.97063 14.8982 0.931305 9.93945 0.931305ZM9.93945 2.93134C13.8173 2.93134 16.9375 6.05153 16.9375 9.92937C16.9375 13.8072 13.8173 16.9352 9.93945 16.9352C6.06162 16.9352 2.94141 13.8072 2.94141 9.92937C2.94141 6.05153 6.06162 2.93134 9.93945 2.93134Z"/>
      </symbol>

      <!-- start of Rannojit -->


      <!-- start of Shariful -->


      <!-- start of Sabbir -->


      <!-- start of Milon -->
      <symbol id="error-msg-icon-svg" width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
        <path d="M18.1378 22.5454C17.8107 22.5759 17.4823 22.502 17.1997 22.3344C16.9932 22.1224 16.8942 21.8281 16.9306 21.5344C16.9382 21.2899 16.9674 21.0465 17.0178 20.8072C17.0667 20.5325 17.1297 20.2607 17.2069 19.9926L18.0651 17.0399C18.1536 16.7484 18.2121 16.4487 18.2397 16.1453C18.2397 15.818 18.2833 15.5925 18.2833 15.4617C18.3015 14.8784 18.0525 14.3186 17.6069 13.9417C17.0588 13.5209 16.3763 13.3141 15.6869 13.3599C15.1928 13.3673 14.7026 13.4482 14.2323 13.5999C13.7184 13.7599 13.1778 13.9514 12.6105 14.1744L12.3633 15.1344C12.5305 15.0762 12.7342 15.0108 12.9669 14.938C13.1889 14.8723 13.419 14.838 13.6505 14.8362C13.9753 14.801 14.3022 14.8808 14.5742 15.0617C14.7589 15.2821 14.8456 15.5685 14.8142 15.8544C14.8133 16.099 14.7865 16.3428 14.7342 16.5817C14.6832 16.8362 14.6178 17.1053 14.5378 17.3889L13.6723 20.3562C13.6026 20.632 13.5468 20.9111 13.5051 21.1925C13.4711 21.4335 13.4541 21.6765 13.4542 21.9198C13.4506 22.5071 13.7192 23.063 14.1814 23.4252C14.7379 23.8525 15.4302 24.0644 16.1305 24.0216C16.6236 24.0317 17.115 23.9605 17.585 23.8107C17.9972 23.67 18.5475 23.4689 19.236 23.207L19.4687 22.2907C19.2822 22.368 19.0902 22.4312 18.8942 22.4797C18.6463 22.5364 18.3918 22.5584 18.1378 22.5454Z"/>
        <path d="M19.0474 8.54549C18.6516 8.18199 18.1301 7.98643 17.5928 8.00006C17.0559 7.98793 16.5349 8.18331 16.1383 8.54549C15.4113 9.17237 15.3301 10.2699 15.957 10.997C16.0129 11.0618 16.0735 11.1224 16.1383 11.1782C16.9665 11.9191 18.2191 11.9191 19.0473 11.1782C19.7743 10.5452 19.8505 9.44268 19.2175 8.71568C19.1648 8.65512 19.108 8.59824 19.0474 8.54549Z"/>
        <path d="M16 0C7.16344 0 0 7.16344 0 16C0 24.8366 7.16344 32 16 32C24.8366 32 32 24.8366 32 16C32 7.16344 24.8366 0 16 0ZM16 30.5454C7.96675 30.5454 1.45456 24.0332 1.45456 16C1.45456 7.96675 7.96675 1.45456 16 1.45456C24.0332 1.45456 30.5454 7.96675 30.5454 16C30.5454 24.0332 24.0332 30.5454 16 30.5454Z"/>
        </symbol>

      <!--start of Niaz -->
      <symbol id="wle-sec-icon-svg" width="102" height="64" viewBox="0 0 102 64" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M93.4594 0.491446C86.4 1.1616 81.5718 2.0002 73.1071 4.0324C43.0388 11.2483 19.0266 27.8428 5.41133 50.8146C3.36125 54.2759 -0.181128 61.1784 0.0072178 61.3505C0.0651704 61.403 1.78748 59.9975 3.83574 58.2279C16.7863 47.0346 31.729 36.1527 40.9145 31.2244C42.1605 30.556 43.3268 29.9022 43.5043 29.7718C44.0693 29.357 49.2615 27.1382 51.1069 26.5224C53.0592 25.8704 53.7003 25.8867 52.016 26.5441C45.6467 29.0291 36.1298 34.8993 25.9465 42.6224C17.0634 49.3566 -0.0108883 63.6073 0.358559 63.9768C0.517929 64.1362 3.29788 63.4642 7.31653 62.2942C8.78707 61.8667 11.2627 61.1458 12.822 60.693C51.1739 49.5341 81.6534 30.8603 90.8714 12.8748C93.3471 8.04246 96.7029 4.22982 101.076 1.27752C103.239 -0.18052 101.953 -0.31455 93.4594 0.491446Z" fill="#8CCC0C"/>
      </symbol>

</svg>
<?php 
$logoObj = get_field('hdlogo', 'options');
if( is_array($logoObj) ){
  $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
}else{
  $logo_tag = '';
}
?>
<header class="header">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="header-cntlr clearfix">
            <div class="header-inr">
              <div class="hdr-lft">
                <?php if( !empty($logo_tag) ): ?>
                <div class="logo">
                  <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php echo $logo_tag; ?>
                  </a>
                </div>
                <?php endif; ?>
              </div>
              <div class="hdr-rgt">
                <nav class="main-nav hide-sm">
                <?php 
                  $menuOptions = array( 
                      'theme_location' => 'cbv_main_menu', 
                      'menu_class' => 'clearfix reset-list',
                      'container' => '',
                      'container_class' => ''
                    );
                  wp_nav_menu( $menuOptions ); 
                ?>
                </nav>

                <div class="user-cart-cntlr">
                  <div class="hambergar-cross-cntlr show-sm">
                    <div class="hambergar-icon">
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                    <strong class="hambergar-title">MENU</strong>
                    <strong class="cross-title">SLUIT</strong>
                  </div>
                  <div class="hdr-user">
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><i><svg class="user-icon" width="20" height="24" viewBox="0 0 20 24" fill="#31304F">
                      <use xlink:href="#user-icon"></use> </svg></i>
                    </a>
                    <strong class="hdr-user-title show-sm">ACCOUNT</strong>
                  </div>
                  <div class="hdr-cart hide-sm">
                    <a href="<?php echo wc_get_cart_url(); ?>">
                    <?php 
                    if( WC()->cart->get_cart_contents_count() > 0 ){
                      echo sprintf ( '<span>%d</span>', WC()->cart->get_cart_contents_count() );
                    }else{
                      echo sprintf ( '<span>%d</span>', 0 );
                    }  
                    ?>
                      <i><svg class="cart-icon" width="30" height="30" viewBox="0 0 30 30" fill="#fff">
                        <use xlink:href="#cart-icon"></use> </svg>
                      </i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="catagory-menu hide-sm">
                <?php 
                  $catmenuOptions = array( 
                      'theme_location' => 'cbv_cat_menu', 
                      'menu_class' => 'clearfix reset-list',
                      'container' => '',
                      'container_class' => ''
                    );
                  wp_nav_menu( $catmenuOptions ); 
                ?>
            </div>
          </div>
        </div>
      </div>
  </div>
</header>

<!-- xs mobile menu -->
<div class="xs-mobile-menu">

  <div class="xs-menu-hdr">
    <div class="user-cart-cntlr">
      <div class="hambergar-cross-cntlr show-sm">
        <div class="hambergar-icon">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <strong class="hambergar-title">MENU</strong>
        <strong class="cross-title">SLUIT</strong>
      </div>
      <div class="hdr-user">
        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><i><svg class="user-icon" width="20" height="24" viewBox="0 0 20 24" fill="#31304F">
          <use xlink:href="#user-icon"></use> </svg></i>
        </a>
        <strong class="hdr-user-title show-sm">ACCOUNT</strong>
      </div>
    </div>
    <div class="hdr-lft">
      <?php if( !empty($logo_tag) ): ?>
      <div class="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <?php echo $logo_tag; ?>
        </a>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="xs-menu-cntlr">
    <div class="xs-menu">
      <div class="submenu-header">
        <div class="back-to-main-menu">
          <a href="#">Terug</a>
        </div>
        <div class="menuTitle"><strong>Thee & Infusies</strong></div>
      </div>
      <nav class="main-nav">
        <?php 
          $catmenuOptions = array( 
              'theme_location' => 'cbv_main_mbmenu', 
              'menu_class' => 'clearfix reset-list',
              'container' => '',
              'container_class' => ''
            );
          wp_nav_menu( $catmenuOptions ); 
        ?>

      </nav>
    </div>
  </div>
  <?php 
$smedias = get_field('social_media', 'options');
  ?>

  <div class="xs-menu-ftr">
    <?php if(!empty($smedias)):  ?>
    <div class="ftr-social-media">
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
    <div class="hdr-cart">
      <a href="<?php echo wc_get_cart_url(); ?>">
        <?php 
        if( WC()->cart->get_cart_contents_count() > 0 ){
          echo sprintf ( '<span>%d</span>', WC()->cart->get_cart_contents_count() );
        }else{
          echo sprintf ( '<span>%d</span>', 0 );
        }  
        ?>
        <i><svg class="cart-icon" width="30" height="30" viewBox="0 0 30 30" fill="#fff">
          <use xlink:href="#cart-icon"></use> </svg>
        </i>
      </a>
    </div>
 </div> 
</div>
<?php if( is_front_page() ): ?>
<section class="hm-search-sec show-sm">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="secrh-select-cntlr">
          <div class="fl-secrh-cntlr">
            <div class="fl-secrh">
              <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="text" placeholder="Naar welke thee ben jij opzoek?" name="s" value="<?php echo get_search_query(); ?>">
                <button>
                  <i><svg class="search-icon" width="21" height="21" viewBox="0 0 21 21" fill="#31304F">
                    <use xlink:href="#search-icon"></use> </svg>
                  </i>
                </button>
                <input type="hidden" name="post_type" value="product" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>