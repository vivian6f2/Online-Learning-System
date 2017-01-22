<?php
	session_save_path("./session");
	session_start();
?>
<?php
	require_once("connect.php");
	$ppt_id=$_GET["ppt_id"]; 
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
?>
<?php
	if($ppt_id!=NULL){
		
		$account = $_SESSION['account'];
		$id = $_SESSION['id'];
		$authority = $_SESSION['authority'];
		$sql = "INSERT INTO ACCOUNT_PPT(id,account_id,ppt_id)
				VALUES (NULL, ?, ?)";
		$sth=$db->prepare($sql);
		if($sth->execute(array($id,$ppt_id))===TRUE){
			echo '<meta http-equiv="refresh" content="0;url=home.php" />';
		}
		else{
			echo '<script> confirm("failed!"); </script>';
			echo '<meta http-equiv="refresh" content="0;url=home.php"/>'; 
		} 
		
		
	}
?>
