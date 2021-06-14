<?php
session_start();
include('db.php');
include('bootstrap.php');
$token = $_GET['token'];
$id_account = $_GET['id_account'];
$rights = $_GET['rights'];
if (isset($_GET['token']) && isset($_GET['id_account'])){
  $q = $db->prepare('UPDATE ACCOUNT SET confirm = 1 WHERE id_account = :id_account AND token = :token');
  $q->execute(array(
    'id_account' => $id_account,
    'token' => $token
  ));
  // Confirmation user is admin
  if ($id_account == 'admin') {
    $q = $db->prepare('UPDATE ACCOUNT SET rights = 4 AND confirm = 1 WHERE id_account = :id_account AND token = :token');
    $q->execute([
      'id_account' => $id_account,
      'token' => $token
    ]);
    
  }
  // End confirmation user is admin
  $_SESSION['id_account'] = $id_account;
  session_destroy();
  echo "
  <div class='text-center'>
  <div class='alert alert-success' role='alert'>
    <img src='https://dna-esgi.fr/images/LogoProjet.svg' class='logo float-left m-2 h-75 me-4' width='95' alt='Logo'>
    <h4 class='alert-heading'><strong>Congratulations !</strong></h4>
    <p>Your account has been confirmed! You can return to our site by clicking on this link:
    <a href='https://dna-esgi.fr/index.php' class='text-decoration-none'><em>Home</em></a> to login and close
    this page.
    On behalf of the entire DNA team, we welcome you!</p>
  </div>
  </div>
  ";

}else {
  session_destroy();
  echo "Email doesn't confirmed !";
}


 ?>
