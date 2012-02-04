<?php

abstract class Plugin {

  abstract public function display($loader, $options);

  public function __construct () {

    Plugins::register($this);

  }

  public function get_id() {

    return $this->plugin_id;

  }

}
