<?php get_header(); ?>

<?php 
	// get Taxonomy ACF Contect
	$queried_object = get_queried_object();
	$taxonomy = $queried_object->taxonomy;
	$term_id = $queried_object->term_id;
	$thumbnail_id = get_field('writer_image', $queried_object);
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
?>
	<main id="main">
		<div id="content" role="main">

			<?php get_template_part('template-parts/nav-magazine'); ?>

			<header class="module-header">
				<figure>
					<img src="<?php echo $thumbnail[0]; ?>" alt="">
				</figure>
				<div>
					<h1><?php echo single_term_title(); ?></h1>
					<p><?php echo term_description(); ?></p>
					<?php 
						$dj_link = get_field('dj_link', $queried_object);
						if ($dj_link):
							$dj_object = get_term($dj_link);
							echo '<p><a href="/djs/'.$dj_object->slug.'">לכל התוכניות של '.$dj_object->name.'</a></p>';
						endif;
					?>
				</div>
			</header>
			<div class="module-posts">
				<?php if ( have_posts() ): ?>
					<?php get_template_part('loops/index-loop'); ?>
				<?php else: ?>
					<?php get_template_part('loops/index-none'); ?>
				<?php endif; ?>
			</div>
		</div>
	</main>

<?php get_footer(); ?>