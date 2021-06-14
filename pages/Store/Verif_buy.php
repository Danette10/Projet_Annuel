<?php session_start();
include('../../includes/db.php');

if (isset($_SESSION['id_account'])) {
$username=htmlspecialchars($_GET['username']);
$id=htmlspecialchars($_GET['id']);
$emoji=htmlspecialchars($_GET['id_emoji']);
$cost=htmlspecialchars($_GET['cost']);

$balance=$db->query('SELECT cash FROM ACCOUNT WHERE id = '.$id);
$wallet=$balance->fetchAll(PDO::FETCH_ASSOC);
foreach ($wallet as $w) {
	if ($w['cash']>=$cost) {
		$new_balance=$w['cash']-$cost;
		$update_cash=$db->prepare('UPDATE ACCOUNT SET cash = :cash WHERE id = :id');
		$update_cash->execute([
			'id'=> $id,
			'cash'=> $new_balance
		]);
$insert_emoji=$db->prepare("INSERT INTO EMOJIGET(id_emoji,id) VALUES(:id_emoji, :id)");
$insert_emoji->execute([
	'id_emoji'=> $emoji,
	'id'=> $id
]);
header('location: https://dna-esgi.fr/main_pages/Store.php');
	 exit;
	}
else {
	header('location: https://dna-esgi.fr/main_pages/Store.php');
    exit;
}
}

}
else {
	header('location: https://dna-esgi.fr/main_pages/Store.php');
    exit;
}








?>
