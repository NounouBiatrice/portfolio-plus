<?php
    
  if (array_key_exists('pkg', $_GET)) {
    
    require 'DownloadCounter.php';
    
    $db_file = 'packages/manifest.json';
    
    $dc = new DownloadCounter($db_file, $_GET['pkg']);
    $dc->increment();
    
    header ('location:packages/'.$_GET['pkg']);
    
  }
