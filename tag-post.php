<?php
/*
The Index Post (or excerpt)
===========================
Used by index.php, category.php and author.php
*/
?>

<?php 
$cats = get_the_category();
if ($cats):
	$slug = $cats[0]->slug;
endif;
?>

<li role="article" id="post_<?php the_ID(); ?>" <?php post_class(); ?>>
	<div>
		<a href="<?php the_permalink(); ?>">&nbsp;</a>
		<?php kzr_print_post_categories(); ?>
		
		<h2><?php the_title(); ?></h2>
		<?php echo '<p class="excerpt">' . get_the_excerpt() . '</p>' ?>

		<span><strong><?php kzr_post_writers($post->ID); ?></strong> <?php the_date( 'd.m.Y', '', '' ); ?></span>
	</div>
</li>
