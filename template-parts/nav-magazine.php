<script>	
	var toggle_form = document.getElementById('toggleFormButton'),
		search_form = document.getElementById('searchFormContainer');

	function toggleSearch() {
		if (toggle_form.classList.contains('close')) { 
			search_form.classList.remove('small');
		} else { 
			search_form.classList.add('small');
		}
	}
</script>

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
  <div class="search-form small" id="searchFormContainer">
    <span class="toggle-form" id="toggleFormButton" onclick="toggleSearch()"></span>
    <form action="/" method="get">
      <input type="text" name="s" id="search" value="" placeholder="חיפוש חופשי" />
    </form>
    <span class="toggle-form close"></span>
  </div>
</div>