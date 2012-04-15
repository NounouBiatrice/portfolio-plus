<?php
/*
* Caches API calls to a local file which is updated on a 
* given time interval.
*/
class API_cache {
  
  private 
      $update_interval // how often to update
    , $cache_file // file to save results to
    , $api_call; // API call (URL with params)

  public function __construct ($tw, $int=10, $cf='api_cache.json') {
    $this->api_call = $tw;
    $this->update_interval = $int * 60; // minutes to seconds
    $this->cache_file = $cf;
  }

  /*
   * Updates cache if last modified is greater than
   * update interval and returns cache contents
   */
  public function get_api_cache () {
    if (!file_exists($this->cache_file) || 
        time() - filemtime($this->cache_file) > $this->update_interval) {
      $this->update_cache();
    }
    return file_get_contents($this->cache_file);
  }

  /*
   * Http expires date
   */
  public function get_expires_datetime () {
    if (file_exists($this->cache_file)) {
      return date (
        'D, d M Y H:i:s \G\M\T', 
        filemtime($this->cache_file) + ($this->update_interval)
      );
    }
  }

  /*
   * Makes the api call and updates the cache 
   */
  private function update_cache () {
    // update from api if past interval time
    $fp = fopen($this->cache_file, 'w+'); // open or create cache
    if ($fp) {
      if (flock($fp, LOCK_EX)) {
        $tweets = file_get_contents ($this->api_call);
        fwrite($fp, $tweets);
        flock($fp, LOCK_UN);
      }
      fclose($fp);
    }
  }
  
}
