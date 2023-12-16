<?php
/**
 * Archive Template
 */

get_header();
?>

<main id="main">
	<div id="content" role="main">

		<?php get_template_part('template-parts/nav-magazine'); ?>

		<header class="magazine-heading">
			<h1><?php single_term_title( "" ); ?></h1>
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