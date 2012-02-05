<?php

  if (array_key_exists('pkg', $_GET)) {

    $package = $_GET['pkg'];
    $db_file = 'packages/manifest.json';
    $stats = json_decode(file_get_contents($db_file), true);

    if (!array_key_exists($package, $stats)) {
      $stats[$package] = 0;
    }

    $stats[$package] = intval($stats[$package]) + 1;
    file_put_contents($db_file, json_encode($stats));

    header ('location:packages/'.$_GET['pkg']);

  }
