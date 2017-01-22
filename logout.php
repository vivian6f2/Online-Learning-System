<?php 
	session_save_path("./session");
	session_start(); 
	session_unset($_SESSION['account']);
	session_unset($_SESSION['id']);
	session_unset($_SESSION['authority']);
	$_SESSION = array();
	session_destroy();
	echo '<meta http-equiv="refresh" content="0;url=login.php"/>';
?>
