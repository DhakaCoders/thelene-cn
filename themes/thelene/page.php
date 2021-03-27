<?php 
get_header(); 
?>
<section class="innerpage-con-wrap">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <article class="default-page-con">
            <div class="page-title">
              <h1><?php the_title(); ?></h1>
            </div>
            <?php the_content(); ?>
          </article>
        </div>
      </div>
    </div>
</section>
<?php get_footer(); ?>