<?php

/**!
 * Cleanup
 */

if (!function_exists('b4st_cleanup_head')) {
  function b4st_cleanup_head()
  {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  }
}
add_action('init', 'b4st_cleanup_head');


if (!function_exists('show_less_login_info')) {
  function show_less_login_info()
  {
    return "<strong>ERROR</strong>: Stop guessing!";
  }
}
add_filter('login_errors', 'show_less_login_info');
