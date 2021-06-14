<?php
include('../../includes/db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$name = $_GET['name'];
$code = $_GET['code'];
$price = $_GET['cost'];
$id_emoji = $_GET['id_emoji'];

$delete_article_account = $db->prepare('DELETE FROM EMOJIGET WHERE id_emoji = '.$id_emoji);
$delete_article_account->execute();
$delete_article = $db->prepare('DELETE FROM EMOJI WHERE id_emoji = '.$id_emoji);
$delete_article->execute();
header('location: https://dna-esgi.fr/main_pages/Store.php');
exit;
 ?>
