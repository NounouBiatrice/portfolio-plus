<?php if ($cf->message_sent()) : ?>

  <p class="success-notif">
    Thanks! your message has bee sent and we'll be
    back in touch soon as we can.
  </p>

<?php elseif ($cf->has_errors()) : ?>

  <p class="warning-notif">
    There were some problems with your form submission. Please
    correct them and try to send again.
  </p>

<?php endif; ?>

<form id="contact-form" action="" method="post">

  <div>
    <label>Your name</label>
    <?php $cf->error_msg('user-name'); ?>
    <input class="cntct-frm-fld" type="text" name="user-name"
      value="<?php $cf->field_value('user-name'); ?>">
  </div>

  <div>
    <label>Your email</label>
    <?php $cf->error_msg('user-email'); ?>
    <input class="cntct-frm-fld" type="email" name="user-email"
      value="<?php $cf->field_value('user-email'); ?>">
  </div>

  <div>
    <label>Your message</label>
    <?php $cf->error_msg('user-message'); ?>
    <textarea cols="30" rows="8" class="cntct-frm-fld" name="user-message"><?php $cf->field_value('user-message'); ?></textarea>
  </div>

  <div>
    <input class="jnav-internal" type="submit" name="send" value="Send">
  </div>

</form>
