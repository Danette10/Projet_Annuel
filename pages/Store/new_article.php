<?php session_start();
include('../../includes/db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: New Article</title>
    <?php include('../../includes/bootstrap.php'); ?>
  </head>
  <body>
    <?php include('../../profile/includes/header_members.php'); ?>
    <h3 class="text-center">CREATE</h3>
    <div class="col-sm-4 mx-auto pt-5">
      <form action="" method="post">
        <input class="form-control" type="text" name="name" placeholder="Type your title" required><br>
        <input class="form-control" type="text" name="code" placeholder="x1F60D" required><br>
        <input class="form-control" type="number" name="price" placeholder="Type the price" required><br>
        <input class="btn btn-success" name="create" type="submit" value="Submit">
      </form>
    </div>
  </body>
</html>
<?php
if (isset($_POST['create']) && !empty($_POST['create'])) {

  $new_article = $db->prepare('INSERT INTO EMOJI (emojiCode,nameEmoji,cost) VALUES (:emojiCode,:nameEmoji,:cost)');
  $name = $_POST['name'];
  $code = $_POST['code'];
  $price = $_POST['price'];
  $new_article->execute([
    'emojiCode' => $code,
    'nameEmoji' => $name,
    'cost' => $price
  ]);
}

 ?>
