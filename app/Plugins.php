<?php
/**
 * 
 */
class Plugins {
  
  public static function display($plugin, $args = null) {
    
    if (file_exists('themes/'.THEME.'/plugins/'.$plugin.'.php')) {
      include 'themes/'.THEME.'/plugins/'.$plugin.'.php';
    } 
    
    elseif (file_exists('plugins/'.$plugin.'.php')) {
      include 'plugins/'.$plugin.'.php';
    } 
    
    else throw new Exception('failed to load plugin: ' . $plugin);
    
  }
  
  // this will go with options to build with required scripts
  public static function pageload_scripts () {
    
    $ep = $GLOBALS['enabled-plugins'];
    
    if (isset($ep['twitter']) && $ep['twitter']) {
      include 'js/twitter.js';
    }
    
  }
  
}
