<?php
	session_save_path("./session");
	session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require_once("connect.php");
	$ppt_id=$_GET['ppt_id'];
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
?>
<?php
	$account = $_SESSION['account'];
	$id = $_SESSION['id'];
	$authority = $_SESSION['authority'];
	$sql = "DELETE FROM PPT WHERE id = ?";
	$sth = $db->prepare($sql);
	if ($sth->execute(array($ppt_id))===TRUE){
		echo '<meta http-equiv="refresh" content="0;url=home.php" />';
	}
	else{
		echo '<script> confirm("failed!"); </script>';
		echo '<meta http-equiv="refresh" content="0;url=home.php" />';
	} 
	
?>
