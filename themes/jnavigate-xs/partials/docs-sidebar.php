<?php $page_url = $loader->page_link_url(); ?>

<nav id="documentation-overview">

  <h3>Usage</h3>

  <ol>

    <li class="doc-link">
      <a class="jnav-internal" href="<?php echo $loader->page_link_url(null, array('query' => array('example' => 'usage'))); ?>">Example usage</a>
      <p>Example of using jNavigate with PHP.</p>
    </li>

  </ol>

  <h3>Options</h3>

  <ol>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#inttrigger'; ?>">intTrigger</a>
      <p>The internal navigation trigger.</p>
    </li>

    <li class="doc-link">
      <a  href="<?php echo $page_url . '#exttrigger'; ?>">extTrigger</a>
      <p>The external navigation trigger.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#switchcontent'; ?>">switchContent</a>
      <p>Enable replacement of the content area html.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#scrolltoposition'; ?>">scrollToPosition</a>
      <p>Scroll the browser window after loading the content.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#scrollspeed'; ?>">scrollSpeed</a>
      <p>The speed at which to scroll to position</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#showloader'; ?>">showLoader</a>
      <p>Enable the loading gif overlay.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#loadingcolor'; ?>">loadingColor</a>
      <p>Color of the loading gif overlay.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#spinner'; ?>">spinner</a>
      <p>The loading gif url.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#spinnerposition'; ?>">spinnerPosition</a>
      <p>Position to display the loading gif.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#usehistory'; ?>">useHistory</a>
      <p>Enable the browser back button.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#cachedocumenttitle'; ?>">cacheDocumentTitle</a>
      <p>Remember the document title in history.</p>
    </li>

  </ol>

  <h3>Events</h3>

  <ol>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#loaded'; ?>">loaded</a>
      <p>Callback function to run on content load.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#error'; ?>">error</a>
      <p>Function to run on request error.</p>
    </li>

  </ol>

  <h3>Methods</h3>

  <ol>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#overlay'; ?>">overlay</a>
      <p>Cover an element with a loading overlay.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#navigate'; ?>">navigate</a>
      <p>Asynchronously load content into an element.</p>
    </li>

    <li class="doc-link">
      <a href="<?php echo $page_url . '#destroy'; ?>">destroy</a>
      <p>Kill the selected areas.</p>
    </li>

  </ol>

</nav>
