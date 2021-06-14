<?php
  session_start();
  include('../../includes/db.php');
  if (isset($_POST['message_submit']) && !empty($_POST['message_submit']) && isset($_SESSION['id_account'])) {
    $id_topic = $_GET['id'];
    $id_account = $_GET['username'];
    $i = $_GET['nb_messages'];
    $topics = $db->query('SELECT * FROM TOPIC WHERE id_topic = '.$id_topic);
    $nb_messages = $db->prepare('SELECT COUNT(DISTINCT id_forumMsg) test FROM FORUMMSG WHERE id_account = :id_account AND id_topic = :id_topic');
    $nb_messages->execute([
      'id_account' => $id_account,
      'id_topic' => $id_topic
    ]);
     while($t = $topics->fetch(PDO::FETCH_ASSOC)){
       $title_topic = $t['titleTopic'];
       $categories = $t['id_type'];
    $saveMsg = $db->prepare('INSERT INTO FORUMMSG (textForumMsg, postDate, id_topic, id_account) VALUES (?,?,?,?)');

    $time = date('Y-m-d H:i:s', mktime(date('H') + 2));
    $saveMsg->execute([
      $_POST['forum_message'],
      $time,
      $t['id_topic'],
      $_SESSION['id_account']
    ]);

    $select_save_message = $db->prepare('SELECT * FROM FORUMMSG WHERE id_account = :id_account AND id_topic = :id_topic');
    $select_save_message->execute([
      'id_account' => $id_account,
      'id_topic' => $id_topic
    ]);
      while ($rsm = $select_save_message->fetch(PDO::FETCH_ASSOC)) {
        while ($rnb = $nb_messages->fetch(PDO::FETCH_ASSOC)) {
          $number_messages = $rnb['test'];
          header("location: https://dna-esgi.fr/pages/forum/forumMsg.php?username=$id_account&title=$title_topic&categories=$categories&id=$id_topic&nb_messages=$number_messages");
          exit;
        }

        // while($i < 10 || $i >= 10) {
        //   $i++;
        //
        // }
      }
    }
  }else {
    header('location: https://dna-esgi.fr/main_pages/Forums.php');
    exit;
  }



 ?>
