<?php
/**
 * @link_text: Documentation
 * @page_title: jNavigate documentation
 * @menu_order: 2
 *
 */
?>

<?php if (array_key_exists('example', $_GET)) : ?>

  <section id="documentation-item" class="main-section-wsb">

    <a class="jnav-internal bk-lnk" href="<?php echo $loader->page_link_url('docs', array('hashtag' => $_GET['example'], 'query' => array('one' => 'two'))); ?>">&laquo; Back to documentation home</a>

    <?php $loader->partial('docs/' . $_GET['example'] . '.php'); ?>

  </section>

<?php else : ?>

  <section id="documentation-overview" class="main-section-wsb">

    <h1>Plugin options and API</h1>

    <p>
      jNavigate enables a content area to be loaded asynchronously from links and form controls both internal and external to that
      content area. jNavigate also provides utility methods for loading resources into a content area with the addition of
      dynamic loading overlays. This page details the <abbr title="Application Programming Interface">API</abbr> for jNavigate with descriptions
      for all of it's options, events and methods.
    </p>

    <h2 id="usage">Usage</h2>

    <p>
      To use jNavigate with it's default options simply enable your content area as you would any other jQuery plugin. In the
      basic example below <code>"#my-content-section"</code> is an example selector for a content area. See the
      <a href="http://api.jquery.com/category/selectors/">jQuery selector documentation</a> if you need help with selectors.
    </p>

<pre class="prettyprint lang-js">
<code class="language-javascript">
  $("#my-content-section").jNavigate();
</code>
</pre>

    <p>
      A mored detailed example shown with a simple PHP setup for a single paged portfolio site can be
      <a href="<?php echo $loader->page_link_url(null, array('query' => array('example' => 'usage'))); ?>" class="jnav-internal">found here</a>. Alternatively, if you would like
      a free, ready built solution with plugin options such as contact forms and image galleries be sure to
      checkout <a href="<?php echo $loader->page_link_url('portfolio'); ?>">Portfolio plus</a>.
    </p>

    <h2>Option reference</h2>

    <ol class="documentation-list">

      <li>

        <h3><a id="inttrigger" href="docs?example=inttrigger" class="jnav-internal doc-example">intTrigger</a></h3>

        <p>Accepts: <code>selector (".jnavigate-int-trigger")</code></p>

        <p class="api-description">
          Selector for the internal navigation links located within the content area. If selector references an a tag then the content area
          will be loaded from the tags <code>href</code> attribute. If selector references a form control then the form is posted to the
          action URL of the parent form.
        </p>

      </li>

      <li>

        <h3><a id="exttrigger" href="docs?example=exttrigger" class="jnav-internal doc-example">extTrigger</a></h3>

        <p>Accepts: <code>selector (".jnavigate-ext-trigger")</code></p>

        <p class="api-description">
          Selector for the external navigation links located within the content area. If selector references an a tag then the content area
          will be loaded from the tags <code>href</code> attribute. If selector references a form control then the form is posted to the
          action URL of the parent form.
        </p>

      </li>

      <li>

        <h3><a id="switchcontent" href="docs?example=switchcontent" class="jnav-internal doc-example">switchContent</a></h3>

        <p>Accepts: <code>boolean (true)</code></p>

        <p class="api-description">
          A switch that determines if jNavigate should replace the HTML of the content area. This can be used in conjunction with the
          <a href="#loaded">loaded event</a> if you require to do some pre-processing with the content returned from the server before
          updating.
        </p>

      </li>

      <li>

        <h3 id="scrolltoposition">scrollToPostion</h3>

        <p>Accepts: <code>boolean (false)</code></p>

        <p class="api-description">
          A switch that determines if jNavigate should sroll the window to either the top of the page or to the target hash in the
          pages URL.
        </p>

      </li>

      <li>

        <h3 id="scrollspeed">scrollSpeed</h3>

        <p>Accepts: <code>Number (0)</code></p>

        <p class="api-description">
          Used in conjunction with the <code>scrollToPosition</code> option. The speed at which to animate the window scrolling.
        </p>

      </li>

      <li>

        <h3 id="showloader">showLoader</h3>

        <p>Accepts: <code>boolean (true)</code></p>

        <p class="api-description">
          A switch that determines if jNavigate should display a loading overlay over the content area during the request process.
        </p>

      </li>

      <li>

        <h3 id="loadingcolor">loadingColor</h3>

        <p>Accepts: <code>string ("#FFFFFF")</code></p>

        <p class="api-description">
          The background colour of the loading overlay. Use this option with <a href="#showLoader">showLoader</a>.
        </p>

      </li>

      <li>

        <h3 id="spinner">spinner</h3>

        <p>Accepts: <code>string ("style/images/ajax-loader.gif")</code></p>

        <p class="api-description">
          The background image URL of the loading overlay. Use this option with <a href="#showLoader">showLoader</a>.
        </p>

      </li>

      <li>

        <h3 id="spinnerposition">spinnerPosition</h3>

        <p>Accepts: <code>string ("center")</code></p>

        <p class="api-description">
          The background position of the loading overlay. Use this option with <a href="#showLoader">showLoader</a>.
        </p>

      </li>

      <li>

        <h3 id="usehistory">useHistory</h3>

        <p>Accepts: <code>boolean (true)</code></p>

        <p class="api-description">
          A switch that determines if the state of the application/site should be pushed onto the history stack. Only
          works if visitors web browser supports the History API.
        </p>

      </li>

      <li>

        <h3 id="cachedocumenttitle">cacheDocumentTitle</h3>

        <p>Accepts: <code>boolean (true)</code></p>

        <p class="api-description">
          A switch that determines if the document title should be stored with the history state. Use in conjunction with
          useHistory to keep store the document title in the data attribute of the content area.
        </p>

      </li>

    </ol>

    <h2>Events</h2>

    <ol class="documentation-list">

      <li>

        <h3 id="loaded">loaded</h3>

        <p class="api-description">
          A function to run once the HTML has been successfully retrieved from the server. The functions scope is bound
          to the jNavigate container element and will receive the HTML loaded from as it's only parameter.
        </p>

      </li>

      <li>

        <h3 id="error">error</h3>

        <p class="api-description">
          A function to run on the event that the request should fail. See the
          <a href="http://api.jquery.com/ajaxError/">jQuery Ajax documentation</a> for more details on the error event.
        </p>

      </li>

    </ol>

    <h2>Methods</h2>

    <ol class="documentation-list">

      <li>

        <h3 id="overlay">overlay()</h3>

        <p class="api-description">
          Add a loading overlay to an element. Example coming soon.
        </p>

      </li>

      <li>

        <h3 id="navigate">navigate()</h3>

        <p class="api-description">
          Load a url into a content area. Example coming soon.
        </p>

      </li>

      <li>

        <h3 id="destroy">destroy()</h3>

        <p class="api-description">
          Remove the plugin from selected content areas. Example coming soon.
        </p>

      </li>

    </ol>

  </section>

<?php endif; ?>

<aside id="sidebar">
  <?php $loader->partial('docs-sidebar.php'); ?>
</aside>

<?php Plugins::display('DownloadCounter'); ?>
