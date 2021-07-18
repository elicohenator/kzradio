<?php 
/** 
 * Magazine & Posts functions
 * Kzradio upgrades February 2021
 */
 

/** 
 * Get post categories and print them with links
 */ 
function kzr_print_post_categories() { 
    $categories = get_the_category();
    $separator = ', ';
    $output = '';
    if ( ! empty( $categories ) ) {
        foreach( $categories as $category ) {
            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
        }
        echo '<p class="post-categories">' . trim( $output, $separator ) . '</p>';
    }
}

/** 
 * Get post writer (custom taxonomy) and print them in the single / loop post
 * Must pass post ID to function
 */ 
function kzr_post_writers($post_ID) {
    $writers = get_the_terms($post_ID, 'writer');
    $separator = ', ';
    $output = '';
    if ( ! empty( $writers ) ) {
        foreach( $writers as $writer ) {
            $output .= '<a href="' . esc_url( get_category_link( $writer->term_id ) ) . '" title="'. esc_attr( $writer->display_name ) .'">' . esc_html( $writer->name ) . '</a>' . $separator;
        }
        echo trim( $output, $separator );
    }
}

/** 
 * Get post tags and output them as a list
 */
function kzr_article_tags($post_ID) {
    $post_tags = get_the_tags($post_ID);
    $output = '';
    if (!empty($post_tags)) {
        foreach ($post_tags as $tag) {
            $output .= '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
        }
        echo '<ul class="list-tags">' . $output . '</ul>';
    }
}

/** 
 * print pill according to post_type
 */
function kzr_print_tag_pill($post_ID) {
	$pillClass = (get_post_type($post_ID) == 'post') ? 'post' : 'show'; 
	$pillText = ($pillClass == 'post') ? 'פוסט' : 'פרק';
	echo '<span class="pill '.$pillClass.'">'.$pillText.'</span>';
}


/** 
 * Show only published posts on related posts
 */

add_filter('acf/fields/post_object/query/name=post', 'show_only_published_posts', 10, 3);
function show_only_published_posts( $args, $field, $post_id ) {

    $args['post_status'] = array('publish');
	return $args;

    return $args;
}

