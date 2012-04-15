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

  <header>
    <?php if ($loader->is_home_page()) : ?>
      <h1>Portfolio+</h1>
    <?php else : ?>
      <div>Portfolio+</div>
    <?php endif ?>
  </header>

  <nav>
    <ol><?php $loader->page_links() ?></ol>
  </nav>

  <div role="main" id="mn">

    <article id="main-article">
      <?php $loader->view(); ?>
    </article>

  </div>

  <footer>
    &copy;2012 &lt;your business name&gt;
  </footer>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php $loader->theme_url(true) ?>js/lib/jquery-1.7.2.min.js"><\/script>')</script>
  <?php $loader->javascript() ?>
</body>
</html>
