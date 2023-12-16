<?php
if (have_posts()) :
  echo '<ul class="list-posts and-tags">';
  while (have_posts()) : the_post();
    if (get_post_type(get_the_ID()) == 'post') :
      get_template_part('loops/index-post');
    else :
      get_template_part('loops/index-tag-show');
    endif;
  endwhile;
  echo '</ul>';

  if (function_exists('b4st_pagination')) {
    b4st_pagination();
  } else if (is_paged()) { ?>
    <ul class="pagination">
      <li class="page-item older"><?php next_posts_link('<i class="fas fa-arrow-left"></i> ' . __('Previous', 'b4st')) ?></li>
      <li class="page-item newer"><?php previous_posts_link(__('Next', 'b4st') . ' <i class="fas fa-arrow-right"></i>') ?></li>
    </ul>
  <?php } ?>
<?php
else :
  get_template_part('loops/404');
endif;
?>