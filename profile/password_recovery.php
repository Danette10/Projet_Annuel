<?php
  session_start();
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: Recovery</title>
    <?php include('../includes/bootstrap.php'); ?>
  </head>
  <?php include('../includes/header.php'); ?>
  <body>
    <form action="password_recovery.php" method="post" class="needs-validation">
      <div class="col-sm-4 mx-auto pt-5">
        <input type="email" name="email" id="email" placeholder="Type your email" class="form-control">
        <br>
        <input type="submit" name="formrecovery" id="formrecovery" class="btn btn-success" value="Submit">
      </div>

    </form>
  </body>
</html>
<?php
include('../includes/db.php');
if (isset($_POST['formrecovery'])) {
  if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $q = $db->prepare('SELECT email FROM ACCOUNT WHERE email = :email');
    $q->execute([
      'email' => $email
    ]);

    require "../PHPMailer/src/PHPMailer.php";
    require "../PHPMailer/src/SMTP.php";
    require "../PHPMailer/src/Exception.php";

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
    $mail->Subject = 'Reset your password';
    $mail->Message = 'Recovery your password !';
    $mail->msgHTML(

      '<img src="http://51.91.121.106/images/LogoProjet.svg" class="logo float-left m-2 h-75 me-4" width="95" alt="Logo">
      <p class="display-2">You have requested the recovery of your password, please click on this link to access the modification:<br></p>
      <div align="center"><a href="http://51.91.121.106/profile/new_password.php">Reset your password !</a>'
    );
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo "mail envoyé";
      header('Refresh: 5;../index.php');
    }
  }else {
    echo "Votre email n'est pas enregistrer dans notre base de données !";
  }
}
 ?>
