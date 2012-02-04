<?php

class ContactForm extends Plugin {

  protected $plugin_id = "contact-form";
  private
      $from_address
    , $to_address
    , $template = "default.php"
    , $errors;


  // :public api

  public function display ($loader, $options) {

    $cf = $this;

    $can_send = false;
    $this->errors = array();

    if (array_key_exists('user-name', $_POST)) {

      $un = $_POST['user-name'];
      $ue = $_POST['user-email'];
      $um = $_POST['user-message'];

      $this->validate($un, $ue, $um);

      if (count($this->errors) === 0) {
        $this->send($un, $ue, $um);
      }

    }

    include 'contact-form.php';

  }

  public function error_msg ($field) {

    if (array_key_exists($field, $this->errors)) {
      echo '<span class="cnt-frm-err">'.$this->errors[$field].'</span>';
    }

  }


  // :private

  // validates the form submission
  private function validate ($username, $email, $message) {

    if (strlen(trim($username)) === 0) {
      $this->errors['user-name'] = 'Please enter your name';
    }

    if (strlen(trim($email)) === 0 || !Mailer::validate($email)) {
      $this->errors['user-email'] = 'Please enter a valid email address';
    }

    if (strlen(trim($email)) === 0) {
      $this->errors['user-message'] = "Please enter a message";
    }

  }

  // builds the template and sednds the email
  private function send ($username, $email, $message) {

    global $loader;

    ob_start();
    include 'templates/'.$this->template;
    $mb = ob_get_clean();

    $mailer = new Mailer(
        $username
      , $email
      , ADMIN_EMAIL
      , 'New form submission'
      , $mb
    );

    $mailer->send();
    header('location:'.$loader->page_link_url(null, array('query' => array(
      'msg-sent' => 1
    ))));

  }

}
