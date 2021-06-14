<?php
  session_start();
  include('../includes/db.php');
  $topics = $db->query('SELECT * FROM TOPIC ORDER BY id DESC');
  $result_topic = $topics->fetchAll(PDO::FETCH_ASSOC);
  $like = $_GET['like'];
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: Forums</title>
    <?php include('../includes/bootstrap.php'); ?>
    <style>

      .new_topic, .new_topic:hover{
        color: white;
      }
    </style>
  </head>
  <body>

    <?php
  		if (isset($_SESSION['id_account'])) {
  			include('../profile/includes/header_members.php');
  		}else{
  	 ?>
    <?php
    include('../includes/header.php');
    echo "
    <div class='alert alert-danger' role='alert'>
      You must be logged in to be able to write or like a subject!
    </div>

    ";
  }?>
  <!-- clavier a mettre dans les topic
  <p>
  <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Link with href
  </a>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <?php //include('../keyboard.php'); ?>
  </div>
</div>
    <textarea id="myText" rows="8" cols="80"></textarea>
    <div class="">

    </div>-->
    <br>
    <div class="col-sm-2 mx-auto">
      <button type="button" class="btn btn-secondary btn-lg"><a href="https://dna-esgi.fr/pages/forum/new_topic.php" class="new_topic text-decoration-none">New Topic</a></button>
    </div>
    <p><br></p>
    <table class="table">
   <tr class="header">
      <th class="main">Title</th>
      <th class="sub-info w10">Number of messages</th>
      <th class="sub-info w20">Creation</th>
      <th class="sub-info w20">Like</th>

   </tr>
   <?php
    foreach ($result_topic as $rt) {
     $id_topic = $rt['id_topic'];
     $message = $db->query('SELECT COUNT(DISTINCT id_forumMsg) cont FROM FORUMMSG WHERE id_topic = '.$id_topic);
     $like = $db->query('SELECT COUNT(DISTINCT id) nb_like FROM LIKETOPIC WHERE id_topic = '.$id_topic);
     $result_message = $message->fetchAll(PDO::FETCH_ASSOC);
     $result_like = $like->fetchAll(PDO::FETCH_ASSOC);
     foreach ($result_message as $rm) {
       foreach ($result_like as $rl) {



    ?>
   <tr>
      <td class="main">

         <h4><a href='https://dna-esgi.fr/pages/forum/forumMsg.php?username=<?= $_SESSION['id_account'] ?>&id=<?= $id_topic ?>&id_forumMsg=<?= $rm['id_forumMsg'] ?>&title=<?= $rt['titleTopic'] ?>&categories=<?= $rt['id_type'] ?>&nb_messages=<?= $number_messages ?>' class="text-decoration-none"><?= $rt['titleTopic']; ?></a></h4>
      </td>
      <td class="sub-info"><?= $rm['cont']; ?></td>
      <td class="sub-info"><?= $rt['creationDateTopic'] ?><br>by <?= $rt['id_account'] ?></td>
      <td class="sub-info"><a href="https://dna-esgi.fr/pages/forum/like_topic.php?id=<?= $id_topic ?>&username=<?= $_SESSION['id_account'] ?>"><img src="https://img.icons8.com/pastel-glyph/2x/facebook-like.png" alt="like" width="50" height="50"></a><?= $rl['nb_like'] ?></td>
   </tr>
   <?php }}} ?>
</table>
  </body>
</html>
