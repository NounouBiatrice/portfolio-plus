<h1>External triggers - extTrigger</h1>

<pre class="prettyprint lang-js"><code>
  $("#jnav-main").jNavigate({
    extTrigger: "nav a"
  });
  
</code></pre>

<p>
  The <code>extTrigger</code> option tells jNavigate which elements to
  watch for click events outside the content area. If the element is a link 
  or form control jNavigate will detect that the user has clicked the element
  and will then navigate the content area to either the <code>href</code> 
  of the link or the <code>action</code> attribute of the controls parent form. 
  If the clicked element is a form control then the form will be submitted via 
  the HTTP method attribute set on the parent form, defaulting to GET.
</p>

<p>
  The below HTML snippet shows a content area <code>#jnav-main</code> that will
  be loaded with the contents of the pages that each of the navigation links
  point to.
</p>

<pre class="prettyprint lang-html"><code> 
  &lt;nav&gt;
    &lt;a href="pages/home"&gt;Home&lt;/a&gt;
    &lt;a href="pages/about"&gt;About&lt;/a&gt;
    &lt;a href="pages/contact"&gt;Contact&lt;/a&gt;
  &lt;/nav&gt;
    
  &lt;section id="jnav-main"&gt;
    
    &lt;p&gt;
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
      Phasellus sapien felis, adipiscing porttitor scelerisque 
      rhoncus, elementum in lectus.
    &lt;/p&gt;
    
  &lt;/section&gt;

</code>
</pre>