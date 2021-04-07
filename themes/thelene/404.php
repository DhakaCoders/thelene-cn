<?php 
get_header(); 
get_template_part('templates/breadcrumbs');
?>

<section class="page-404-sec-wrp">
  <div class="page-404-xs-bg show-xs">
    <img src="<?php echo THEME_URI; ?>/assets/images/flower-xs.png">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-404-dsc-wrp">
          <strong><img src="<?php echo THEME_URI; ?>/assets/images/page-404-dsc-icon.png"></strong>
          <span><?php esc_html_e( 'Proin eu vitae sit pellentesque.', THEME_NAME ); ?></span>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui eros, ut imperdiet in. Tincidunt eget sit ac ut. Luctus fermentum condimentum faucibus sit. Morbi quisque a vestibulum, quis hac libero lorem sit aenean. Neque, vel amet porttitor dolor.</p>
          <ul class="clearfix reset-list">
            <li><a href="#">Link Titel</a></li>
            <li><a href="#">Link Titel</a></li>
            <li><a href="#">Link Titel</a></li>
          </ul>
          <div class="page-404-btn clearfix">
            <a class="fl-blue-btn" href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e( 'HOME', THEME_NAME ); ?></a>
            <a class="fl-trnsprnt-btn" href="<?php echo get_permalink(get_option( 'woocommerce_shop_page_id' )); ?>"><?php esc_html_e( 'SHOP', THEME_NAME ); ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>