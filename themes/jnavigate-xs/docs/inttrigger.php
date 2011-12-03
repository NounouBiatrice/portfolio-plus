<h1>Internal triggers - intTrigger</h1>

<pre class="prettyprint lang-js"><code>
  $("#jnav-main").jNavigate({
    intTrigger: ".jnav-int"
  });
  
</code></pre>

<p>
  The <code>intTrigger</code> option tells jNavigate which elements to
  watch for click events inside the content area. If the element is a link 
  or form control jNavigate will detect that the user has clicked the element
  and will then navigate the content area to either the <code>href</code> 
  of the link or the <code>action</code> attribute of the controls parent form. 
  If the clicked element is a form control then the form will be submitted via 
  the HTTP method attribute set on the parent form, defaulting to GET.
</p>

<p>
  The below HTML snippet shows a content area <code>#jnav-main</code> that will
  be loaded with the contents of the page at <em>articles/latin-text#more</em>
  when the link <code>.jnav-int</code> is clicked.
</p>

<pre class="prettyprint lang-html"><code> 
  &lt;section id="jnav-main"&gt;
    
    &lt;p&gt;
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
      Phasellus sapien felis, adipiscing porttitor scelerisque 
      rhoncus, elementum in lectus.
      
      &lt;a class="jnav-int" href="articles/latin-text#more"&gt;
        Continue reading
      &lt;/a&gt;
      
    &lt;/p&gt;
    
  &lt;/section&gt;

</code>
</pre>
