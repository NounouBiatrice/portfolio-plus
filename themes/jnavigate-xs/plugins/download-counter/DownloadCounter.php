<?php
/**
 * 
 */
class DownloadCounter {
  
  
  private 
      $package
    , $db_file
    , $stats;
    
  
  // :public api
  
  public function __construct ($db, $p) {
    
    $this->db_file = $db;
    $this->package = $p;
    
    $this->load();
    
  }
  
  
  public function dld_url ($p, $e = true) {
    
    $url = 'plugins/download-counter/download.php?pkg=' . $this->package;
    
    if ($e) {
      echo $url;
      return true;
    }
    
    return $url;    
    
  }
  
  
  public function increment () {
    
    if (!array_key_exists($this->package, $this->stats)) {
      
      $this->stats[$this->package] = 0;
      
    }
    
    $this->stats[$this->package] = intval($this->stats[$this->package]) + 1;
    
    $this->save();
    
  }
  
  
  // :private
  
  private function load () {
    
    $this->stats = json_decode(file_get_contents($this->db_file), true);
    
  }
  
  
  private function save () {
    
    file_put_contents($this->db_file, json_encode($this->stats));
    
  }
  
}
