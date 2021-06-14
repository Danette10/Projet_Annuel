<?php

// Ouvrir la session utilisateur
session_start();
// Ecrire une ligne dans le fichier log.txt

// Ouvrir le fichier ou le créer si besoin
$log_logout = fopen('../admin_page/log_logout.txt', 'a+');

// Création de la ligne à ajouter au log
$line = date('Y/m/d - H:i:s', mktime(date('H') + 2)) . ' - Logout of : ' . $_SESSION['id_account'] . "\n";

fputs($log_logout, $line);

fclose($log_logout);


// Détruire la session
session_destroy();

// Redirection vers l'accueil
header('location: https://dna-esgi.fr/index.php');
exit;
?>
