<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require_once("connect.php");
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
	$account = $_POST["account"];
	$name = $_POST["name"];
	$is_teacher = $_POST["is_teacher"];
?>
<?php
	if($account!=NULL&&$name!=NULL){
		$authority;
		if($is_teacher == "on") $authority="teacher";
		else $authority="student";
		
		$space = ' ';
		$pos = strpos($account, $space);
		
		if($pos === false){
			/*insert into account*/
			insert_account($account, $name, $authority, $db);
		}
		else{
			echo '<script> confirm("You cannot have space in your account!"); </script>';
			echo '<meta http-equiv="refresh" content="0;url=web_regist.php"/>';
		}
	}
	else{
		echo '<script> confirm("Regist Failed!"); </script>';
		echo '<meta http-equiv="refresh" content="0;url=regist.php"/>';
	}
?>
<?php
	function insert_account($account,$name,$authority,$db){
	
		$sql = "SELECT * FROM ACCOUNT WHERE account = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($account));
		$row = $sth->fetchObject();
		//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($row != NULL){
			echo '<script> confirm("Account has already been used."); </script>';
			echo '<meta http-equiv="refresh" content="0;url=regist.php"/>';   
		}
		else{
			/*insert ACCOUNT*/
			$sql = "INSERT INTO ACCOUNT (id, account, name, authority)
					VALUES (NULL, ?, ?, ?) ON DUPLICATE KEY UPDATE id=id";
			$sth = $db->prepare($sql);
			
			if ($sth->execute(array($account,$name,$authority))=== TRUE){
				echo '<script> confirm("Regist Succeed!"); </script>';
				echo '<meta http-equiv="refresh" content="0;url=login.php"/>';     
			}
			else {
				echo '<script> confirm("Regist Failed! (insert into sql failed)"); </script>';
				echo '<meta http-equiv="refresh" content="0;url=regist.php"/>';     
			}
		}
	}
?>