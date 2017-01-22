<?php 
	session_save_path("./session");
	session_start(); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require_once("connect.php");
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
?>
<html>
	<head>
		<title>線上教學系統</title>
		<style type="text/css">
			.font-style {
				font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
				color: #BF815D;
				font-size: 20;
				padding: 15;
				font-weight: bold;
			}
			.font-style-title {
				font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
				color: #BF815D;
				font-size: 50;
				padding: 5;
				font-weight: bold;
			}
			.font-style-session {
				font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
				color: #629096;
				font-size: 20;
				padding: 15;
				font-weight: bold;
			}
			.button { 
				font-size:16px;
				font-family:Trebuchet MS;
				font-weight:normal;
				-moz-border-radius:8px;
				-webkit-border-radius:8px;
				border-radius:8px;
				border:0px solid #ffffff;
				padding:7px 14px;
				text-decoration:none;
				background:-moz-linear-gradient( center top, #F4BF9F 5%, #965A37 100% );
				background:-ms-linear-gradient( top, #F4BF9F 5%, #965A37 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#F4BF9F', endColorstr='#965A37');
				background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #F4BF9F), color-stop(100%, #DD8E6A) );
				background-color:#F4BF9F;
				color:#f2f3fa;
				display:inline-block;
				text-shadow:1px 1px 0px #d0b0d;
				-webkit-box-shadow: 1px 1px 0px 0px #ffffff;
				-moz-box-shadow: 1px 1px 0px 0px #ffffff;
				box-shadow: 1px 1px 0px 0px #ffffff;
			}.button:hover {
				background:-moz-linear-gradient( center top, #965A37 5%, #F4BF9F 100% );
				background:-ms-linear-gradient( top, #965A37 5%, #F4BF9F 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#965A37', endColorstr='#F4BF9F');
				background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #965A37), color-stop(100%, #F4BF9F) );
				background-color:#965A37;
			}.button:active {
				position:relative;
				top:1px;
			}
			.back{
				position:fixed;
				left:10px;
				top:10px;
			}
			.user{
				position:fixed;
				right:80px;
				top:15px;
				background-color:#E8FBFD;
			}
			.logout{
				position:fixed;
				right:10px;
				top:10px;
			}
		</style>
	</head>
	<body bgcolor="#E8FBFD">
		<?php
			$account = $_SESSION['account'];
			$id = $_SESSION['id'];
			$authority = $_SESSION['authority'];
			if($id==null || $account==null )
			{
				echo '<script>alert("You cannot upload ppt.")</script>';
				echo '<meta http-equiv="refresh" content="0;url=logout.php" />';
			}
			else{
				$sql = "SELECT * FROM ACCOUNT WHERE id = ?";
				$sth = $db->prepare($sql);
				$sth->execute(array($id));
				$name = $sth->fetchObject()->name;
				echo '<aa class="user"><ss class="font-style-session">Hi,&nbsp;'.$name.'.&nbsp</ss></aa>&nbsp;&nbsp;&nbsp';
		?>
			<aa class="logout"><a href="logout.php" class="button">Logout</a></aa>
			<aa class="back"><a href="home.php" class="button">Back</a></aa>
			<table width="100%" height="15%">
			<tr><td align="center" valign="bottom">
			<ss class = "font-style-title">Upload PPT</ss>
			</td></tr>
			</table><br><br><br>
			<table width="100%" height="30%">
			<tr><td align="center" valign="middle">
			<ss class="font-style-session">Upload PDF form only</ss><br><br>
			<form enctype="multipart/form-data" name="ADD" method="POST" action="upload_ppt_access.php">
				<ss class="font-style">PPT&nbsp;:&nbsp;</ss><input type="file" name="ppt"/><br><br><br>
				<input type="submit" name="button" value="Upload" class="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</form>
			</td></tr>
			</table>
		<?php
			}
		?>
	</body>	
</html>
