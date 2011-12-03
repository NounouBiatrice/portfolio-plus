<?php
/**
 * @menu_order: 4
 * @link_text: Contact Us
 * 
 */ 
?>

<?php $loader->partial('contact_form.php'); ?>

<h1>Contact us</h1>

<form id="contact-form" action="" method="post">
  
  <div>
    <input type="text" name="user-name" value="">
    <label>Your name</label>
  </div>
  
  <div>
    <input type="email" name="user-email" value="">
    <label>Your email</label>
  </div>
  
  <div>
    <textarea name="user-message"></textarea>
    <label>Your message</label>
  </div>
  
  <div>
    <input class="jnav-internal" type="submit" name="send" value="Send">
  </div>
  
</form>
