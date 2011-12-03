<?php

  require 'site-config.php';
  require 'app/Plugins.php';
  require 'app/Pageloader.php';
  //require 'app/db/Connection.php';
  
  // main pages controller
  $page_name = array_key_exists('page', $_GET) ? $_GET['page'] : 'home';
  $loader = new PageLoader($page_name);
  
  // container for enabled plugins (mainly for js inclusion in page load)
  $GLOBALS['enabled-plugins'] = array();
  
  // Ajax partial request from jNavigate
  if (array_key_exists('jnavigate', $_REQUEST)) {
    
    $loader->view();
    exit();
    
  }
  
  // pull in themes index page
  include 'themes/'.THEME.'/index.php';
  