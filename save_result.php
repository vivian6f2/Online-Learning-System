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
	$account_ppt_id = $_POST['account_ppt_id'];
	$page = $_POST['page'];
	
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	$fileName = './PIC/temp/temp_'.$account_ppt_id.'_'.$page.'.png';
	file_put_contents($fileName, $fileData);
	system("chmod 777 ./PIC/temp/temp_".$account_ppt_id.'_'.$page.".png");
	
	//get ppt name

	$sql = "SELECT * FROM PPT WHERE id = ANY(SELECT ppt_id FROM ACCOUNT_PPT WHERE id = ?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($account_ppt_id));
	$row = $sth->fetchObject();

	$size = getimagesize("http://140.113.140.27:81/HCI_project/PIC/temp/temp_".$account_ppt_id.'_'.$page.".png");
	$img1 = imagecreatefromjpeg('http://140.113.140.27:81/HCI_project/PDF/'.$row->name.'/'.$row->name.'-'.$page.'.jpg');
	$img2 = imagecreatefrompng("http://140.113.140.27:81/HCI_project/PIC/temp/temp_".$account_ppt_id.'_'.$page.".png");
	imagecopy($img1, $img2, 0, 0, 0, 0, $size[0], $size[1]);

	//create file

	if(is_dir("./PDF/".$row->name."/".$account_ppt_id)){
		system("chmod 777 ./PDF/".$row->name."/".$account_ppt_id);
	}
	else{
		system("mkdir ./PDF/".$row->name."/".$account_ppt_id);
		system("chmod 777 ./PDF/".$row->name."/".$account_ppt_id);
	}
	
	imagepng($img1,"./PDF/".$row->name."/".$account_ppt_id."/".$page.".png",0,PNG_ALL_FILTERS);
	system("chmod 777 ./PDF/".$row->name."/".$account_ppt_id."/".$page.".png");
	
	
	//echo '<img src='.$img1.'>';
	echo 'done';
	imagedestroy($img1);
	imagedestroy($img2);
	system("rm ./PIC/temp/temp_".$account_ppt_id.'_'.$page.".png");
	
?>
<?php
	
	/*$account_ppt_id = 7;//$_POST['account_ppt_id'];
	$page = 0;//$_POST['page'];
	
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	$fileName = './PIC/temp/temp_'.$account_ppt_id.'_'.$page.'.png';
	file_put_contents($fileName, $fileData);
	system("chmod 777 ./PIC/temp/temp_".$account_ppt_id.'_'.$page.".png");
	//get ppt name
	$sql = "SELECT * FROM PPT WHERE id = ANY(SELECT ppt_id FROM ACCOUNT_PPT WHERE id = ?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($account_ppt_id));
	$row = $sth->fetchObject();
	
	$size = getimagesize("http://140.113.140.27:81/HCI_project/PIC/temp/temp_".$account_ppt_id.'_'.$page.".png");
	$img1 = imagecreatefromjpeg('http://140.113.140.27:81/HCI_project/PDF/'.$row->name.'/'.$row->name.'-'.$page.'.jpg');
	$img2 = imagecreatefrompng("http://140.113.140.27:81/HCI_project/PIC/temp/temp_".$account_ppt_id.'_'.$page.".png");
	imagecopy($img1, $img2, 0, 0, 0, 0, $size[0], $size[1]);
	
	//create file
	//if(is_dir("./PDF/".$row->name."/".$account_ppt_id)){
	//	system("chmod 777 ./PDF/".$row->name."/".$account_ppt_id);
	//}
	//else{
	//	system("mkdir ./PDF/".$row->name."/".$account_ppt_id);
	//	system("chmod 777 ./PDF/".$row->name."/".$account_ppt_id);
	//}
	
	//imagepng($img1,"./PDF/".$row->name."/".$account_ppt_id."/"$page".png",0);
	//system("chmod 777 ./PDF/".$row->name."/".$account_ppt_id."/"$page".png");
	imagepng($img1,"./PDF/".$row->name."/"$page".png",0);
	system("chmod 777 ./PDF/".$row->name."/"$page".png");
	
	//echo '<img src='.$img1.'>';
	echo 'done';
	imagedestroy($img1);
	imagedestroy($img2);
	//system("rm ./PIC/temp/temp_".$account_ppt_id.'_'.$page.".png");*/
	
?>
