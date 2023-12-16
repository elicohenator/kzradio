<?php
/*
Show show content in tag page
*/
?>

<?php 
$shows_term = wp_get_post_terms($post->ID, 'shows');
$djs_term = wp_get_post_terms($post->ID, 'djs');
?>

<li role="article" id="post_<?php the_ID(); ?>" <?php post_class(); ?>>
	<div>
		
		<?php kzr_print_tag_pill($post->ID); ?>		

		<a href="<?php the_permalink(); ?>">&nbsp;</a>
				
		<h2><?php the_title(); ?></h2>

		<span>
			<strong>
				<?php foreach ($djs_term as $term) { ?>
			        <a href="<?php echo get_term_link($term) ?>" class="data od-show-dj"><?php echo $term->name; ?></a>
				<?php } ?> - 
				<a href="<?php echo get_term_link($shows_term[0]); ?>">
            			<?php echo $shows_term[0]->name; ?>
		        </a>
			</strong>

			<?php echo get_the_date( 'd.m.Y', '', '' ); ?>
		</span>
	</div>
</li>