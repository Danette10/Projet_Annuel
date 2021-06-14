<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('db.php');
session_start();

// Ecrire une ligne dans le fichier log.txt

// Ouvrir le fichier ou le créer si besoin
$log_error = fopen('../admin_page/log_error.txt', 'a+');

// Création de la ligne à ajouter au log
$line = date('Y/m/d - H:i:s', mktime(date('H') + 2)) . ' - Attempt to connect of : ' . $_POST['id_account'] . "\n";

fputs($log_error, $line);

fclose($log_error);

  if (isset($_POST['formlogin'])) {
    extract($_POST);

    if (!empty($id_account) && !empty($password)) {
      //session_start();

      $id_account = $_POST['id_account'];
      $password = $_POST['password'];

      if ($id_account = $_POST['id_account']) {
        $q = 'SELECT * FROM ACCOUNT WHERE rights = 3 AND confirm = 1 AND id_account = :id_account AND password = :password';

        $req = $db->prepare($q);

        $req->execute([
          'id_account' => $_POST['id_account'],
          'password' => hash('sha512', $_POST['password'])
        ]);

        $result = $req->fetchAll(PDO::FETCH_ASSOC);

             if ($result) {
               //session_start();
               $_SESSION['id_account'] = $_POST['id_account'];
            foreach ($result as $row) {
              $_SESSION['id'] = $row['id'];
              $_SESSION['id_account'] = $row['id_account'];
              $_SESSION['email'] = $row['email'];
              $_SESSION['xp'] = $row['xp'];
              $_SESSION['cash'] = $row['cash'];
              $_SESSION['phone'] = $row['phone'];
              $_SESSION['rights'] = $row['rights'];
              $_SESSION['image'] = $row['image'];
              $hashpassword = $row['password'];

        }
        // Ecrire une ligne dans le fichier log.txt

        // Ouvrir le fichier ou le créer si besoin
        $log_success = fopen('../admin_page/log_success.txt', 'a+');

        // Création de la ligne à ajouter au log
        $line = date('Y/m/d - H:i:s', mktime(date('H') + 2)) . ' - Connection of : ' . $_POST['id_account'] . "\n";

        fputs($log_success, $line);

        fclose($log_success);
          header('location: https://dna-esgi.fr/profile/profile.php?id=' . $_SESSION['id'] . '&id_account=' . $_SESSION['id_account'] . '');
          exit;
      }

    }if($id_account = $_POST['id_account']){
      $id_account = $_POST['id_account'];
      $password = $_POST['password'];

      $q = 'SELECT * FROM ACCOUNT WHERE rights = 1 AND confirm = 1 AND id_account = :id_account AND password = :password';
      $req = $db->prepare($q);
      $req->execute(['id_account' => $id_account,'password' => hash('sha512', $_POST['password'])]);
      $result = $req->fetchAll(PDO::FETCH_ASSOC);

           if ($result) {
             //session_start();
             // Ajouter un paramètre email à la session
             $_SESSION['id_account'] = $_POST['id_account'];
          foreach ($result as $row) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['id_account'] = $row['id_account'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['xp'] = $row['xp'];
            $_SESSION['cash'] = $row['cash'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['rights'] = $row['rights'];
            $_SESSION['image'] = $row['image'];
            $_SESSION['confirm'] = $row['confirm'];
            $hashpassword = $row['password'];
      }
      // Ecrire une ligne dans le fichier log.txt

      // Ouvrir le fichier ou le créer si besoin
      $log_success = fopen('../admin_page/log_success.txt', 'a+');

      // Création de la ligne à ajouter au log
      $line = date('Y/m/d - H:i:s', mktime(date('H') + 2)) . ' - Connection of : ' . $_POST['id_account'] . "\n";

      fputs($log_success, $line);

      fclose($log_success);
      header('location: https://dna-esgi.fr/profile/profile.php?id=' . $_SESSION['id'] . '&id_account=' . $_SESSION['id_account'] . '');
      exit;
    }else{
      header('location: https://dna-esgi.fr/index.php?message=Username or password invalid !');
        }
      }
    }
  }else {
      echo "Please complete all fields !";
    }

 ?>
