<?php
	session_save_path("./session");
	session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require_once("connect.php");
	$account_ppt_id=$_GET['account_ppt_id'];
	$page=$_GET['page'];
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
?>
<?php
	//get ppt name
	$sql = "SELECT * FROM PPT WHERE id = ANY(SELECT ppt_id FROM ACCOUNT_PPT WHERE id = ?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($account_ppt_id));
	$row = $sth->fetchObject();
	$ppt_name = $row->name;
	
	$sql = "DELETE FROM PPT_MOVE WHERE account_ppt_id = ? AND page = ?";
	$sth = $db->prepare($sql);
	if ($sth->execute(array($account_ppt_id,$page))===TRUE){
		system("rm ./PDF/".$ppt_name."/".$account_ppt_id.'/'.$page.".png");
		echo 'Delete succeed!';
	}
	else{
		echo 'Delete failed!';
	} 
	
?>
