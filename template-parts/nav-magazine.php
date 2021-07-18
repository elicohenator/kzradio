<div class="nav-magazine-container">
  <nav class="nav-magazine">
    <?php
      wp_nav_menu( array(
        'theme_location'	=> 'magazine',
        'container'			=> false,
        'menu_class'		=> 'magazine-menu'
      ) );
    ?>
  </nav>
  <div class="search-form small">
    <span class="toggle-form"></span>
    <form action="/" method="get">
      <input type="text" name="s" id="search" value="" placeholder="חיפוש חופשי" />
    </form>
    <span class="toggle-form close"></span>
  </div>
</div>