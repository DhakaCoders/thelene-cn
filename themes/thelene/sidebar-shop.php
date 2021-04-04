<div class="sidebar-close-btn back-to-dashboard-btn-cntlr show-md">
	<span>Terug naar overzicht</span>
</div>
<div class="sidebar-title">
  <h4 class="fl-h4">Filter producten</h4>
  <div class="sidebar-content">
    <?php if ( is_active_sidebar( 'shop-widget' ) ) : ?>
      <?php dynamic_sidebar( 'shop-widget' ); ?>
    <?php endif; ?>
  </div>
</div>