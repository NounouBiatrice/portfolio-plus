<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="js/jnavigate.jquery.js"></script>

<!--[if IE]>
  <script src="js/history.js"></script>"
<![endif]-->

<?php @include $loader->theme_url() . '/js/scripts.php'; ?>

<script>

  $(function () {

    prettyPrint(); // syntax highlighting
    
    <?php Plugins::pageload_scripts() ?>
    
    $("#main-article").jNavigate({
        extTrigger: '.jnav-external'
      , intTrigger: '.jnav-internal'
      , spinner: <?php echo '"themes/'.THEME.'/styles/images/ajax-loader.gif"'; ?>
      , spinnerPosition: 'center 30px'
      , loaded: updatePageInfo
      , cacheDocumentTitle: true
      , loadingColor: "#D9D9D9"
    });
    
  });
  
  var updatePageInfo = function (html) {
    
    var data = $(this).data();
    
    if (data && "jnavlasttrigger" in data) {
      
      $trigger = data['jnavlasttrigger'];
      $(".main-nav-link").removeClass("current");
      
      if ($trigger.hasClass("main-nav-link")) {
        $trigger.addClass("current");
      }
      
      tdata = $trigger.data();
      
      if (tdata && tdata.pagetitle) {
       document.title = tdata.pagetitle;
      }
      
    }

    prettyPrint(); // syntax highlighting

  };
  
</script>