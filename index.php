<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Blog - Deep Toaster</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/lib/fonts/flaticon.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:800|Titillium+Web:400,700" type="text/css" rel="stylesheet" />
    <link href="/lib/css/squiffles.css" type="text/css" rel="stylesheet" />
    <link rel="alternate" type="application/rss+xml" title="Blog - Deep Toaster &raquo; Feed" href="http://squiffl.es/blog/feed/" />
    <link rel="alternate" type="application/rss+xml" title="Blog - Deep Toaster &raquo; Comments Feed" href="http://squiffl.es/blog/comments/feed/" />
  </head>
  <body>
    <div id="header">
      <div class="pull-right">
        <a href="/blog/">Blog</a>
        <a href="/resume/">Resume</a>
      </div>
      <h1>
        <a href="/">Deep Toaster</a>
      </h1>
    </div>
<?php
get_sidebar();
?>    <div id="main">
<?php
while (have_posts()) {
  the_post();

  echo <<<EOF
      <div class="post">

EOF;

  echo '        ';

  if (is_single()) {
    the_title('<h2 class="post-title">', '</h2>');
  } else {
    the_title('<h2 class="post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
  }

  echo <<<EOF

        <div class="post-content">

EOF;

  the_content();
  the_tags('<p>Tags: ', ', ', '</p>');
  edit_post_link();

  echo <<<EOF
        </div>

EOF;

  if (is_single()) {
    comments_template();
  } else {
    echo <<<EOF
        <div class="comment">
EOF;

    comments_popup_link();

    echo <<<EOF
        </div>

EOF;
  }

  echo <<<EOF
      </div>

EOF;
}

the_posts_navigation();
?>
    </div>
  </body>
</html>
