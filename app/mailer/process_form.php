<?php

require 'Mailer.php';

if (array_key_exists('name', $_POST)) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  
  $mail = new Mailer($name, $email, 'phil@profilepicture.co.uk', 'New Form Submission', $message);
  $result = array('sent' => false, 'message' => '');
  
  if($mail->validate()) {
    $result['sent'] = $mail->send();
  } else $result['message'] = 'Invalid email address';
  
  echo json_encode($result);
  
}