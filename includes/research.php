<?php

session_start();
include('db.php');
if(isset($_GET['search'])){
  $name=(String) trim($_GET['search']);
  $req=$db->prepare("SELECT nameVideoGames FROM videogames WHERE nameVideoGames LIKE :game LIMIT 5");
  $req->execute(array(':game'=>"%".$name."%"));
  $result=$req->fetchALL(PDO::FETCH_ASSOC);
  $req->closeCursor();
  $id=0;
  echo "<text>Video Games<br/><text>";
  if ($result==NULL){
    echo "<text>NO RESULT<br/><text>";
  }
  else{
    foreach($result as $r){
      echo "<a href='https://dna-esgi.fr/main_pages/VideosGames.php' id='result_line_".$id."'>".$r['nameVideoGames']."   <br/></a>";
      $id+=1;
    }
  }
  $req=$db->prepare("SELECT tittleArticle FROM article WHERE tittleArticle LIKE :tittle LIMIT 5");
  $req->execute(array(':tittle'=>"%".$name."%"));
  $result=$req->fetchALL(PDO::FETCH_ASSOC);
  $req->closeCursor();
  echo "<text>News<br/><text>";
  if ($result==NULL){
    echo "<text>NO RESULT<text>";
  }
  else{
    foreach($result as $r){
      echo "<a href='https://dna-esgi.fr/main_pages/News.php' id='result_line_".$id."'>".$r['tittleArticle']."  <br/> </a>";
      $id+=1;
    }
  }
}else {
  echo "<text>error</text>";
}
 ?>
