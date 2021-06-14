<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include('bootstrap.php');

require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";
require "../PHPMailer/src/Exception.php";

$email = $_GET['email'];
$token = $_GET['token'];
$id_account = $_GET['id_account'];

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'email';
$mail->Password = 'mdp';
$mail->setFrom('email', 'No-Reply');
$mail->addAddress($email);
$mail->Subject = 'Confirm your registration';
$mail->Message = 'Valid your registration !';
$mail->msgHTML(

  "<img src='https://dna-esgi.fr/images/LogoProjet.svg' class='logo float-left m-2 h-75 me-4' width='95' alt='Logo'>
  <p class='display-2'>Thank you for your interest in our site, please click on the link below to confirm your registration:<br></p>
  <div align='center'><a href='https://dna-esgi.fr/includes/conf_registration.php?id_account=". $id_account . "&token=" . $token ."'>Confirm your account !</a>"
);
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo "
    <div class='mx-auto text-center'>
    <div class='alert alert-success' role='alert'>
      <h4 class='alert-heading display-5'>Well done !</h4>
      <p class='display-5'>Look at your mailbox you must
      have received a confirmation email. <br>Check your spam if we are not in your inbox.</p>
      <hr>
      <p class='mb-0 fs-3'>Click the link in the email to start enjoying our site fully.</p>
      <p class='mb-0 fs-3'>You can close this page. If you did not receive the email, click <a href='https://dna-esgi.fr/includes/email_resend.php?id_account=".$id_account."&token=".$token."'>here</a> to resend it.
      </div>
      </div>
    </div>
    </div>
    ";
}

 ?>
