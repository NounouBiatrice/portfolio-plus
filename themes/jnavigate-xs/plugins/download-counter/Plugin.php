<?php
/**
 *
 */
class DownloadCounter extends Plugin {

  protected $plugin_id = 'download-counter';


  // :public api

  public function display ($loader, $options) {

    include 'download-links.php';

  }


  public function download_url ($p, $e = true) {

    $url = 'plugins/download-counter/download.php?pkg=' . $this->package;

    if ($e) {
      echo $url;
      return true;
    }

    return $url;

  }


}
