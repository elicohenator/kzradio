<?php
/**
 * Tag Archive Template
 */

get_header();
?>

<main id="main">
	<div id="content" role="main">

		<header class="magazine-heading heading-tag">
			<h1><?php single_term_title( "" ); ?></h1>
		</header>

		<div class="module-posts list-tag-posts">
			<?php if ( have_posts() ): ?>
				<?php get_template_part('loops/index-tag-loop'); ?>
			<?php else: ?>
				<?php get_template_part('loops/index-none'); ?>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>