 <?php session_start();
 include('../../includes/db.php');
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 $name = $_GET['name'];
 $code = $_GET['code'];
 $price = $_GET['cost'];
 $id_emoji = $_GET['id_emoji'];
 if (isset($_POST['create']) && !empty($_POST['create'])) {
   $modify_article = $db->prepare('UPDATE EMOJI SET emojiCode = :emojiCode, nameEmoji = :nameEmoji, cost = :cost WHERE id_emoji = '.$id_emoji);
   $new_name = $_POST['name'];
   $new_price = $_POST['price'];
   $new_code = $_POST['code'];
   $modify_article->execute([
     'emojiCode' => $new_code,
     'nameEmoji' => $new_name,
     'cost' => $new_price
   ]);
   header('location: https://dna-esgi.fr/main_pages/Store.php');
   exit;
 }
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
     <h2 class="text-center">MODIFY</h2>
     <div class="col-sm-4 mx-auto pt-5">
       <form action="" method="post">
         <input class="form-control" type="text" name="name" value="<?= $name ?>" required><br>
         <input class="form-control" type="text" name="code" value="<?= $code ?>" required><br>
         <input class="form-control" type="number" name="price" value="<?= $price ?>" required><br>
         <input class="btn btn-success" name="create" type="submit" value="Submit">
       </form>
     </div>
   </body>
 </html>
