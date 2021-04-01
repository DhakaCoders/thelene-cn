<?php 
/*Template Name: Contact*/
get_header();
$thisID = get_the_ID(); 
get_template_part('templates/breadcrumbs');
?>
<?php  
  $intro = get_field('formsec', $thisID);
  $page_title = !empty($intro['titel']) ? $intro['titel'] : get_the_title();
?>
<section class="contact-form-sec-wrp">
 <div class="container">
  <div class="row">
    <div class="col-md-12">
     <div class="contact-form-dsc-wrp">
      <div class="page-entry-header text-center">
        <h1 class="fl-h1"><?php echo $page_title; ?></h1>
        <?php 
          if( !empty($intro['subtitel']) ) printf( '<h6 class="fl-h6">%s</h6>', $intro['subtitel'] );
          if( !empty($intro['beschrijving']) ) echo wpautop( $intro['beschrijving'] );
        ?>
      </div>
    </div>

    <div class="contact-form-block clearfix">
      <?php if( !empty($intro['beschrijving']) ): ?>
      <div class="contact-form-lft">
        <div class="contact-er-msg">
          <span>
            <i><svg class="error-msg-icon-svg" width="32" height="32" viewBox="0 0 32 32" fill="#ffffff">
            <use xlink:href="#error-msg-icon-svg"></use> </svg></i>
            Oh snap! Het formulier lijkt niet correct!</span>
        </div>
        <div class="contact-form-wrp clearfix">
          <div class="wpforms-container">
            <form class="wpforms-form needs-validation" novalidate>
              
              <div class="wpforms-field-container">
                
                <div class="wpforms-field XsNameField">
                  <label class="wpforms-field-label">Naam</label>
                  <input type="text" name="name" placeholder="Voornaam" required>
                </div>
                <div class="wpforms-field NameField">
                  <input type="text" name="name" placeholder="Naam" required>
                </div>

                <div class="wpforms-field wpforms-has-error FullWidthField">
                  <label class="wpforms-field-label">Telefoonnummer</label>
                  <input type="text" name="text" placeholder="Bijv. 09 224 61 11" required>
                  <label class="wpforms-error">X</label>
                </div>

                <div class="wpforms-field wpforms-has-error FullWidthField">
                  <label class="wpforms-field-label">E-mail</label>
                  <input type="email" name="email" placeholder="Bijv. jan@domein.be" class="form-control" required>
                  <label class="wpforms-error">X</label>
                  <span>Controleer dit veld</span>
                </div>

                <div class="wpforms-field wpforms-field-textarea">
                  <label class="wpforms-field-label">Bericht</label>
                  <textarea name="message" placeholder="Bericht"></textarea>
                </div>
              </div><!-- end of .wpforms-field-container-->

              <div class="wpforms-field-text">
                <p>Wij respecteren uw <a href="#"> privacy.</a> Jouw gegevens worden altijd vertrouwelijk behandeld.</p>
              </div>

              <div class="wpforms-submit-container">
                <button type="submit" name="submit" class="wpforms-submit">VERZENDEN</button>
              </div>

            </form>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php 
        $address = get_field('address', 'options');
        $gmurl = get_field('url', 'options');
        $telefoon = get_field('telefoon', 'options');
        $email = get_field('emailadres', 'options');
        $gmaplink = !empty($gmurl)?$gmurl: 'javascript:void()';
        $smedias = get_field('social_media', 'options');
      ?>
      <div class="contact-form-rgt">
        <div class="contact-form-info-cntlr">
          <div class="contact-form-info">
            <h5 class="fl-h5 contact-form-info-title"><?php _e( 'CONTACT INFO', THEME_NAME ); ?></h5>
            <ul class="reset-list clearfix">
              <?php 
                if( !empty($address) ) printf('<li><a href="%s" target="_blank">%s</a></li>', $gmaplink, $address);
                if( !empty($email) ) printf('<li><a href="mailto:%s">%s</a></li>', $email, $email); 
                if( !empty($telefoon) ) printf('<li><span>Tel: <a href="tel:%s">%s</a></span>', phone_preg($telefoon),  $telefoon);  
              ?>
              </ul>
            </div>
             <?php if(!empty($smedias)):  ?>
            <div class="contact-form-info-socail">
              <ul class="reset-list clearfix">
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
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<?php  
  $gmap = get_field('gmap', $thisID);
  if($gmap):
?>
<section class="contact-google-map-sec-wrp">
  <div class="contact-google-dsc-wrp">
    <?php 
      if( !empty($gmap['titel']) ) printf( '<h5 class="fl-h5 contact-google-dsc-title">%s</h5>', $gmap['titel'] );
      if( !empty($gmap['beschrijving']) ) echo wpautop( $gmap['beschrijving'] );
    ?>
  </div>
  <?php if( !empty($gmap['map_embedded']) ): ?>
  <div class="contact-google-map">
    <?php echo $gmap['map_embedded']; ?>
  </div>  
  <?php endif; ?>  
</section>
<?php endif; ?>
<?php get_footer(); ?>