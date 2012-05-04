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
      echo $ex->get_message(); // FIXME: log this error once there is an error log
    }

  }


  public static function get($plugin) {

    if (array_key_exists($plugin, self::$plugins)) {
      return self::$plugins[$plugin];
    }

    return self::register($plugin);

  }


  public static function javascript() {

    foreach(self::$plugins as $p) {

      if ($script = @$p->js()) {
        echo '<script src="plugins/' . $script . '"></script>';
      }

    }

  }


  public static function css() {

    foreach(self::$plugins as $p) {

      if ($css = @$p.css()) {
        echo '<link rel="stylesheet" href="' . $css . '">';
      }

    }

  }


  public static function register($plugin_name) {

    self::$plugins[$plugin_name] = new $plugin_name();
    return self::$plugins[$plugin_name];

  }

}
