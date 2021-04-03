<?php 
get_header(); 
get_template_part('templates/breadcrumbs');
$thisID = get_option( 'page_for_posts' );
$titel = get_field('titel', $thisID);
$subtitel = get_field('subtitel', $thisID);
$beschrijving = get_field('beschrijving', $thisID); 
$titel = !empty($titel)? $titel : get_the_title($thisID);
?>
<section class="blg-page-hdr">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="bph-inner">  
          <div class="page-entry-header">        
            <?php 
                printf('<h1 class="fl-h1">%s</h1>', $titel); 
                if( !empty($subtitel) ) printf('<h6 class="fl-h6">%s</h6>', $subtitel);
                if( !empty($beschrijving) ) echo wpautop( $beschrijving );
            ?>
          </div>
        </div>  
      </div>  
    </div>    
  </div>  
</section>
<?php 
 if( isset($_GET['orderby']) && !empty($_GET['orderby']) ){
      $order = $_GET['orderby'];
  }
?>
<section class="">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="">
          
          <div class="secrh-select-cntlr">
            <div class="fl-secrh-cntlr">
              <div class="fl-secrh">
                  <form action="<?php echo get_permalink($thisID); ?>" method="get">
                    <input type="text" placeholder="Naar welke thee ben jij opzoek?" name="s" value="<?php echo get_search_query(); ?>">
                    <button type="submit">
                      <i><svg class="search-icon" width="21" height="21" viewBox="0 0 21 21" fill="#31304F">
                        <use xlink:href="#search-icon"></use> </svg></i>
                      </button>
                  </form>
                </div>
            </div>
            <div class="fl-select-cntlr">
              <span>Sorteren Op:</span>
              <div class="fl-select">
                <form method="get" action="<?php echo get_permalink($thisID); ?>">
                <select class="selectpicker" name="orderby" id="" onchange="this.form.submit()">
                  <option value="asc" <?php echo ($order == 'asc')?'selected':'';?>>A-Z</option>
                  <option value="desc" <?php echo ($order == 'desc')?'selected':'';?>>Z-A</option>
                </select>
              </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="blog-page-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">     
        <div class="blog-grids-cntrl">
          <?php if(have_posts()): ?>
          <div class="blg-grds-item">
            <ul class="clearfix reset-list">
              <?php 
                $i = 1; 
                while(have_posts()): the_post();
                  $blogimgID = get_post_thumbnail_id(get_the_ID());
                  $blog_imgsrc = !empty($blogimgID)? cbv_get_image_src($blogimgID, 'blog_grid'): THEME_URI.'/assets/images/blog-img-teapot.jpg';
              ?>
              <li>
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
              </li>
              <?php $i++; endwhile; ?>
            </ul>    
          </div>
          <?php 
          global $wp_query;
          if( $wp_query->max_num_pages > 1 ): 
          ?>
          <div class="fl-pagi-cntlr">
            <?php
              $big = 999999999; // need an unlikely integer
              $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

              echo paginate_links( array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'type'      => 'list',
                'prev_text' => __(''),
                'next_text' => __(''),
                'format'    => '?paged=%#%',
                'current'   => $current,
                'total'     => $wp_query->max_num_pages
              ) );
            ?>
          </div>
          <?php endif; ?>
          <?php else: ?>
            <div class="notfound">Geen resultaat.</div>
          <?php endif; ?>
        </div>
      </div>  
    </div>
  </div>
</section>
<?php get_footer(); ?>