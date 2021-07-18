<?php get_header(); ?>

<main id="main">
	<div id="content" role="main">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
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