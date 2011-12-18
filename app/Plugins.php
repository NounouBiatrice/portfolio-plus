<?php
/**
 * 
 */
class Plugins {
  
  
  /**
   * Displays the plugins main view.
   * 
   * @param string $plugin The plugin's view file located in either the themes
   *   plugins directory or the global plugin directory
   */
  public static function display($plugin) {
    
    global $loader;
    
    $plugin = preg_replace('/\.php\s*?$/', '', $plugin);
    
    // look in theme first
    if (file_exists('themes/'.THEME.'/plugins/'.$plugin.'.php')) {
      include 'themes/'.THEME.'/plugins/'.$plugin.'.php';
    } 
    
    // then global
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
