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
	$ppt_id = $_GET['ppt_id'];
	$page = $_GET['page'];
	$question = $_POST['question'];
	
	if($question==NULL){
		$sql = "SELECT * FROM PPT WHERE id = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($ppt_id));
		$row = $sth->fetchObject();
		$ppt_name = $row->name;		
	
		$sql = "DELETE FROM PPT_QUESTION WHERE ppt_id = ? AND page = ?";
		$sth = $db->prepare($sql);
		if($sth->execute(array($ppt_id,$page))===TRUE){
			echo '<meta http-equiv="refresh" content="0;url=edit_ppt.php?ppt_name='.$ppt_name.'&page='.$page.'" />';
		}
		else{
			echo '<script> confirm("failed!"); </script>';
			echo '<meta http-equiv="refresh" content="0;url=edit_ppt.php?ppt_name='.$ppt_name.'&page='.$page.'"/>'; 
		} 
	}
	else{
		$sql = "UPDATE PPT SET author = 1 WHERE id = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($ppt_id));
		
		$sql = "SELECT * FROM PPT WHERE id = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($ppt_id));
		$row = $sth->fetchObject();
		$ppt_name = $row->name;
		
		/*check if question exist*/
		$sql = "SELECT * FROM PPT_QUESTION WHERE ppt_id = ? AND page = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($ppt_id,$page));
		$row = $sth->fetchObject();
		if($row==NULL){
			$sql = "INSERT INTO PPT_QUESTION(id,ppt_id,page,question) VALUES(NULL,?,?,?)";
			$sth = $db->prepare($sql);
			if($sth->execute(array($ppt_id,$page,$question))===TRUE){
				/*check if in account_ppt*/
				$sql = "SELECT * FROM ACCOUNT_PPT WHERE account_id = ? AND ppt_id = ?";
				$sth = $db->prepare($sql);
				$sth->execute(array($id,$ppt_id));
				$row2 = $sth->fetchObject();
				if($row2==NULL){
					$sql = "INSERT INTO ACCOUNT_PPT(id,account_id,ppt_id)
							VALUES (NULL, ?, ?)";
					$sth=$db->prepare($sql);
					$sth->execute(array($id,$ppt_id));
				}
				
				echo '<meta http-equiv="refresh" content="0;url=edit_ppt.php?ppt_name='.$ppt_name.'&page='.$page.'" />';
			}
			else{
				echo '<script> confirm("failed!"); </script>';
				echo '<meta http-equiv="refresh" content="0;url=edit_ppt.php?ppt_name='.$ppt_name.'&page='.$page.'"/>'; 
			} 
		}
		else{
			$sql = "UPDATE PPT_QUESTION SET question = ? WHERE ppt_id = ? AND page = ?";
			$sth = $db->prepare($sql);
			if($sth->execute(array($question,$ppt_id,$page))===TRUE){
				echo '<meta http-equiv="refresh" content="0;url=edit_ppt.php?ppt_name='.$ppt_name.'&page='.$page.'" />';
			}
			else{
				echo '<script> confirm("failed!"); </script>';
				echo '<meta http-equiv="refresh" content="0;url=edit_ppt.php?ppt_name='.$ppt_name.'&page='.$page.'"/>'; 
			} 
		
		}
		$sql = "SELECT * FROM PPT WHERE name = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($ppt_name));
		$sql = "INSERT INTO PPT_MOVE(account_ppt_id,page,mode,X,Y,color,time) VALUES(?,?,?,?,?,?,?)";
		$sth = $db->prepare($sql);
		$sth->execute(array($account_ppt_id, $page, $mode, $X, $Y, $color, $time));
	}
?>
