<?php

/**
 * Template Name: Home
 * The template for displaying all posts.
 */

get_header();
?>
<style>
  @media (max-width: 767px) {

    #wrapper-home .next-shows,
    #wrapper-home #shows-curr-and-next {
      height: auto !important;
    }
  }
</style>
<main class="container home" id="main">
  <div class="row">
    <div id="content" class="home" role="main">
      <div id="wrapper-home">
        <?php if ( have_rows( 'homepage_sections' ) ) : ?>
          <?php while ( have_rows('homepage_sections' ) ) : the_row(); ?>
            <?php if ( get_row_layout() == 'schedule' ) : ?>
              <?php
                $im_on_home_page = true;
                get_curr_shows();
              ?>

              <div class="kz-title full-schedule-link">
                <?php if (get_sub_field('link')): ?>
                  <?= printLink(get_sub_field('link'), 'normal'); ?>
                <?php endif; ?>
              </div>

            <?php elseif (get_row_layout() == 'banner'): ?>

              <div id="magazine-banner">
                <?php if (get_sub_field('link')): ?>
                  <a href="<?php the_sub_field('link'); ?>">
                <?php endif; ?>
			            <figure><picture>
                    <source srcset="<?php the_sub_field('mobile_image'); ?>" media="(max-width: 760px)">
                    <img src="<?php the_sub_field('desktop_image'); ?>" alt="הצביעו למצעד האלטרנטיבי השנתי 2021" width="400" height="400" style="width: 100%;">
                  </picture></figure>
                <?php if (get_sub_field('link')): ?>
                </a>
                <?php endif; ?>
              </div>

              <style>
                #magazine-banner img.mobile-only { display: none; }
                @media (max-width: 767px) {
                  #magazine-banner { position: relative; overflow: hidden; }
                    #magazine-banner a { display: block; }
                    #magazine-banner img.desktop-only { display: none; }
                    #magazine-banner img.mobile-only { display: block; }
                  #magazine-banner img { position: relative; max-width: none; left: 50%; transform: translateX(-50%); }
                }
              </style>

            <?php elseif (get_row_layout() == 'djs'): ?>

              <div class="broadcasters">
                <div class="wrapper">
                  <h2 class="kz-title"><?php the_sub_field('title'); ?></h2>
                  <?php
                  $djs = get_terms(array(
                    'taxonomy' => 'djs',
                    'hide_empty' => false,
                    'meta_query'    => array(
                      'relation'    => 'AND',
                      array(
                        'key'      => 'dont_show',
                        'value'      => true,
                        'compare'    => '!='
                      )
                    )
                  ));
                  shuffle($djs);
                  $djs = array_slice($djs, 0, 6);
                  ?>
                  <ul class="items">

                    <?php foreach ($djs as $dj) {
                      $dj_link = get_term_link($dj);
                      $dj_img_id = get_field('dj_photo', $dj);
                      $dj_img_small_id = get_field('dj_photo_small', $dj);
                      $dj_img_small = wp_get_attachment_image($dj_img_small_id, 'dj_img', '', array('alt' => $dj->name));
                      $dj_img = wp_get_attachment_image($dj_img_id, 'dj_img', '', array('alt' => $dj->name));
                    ?>
                      <li class="item <?php echo $dj_img_small_id; ?>">
                        <a href="<?php echo esc_url($dj_link); ?>">
                          <?php
                          if ($dj_img_small_id)
                            echo $dj_img_small;
                          else
                            echo $dj_img;
                          ?>
                          <span class="dj-name"><?php echo $dj->name; ?></span>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                  <div class="all-djs-reference">
                    <?php the_sub_field('link_text'); ?> <?= printLink(get_sub_field('link_object'), 'all-djs-link'); ?>
                  </div>

                </div>
              </div>

            <?php elseif (get_row_layout() == 'on_demend_video'): ?>

              <div class="on-demand-and-video">
                <div class="on-demand">
                  <h2 class="kz-title"><?php the_sub_field('title'); ?></h2>
                  <div class="on-demand-items">
                    <?php
                    $args = array('posts_per_page' => 12, 'post_type' => 'show');
                    $posts = get_posts($args);
                    foreach ($posts as $post) {

                      get_template_part('loops/show');
                    }
                    wp_reset_postdata(); ?>
                  </div>
                  <div class="want-more">
                    <a href="<?php bloginfo('url'); ?>/last-shows">לכל התכניות</a>
                  </div>
                </div>
                
                <div class="kz-video">
                  <h2 class="kz-title"><?php the_field('video_title'); ?></h2>
                  <iframe class="kz-vid-iframe" width="782" height="476" src="<?php the_sub_field('featured_video'); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                  <div class="hold-on">
                    <a href="https://www.youtube.com/user/KZRadio">לערוץ היוטיוב של הקצה</a>
                  </div>
                </div>
              </div>

            <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>

        <div id="ctas-strip">
          <div class="apps-and-form clearfix">
            <div class="form-wrapper">
              <h3 class="kz-subtitle">ניוזלטר הקצה</h3>
              <p class="desc">
                הרשמו לניוזלטר שלנו ותקבלו עדכונים על תכניות, ספיישלים, אירועים ועוד. בלי ספאם. מבטיחים.
              </p>
              <?php //echo do_shortcode( '[mc4wp_form id="312"]' ); 
              ?>
              <p><a href="https://us7.list-manage.com/subscribe?u=cd5550d0b8eebbade6b90ac64&id=4f2e5346ab&fbclid=IwAR0RTfX_l0Z11bbyrY-7TfYcIzfoBLAGu5iXku2AOKC7juo8zhhqzt3KJps" target="_blank" class="cta-btn">להרשמה</a>
            </div>
            <div class="ways-to-listen">
              <h3 class="kz-subtitle"><?php the_field('streaming_title'); ?></h3>
              <div class="apps">
                <div class="apps-title">באפליקציה שלנו</div>
                <div class="apps-btns">
                  <a href="<?php the_field('google_play_link'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/theme/images/googleplay.svg" alt="הקצה בגוגל פליי"></a>
                  <a href="<?php the_field('app_store_link'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/theme/images/appstore.svg" alt="הקצה באפ-סטור"></a>
                </div>
              </div>
              <div class="streaming-w">
                <div class="apps-title">באפליקציות אחרות</div>
                <div class="apps-icons">
                  <a href="<?php the_field('podbean_link'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/theme/images/podbean.png" alt="הקצה בפודבין"></a>
                  <a href="<?php the_field('tune_in_link'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/theme/images/tunein.png" alt="הקצה בטיון אין"></a>
                  <a href="<?php the_field('apple_music_link'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/theme/images/apple-music-icon.png" alt="הקצה באפל מיוזיק"></a>
                  <?php /* <a href="<?php the_field( 'spotify_link' ); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/theme/images/spotify.svg" alt="הקצה בספוטיפיי"></a> */ ?>
                </div>
              </div>
              <div class="on-tv">
                <div class="apps-title">גם בטלויזיה</div>
                <img src="<?php bloginfo('template_url'); ?>/theme/images/cellcom-tv.png" alt="הקצה בסלקום טי.וי.">
              </div>
            </div>
            <!--.ways-to-listen-->
          </div>
          <!--.apps-and-form-->

          <?php /*<div class="atem">
            <div class="textual-area">
              <div class="title-wrapper">
                <h3 class="kz-big-title"><?php the_field('fb_title'); ?></h3>
                <?php if ($fb_sub = get_field('fb_subtitle')) { ?>
                  <div class="show-time"><?php echo $fb_sub; ?></div>
                <?php } ?>
              </div>
              <?php if ($fb_main_text = get_field('fb_main_text')) { ?>
                <div class="main-text">
                  <?php echo $fb_main_text; ?>
                </div>
              <?php } ?>
              <?php if ($fb_url = get_field('fb_cta_button_url')) { ?>
                <a href="<?php echo $fb_url; ?>" class="cta-btn"><?php the_field('fb_cta_button_label'); ?></a>
              <?php } ?>
            </div>
          </div>*/ ?>
          <!--.atem-->
        </div>
        <!--#ctas-strip-->
      </div>
      <!--.#wrapper-home-->
    </div><!-- /#content -->
    
  </div><!-- /.row -->
</main><!-- /.container -->
<?php get_footer(); ?>