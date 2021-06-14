<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: New Password</title>
    <?php include('../includes/bootstrap.php'); ?>
  </head>
  <?php include('../includes/header.php'); ?>
  <body>
    <form action="new_password.php" method="post" class="needs-validation">
      <div class="col-sm-4 mx-auto pt-5">
        <input type="email" name="email" id="email" placeholder="Type your email" class="form-control">
        <br>
        <input type="password" name="password" id="password" placeholder="Type your new password" class="form-control">
        <br>
        <input type="password" name="cpassword" id="cpassword" placeholder="Retype your new password" class="form-control">
        <br>
        <input type="submit" name="formreset" id="formreset" class="btn btn-success" value="Submit">
      </div>

    </form>

    </form>
  </body>
</html>
<?php
  session_start();
  include('../includes/db.php');
  if (isset($_POST['formreset'])) {
    if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['cpassword']) && !empty($_POST['cpassword']) && isset($_POST['email']) && !empty($_POST['email'])) {
      $password = $_POST['password'];
      $cpassword = $_POST['cpassword'];
      $email = $_POST['email'];
      $q = $db->prepare('UPDATE ACCOUNT SET password = :password WHERE email = :email');
      $q->execute([
        'password' => hash('sha512', $_POST['password']),
        'email' => $email
      ]);
      echo "Votre mot de passe a bien été modifier";
    }else {
      echo "Mot de passe non changer";
    }
  }

 ?>
