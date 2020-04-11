<?php
wp_list_comments(array(
  'format' => 'xhtml'
));

echo <<<EOF
              <li>

EOF;

comment_form();

echo <<<EOF

              </li>

EOF;
?>
