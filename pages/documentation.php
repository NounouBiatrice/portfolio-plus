<?php
/**
 * You can delete this page once you are all set up!
 *
 * @link_text: Getting started
 * @page_title: Documentation
 * @menu_order: 3
 */
?>

<h1>Portfolio+ guide</h1>

<h2>Installation and configuration</h2>

<p>
  Open up the site-config.php file in your favourite text editor, your
  operating system's plain text editor will do but do not use a program such as wordpad or Microsoft word. Read the instructions for
  each of sections and edit the settings accordingly.
</p>

<p>
  Once configured, using an FTP program of your choice upload the files from the downloaded zip file to a folder in the public root of your hosing account or web server.
</p>

<h2>Pages</h2>

<p>
  Pages are the main component of your Portfolio+ site. To add a new page or edit an existing one look in the <code>/pages</code> directory of this installation. Page
  files are PHP templates and need to have the .php file extension. Portfolio+
  will know about your new pages as soon as you have added them, you can tell
  it more about you page by adding what is known as a comment to the top of
  your new page file. The comment should be formatted as in the example below.
</p>

<pre><code>&lt;?php                     // this is the start of a PHP code section
/**                       // this is the start of a PHP comment
 * @link_text: Home       // The text that will show in the navigation menu
 * @menu_order: 1         // the order in which the page should appear in the menu
 * @page_title: Welcome   // The title of the html document for this page
 */                       // The end of the comment
?&gt;                        // The end of the PHP code section
</code>
</pre>

<h2>Partials</h2>

<p>
  Partials are small pieces of reusable content for your pages. Partials live in the <code>/parials</code> directory and can be
  either PHP templates or plain text files such as .html, .txt, .xml
  etc. To load a page partial into a page you need to ask the page
  loader to display it with a short snippet of PHP. If your page partial is a PHP template you may omit the file extension.
</p>

<pre><code>&lt;?php $loader->partial('yourfile.html'); ?&gt;</code></pre>

<h2>Plugins</h2>

<p>
  Portfolio+ comes with a few plugins to get you started such as the
  contact form and twitter widget. To display a plugin within your page
  you need to ask the Plugin controller. Instructions on how to use
  each plugin can be found in the README.txt file within the plugins
  installation folder in the <code>/plugins</code> directory.
</p>

<pre><code>&lt;?php Plugins::display('Twitter'); ?&gt;</code></pre>

<h2>Theming</h2>

<p>
  Creating a theme for your Portfolio+ site is actually very easy and
  if you know how to code some HTML and CSS you are half way there.
  For full documentation on how to create and share your own theme please visit the <a href="http://www.jnavigate.com/portfolio-plus">Portfolio+ theme development guide</a>.
</p>
