<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <script src="../../includes/js/keyboard.js" charset="utf-8"></script>
    <?php include('../includes/bootstrap.php'); ?>
    <?php
      include('../includes/db.php');
      $q='SELECT emojiCode FROM EMOJI INNER JOIN EMOJIGET ON EMOJI.id_emoji = EMOJIGET.id_emoji WHERE id = :id';
      $request=$db->prepare($q);
      $i=0;
      $list="";
      $request->execute(['id'=> $_SESSION['id']]);
      $result=$request->fetchAll(PDO::FETCH_ASSOC);
      $request->closeCursor();
      echo "<script type='text/javascript'>";
      for($i=0;$i<count($result);$i++){
        if($i!=count($result)-1){
          $list=$list."0".$result[$i]['emojiCode'].",";
        }
        else{
          $list=$list."0".$result[$i]['emojiCode'];
        }
      }
      echo "var table=[".$list."]";
      echo "</script>";

    ?>

  </head>
  <body onload="printButtons(table)">
    <div id="buttons">

    </div>
  </body>
</html>
