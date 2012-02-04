<?php
/**
 * @menu_order: 4
 * @link_text: Contact
 *
 */
?>

<div>

  <h1>Contact</h1>

  <?php Plugins::display('ContactForm'); ?>

  <aside id="sidebar">
    <?php $loader->partial('contact-sidebar'); ?>
  </aside>

</div>
