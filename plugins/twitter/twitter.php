<?php

  // Add your settings here ---------------------------------------------------!

  $user_name = 'phil_parsons';
  $results_per_page = 4;
  $include_retweets = 1; // (1:Yes | 0:No)
  $cache_results_for = 1; // in minutes

  // Do not edit below this point ---------------------------------------------!

  require '../app/api-cache.php';

  $cache_file = '../app/cache/twitter.json';
  $api_call = 'http://api.twitter.com/1/statuses/user_timeline.json?';
  $api_call .= 'screen_name=' . $user_name . '&';
  $api_call .= 'count=' . $results_per_page . '&';
  $api_call .= 'include_rts=' . $include_retweets;
  $cache_for = 1; // cache results for one minutes

  $api_cache = new API_cache ($api_call, $cache_for, $cache_file);
  if (!$res = $api_cache->get_api_cache())
    $res = '{"error" : "Could not load cache"}';

  ob_start();
  echo $res;
  $json_body = ob_get_clean();

  header ('Content-Type: application/json');
  header ('Content-length: ' . strlen($json_body));
  header ("Expires: " . $api_cache->get_expires_datetime());
  echo $json_body;

