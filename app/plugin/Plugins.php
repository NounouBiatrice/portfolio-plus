<?php
/**
 *
 */
class Plugins {

  // cache for all initialised plugins
  public static $plugins = array();


  public static function register_all() {

    // global plugins first
    foreach (glob('plugins/*/Plugin.php') as $gp) {
      @require_once $gp;
    }

    // theme plugins second
    foreach (glob('themes/'.THEME.'/plugins/*/Plugin.php') as $tp) {
      @require_once $tp;
    }

  }


  /**
   * Displays the plugins main view.
   *
   * @param string $plugin The plugin's view file located in either the themes
   *   plugins directory or the global plugin directory
   */
  public static function display($plugin, $options = array()) {

    global $loader;

    try {

      $plugin = self::get($plugin);
      $plugin->display($loader, $options);

    }

    catch (Exception $ex) {
      echo $ex->get_message(); // FIXME log error
    }

  }


  public static function get ($plugin) {

    if (array_key_exists($plugin, self::$plugins)) {
      return self::$plugins[$plugin_id];
    }

    return new $plugin();

  }


  // this will go with options to build with required scripts
  public static function pageload_scripts () {

    foreach(self::$plugins as $p) {
      @$p->onload_js();
    }

  }


  public static function register ($plugin) {

    self::$plugins[$plugin->get_id()] = $plugin;

  }

}
