<?php
/*
The Single Post
===============
*/
?>

<?php get_template_part('template-parts/nav-magazine'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();
	$orig_post_ID = get_the_ID(); ?>
		<article role="article" id="post_<?php the_ID() ?>" <?php post_class('single-post-container') ?>>
			<?php if (has_post_thumbnail()) :
				$thumbnail = get_the_post_thumbnail_url(); 
				$caption = get_post(get_post_thumbnail_id())->post_excerpt; //The Caption
			else :
				$thumbnail = "/wp-content/uploads/2018/11/pexels-photo-744318.jpeg";
				$caption = '';
			endif; ?>
			<header class="article-header">
				<figure class="<?php the_field('image_layout'); ?>">
					<img src="<?php echo $thumbnail; ?>" alt="<?php echo esc_html(get_the_title()); ?>">
					
					<figcaption><span><?= $caption; ?></span></figcaption>
				</figure>
				<div>
					<?php kzr_print_post_categories(); ?>

					<h1><?php the_title(); ?></h1>
					<?php echo '<p class="excerpt">' . get_the_excerpt() . '</p>' ?>
					
					<span><strong><?php kzr_post_writers($orig_post_ID); ?></strong> <?php the_date( 'd.m.Y', '', '' ); ?></span>
				</div>
			</header>
			<div class="single-post-content">
				<?php the_content(); ?>
			</div>
			<div class="post-footer">
				<ul class="list-social">
					<li class="title">אהבת? שתפ/י:</li>
					<li>
						<a href="https://twitter.com/intent/tweet?url=<?php echo get_the_permalink($orig_post_ID); ?>&text=<?php echo get_the_title($orig_post_ID); ?>&via=KZRnet" rel="noopener noreferrer" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/theme/images/share-twitter.png" alt="Share On Twitter">בטוויטר
						</a>
					</li>
					<li>
						<a href="https://www.facebook.com/sharer.php?u=<?php echo get_the_permalink($orig_post_ID); ?>" rel="noopener noreferrer" target="_blank">
							<img class="share-facebook" src="<?php echo get_template_directory_uri(); ?>/theme/images/share-facebook.png" alt="Share On Facbook">בפייסבוק
						</a>
					</li>
					<li>
						<a href="https://wa.me/?text=<?php echo get_the_title($orig_post_ID); ?>%20-%20<?php echo get_the_permalink($orig_post_ID); ?>" rel="noopener noreferrer" target="_blank">
							<img class="share-whatsapp" src="<?php echo get_template_directory_uri(); ?>/theme/images/share-whatsapp.png" alt="Share On Whatsapp">בוואטסאפ
						</a>
					</li>
					<li>
						<a href="https://t.me/share/url?url=<?php echo get_the_permalink($orig_post_ID); ?>&text=<?php echo get_the_title($orig_post_ID); ?>" rel="noopener noreferrer" target="_blank">
							<img class="share-telegram" src="<?php echo get_template_directory_uri(); ?>/theme/images/share-telegram.png" alt="Share On Telegram">בטלגרם
						</a>
					</li>
				</ul>
				<?php kzr_article_tags($orig_post_ID); ?>
			</div>
		</article>

		<?php 
			$related_posts = get_field('related_posts'); 
			$remaining = ($related_posts) ? 3 - count($related_posts) : 3;
			$exclude = array($orig_post_ID);
			$finalPosts = array();

			if ($remaining > 0):
				$recPosts = get_posts(array(
					'posts_per_page' => $remaining,
					'order' => 'rand',
					'exclude' => $exclude,
					'fields' => 'ids'
				));
			endif;
	
			
			foreach ($related_posts as $r_post):
				array_push($finalPosts, $r_post['post']);
			endforeach;

			foreach ($recPosts as $r_post):
				array_push($finalPosts, $r_post);
			endforeach;

			if ($finalPosts): 
				echo '<article class="module-recommendations">';
					echo '<h3>וואלק יש מצב שתעופ/י גם על אלו</h3>';
					echo '<ul class="list-posts">';
						foreach ( $finalPosts as $post ) :
							setup_postdata( $post ); 
							get_template_part('loops/index-post');
						endforeach; 
					echo '</ul>';
					wp_reset_postdata();
				echo '</article>';
			endif; 
		?>
<?php
	endwhile;
else :
	get_template_part('loops/404');
endif;
?>