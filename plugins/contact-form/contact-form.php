<?php if (array_key_exists('msg-snt', $_GET)) : ?>

  <p id="msg-snt">
    Thanks! your message has bee sent and we'll be
    back in touch soon as we can.
  </p>

<?php else : ?>

  <form id="contact-form" action="" method="post">

    <div>
      <label>Your name</label>
      <input type="text" name="user-name" value="">
      <?php $cf->error_msg('user-name'); ?>
    </div>

    <div>
      <label>Your email</label>
      <input type="email" name="user-email" value="">
      <?php $cf->error_msg('user-email'); ?>
    </div>

    <div>
      <label>Your message</label>
      <textarea name="user-message"></textarea>
      <?php $cf->error_msg('user-message'); ?>
    </div>

    <div>
      <input class="jnav-internal" type="submit" name="send" value="Send">
    </div>

  </form>

<?php endif; ?>

