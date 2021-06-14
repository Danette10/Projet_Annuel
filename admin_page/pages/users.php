<?php
  session_start();
  include('../../includes/db.php');
  global $db;
  if (isset($_GET['confirm']) && !empty($_GET['confirm'])) {
    $confirm = (int) $_GET['confirm'];
    $q = $db->prepare('UPDATE ACCOUNT set confirm = 1 WHERE id = ?');
    $q->execute(array($confirm));
  }
  if (isset($_GET['ban']) && !empty($_GET['ban'])) {
    $ban = (int) $_GET['ban'];
    $q = $db->prepare('UPDATE ACCOUNT set confirm = 0 WHERE id = ?');
    $q->execute(array($ban));
  }
  if (isset($_GET['unban']) && !empty($_GET['unban'])) {
    $unban = (int) $_GET['unban'];
    $q = $db->prepare('UPDATE ACCOUNT set confirm = 1 WHERE id = ?');
    $q->execute(array($unban));
  }
  if (isset($_GET['admin']) && !empty($_GET['admin'])) {
    $admin = (int) $_GET['admin'];
    $q = $db->prepare('UPDATE ACCOUNT set rights = 3 WHERE id = ?');
    $q->execute(array($admin));
  }
  if (isset($_GET['normal']) && !empty($_GET['normal'])) {
    $normal = (int) $_GET['normal'];
    $q = $db->prepare('UPDATE ACCOUNT set rights = 1 WHERE id = ?');
    $q->execute(array($normal));
  }

  $account = $db->query('SELECT * FROM ACCOUNT WHERE rights < 4 AND id_account != "admin" ORDER BY id');

 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: Users</title>
    <?php include('../../includes/bootstrap.php'); ?>
    <style>
    .ban, .unban, .admin, .normal, .confirm, .ban:hover, .unban:hover, .btn:hover, .admin:hover, .normal:hover, .confirm:hover{
      color: white !important;
    }
    .button_admin{
      background-color: #144065 !important;
    }
    .button_admin:hover{
      background-color: #0C4779 !important;
    }
    .button_normal{
      background-color: #0D497B !important;
    }
    .button_normal:hover{
      background-color: #055191 !important;
    }
    </style>
  </head>
  <body>
    <?php if (isset($_SESSION['id_account']) && $_SESSION['rights'] == 3) {
      include('../includes/header.php');
      setcookie('id_account', $_SESSION['id_account'], time() + 3600);


    ?>
    <br><h3 class="text-center">Currently registered users:</h3><br>

      <table class="table">
     <tr class="header">
        <th class="main">Users</th>
        <th class="sub-info w10">Ban/Unban</th>
        <th class="sub-info w20">Pivilages</th>
        <th class="sub-info w30">Confirm</th>
     </tr>
       <?php while($users = $account->fetch(PDO::FETCH_ASSOC)){ ?>
        <tr>
          <td class="main"><?= $users['id'] ?> : <?= $users['id_account'] ?></td>
          <td class="sub-info">
            <?php if($users['confirm'] == 1){ ?>
              <button type="button" class="button1 btn btn-lg btn-danger border-dark"><a href="users.php?ban=<?= $users['id'] ?>" class="ban text-decoration-none">Ban</a></button>
            <?php }elseif($users['confirm'] == 0){ ?>
              <button type="button" name="button" class="button2 btn btn-lg btn-success border-dark"><a href="users.php?unban=<?= $users['id'] ?>" class="unban text-decoration-none">Unban</a></button>
            <?php } ?>
          </td>
          <td class="sub-info">
            <?php if($users['rights'] == 1){ ?>
              <button type="button" class="button_admin btn btn-lg"><a href="users.php?admin=<?= $users['id'] ?>" class="admin text-decoration-none">Admin</a></button>
            <?php }elseif($users['rights'] == 3){ ?>
              <button type="button" class="button_normal btn btn-lg"><a href="users.php?normal=<?= $users['id'] ?>" class="normal text-decoration-none">Normal</a></button>
            <?php } ?>
          </td>
          <td class="sub-info">
            <?php if($users['confirm'] == -1){ ?>
              <button type="button" class="button_confirm btn btn-success btn-lg"><a href="users.php?confirm=<?= $users['id'] ?>" class="confirm text-decoration-none">Confirm</a></button>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
        </table>
      <?php
    }else {
        header('location: https://dna-esgi.fr/index.php');
        exit;
      } ?>
  </body>
</html>
