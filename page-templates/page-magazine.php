<?php
/**
 * Template Name: Magazine
 */

get_header();
?>

<main id="main">
	<div id="content" role="main">
		
		<?php get_template_part('template-parts/nav-magazine'); ?>

		<header class="magazine-heading image">
		<h1>
			<a href="/magazine/">
				<img src="<?php echo get_template_directory_uri(); ?>/theme/images/magazine-logo.png" alt="מגזין הקצה" />
			</a>
		</h1>
		</header>

		<?php 
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(
				'orderby' => 'date',
				'order' => 'desc',
				'post_type' => 'post',
				'posts_per_page' => '244',
				'paged' => $paged
			);
			$posts = get_posts($args);
			if ($posts):
				echo '<div class="module-posts"><ul class="list-posts">';
					foreach ($posts as $post):
						setup_postdata($post);
						get_template_part('loops/index-post');
					endforeach;
				echo '</ul></div>';
			endif; 
		?>
	</div>
</main>
<?php get_footer(); ?>