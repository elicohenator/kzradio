<?php
/**!
 * The Page Content Loop
 */
?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
		<header>
			<h1><?php the_title(); ?></h1>
		</header>
		<div>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>
	</article>
<?php endwhile; else : get_template_part('loops/404'); endif; ?>