<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title><?php
if (is_singular()) {
  echo the_title() . ' - ';
}
?>Blog - Deep Toaster</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/bin/fonts/flaticon.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:800|Titillium+Web:400,700" type="text/css" rel="stylesheet" />
    <link href="/bin/css/squiffles.css" type="text/css" rel="stylesheet" />
    <link rel="alternate" type="application/rss+xml" title="Deep Toaster &raquo; Feed" href="http://fishbotwilleatyou.com/blog/feed/" />
    <link rel="alternate" type="application/rss+xml" title="Deep Toaster &raquo; Comments Feed" href="http://fishbotwilleatyou.com/blog/comments/feed/" />
<?php
$permalink = esc_url(get_permalink());

if (is_singular()) {
  echo <<<EOF
    <link rel="canonical" href="$permalink" />

EOF;
}
?>  </head>
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
      <dl class="timeline">
<?php
while (have_posts()) {
  the_post();
  $date = get_the_date('j M');

  echo <<<EOF
        <dt>$date</dt>
        <dd>
          <div class="post">
            <h2 class="post-title">
EOF;

  if (is_single()) {
    the_title();
  } else {
    the_title("<a href=\"$permalink\" rel=\"bookmark\">", '</a>');
  }

  echo <<<EOF
</h2>
            <div class="post-content">

EOF;

  the_content();
  the_tags('<p>Tags: ', ', ', '</p>');

  echo <<<EOF

              <p>
EOF;

  edit_post_link();

  echo <<<EOF
              </p>
            </div>
            <ul class="post-comments">

EOF;

  if (is_single()) {
    comments_template();
  } else {
    echo <<<EOF
              <li>
EOF;

    comments_popup_link();

    echo <<<EOF
              </li>

EOF;
  }

  echo <<<EOF
            </ul>
          </div>
        </dd>

EOF;
}

the_posts_navigation();
?>
      </dl>
    </div>
  </body>
</html>
