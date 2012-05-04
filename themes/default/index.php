<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8" />

  <title><?php $loader->page_title() ?></title>

  <link rel="stylesheet" type="text/css" media="screen" href="<?php $loader->theme_url(true); ?>css/style.css">
  <?php Plugins::css() ?>

  <script src="<?php $loader->theme_url(true); ?>js/lib/modernizr-2.5.3.min.js"></script>

</head>

<body>
<div id="all-cntnt">

  <header>
    <?php if ($loader->is_home_page()) : ?>
      <h1 id="logo">Portfolio<span>+</span></h1>
    <?php else : ?>
      <div id="logo">Portfolio<span>+</span></div>
    <?php endif ?>
  </header>

  <nav id="page-links">
    <ol><?php $loader->page_links('page-link') ?></ol>
  </nav>

  <div role="main" id="main">

    <article id="main-article">
      <?php $loader->view(); ?>
    </article>

  </div>

  <footer>
    &copy;2012 &lt;your name&gt;
  </footer>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php $loader->theme_url(true) ?>js/lib/jquery-1.7.2.min.js"><\/script>')</script>
<?php $loader->javascript() ?>
</body>
</html>
