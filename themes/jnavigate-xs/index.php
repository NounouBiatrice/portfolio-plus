<!DOCTYPE html>
<html lang="en">
  <head>

  <meta charset="utf-8" />

  <title><?php $loader->page_title(); ?></title>

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" media="screen" href="<?php $loader->theme_url(true); ?>styles/default.css">

  <script src="<?php $loader->theme_url(true); ?>js/modernizr.min.js"></script>

  <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php $loader->theme_url(true); ?>styles/ie.css">
  <![endif]-->

  </head>

  <body>

    <?php $loader->partial('header.php'); ?>

    <section id="main-content">

      <div id="main-shadow" class="page-content-area">

        <div id="main-wrap">

          <article id="main-article">
            <?php $loader->view(); ?>
          </article>

        </div>

      </div>

    </section>

  <?php $loader->partial('footer.php'); ?>

  <?php $loader->scripts(); // Plugin and application scripts ?>
  </body>
</html>