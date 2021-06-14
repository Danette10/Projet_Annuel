<?php
  session_start();
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include('bootstrap.php');


  if (isset($_POST['formsend'])) {

    extract($_POST);

      // Vérifier la validité de l'email

      if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
      	// Rediriger vers inscription.php avec un message d'erreur
      	header('location: https://dna-esgi.fr/main_pages/Registration.php?message=Invalid email !');
      	exit;
      }
      // Vérifier la longueur du mot de passes

      if(strlen($_POST['password_register']) < 6 || strlen($_POST['password_register']) > 30){
      	// Rediriger vers inscription.php avec un message d'erreur
      	header('location: https://dna-esgi.fr/main_pages/Registration.php?message=The password must be between 6 and 30 characters long !');
      	exit;
      }



// Vérifier si fichier envoyé
if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){

		// Vérifier le type de fichier
		$acceptable = [
			'image/jpeg',
			'image/png',
			'image/gif',
		];

		if(!in_array($_FILES['image']['type'], $acceptable)){
			// Rediriger vers inscription.php avec un message d'erreur
			header('location: https://dna-esgi.fr/main_pages/Registration.php?message=Type de fichier incorrect.&type=danger');
			exit;
		}


		// Vérifier le poids du fichier
		$maxSize = 2 * 1024 * 1024;  //2Mo

		if($_FILES['image']['size'] > $maxSize){
			// Rediriger vers inscription.php avec un message d'erreur
			header('location: https://dna-esgi.fr/main_pages/Registration.php?message=Ce fichier est trop lourd.&type=danger');
			exit;
		}


		// Enregistrer le fichier sur le serveur


		// Chemin d'enregistrement
		$path = '../profile/uploads';

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

}
      // Fin traitement image

      include('db.php');
      // Verifier si le pseudo n'est pas déja utiliser

      // Requete SELECT FROM ... WHERE
      $q = 'SELECT id FROM ACCOUNT WHERE id_account = :id_account';
      // Préparer la requete
      $req = $db->prepare($q);
      // Executer la requete
      $req->execute([
      	'id_account' => $_POST['id_account']
      ]);
      // Recupérer la première ligne de résultat
      $reponse = $req->fetch();  // Renvoie la première ligne sous forme de tableau ou une valeur booléenne FALSE
      // Si la ligne existe : erreur, le pseudo est déja utilisé
      if ($reponse) {
      	header('location: https://dna-esgi.fr/main_pages/Registration.php?message=This username is already used !');
      	exit;
      }
      // Fin vérif pseudo

      // Verifier si l'email n'est pas déja utiliser

      // Requete SELECT FROM ... WHERE
      $q = 'SELECT id FROM ACCOUNT WHERE email = :email';
      // Préparer la requete
      $req = $db->prepare($q);
      // Executer la requete
      $req->execute([
      	'email' => $_POST['email']
      ]);
      // Recupérer la première ligne de résultat
      $reponse = $req->fetch();  // Renvoie la première ligne sous forme de tableau ou une valeur booléenne FALSE
      // Si la ligne existe : erreur, l'email est déja utilisé
      if ($reponse) {
      	header('location: https://dna-esgi.fr/main_pages/Registration.php?message=This email is already used !');
      	exit;
      }
      // Fin vérif email

      // Verifier si le phone n'est pas déja utiliser

      // Requete SELECT FROM ... WHERE
      $q = 'SELECT id FROM ACCOUNT WHERE phone = :phone';
      // Préparer la requete
      $req = $db->prepare($q);
      // Executer la requete
      $req->execute([
      	'phone' => $_POST['phone']
      ]);
      // Recupérer la première ligne de résultat
      $reponse = $req->fetch();  // Renvoie la première ligne sous forme de tableau ou une valeur booléenne FALSE
      // Si la ligne existe : erreur, le phone est déja utilisé
      if ($reponse) {
      	header('location: https://dna-esgi.fr/main_pages/Registration.php?message=This phone number is already used !');
      	exit;
      }
      // Fin vérif phone

      // Verif captcha


      if (!empty($password_register) && !empty($cpassword_register) && !empty($email) && !empty($id_account) && !empty($phone) && !empty($bday) && $_SESSION['captcha'] == $_POST['captcha'] && !empty($_POST['captcha'])) {
        if ($password_register == $cpassword_register) {
          $lengthToken = 15;
          $token = "";
          $token = rand(0, 999999999999999);
          $token = strval($token);


          $q = $db->prepare("INSERT INTO ACCOUNT(id_account,email,password,rights,level,xp,cash,creationDateAccount,phone,bday,image,token,confirm) VALUES(:id_account,:email,:password,:rights,:level,:xp,:cash,:creationDateAccount,:phone,:bday,:image,:token,:confirm)");
          $email = $_POST['email'];
          $id_account = $_POST['id_account'];
          $phone = $_POST['phone'];
          $bday = $_POST['bday'];
          $password_register = $_POST['password_register'];
          $cpassword_register = $_POST['cpassword_register'];
          $heure = date('Y-m-d H:i:s', mktime(date('H') + 2));

          require "../PHPMailer/src/PHPMailer.php";
          require "../PHPMailer/src/SMTP.php";
          require "../PHPMailer/src/Exception.php";

          $mail = new PHPMailer();
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->Port = 587;
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->SMTPAuth = true;
          $mail->Username = 'dsebagpro@gmail.com';
          $mail->Password = 'info2021+';
          $mail->setFrom('dsebagpro@gmail.com', 'No-Reply');
          $mail->addAddress($email);
          $mail->Subject = 'Confirm your registration';
          $mail->Message = 'Valid your registration !';
          $mail->msgHTML(

            '<img src="https://dna-esgi.fr/images/LogoProjet.svg" class="logo float-left m-2 h-75 me-4" width="95" alt="Logo">
            <p class="display-2">Thank you for your interest in our site, please click on the link below to confirm your registration:<br></p>
            <div align="center"><a href="https://dna-esgi.fr/includes/conf_registration.php?id_account='. $id_account . '&token=' . $token .'">Confirm your account !</a>'
          );
          if (!$mail->send()) {
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
              echo "
              <div class='mx-auto text-center'>
              <div class='alert alert-success' role='alert'>
                <h4 class='alert-heading display-5'>Well done !</h4>
                <p class='display-5'>Look at your mailbox you must
                have received a confirmation email. <br>Check your spam if we are not in your inbox.</p>
                <hr>
                <p class='mb-0 fs-3'>Click the link in the email to start enjoying our site fully.</p>
                <p class='mb-0 fs-3'>You can close this page. If you did not receive the email, click <a href='https://dna-esgi.fr/includes/email_resend.php?email=".$email."&token=".$token."&id_account=".$id_account."'>here</a> to resend it.
                </div>
                </div>
              </div>
              </div>
              ";
          }
          $q->execute([
            'id_account' => $id_account,
            'email' => $email,
            'password' => hash('sha512', $_POST['password_register']),
            'rights' => 1,
            'level' => 0,
            'xp' => 0,
            'cash' => 50,
            'creationDateAccount' => $heure,
            'phone' => $phone,
            'bday' => $bday,
            'image' => isset($filename) ? $filename : '',
            'token' => $token,
            'confirm' => -1
          ]);


      }else {
        echo "The fields are not all filled !";
      }
    }
}
 ?>
