<?php session_start();
include('../includes/db.php');
$req=$db->query('SELECT * FROM EMOJI ORDER BY cost');
$result_req=$req->fetchAll(PDO::FETCH_ASSOC);
$select_emoji_account = $db->prepare('SELECT id_emoji, id FROM EMOJIGET WHERE id_emoji = :id_emoji AND id = :id');


  ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: Store</title>
    <?php include('../includes/bootstrap.php'); ?>
    <style media="screen">
      .create, .create:hover{
        color: white
      }
    </style>
  </head>
  <body>
    <?php
          if (isset($_SESSION['id_account'])) {
              include('../profile/includes/header_members.php');
          }else{
       ?>
       <?php include('../includes/header.php');
       echo "
       <div class='alert alert-danger' role='alert'>
         You must be logged in to purchase an item!
       </div>
       ";}
       ?><br>
       <?php if($_SESSION['rights'] == 3){ ?>
         <div class="col-sm-1 mx-auto">
           <button type="button" class="btn btn-lg btn-primary"><a href="https://dna-esgi.fr/pages/Store/new_article.php" class="create text-decoration-none">Create</a></button>
         </div><br>
      <?php } ?>

    <?php foreach ($result_req as $rq) { ?>

      <div class="container">
        <div class="row">
          <div class="col card" style="width: 18rem;">
            <h1 class="text-center"><?='&#'.$rq['emojiCode']; ?></h1>
            <div class="card-body">
              <h5 class="card-title"><?= $rq['nameEmoji'] ?></h5>
              <p class="card-text">Price: <strong><?= $rq['cost'] ?></strong></p>

              <?php
              $select_emoji_account->execute([
                'id' => $_SESSION['id'],
                'id_emoji' => $rq['id_emoji']
              ]);
              $result_emoji_account=$select_emoji_account->fetchAll(PDO::FETCH_ASSOC);
              foreach($result_emoji_account as $rea){
                $id = $rea['id'];
                $id_emoji = $rea['id_emoji'];
                }
               ?>
                <?php if($id == $_SESSION['id'] && $id_emoji == $rq['id_emoji']){ ?>
            <button type="button" name="button" class="btn btn-lg disabled">Purchased</button>
          <?php }else{ ?>
          <a href="https://dna-esgi.fr/pages/Store/Verif_buy.php?username=<?= $_SESSION['id_account']?>&id=<?= $_SESSION['id']?>&id_emoji=<?= $rq['id_emoji']?>&cost=<?=$rq['cost']?>" class="btn btn-success">Purchase</a>
        <?php } ?>
            <?php if($_SESSION['rights'] == 3){ ?>
              <a href="https://dna-esgi.fr/pages/Store/modify_article.php?name=<?= $rq['nameEmoji'] ?>&code=<?= $rq['emojiCode'] ?>&id_emoji=<?= $rq['id_emoji']?>&cost=<?=$rq['cost']?>" class="btn btn-secondary">Modify</a>
              <a href="https://dna-esgi.fr/pages/Store/delete_article.php?name=<?= $rq['nameEmoji'] ?>&code=<?= $rq['emojiCode'] ?>&id_emoji=<?= $rq['id_emoji']?>&cost=<?=$rq['cost']?>" class="btn btn-danger">Delete</a>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <br>
  <?php } ?>
  </body>
</html>
