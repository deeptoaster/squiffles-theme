<?
define('SQUIFFLES_FIELD_TRELLO_CARD', 'Trello Card');

include_once(ABSPATH . '/wp-admin/includes/post.php');

$config = array();

include(__DIR__ . '/../../../../config.php');

add_action('widgets_init', 'register_sidebar');
add_filter('show_admin_bar' , '__return_false');

add_action('save_post', function($post_id, $post) use ($config) {
  if (!isset($config['trello_key']) || !isset($config['trello_token'])) {
    return;
  }

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

  $fields = array(
    'key' => $config['trello_key'],
    'token' => $config['trello_token'],
    'url' => preg_replace(
      array('/^http:/', '/%postname%/'),
      array('https:', $postname),
      $permalink
    )
  );

  $query = http_build_query(array(
    'fields' => 'url',
    'key' => $config['trello_key'],
    'token' => $config['trello_token']
  ));

  $cards = get_post_custom_values(SQUIFFLES_FIELD_TRELLO_CARD, $post_id);
  $handle = curl_init();
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

  foreach ($cards as $card) {
    if (preg_match('/^https?:\/\/trello.com\/c\/(\w+)/', $card, $matches)) {
      $url = "https://api.trello.com/1/cards/$matches[1]/attachments";
      curl_setopt($handle, CURLOPT_HTTPGET, true);
      curl_setopt($handle, CURLOPT_URL, "$url?$query");
      $attachments = json_decode(curl_exec($handle));
      $exists = false;

      foreach ($attachments as $attachment) {
        if ($attachment->url === $fields['url']) {
          $exists = true;
          break;
        }
      }

      if (!$exists) {
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_exec($handle);
      }
    }
  }

  curl_close($handle);
}, 10, 2);
?>
