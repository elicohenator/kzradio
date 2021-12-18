<?php
/*
All the functions are in the PHP files in the `functions/` folder.
*/

if ( ! defined( '_KZR_VERSION' ) ) {
	define( '_KZR_VERSION', '1.31' ); // 3.12.2021
}

require get_template_directory() . '/functions/cleanup.php';
require get_template_directory() . '/functions/setup.php';
require get_template_directory() . '/functions/enqueues.php';
require get_template_directory() . '/functions/navbar.php';
require get_template_directory() . '/functions/widgets.php';
require get_template_directory() . '/functions/search-widget.php';
require get_template_directory() . '/functions/index-pagination.php';
require get_template_directory() . '/functions/single-split-pagination.php';
require get_template_directory() . '/functions/shows-filter.php';
require get_template_directory() . '/functions/check-schedule.php';
require get_template_directory() . '/functions/player-functions.php';
require get_template_directory() . '/functions/magazine-functions.php';

function header_scripts()
{
  wp_enqueue_style('home', get_template_directory_uri() . '/style-home.css', array(), _KZR_VERSION);
  wp_enqueue_style('basic', get_template_directory_uri() . '/theme/css/basic.css', array(), _KZR_VERSION);
  wp_enqueue_style('css1', get_template_directory_uri() . '/theme/css/css1.css', array(), _KZR_VERSION);
}
add_action('wp_enqueue_scripts', 'header_scripts', 100);
add_image_size('dj_img', 240, 240, true);
add_image_size('next_shows', 620, 300, true);
add_image_size('magazine_lobby', 320, 220, true);


function load_admin_styles()
{
  wp_enqueue_style('admin-style', get_template_directory_uri() . '/theme/css/admin-style.css', array(), filemtime(get_stylesheet_directory() . '/theme/css/admin-style.css'));
}
add_action('admin_enqueue_scripts', 'load_admin_styles');

if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'    => 'Options',
    'menu_title'    => 'Options',
    'menu_slug'     => 'options',
    'capability'    => 'edit_others_posts',
    'redirect'      => false
  ));
}

/**
 *  Add CPT to archive
 */
function add_cpt_to_archives($query)
{
  if (is_archive() || is_search() || is_category()) {
    $query->set('post_type', array(
      'post', 'nav_menu_item'
    ));
    return $query;
  }
}
add_filter('pre_get_posts', 'add_cpt_to_archives');

/**
 *  Show 'show' CPT in Taxonomies
 */
function create_tag_page($query)
{
  if (is_tag() && empty($query->query_vars['suppress_filters'])) {
    $query->set('post_type', array(
      'show', 'nav_menu_item', 'post'
    ));
    return $query;
  }
}
add_filter('pre_get_posts', 'create_tag_page');


/**
 *  Show 'show' CPT in Taxonomies
 */
function shows_in_custom_taxonomies($query)
{
  if (is_tax()) {
    $query->set('post_type', array(
      'show', 'nav_menu_item'
    ));
    return $query;
  }
}
add_filter('pre_get_posts', 'shows_in_custom_taxonomies');

/**
 *  Display Post in writer pages
 */
function posts_in_writer_taxonomies($query)
{
  if (is_tax('writer')) {
    $query->set('post_type', array(
      'post', 'nav_menu_item'
    ));
    return $query;
  }
}
add_filter('pre_get_posts', 'posts_in_writer_taxonomies');


/**
 *  Set show limit in 'shows' taxonomy
 */
function shows_taxonomy_per_page_limit($query)
{
  if (is_tax('shows')) {
    $query->set('posts_per_page', 10);
    return $query;
  }
}
add_filter('pre_get_posts', 'shows_taxonomy_per_page_limit');


/**
 *  Fetch last time "options" page was saved.
 */
$options = 'options';
$lastTimeKey = 'field_5b8ea90632530';
function my_acf_save_post($options)
{
  // bail early if no ACF data
  if (empty($_POST['acf'])) {
    return;
  }
  $currTime = date_create('Y-m-d H:i:s');
  update_field($lastTimeKey, $currTime, $options);
}
add_action('acf/save_post', 'my_acf_save_post', 1);


/** Add all CPT's to At A Glance */
add_action('dashboard_glance_items', 'cpad_at_glance_content_table_end');
function cpad_at_glance_content_table_end()
{
  $args     = array(
    'public'   => true,
    '_builtin' => false
  );
  $output   = 'object';
  $operator = 'and';

  $post_types = get_post_types($args, $output, $operator);
  foreach ($post_types as $post_type) {
    $num_posts = wp_count_posts($post_type->name);
    $num       = number_format_i18n($num_posts->publish);
    $text      = _n($post_type->labels->singular_name, $post_type->labels->name, intval($num_posts->publish));
    if (current_user_can('edit_posts')) {
      $output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
      echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
    }
  }
}


function custom_dj_view()
{
  remove_menu_page('index.php');                  //Dashboard  
  remove_menu_page('jetpack');                    //Jetpack*
  remove_menu_page('edit.php?post_type=page');    //Pages  
  remove_menu_page('edit-comments.php');          //Comments  
  remove_menu_page('themes.php');                 //Appearance  
  remove_menu_page('plugins.php');                //Plugins  
  remove_menu_page('users.php');                  //Users  
  remove_menu_page('tools.php');                  //Tools  
  remove_menu_page('options-general.php');        //Settings
  remove_menu_page('wpcf7');
}

if (current_user_can('kzradio_dj')) {
  add_action('admin_menu', 'custom_dj_view');
}

if (function_exists('wpseo_use_page_analysis') && !current_user_can('administrator')) {
  add_filter('wpseo_use_page_analysis', '__return_false');
}

add_filter('excerpt_length', function ($length) {
  if (is_page_template('page-templates/page-magazine.php')) {
    return 19;
  }
});

add_filter('excerpt_more', 'new_excerpt_more');

function new_excerpt_more()
{
  if (is_page_template('page-templates/page-magazine.php')) {
    return "...";
  }
}

add_filter('hidden_meta_boxes', 'show_hidden_meta_boxes', 10, 2);
function show_hidden_meta_boxes($hidden, $screen)
{
  if ('post' == $screen->base) {
    foreach ($hidden as $key => $value) {
      if ('postexcerpt' == $value) {
        unset($hidden[$key]);
        break;
      }
    }
  }

  return $hidden;
}

function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Register Center align shortcode for block editor
function center_align($atts, $content = null)
{
  return '<div class="text-center">' . $content . '</div>';
}
add_shortcode('center', 'center_align');

function show_in_post($atts = array())
{
  extract(shortcode_atts(array(
    'show_id' => ''
  ), $atts));
  $args = array('p' => $show_id, 'post_type' => 'any');
  $sec_query = new WP_Query($args);

  if ($sec_query->have_posts()) {
    while ($sec_query->have_posts()) {
      $sec_query->the_post();
      $tags = get_the_tags();
      $id = get_the_ID();
      $shows_term = wp_get_post_terms($id, 'shows');
      $djs_term = wp_get_post_terms($id, 'djs');

      if (has_post_thumbnail()) {
        $thumbnail = get_the_post_thumbnail_url($id, 'large');
      } else {
        $thumbnail_id = get_field('show_image', 'shows_' . $shows_term['0']->term_id);
        if ($thumbnail_id) {
          $thumbnail = wp_get_attachment_image_src($thumbnail_id, 'large')[0];
        } else {
          $thumbnail = get_template_directory_uri() . '/theme/images/show_placeholder.jpg';
        }
      }

      $output = '';
      $output = '<div class="od-item center-bg" style="background-image: url(' . $thumbnail . ');" id="post_' . get_the_ID() . '">';
      $output .= '<a href="' . get_the_permalink($id) . '" class="show-link"></a>';
      $output .= '<span class="data od-show-time"><span class="show-date">' . get_the_time('j.n.Y', $id) . '</span></span>';
      $output .= '<div class="od-details">';
      foreach ($djs_term as $term) {
        $output .= '<a href="' . get_term_link($term) . '" class="data od-show-dj">' . $term->name . '</a>';
      }
      $output .= '<br />';
      if (strpbrk(get_the_title($id), "אבגדהוזחטיכלמנסעפרקשתןםךףץ") == false) {
		  $titleHe = " style='direction: ltr'";
	  } else {
		  $titleHe = "";
	  }
      $output .= '<span class="data od-title"' . $titleHe;
      $output .= '>';
      $output .= '<a href="' . get_the_permalink($id) . '">' . get_the_title($id) . '</a>';
      $output .= '</span><br/>';
      $output .= '<span class="show-name-wrapper">';
      $output .= '<span class="data od-show-name">';
      $output .= '<a href="' . get_term_link($shows_term[0]) . '">';
      $output .= $shows_term[0]->name;
      $output .= '</a>';
      $output .= '</span>';

      $s_link = get_field('stream_link');
      if ($s_link) :
        $title = get_the_title();
        $p_title = str_replace("'", "", $title);
        $params = '\'' . $s_link . '\'' . ',' . '\'' . $p_title . '\'' . ',' . '\'' . $thumbnail . '\'';

        $output .= '<span class="play" role="button" tabindex="0" onclick="javascript:loadmp3(' . $params . ')">';
        $output .= '<img src="' . get_template_directory_uri() . '/theme/images/play.svg" alt="Play">';
        $output .= '</span>';
      endif;

      $output .= '</span>';
      $output .= '</div>';
      $output .= '<div class="list-tags">';
      if ($tags) :
        foreach ($tags as $key => $value) {
          $name = $value->name;
          $output .= '<span class="data tag">';
          $output .= '<a href="' . get_term_link($value->term_id) . '">' . $name . '</a>';
          $output .= '</span>';
        }
      endif;
      $output .= '</div>';
      $output .= '</div>';
      return $output;
    }
    wp_reset_postdata();
  }
}
add_shortcode('show_in_post', 'show_in_post');



// define the wpseo_opengraph_image callback
/*function filter_wpseo_opengraph_image( $img ) {
    if( get_post_type() == 'show' ) {
        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
        $term_id = $queried_object->term_id;
        $thumbnail_id = get_field('show_image', $taxonomy . '_' . $term_id);
        $thumbnail = wp_get_attachment_image_src($thumbnail_id ,'full')[0];
		$img = $thumbnail;
    }
    return $img;
}

// add the filter
add_filter( 'wpseo_opengraph_image', 'filter_wpseo_opengraph_image', 10, 1 );*/

add_action('admin_footer', function () { ?>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      //taxonomy
      var tx = 'shows';

      var $scope = $('#' + tx + '-all > ul');
      $('body.post-type-show #publish').click(function() {
        if ($scope.find('input:checked').length > 0) {
          return true;
        } else {
          alert('שכחת לסמן תוכנית :)');
          return false;
        }
      });
    });
  </script>
<?php });
/*
function wr_change_yoast_fb_default_image_for_shows($img) {
	if(is_singular('show')) {
		if (!has_post_thumbnail()) {
			$taxShows = get_the_terms(get_the_ID(), 'shows');
			$taxImageID = get_field('show_image', 'term_' . $taxShows[0]->term_id);
			$taxImageURL = wp_get_attachment_url($taxImageID);
			$img = $taxImageURL;
		}
	}
	return $img;
}
add_filter( 'wpseo_opengraph_image', 'wr_change_yoast_fb_default_image_for_shows', 10, 1 );*/

add_action('manage_posts_custom_column', 'wrc_post_columns_data', 10, 2);
add_filter('manage_edit-post_columns', 'wrc_post_columns_display');

function wrc_post_columns_data($column, $post_id)
{
  switch ($column) {
    case 'modified':
      $m_orig     = get_post_field('post_modified', $post_id, 'raw');
      $m_stamp    = strtotime($m_orig);
      $modified   = date('d/m/y @ G:i', $m_stamp);
      $modr_id    = get_post_meta($post_id, '_edit_last', true);
      $auth_id    = get_post_field('post_author', $post_id, 'raw');
      $user_id    = !empty($modr_id) ? $modr_id : $auth_id;
      $user_info  = get_userdata($user_id);
      echo '<p class="mod-date">';
      echo '<em>' . $modified . '</em><br />';
      echo 'by <strong>' . $user_info->display_name . '<strong>';
      echo '</p>';
      break;
      // end all case breaks
  }
}

function wrc_post_columns_display($columns)
{
  $columns['modified'] = 'Last Modified';
  return $columns;
}


add_action('wp_ajax_register_vote', 'register_vote');
add_action('wp_ajax_nopriv_register_vote', 'register_vote');

function register_vote()
{
  // verify nonce
  wp_verify_nonce($_POST['security'], 'ajax_nonce');

  // save fields to variables
  $first_name = sanitize_text_field($_POST['first_name']);
  $last_name = sanitize_text_field($_POST['last_name']);
  $email = sanitize_email($_POST['email']);
  $location = sanitize_text_field($_POST['location']);

  $song1 = sanitize_text_field($_POST['song1']);
  $song2 = sanitize_text_field($_POST['song2']);
  $song3 = sanitize_text_field($_POST['song3']);
  $song4 = sanitize_text_field($_POST['song4']);
  $song5 = sanitize_text_field($_POST['song5']);
  $song6 = sanitize_text_field($_POST['song6']);
  $song7 = sanitize_text_field($_POST['song7']);
  $song8 = sanitize_text_field($_POST['song8']);
  $song9 = sanitize_text_field($_POST['song9']);
  $song10 = sanitize_text_field($_POST['song10']);
  $bestSong = sanitize_text_field($_POST['best_song']);
  
  $album1 = sanitize_text_field($_POST['album1']);
  $album2 = sanitize_text_field($_POST['album2']);
  $album3 = sanitize_text_field($_POST['album3']);
  $album4 = sanitize_text_field($_POST['album4']);
  $album5 = sanitize_text_field($_POST['album5']);
  $album6 = sanitize_text_field($_POST['album6']);
  $album7 = sanitize_text_field($_POST['album7']);
  $album8 = sanitize_text_field($_POST['album8']);
  $album9 = sanitize_text_field($_POST['album9']);
  $album10 = sanitize_text_field($_POST['album10']);
  $bestAlbum = sanitize_text_field($_POST['best_album']);

  $movie = sanitize_text_field($_POST['movie']);
  $series = sanitize_text_field($_POST['series']);
  $note = sanitize_text_field($_POST['note']);

  $newVote = array(
    'post_title'    => $first_name.' '.$last_name,
    'post_status'   => 'publish',
    'post_type'   => 'vote',

  );
  $newVoteID = wp_insert_post($newVote);

  update_field('first_name', $first_name, $newVoteID);
  update_field('last_name', $last_name, $newVoteID);
  update_field('email', $email, $newVoteID);
  update_field('location', $location, $newVoteID);

  update_field('song1', $song1, $newVoteID);
  update_field('song2', $song2, $newVoteID);
  update_field('song3', $song3, $newVoteID);
  update_field('song4', $song4, $newVoteID);
  update_field('song5', $song5, $newVoteID);
  update_field('song6', $song6, $newVoteID);
  update_field('song7', $song7, $newVoteID);
  update_field('song8', $song8, $newVoteID);
  update_field('song9', $song9, $newVoteID);
  update_field('song10', $song10, $newVoteID);
  update_field('best_song', $bestSong, $newVoteID);

  update_field('album1', $album1, $newVoteID);
  update_field('album2', $album2, $newVoteID);
  update_field('album3', $album3, $newVoteID);
  update_field('album4', $album4, $newVoteID);
  update_field('album5', $album5, $newVoteID);
  update_field('album6', $album6, $newVoteID);
  update_field('album7', $album7, $newVoteID);
  update_field('album8', $album8, $newVoteID);
  update_field('album9', $album9, $newVoteID);
  update_field('album10', $album10, $newVoteID);
  update_field('best_album', $bestAlbum, $newVoteID);
  
  update_field('movie', $movie, $newVoteID);
  update_field('series', $series, $newVoteID);
  update_field('note', $note, $newVoteID);

  // send some information back to the javascipt handler
  $response = array(
    'status' => '200',
    'message' => 'OK',
    'new_post_ID' => $newVoteID
  );

  // normally, the script expects a json respone
  header( 'Content-Type: application/json; charset=utf-8' );
  echo json_encode( $response );

  exit; // important

  die();
}



