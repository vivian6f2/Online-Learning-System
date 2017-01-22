<?php 
	session_save_path("./session");
	session_start(); 
?>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<?php
	require_once("connect.php");
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
	
?>
<?php
	header('Content-type: image/png');
	$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	$fileName = './PDF/temp.png';
	file_put_contents($fileName, $fileData);
	system("chmod 777 ./PDF/temp.png");
	
	$size = getimagesize("http://140.113.140.27:81/HCI_project/PDF/temp.png");
	$img1 = imagecreatefromjpeg('http://140.113.140.27:81/HCI_project/PDF/Lab/Lab-0.jpg');
	$img2 = imagecreatefrompng("http://140.113.140.27:81/HCI_project/PDF/temp.png");
	imagecopy($img1, $img2, 0, 0, 0, 0, $size[0], $size[1]);
	
	imagepng($img1,"./PDF/test.png",0,PNG_ALL_FILTERS);
	system("chmod 777 ./PDF/test.png");
	
	//echo '<img src='.$img1.'>';
	echo 'done';
	imagedestroy($img1);
	imagedestroy($img2);
	
?>
