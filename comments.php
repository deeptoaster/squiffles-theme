<?php
if (have_comments()) {
  echo <<<EOF
        <ul class="comments">

EOF;

  wp_list_comments(array(
    'format' => 'html5'
  ));

  echo <<<EOF
        </ul>

EOF;
}

comment_form();
?>
