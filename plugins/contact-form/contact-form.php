<?php if (array_key_exists('msg-snt', $_GET)) : ?>

  <p id="msg-snt">
    Thanks! your message has bee sent and we'll be
    back in touch soon as we can.
  </p>

<?php else : ?>

  <form id="contact-form" action="" method="post">

    <div>
      <label>Your name</label>
      <?php $cf->error_msg('user-name'); ?>
      <input class="cntct-frm-fld" type="text" name="user-name" value="">
    </div>

    <div>
      <label>Your email</label>
      <?php $cf->error_msg('user-email'); ?>
      <input class="cntct-frm-fld" type="email" name="user-email" value="">
    </div>

    <div>
      <label>Your message</label>
      <?php $cf->error_msg('user-message'); ?>
      <textarea cols="30" rows="8" class="cntct-frm-fld" name="user-message"></textarea>
    </div>

    <div>
      <input class="jnav-internal" type="submit" name="send" value="Send">
    </div>

  </form>

<?php endif; ?>

