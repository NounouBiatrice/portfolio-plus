<?php

  require 'site-config.php';
  require 'app/Plugins.php';
  require 'app/Plugin.php';
  require 'app/Pageloader.php';
  require 'app/Mailer.php';

  Plugins::register_all();

  // main pages controller
  $page_name = array_key_exists('page', $_GET) ? $_GET['page'] : 'home';
  $loader = new PageLoader($page_name);

  // Ajax partial request from jNavigate
  if (array_key_exists('jnavigate', $_REQUEST)) {

    $loader->view();
    exit();

  }

  // pull in theme index page
  include 'themes/'.THEME.'/index.php';
