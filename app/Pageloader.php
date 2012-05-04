<?php
/**
 * View rendering engine. Load pages/partials and provides utils for creating
 * menus and interacting with page properties
 *
 * @author Phil Parsons <philparsons.co.uk>
 * @package jNavigate
 *
 */
class PageLoader {

  private
      $pages
    , $curr_page
    , $ordered_page_keys; // Order pages for site navigation


  public function __construct($page) {

    if (!CACHE_ENABLED) {
      $this->pages = array();
      $this->load_pages();
      $this->set_page($page);
    }

  }


  // :public API

  /**
   * Renders a list of page links for use as a navigation menu.
   *
   * @param string $li_class css class name to give to the list items.
   * @param string $a_class css class name to give to the page links.
   * @param string $tag HTML tag to use for the list items.
   *
   */
  public function page_links($li_class = '', $a_class = '', $tag = 'li') {

    $links = '';
    $page_num = 1;

    foreach ($this->ordered_page_keys as $key) {

      $page = $this->pages[$key];
      $links .= '<' . $tag . ' id="page-' . $page_num++ . '"';

      if (strlen($li_class)) {
         $links .= ' class="' . $li_class . '"';
      }

      $links .= '><a ';

      if ($this->curr_page['page'] === $page['page']) {
        $links .= 'class="' . trim('current ' . $a_class) . '" ';
      }
      elseif (strlen($a_class)) {
         $links .= 'class="' . $a_class . '" ';
      }

      $links .= 'href="' . $page['path']. '"';

      if (array_key_exists('page_title', $page)) {
        $links .= ' data-pagetitle="'. htmlentities($page['page_title']) . '"';
      }

      $links .= '><span>';

      if (array_key_exists('link_text', $page)) {
        $links .= $page['link_text'];
      }
      else {
        $links .= $page['page'];
      }

      $links .= '</span></a></' . $tag . '>';

    }

    echo $links;

  }


  /**
   * Renders the current page title from meta data or from tidied up file name
   * if no page title has been provided.
   */
  public function page_title() {

    $title = array_key_exists('page_title', $this->curr_page) ?
      $this->curr_page['page_title'] :
      $this->curr_page['page'];

    echo $title;

  }


  /**
   * Renders the current page.
   */
  public function view() {

    $loader = $this; // for consistency in templates
    include 'pages/' . $this->curr_page['page'] . '.php';

  }


  /**
   * Identifies if the current page is the home page.
   *
   * @return boolean
   */
  public function is_home_page() {

    return ( strtolower($this->curr_page['page']) === 'home' );

  }


  /**
   * Getter for the class of a page
   *
   * @param string $page Name of a page
   */
  public function page_class($page = null) {

    $page = $page ? $this->pages[$page] : $this->curr_page;

    if (array_key_exists('css_class', $page)) {
      echo $page['css_class'];
      return;
    }

    echo strtolower(preg_replace('/[^\w\d]/', '-', $page['page']));

  }


  /**
   * Getter for a page's resource identifier
   *
   * @param string $page Name of the page to get the URI
   * @return string
   */
  public function page_link_url($page = null, $qs = null, $ic = false) {

    $ret = preg_replace(
        '/\?.*$/'
      , ''
      , $page ? $this->pages[$page]['path'] : $this->curr_page['path']
    );

    if ($qs) { // have query string parameters

      if (array_key_exists('query', $qs)) {

        if ($ic) {
          $qs['query'] = $this->url_query_params($qs['query']);
        }

        $ret .= '?' . http_build_query($qs['query']);

      }

      if (array_key_exists('hashtag', $qs)) {
        $ret .= '#' . $qs['hashtag'];
      }

    }

    return $ret;

  }


  public function url_query_params($additional = null) {

    $ret = array();

    foreach(explode('&', $_SERVER['QUERY_STRING']) as $qp) {

      $key_val = explode('=', $qp);
      $ret[$key_val[0]] = $key_val[1]; // TODO: check exists

    }

    if ($additional) {
      $ret = array_merge($ret, $additional);
    }

    return $ret;

  }


  /**
   * Getter for the active themes base URL
   *
   * @param boolean $e Set true to render the URL false to return
   * @return string|void
   */
  public function theme_url($e = false) {

    if ($e) echo 'themes/'.THEME.'/';
    else return 'themes/'.THEME."/";

  }


  /**
   * Renders a page parial
   *
   * @param string $path The path to the page partial from the themes base URL.
   *
   */
  public function partial($path) {

    $loader = $this; // for consistency in templates

    if (preg_match('/\.[A-Za-z]{2,4}$/', $path) === 0) {
      $path = $path . '.php';
    }

    // should be here
    if (file_exists('partials/' . $path)) {

      include 'partials/' . $path;
      return true;

    }

    // but could be in here
    if (file_exists($this->theme_url() . $path)) {

      include $this->theme_url() . $path;
      return true;

    }

    // really shouldn't be in here
    if (file_exists($path)) {

      include $path;
      return true;

    }

    throw new Exception('Failed to load page partial: ' . $path);

  }


  public function javascript($use_jnavigate = true) {

    if ($use_jnavigate) {
      echo '<script src="assets/js/jnavigate.jquery.min.js"></script>';
    }

    Plugins::javascript();

  }


  // :private

  // set the current page
  private function set_page($page) {

    if (array_key_exists($page, $this->pages)) {

      $this->curr_page = $this->pages[$page];
      return;

    }

    throw new Exception('Unable to load default page');

  }


  // read the theme directory and load pages
  private function load_pages() {

    foreach (glob('pages/*.php') as $page) {

      if ($fc = file_get_contents($page)) {

        $matches = array();
        $info = '';

        if (preg_match('/^\s*<\?php([^\?>]+)\?>/', $fc, $matches) > 0) {
          $info = $matches[1];
        }

        $this->add_page($page, $info);

      }

      else {
        throw new Exception('Could not read metadata for page (' . $page . ')');
      }

    }

    $this->sort_pages();

  }


  // adds a page to the pages cache
  private function add_page($page, $info_str) {

    $matches = array();
    $page_name = preg_replace(
        '%^\/?pages/([\w\d-]+).php%'
      , '\1'
      , $page
    );

    $path = $page_name;

    if (!USE_PP) { // not using pretty permalinks so build full path
      $path = 'index.php?page=' . $page_name;
    }

    if ($info_str) { // page has meta comments

      $patt = '/@([^:]+):\s*(.+?)\s*$/m';

      if (preg_match_all($patt, $info_str, $matches, PREG_SET_ORDER) > 0) {

        $page_info = array('page' => $page_name, 'path' => $path);

        foreach ($matches as $match) { // add each meta item
          $page_info[$match[1]] = $match[2];
        }

        $this->pages[$page_name] = $page_info;

        return;

      }

    }

    // couldn't determine page info so just use file name
    $this->pages[$page_name] = array (
        'page' => $page_name
      , 'page_title' => $page_name
      , 'link_text' => $page_name
      , 'path' => $path
    );

  }


  // sort pages based on their menu_order (if they have one)
  private function sort_pages() {

    $keys = array_keys($this->pages);
    $num_pages = count($keys);

    for ($i = 0; $i < ($num_pages - 1); ++$i) {

      $swap_rank = array_key_exists('menu_order', $this->pages[$keys[$i]]) ?
        $this->pages[$keys[$i]]['menu_order'] :
        999;

      $swap_to = $i;

      for ($j = ($i + 1); $j < $num_pages; $j++) {

        $test_rank = array_key_exists('menu_order', $this->pages[$keys[$j]]) ?
          $this->pages[$keys[$j]]['menu_order'] :
          999;

        if ($test_rank < $swap_rank) { // ranked higher then swap

          $swap_to = $j;
          $swap_rank = $test_rank;

        }

      }

      if ($swap_to !== $i) { // move this page if found a higher ranked page

        $tmp = $keys[$i];
        $keys[$i] = $keys[$swap_to];
        $keys[$swap_to] = $tmp;

      }

    }

    $this->ordered_page_keys = $keys;

  }

}
