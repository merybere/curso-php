<?php
 
include_once ('./Mail.php');
include_once ('./Mail/Transport/Smtp.php');

$email = 'agustincl@gmail.com';
send($email);

function send($email)
{
 //Initialize needed variables
 $your_name = 'Maria Berenguer';
 $your_email = 'mariaberen@gmail.com'; //Or your_email@gmail.com for Gmail
 $your_password = 'zshah6oh';
 $send_to_name = 'Agustín';
 $send_to_email = $email;
 
 //SMTP server configuration
 $smtpHost = 'smtp.gmail.com';
 $smtpConf = array(
  'auth' => 'login',
  'ssl' => 'ssl',
  'port' => '465',
  'username' => $your_email,
  'password' => $your_password
 );
 $transport = new Zend_Mail_Transport_Smtp($smtpHost, $smtpConf);
 
 //Create email
 $mail = new Zend_Mail();
 $mail->setFrom($your_email, $your_name);
 $mail->addTo($send_to_email, $send_to_name);
 $mail->setSubject('Hello World');
 $mail->setBodyText('This is the body text of the email.');
 
 //Send
 $sent = true;
 try {
  $mail->send($transport);
 }
 catch (Exception $e) {
  $sent = false;
 }
 
 //Return boolean indicating success or failure
 return $sent;
}