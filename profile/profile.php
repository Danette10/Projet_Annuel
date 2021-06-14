<?php
session_start();
include('../includes/bootstrap.php');
include('../includes/db.php');
if (!isset($_SESSION['id_account'])) {

  header('location: https://dna-esgi.fr/index.php');
}else{
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Profile</title>
    <style media="screen">
      a{
        color: white;
      }
      a:hover{
        color: black;
      }
    </style>
  </head>
  <body>

    <?php
      $select_element_account = $db->prepare('SELECT * FROM ACCOUNT WHERE id_account = :id_account');
      $select_element_account->execute([
        'id_account' => $_SESSION['id_account']
      ]);

      if ($_SESSION['rights'] >= 3) {
        include('../admin_page/includes/header.php');
     ?>
     <?php while ($sea = $select_element_account->fetch(PDO::FETCH_ASSOC)){ ?>
     <h4 class="display-4 text-center text-uppercase"><?php echo "<strong>Welcome " . $_SESSION['id_account'] . ' !</strong>'; ?></h4><br>
     <br>
     <div class="card ms-5" style="width: 25rem;">
       <?php echo '<img class="card-img-top" src="uploads/' . $sea['image'] . '" alt="avatar">'; ?>
       <div class="card-body">
         <p class="card-title text-center fs-5"><strong>ADMINISTRATOR ACCOUNT</strong></p>
       </div>
       <ul class="list-group list-group-flush">
         <li class="list-group-item fs-5"><?php echo "Your username: " . "<strong>" . $sea['id_account'] . '</strong>'; ?></li>
         <li class="list-group-item fs-5"><?php echo "Your email: " . "<strong>" . $sea['email'] . '</strong>'; ?></li>
         <li class="list-group-item fs-5"><?php echo "You have: " . "<strong>" . $sea['xp'] . ' xp</strong>'; ?></li>
         <li class="list-group-item fs-5"><?php echo "You have: " . "<strong>" . $sea['cash'] . ' CG</strong>'; ?></li>
         <li class="list-group-item fs-5"><?php echo "Your phone number is: " . "<strong>" . $sea['phone'] . ''; ?></li>
       </ul>
     <?php } ?>
       <div class="card-body">
         <button type="button" class="btn btn-lg btn-secondary"><a href="modif_profile.php" class="text-decoration-none" style="color: white;">Change your information</a></button>
       </div>
       <div class="card-body">
         <button type="button" class="btn btn-lg btn-danger"><a href="../Logout.php" class="text-decoration-none" style="color: white;">Logout</a></button>
         <button type="button" class="btn btn-lg btn-primary"><a href="https://dna-esgi.fr/admin_page/pages/logs.php" class="text-decoration-none" style="color: white;">Logs</a></button>

       </div>
     </div>

   <?php }else{ ?>
     <?php while ($sea = $select_element_account->fetch(PDO::FETCH_ASSOC)){ ?>
     <?php include('includes/header_members.php'); ?>
    <h4 class="display-4 text-center text-uppercase"><?php echo "<strong>Welcome " . $_SESSION['id_account'] . ' !</strong>'; ?></h4><br>
    <br>
    <div class="card ms-5" style="width: 25rem;">
      <?php
      if ($sea['image'] == NULL) {
        echo '<img class="card-img-top" src="includes/default_avatar.jpg" alt="avatar">';
      }else{
      echo '<img class="card-img-top" src="uploads/' . $sea['image'] . '" alt="avatar">';
      }
      ?>

      <div class="card-body">
        <h5 class="card-title">Informations:</h5>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item fs-5"><?php echo "Your username: " . "<strong>" . $sea['id_account'] . '</strong>'; ?></li>
        <li class="list-group-item fs-5"><?php echo "Your email: " . "<strong>" . $sea['email'] . '</strong>'; ?></li>
        <li class="list-group-item fs-5"><?php echo "You have: " . "<strong>" . $sea['xp'] . ' xp</strong>'; ?></li>
        <li class="list-group-item fs-5"><?php echo "You have: " . "<strong>" . $sea['cash'] . ' CG</strong>'; ?></li>
        <li class="list-group-item fs-5"><?php echo "Your phone number is: " . "<strong>" . $sea['phone'] . ''; ?></li>
      </ul>
      <?php } ?>
      <div class="card-body">
        <button type="button" class="btn btn-lg btn-secondary"><a href="https://dna-esgi.fr/profile/modif_profile.php" class="text-decoration-none" style="color: white;">Change your information</a></button>
      </div>
      <div class="card-body">
        <button type="button" class="btn btn-lg btn-danger"><a href="https://dna-esgi.fr/main_pages/Logout.php" class="text-decoration-none" style="color: white;">Logout</a></button>
      </div>
    </div>



  </body>
</html>

<?php }}?>
