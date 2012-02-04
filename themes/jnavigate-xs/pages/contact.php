<?php
/**
 * @menu_order: 4
 * @link_text: Contact
 *
 */
?>

<div>


  <section class="main-section-wsb">

    <h1>Contact</h1>

    <?php Plugins::display('ContactForm'); ?>
  </section>

  <aside id="sidebar">
    <?php $loader->partial('contact-sidebar'); ?>
  </aside>

</div>
