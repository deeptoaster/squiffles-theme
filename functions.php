<?
define('SQUIFFLES_FIELD_TRELLO_CARD', 'Trello Card');

include_once(ABSPATH . '/wp-admin/includes/post.php');
include(__DIR__ . '/../../../../lib/functions.php');

add_action('widgets_init', 'register_sidebar');
add_filter('show_admin_bar' , '__return_false');

add_action('save_post', function($post_id, $post) {
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if ($post->post_type === 'revision') {
    return;
  }

  list($permalink, $postname) = get_sample_permalink($post_id);

  if (is_numeric($postname)) {
    return;
  }

  squiffles_attach_to_trello(
    get_post_custom_values(SQUIFFLES_FIELD_TRELLO_CARD, $post_id),
    preg_replace(
      array('/^http:/', '/%postname%/'),
      array('https:', $postname),
      $permalink
    )
  );
}, 10, 2);
?>
