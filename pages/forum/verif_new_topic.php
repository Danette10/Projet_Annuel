<?php
session_start();
  include('../../includes/db.php');
  if (isset($_SESSION['id_account'])) {
    if (isset($_POST['topic_submit'])) {
      if (isset($_POST['topic_subject'],$_POST['topic_container'])) {
        $subject = htmlspecialchars($_POST['topic_subject']);
        $container = htmlspecialchars($_POST['topic_container']);
        $categories = htmlspecialchars($_POST['categories']);
        if (!empty($subject) && !empty($container)) {
          if (strlen($subject) <= 70) {
            if (isset($_POST['topic_mail'])) {
              $notif_mail = 1;
            }else {
              $notif_mail = 0;
            }
            $id_creator = $_SESSION['id_account'];
            $insert_topic = $db->prepare('INSERT INTO TOPIC (titleTopic,container,notif_creator,creationDateTopic,id,id_account,id_type) VALUES (?,?,?,?,?,?,?)');
            $time = date('Y-m-d H:i:s', mktime(date('H') + 2));
            $insert_topic->execute([
              $subject,
              $container,
              $notif_mail,
              $time,
              $_SESSION['id'],
              $id_creator,
              $categories
            ]);
            header('location: https://dna-esgi.fr/main_pages/Forums.php');
            exit;
          }else {
            echo "Votre sujet ne peux pas dépasser 70 caractères !";
          }
        }else {
          echo "Veuillez compléter tous les champs !";
        }


      }
    }
  }



  include('new_topic.php');
 ?>
