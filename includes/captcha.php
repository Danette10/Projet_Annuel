<?php
session_start();

$_SESSION['captcha'] = rand(1000,9999);
$img = imagecreate(100,30);
$font = 'fonts/@El&Font_Destroy!.ttf';

$bg = imagecolorallocate($img,255,255,255);
$textcolor = imagecolorallocate($img, 0, 0, 0);

imagettftext($img, 23, 0, 0, 25, $textcolor, $font, $_SESSION['captcha']);

header('Content-type:image/jpeg');
imagejpeg($img);
imagedestroy($img);

?>
