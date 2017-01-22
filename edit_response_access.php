<?php 
	session_save_path("./session");
	session_start(); 
?>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<?php
	require_once("connect.php");
	$account = $_SESSION['account'];
	$id = $_SESSION['id'];
	$authority = $_SESSION['authority'];
	
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
	$ppt_name = $_GET['ppt_name'];
	$page = $_GET['page'];
	$account_ppt_id = $_GET['account_ppt_id'];
	$account_id = $_GET['account_id'];
	$response_id = $_GET['response_id'];
	$response = $_POST['response'];
	
	
	
	$sql = "UPDATE PPT_RESPONSE SET response = ? WHERE id = ?";
	$sth = $db->prepare($sql);
	if($sth->execute(array($response,$response_id))===TRUE){
		echo '<meta http-equiv="refresh" content="0;url=view_answer.php?ppt_name='.$ppt_name.'&account_ppt_id='.$account_ppt_id.'&page='.$page.'" />';
	}
	else{
		echo '<script> confirm("failed!"); </script>';
		echo '<meta http-equiv="refresh" content="0;url=view_answer.php?ppt_name='.$ppt_name.'&account_ppt_id='.$account_ppt_id.'&page='.$page.'"/>'; 
	} 
		
	
?>
