<?php
session_start();
include('../../includes/db.php');
$id_topic = $_GET['id'];
$id_account = $_GET['username'];
if (isset($_SESSION['id_account'])) {

  $select_account_like = $db->prepare('SELECT * FROM LIKETOPIC WHERE id_topic = :id_topic AND id_account = :id_account');
  $select_account_like->execute([
    'id_topic' => $id_topic,
    'id_account' => $id_account
  ]);
  $result = $select_account_like->fetch(PDO::FETCH_ASSOC);
  if ($result) {
    $delete_like = $db->prepare('DELETE FROM LIKETOPIC WHERE id_topic = :id_topic AND id_account = :id_account');
    $delete_like->execute([
      'id_topic' => $id_topic,
      'id_account' => $id_account
    ]);
     header('location: https://dna-esgi.fr/main_pages/Forums.php?id='.$id_topic.'&username='.$id_account.'');
     exit;
  }else {
    $insert_like = $db->prepare('INSERT INTO LIKETOPIC (id_topic,id_account) VALUES (:id_topic,:id_account)');
    $insert_like->execute([
      'id_topic' => $id_topic,
      'id_account' => $id_account
    ]);
     header('location: https://dna-esgi.fr/main_pages/Forums.php?id='.$id_topic.'&username='.$id_account.'');
     exit;
  }
}else {
  header('location: https://dna-esgi.fr/main_pages/Forums.php');
  exit;
}

 ?>
