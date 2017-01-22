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
	$account_ppt_id = $_GET['account_ppt_id'];
	$page = $_GET['page'];
	$response = $_POST['response'];
	$account_id = $_GET['account_id'];
	$ppt_name = $_GET['ppt_name'];
	
	$sql = "INSERT INTO PPT_RESPONSE(id,account_ppt_id,page,response,account_id) VALUES(NULL,?,?,?,?)";
	$sth = $db->prepare($sql);
	if($sth->execute(array($account_ppt_id,$page,$response,$account_id))===TRUE){
		echo '<meta http-equiv="refresh" content="0;url=view_answer.php?ppt_name='.$ppt_name.'&account_ppt_id='.$account_ppt_id.'&page='.$page.'" />';
	}
	else{
		echo '<script> confirm("failed!"); </script>';
		echo '<meta http-equiv="refresh" content="0;url=view_answer.php?ppt_name='.$ppt_name.'&account_ppt_id='.$account_ppt_id.'&page='.$page.'"/>'; 
	} 
	
?>
