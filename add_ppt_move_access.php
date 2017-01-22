<?php 
	session_save_path("./session");
	session_start(); 
?>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<?php
	require_once("connect.php");
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
	$list=$_GET["list"];
	$decode_data = json_decode($list);
	
	$account_ppt_id = $decode_data->account_ppt_id;
	$page = $decode_data->page;
	$mode = $decode_data->mode;
	$X = $decode_data->X;
	$Y = $decode_data->Y;
	$color = $decode_data->color;
	$time = $decode_data->time;
	
	$sql = "SELECT * FROM PPT WHERE name = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($ppt_name));
	$sql = "INSERT INTO PPT_MOVE(account_ppt_id,page,mode,X,Y,color,time) VALUES(?,?,?,?,?,?,?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($account_ppt_id, $page, $mode, $X, $Y, $color, $time));
?>