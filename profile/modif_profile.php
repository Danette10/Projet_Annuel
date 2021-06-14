<?php
  session_start();
  include('../includes/db.php');
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);



  // Start change image

  if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
  		// Vérifier le type de fichier
  		$acceptable = [
  			'image/jpeg',
  			'image/png',
  			'image/gif',
  		];

  		if(!in_array($_FILES['image']['type'], $acceptable)){
  			// Rediriger vers inscription.php avec un message d'erreur
  			header('location: modif_profile.php?message=Type de fichier incorrect.&type=danger');
  			exit;
  		}


  		// Vérifier le poids du fichier
  		$maxSize = 2 * 1024 * 1024;  //2Mo

  		if($_FILES['image']['size'] > $maxSize){
  			// Rediriger vers inscription.php avec un message d'erreur
  			header('location: modif_profile.php?message=Ce fichier est trop lourd.&type=danger');
  			exit;
  		}


  		// Enregistrer le fichier sur le serveur


  		// Chemin d'enregistrement
  		$path = 'uploads';

  		// Vérifier que le dossier uploads existe, sinon le créer
  		if(!file_exists($path)){
  			mkdir($path, 0777);
  		}

  		$filename = $_FILES['image']['name'];

  		// Créer un nom de fichier à partir de la date (timestamp)
  		// image-1613985411.ext
  		// Attention : deux fichiers uploadés dans la même seconde auront le même nom !!

  		// Récupérer l'extension du fichier
  		$array = explode('.', $filename);
  		$ext = end($array); // extension du fichier

  		$filename = 'image-' . time() . '.' . $ext;


  		// Déplacer le fichier vers son emplacement définitif (le dossier uploads)
  		$destination = $path . '/' . $filename;
      move_uploaded_file($_FILES['image']['tmp_name'], $destination);

      $delCurrentImage = $db->prepare('UPDATE ACCOUNT set image = ""');


        $updateImage = $db->prepare("UPDATE ACCOUNT SET image = :image WHERE id_account = :id_account");
        $updateImage->execute([
          'image' => isset($filename) ? $filename : '',
          'id_account' => $_SESSION['id_account']
        ]);
        // End change image
        header('location: https://dna-esgi.fr/profile/profile.php?id_account=' . $_SESSION['id_account']);
        exit;
  }
  if (isset($_POST['phone']) && !empty($_POST['phone'])) {
    $update_phone = $db->prepare('UPDATE ACCOUNT SET phone = :phone WHERE id = '.$_SESSION['id']);
    $update_phone->execute([
      'phone' => $_POST['phone']
    ]);
    header('location: https://dna-esgi.fr/profile/profile.php?id_account=' . $_SESSION['id_account']);
    exit;
  }
  if (isset($_POST['password'],$_POST['cpassword']) && !empty($_POST['password']) && !empty($_POST['cpassword'])) {
    if ($_POST['password'] == $_POST['cpassword']) {
      $update_pass = $db->prepare('UPDATE ACCOUNT SET password = :password WHERE id = '.$_SESSION['id']);
      $update_pass->execute([
        'password' => hash('sha512', $_POST['password'])
      ]);
      header('location: https://dna-esgi.fr/profile/profile.php?id_account=' . $_SESSION['id_account']);
      exit;
    }
  }

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: Modification Profile</title>
    <?php include('../includes/bootstrap.php'); ?>
  </head>
  <body>
    <?php include('includes/header_members.php'); ?>
    <form action="" class="row g-3 needs-validation" method="post" enctype="multipart/form-data" novalidate>

      <div class="col-sm-4 mx-auto pt-5">
        <label>Change your phone number :</label>
        <input type="number" name="phone" id="phone" class="form-control" placeholder="Change your phone number"><br>
        <label>Change your password :</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Change your password"><br>
        <label>Retype your password :</label>
        <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Retype your password"><br>
        <label>Change your pictures (png, jpeg, gif) :</label>
        <input type="file" class="form-control" name="image" id="image" accept="image/jpeg,image/png,image/gif"><br>
        <input type="submit" class="btn btn-success" value="Submit">

    </div>
    </form>
    <script src="../includes/js/validation_form.js" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </body>
</html>
