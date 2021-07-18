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
			else :
				$thumbnail = "/wp-content/uploads/2018/11/pexels-photo-744318.jpeg";
			endif; ?>
			<header class="article-header">
				<figure class="<?php the_field('image_layout'); ?>">
					<img src="<?php echo $thumbnail; ?>" alt="<?php echo esc_html(get_the_title()); ?>">
					<?php 
						$title = get_post(get_post_thumbnail_id())->post_title; //The Title
						$caption = get_post(get_post_thumbnail_id())->post_excerpt; //The Caption
						$description = get_post(get_post_thumbnail_id())->post_content; // The Description
					?>
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
					<li class="title">אהבת? שתפ.י:</li>
					<li>
						<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=KZRnet" rel="noopener noreferrer" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/theme/images/share-twitter.png" alt="Share On Twitter">בטוויטר
						</a>
					</li>
					<li>
						<a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" rel="noopener noreferrer" target="_blank">
							<img class="share-facebook" src="<?php echo get_template_directory_uri(); ?>/theme/images/share-facebook.png" alt="Share On Facbook">בפייסבוק
						</a>
					</li>
					<li>
						<a href="https://wa.me/?text=<?php the_title(); ?>%20-%20<?php the_permalink(); ?>" rel="noopener noreferrer" target="_blank">
							<img class="share-whatsapp" src="<?php echo get_template_directory_uri(); ?>/theme/images/share-whatsapp.png" alt="Share On Whatsapp">בוואטסאפ
						</a>
					</li>
					<li>
						<a href="https://t.me/share/url?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" rel="noopener noreferrer" target="_blank">
							<img class="share-telegram" src="<?php echo get_template_directory_uri(); ?>/theme/images/share-telegram.png" alt="Share On Telegram">בטלגרם
						</a>
					</li>
				</ul>
				<?php kzr_article_tags($orig_post_ID); ?>
			</div>
		</article>

		<?php 
			$related_posts = get_field('related_posts'); 
			$remaining = 3 - count($related_posts);
			$exclude = array($orig_post_ID);

			$recPosts = get_posts(array(
				'posts_per_page' => $remaining,
				'order' => 'rand',
				'exclude' => $exclude,
				'fields' => 'ids'
			));
	
			$finalPosts = array();
			foreach ($related_posts as $r_post):
				array_push($finalPosts, $r_post['post']);
			endforeach;

			foreach ($recPosts as $r_post):
				array_push($finalPosts, $r_post);
			endforeach;

			if ($recPosts): 
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