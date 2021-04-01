<?php 
get_header(); 
?>
<section class="innerpage-con-wrap">
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
</section>
<?php get_footer(); ?>