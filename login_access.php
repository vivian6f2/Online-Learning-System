<?php 
	session_save_path("./session");
	session_start(); 
?>
<?php
	$account = $_POST["account"];
	require_once("connect.php");
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
?>
<?php
	$sql = "SELECT * FROM ACCOUNT WHERE account = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($account));
	$row = $sth->fetchObject();
	if($row != NULL){
		$_SESSION['account']=$account;
		$_SESSION['id']=$row->id;
		$_SESSION['authority']=$row->authority;
		echo '<meta http-equiv="refresh" content="0;url=home.php"/>';
	}
	else{
		echo '<script> confirm("Account is not exist!"); </script>';
		echo '<meta http-equiv="refresh" content="0;url=login.php"/>';
	}
?>
