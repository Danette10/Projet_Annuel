<?php
  session_start();
  include('../../includes/db.php');
  $id_topic = $_GET['id'];
  $id_account = $_GET['username'];
  $number_messages = $_GET['nb_messages'];
  $topic = $db->query('SELECT * from TOPIC WHERE id_topic = '.$id_topic);
  $topic_messages = $db->query('SELECT * FROM FORUMMSG WHERE id_topic = '.$id_topic);
  $result_topic = $topic->fetchAll(PDO::FETCH_ASSOC);
  $result_topic_messages = $topic_messages->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result_topic as $rt) {

 ?>


 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>DNA: <?= $rt['titleTopic']; ?></title>
     <?php include('../../includes/bootstrap.php'); ?>
     <style>
       .delete{
         color: black;
       }
       .delete:hover{
         color: white;
       }
     </style>
   </head>
   <?php
     if (isset($_SESSION['id_account'])) {
       include('../../profile/includes/header_members.php');
       setcookie('id_account', $_POST['id_account'], time() + 3600);
     }else{
       include('../../includes/header.php');
       echo "
       <div class='alert alert-danger' role='alert'>
         You must be connected to be able to write on a topic !
       </div>

       ";
       //header('location: https://dna-esgi.fr/main_pages/Forums.php');
     }
    ?>

      <br><h4 class="text-center">Categories: <?= $_GET['categories'] ?><br>Subject: <?= $rt['container'];?></h4><br>
      <div class="col-6 mx-auto">
        <table class="table">
       <tr class="header">
          <th class="main">Messages</th>
          <th class="sub-info w10">Username</th>
          <th class="sub-info w20">Date</th>
          <?php if($_SESSION['rights'] == 3){ ?>
          <th class="sub-info w20">Delete</th>
        <?php } ?>
       </tr>
      <?php foreach ($result_topic_messages as $message) { ?>

      <tr>
         <td class="main">
           <?= $message['textForumMsg']; ?>

         </td>
         <td class="sub-info"><strong><?= $message['id_account']; ?></strong></td>
         <td class="sub-info"><?= $message['postDate']; ?></td>
         <td class="sub-info">
           <?php if($_SESSION['rights'] == 3){ ?>
           <button type="button" class="btn btn-danger"><a href='https://dna-esgi.fr/pages/forum/deleteMsg.php?username=<?= $id_account ?>&id=<?= $message['id_topic'] ?>&id_forumMsg=<?= $message['id_forumMsg'] ?>&title=<?= $rt['titleTopic'] ?>&categories=<?= $rt['id_type'] ?>&nb_messages=<?= $number_messages ?>' class="delete text-decoration-none">Delete</a></button>
           <?php } ?>
         </td>
      </tr>
    <?php }} ?>
     <body>
       <form class="new_msg" action='newMsg.php?id=<?= $id_topic ?>&username=<?= $id_account ?>&nb_messages=<?= $number_messages ?>' method="post">
         <textarea id="myText"class="form-control" name="forum_message"></textarea><br>
         <input class="btn btn-success" type="submit" name="message_submit">
         <p>
        <br>
         <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
           EMOJI
         </a>
       </p>
       <div class="collapse" id="collapseExample">
         <div class="card card-body">
           <?php include('../../keyboard.php'); ?>
         </div>
       </form>
    </div>

   </body>
 </html>
 <?php
 if ($number_messages == 10) {
   $update_cash = $db->prepare('UPDATE ACCOUNT SET cash = 100, xp = 50 WHERE id_account = :id_account');
   $update_cash->execute([
     'id_account' => $id_account
   ]);
   header("location: https://dna-esgi.fr/pages/forum/forumMsg.php?username=$id_account&title=$title_topic&categories=$categories&id=$id_topic&nb_messages=$number_messages");
   exit;
 }
  ?>
