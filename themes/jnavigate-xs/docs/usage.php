<h1>Using jNavigate with PHP</h1>

<p>
  The code sample shown here details a very simple PHP portfolio site setup to
  use jNavigate to enable it as a single paged application. The code is commented in 
  the required areas to give a better understanding of how the plugin and PHP code
  work together.
</p>


<pre class="prettyprint lang-php"><code>
  &lt;?php
  
    // in this example http://mysite.com/index.php?page=contact is the 
    // requested URL and contact.php is the php page we want to display
    // the check here just makes sure the parameter is set and if not 
    // defaults to the home page
    $page = array_key_exists('page', $_GET) ? $_GET['page'] : 'home';
  
    // The URL was requested by the jNavigate plugin. jNavigate will add 
    // the jnavigate=1 flag to the data of each GET or POST request 
    // it makes.
    if (array_key_exists('jnavigate', $_REQUEST)) {
      
      // include the template and stop further execution
      include($page.'php');
      exit();
      
    }
    
    // if the page is not requested with jnavigate then normal processing
    // continues and the entire document is returned to the browser
    
  ?&gt;
  &lt;!DOCTYPE html&gt;
  &lt;html lang="en"&gt;
    &lt;head&gt;
      &lt;meta charset="utf-8" /&gt;
      &lt;title&gt;My portfolio&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
    
      &lt;nav&gt;
        &lt;ol&gt;
          &lt;?php 
            // add the jnav-ext class to navigation links to use as 
            // external triggers
          ?&gt;
          &lt;li class="jnav-ext" href="index.php?page=home"&gt;Home&lt;/li&gt;
          &lt;li class="jnav-ext" href="index.php?page=about"&gt;About&lt;/li&gt;
          &lt;li class="jnav-ext" href="index.php?page=work"&gt;Work&lt;/li&gt;
        &lt;/ol&gt;
      &lt;/nav&gt;
  
      &lt;article id="main-article"&gt;
        &lt;?php
          // output the page normally
          include($page.'php');
        ?&gt;
      &lt;/article&gt;
            
    &lt;script src="http://code.jquery.com/jquery-1.7.1.min.js"&gt;&lt;/script&gt;
    &lt;script src="js/jnavigate.jquery.min.js"&gt;&lt;/script&gt;
    &lt;script&gt;
      
      $(function () {
        
        // initialise jnavigate with 
        // our internal and external
        // trigger classes
        $("#main-article").jNavigate({
            extTrigger: '.jnav-ext'
          , intTrigger: '.jnav-int'
        });
        
      });
     
    &lt;/script&gt;
    &lt;/body&gt;
  &lt;/html&gt;

</code>
</pre>

<p>
  This example is simplified and it should be noted that further checking should
  be made to ensure that the requested page's template does indeed exist.
</p>