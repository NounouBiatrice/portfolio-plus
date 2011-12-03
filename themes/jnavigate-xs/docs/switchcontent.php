<h1>Switching content - switchContent</h1>

<pre class="prettyprint lang-js"><code>
  $("#jnav-main").jNavigate({
      switchContent: false
    , loaded: preprocessHTML
  });
  
  function preprocessHTML(html) {
    
    $(html)
      .find(".some-links")
      .css("color", "red");
    );
    
    this.html(html); // 'this' is bound to #jnav-main
    
  }
  
</code></pre>

<p>
  The <code>switchContent</code> option tells jNavigate whether it can go ahead
  and replace the content areas HTML with the HTML returned from the server. By 
  default jNavigate will do this but turning it off gives the option to perform
  some preprocessing on the returned HTML as shown in the above example.
</p>
