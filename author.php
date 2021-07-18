<?php
$userInfo = get_userdata( get_query_var('author'));
$isAuthor = true;
if (
	!in_array('contributor', $userInfo -> roles) &&
	!in_array('administrator', $userInfo -> roles) &&
	!in_array('author', $userInfo -> roles) &&
	!in_array('editor', $userInfo -> roles) &&
	!in_array('kzradio_dj', $userInfo -> roles)
) {
	$isAuthor = false;
	wp_redirect(esc_url( home_url() ) . '/404', 404);
}
?>
<?php get_header(); ?>

<main id="main">
	<div id="content" role="main">
		<header class="module-header">
			<figure>
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 280 ); ?>
			</figure>
			<div>
				<h1><?php echo get_the_author_meta( 'display_name' ); ?></h1>
				<p><?php echo get_the_author_meta( 'description' ) ?></p>
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