<?php
include('../../includes/db.php');
$id_topic = $_GET['id'];
$id_forumMsg = $_GET['id_forumMsg'];
$title_topic = $_GET['title'];
$categories = $_GET['categories'];
$id_account = $_GET['username'];
$i = $_GET['nb_messages'];
$delMsg = $db->prepare('DELETE FROM FORUMMSG WHERE id_forumMsg = '.$id_forumMsg);
$delMsg->execute();
header("location: https://dna-esgi.fr/pages/forum/forumMsg.php?username=$id_account&title=$title_topic&categories=$categories&id=$id_topic&nb_messages=$i");
exit;
 ?>
