<?php
/**
 * @menu_order: 4
 * @link_text: Contact
 * 
 */ 
?>

<?php $loader->partial('contact-form.php'); ?>

<div id="under-construction">
  
  <h1>Contact</h1>
  
  <?php Plugins::display('contact-form'); ?>
  
  <p>
    I'm currently working on the plugin architecture for 
    <a href="<?php echo $loader->page_link_url('portfolio-plus'); ?>" class="jnav-internal">Portfolio+</a>
    and will have a contact form here once complete. In the meantime, if you would 
    like to contact me about the development progress or usage of the projects
    presented on this site then please visit my <a href="http://philparsons.co.uk">personal
    site and use the contact form there.</a>
  </p>

</div>