<?php
try{
$db = new PDO('mysql:host=localhost;dbname=dbname', 'user', 'mdp', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}catch(Exception $e){
die('Erreur : ' . $e->getMessage()); // Si erreur, afficher le message d'erreur
}
?>
