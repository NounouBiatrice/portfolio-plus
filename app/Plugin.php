<?php

abstract class Plugin {

  abstract public function display($loader, $options);

  public function __construct () {}

}
