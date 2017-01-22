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
			.CSSTableGenerator {
				left-margin:10%;padding:0px;
				width:80%;
				box-shadow: 10px 10px 5px #888888;
				border:1px solid #ffffff;
				
				-moz-border-radius-bottomleft:10px;
				-webkit-border-bottom-left-radius:10px;
				border-bottom-left-radius:10px;
				
				-moz-border-radius-bottomright:10px;
				-webkit-border-bottom-right-radius:10px;
				border-bottom-right-radius:10px;
				
				-moz-border-radius-topright:10px;
				-webkit-border-top-right-radius:10px;
				border-top-right-radius:10px;
				
				-moz-border-radius-topleft:10px;
				-webkit-border-top-left-radius:10px;
				border-top-left-radius:10px;
			}.CSSTableGenerator table{
				border-collapse: collapse;
					border-spacing: 0;
				width:80%;
				height:100%;
				margin:0px;padding:0px;
			}.CSSTableGenerator tr:last-child td:last-child {
				-moz-border-radius-bottomright:10px;
				-webkit-border-bottom-right-radius:10px;
				border-bottom-right-radius:10px;
			}
			.CSSTableGenerator table tr:first-child td:first-child {
				-moz-border-radius-topleft:10px;
				-webkit-border-top-left-radius:10px;
				border-top-left-radius:10px;
			}
			.CSSTableGenerator table tr:first-child td:last-child {
				-moz-border-radius-topright:10px;
				-webkit-border-top-right-radius:10px;
				border-top-right-radius:10px;
			}.CSSTableGenerator tr:last-child td:first-child{
				-moz-border-radius-bottomleft:10px;
				-webkit-border-bottom-left-radius:10px;
				border-bottom-left-radius:10px;
			}.CSSTableGenerator tr:hover td{
				
			}
			.CSSTableGenerator tr:nth-child(odd){ background-color:#CEF2E0; }
			.CSSTableGenerator tr:nth-child(even)    { background-color:#BEE8EE; }.CSSTableGenerator td{
				vertical-align:middle;
				
				border:1px solid #ffffff;
				border-width:0px 1px 1px 0px;
				text-align:center;
				padding:7px;
				font-size:16px;
				font-family:Trebuchet MS;
				font-weight:normal;
				color:#6C381A;
			}.CSSTableGenerator tr:last-child td{
				border-width:0px 1px 0px 0px;
			}.CSSTableGenerator tr td:last-child{
				border-width:0px 0px 1px 0px;
			}.CSSTableGenerator tr:last-child td:last-child{
				border-width:0px 0px 0px 0px;
			}.CSSTableGenerator tr:first-child td{
					background:-o-linear-gradient(bottom, #A3D3BB 5%, #A3D3BB 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #629096), color-stop(1, #629096) );
				background:-moz-linear-gradient( center top, #A3D3BB 5%, #A3D3BB 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#A3D3BB", endColorstr="#A3D3BB");	background: -o-linear-gradient(top,#629096,629096);
			
				background-color:#A3D3BB;
				border:0px solid #ffffff;
				text-align:center;
				border-width:0px 0px 1px 1px;
				font-size:18px;
				font-family:Trebuchet MS;
				font-weight:bold;
				color:#ffffff;
			}.CSSTableGenerator tr:first-child:hover td{
				background:-o-linear-gradient(bottom, #A3D3BB 5%, #A3D3BB 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #629096), color-stop(1, #629096) );
				background:-moz-linear-gradient( center top, #A3D3BB 5%, #A3D3BB 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#A3D3BB", endColorstr="#A3D3BB");	background: -o-linear-gradient(top,#629096,629096);
			
				background-color:#A3D3BB;
			}.CSSTableGenerator tr:first-child td:first-child{
				border-width:0px 0px 1px 0px;
			}.CSSTableGenerator tr:first-child td:last-child{
				border-width:0px 0px 1px 1px;
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
			if($authority != "student" && $authority != "teacher") {
				echo '<script>alert("You cannot read this page.")</script>';
				echo '<meta http-equiv="refresh" content="0;url=logout.php" />';
			}
			$sql = "SELECT * FROM ACCOUNT WHERE id = ?";
			$sth = $db->prepare($sql);
			$sth->execute(array($id));
			$name = $sth->fetchObject()->name;
			echo '<aa class="user"><ss class="font-style-session">Hi,&nbsp;'.$name.'.&nbsp</ss></aa>&nbsp;&nbsp;&nbsp';
		?>
			<aa class="logout"><a href="logout.php" class="button">Logout</a></aa>
			<table width="100%" height="15%">
			<tr><td align="center" valign="bottom">
			<ss class = "font-style-title">Home</ss>
			</td></tr>
			</table><br><br>
		<?php
			echo '<div align="center">';
			echo '<ss class="font-style">My PPT</ss>';
			echo '</div><br><br>';
			echo '<table class = "CSSTableGenerator" align="center" valign="middle">';
			echo '<tr><td>PPT Name</td><td>Preview</td><td>Learn</td><td>Gallery</td><td>Remove from my PPT</td></tr>';
			$sql = "SELECT * FROM PPT WHERE id = ANY(SELECT ppt_id FROM ACCOUNT_PPT WHERE account_id = ?) AND author = 1";
			$sth = $db->prepare($sql);
			$sth->execute(array($id));
			while($row = $sth->fetchObject()){
				echo '<tr><td>'.$row->name.'</td>';
				echo '<td><img src="http://140.113.140.27:81/HCI_project/PDF/'.$row->name.'/'.$row->name.'-0.jpg" height="50"></td>';
				echo '<td><a href="learn_ppt.php?ppt_name='.$row->name.'" class="button">Learn</a></td>';
				echo '<td><a href="ppt_gallery.php?ppt_name='.$row->name.'&ppt_id='.$row->id.'" class="button">Gallery</a></td>';
				echo '<td><a href="remove_ppt_from_account_access.php?ppt_id='.$row->id.'" class="button">Remove</a></td></tr>';
			}
			echo '</table><br><br><br>';

			echo '<div align="center">';
			echo '<ss class="font-style">All PPT</ss>';
			echo '</div><br><br>';
			echo '<table class = "CSSTableGenerator" align="center" valign="middle">';
			echo '<tr><td>Name</td><td>Preview</td><td>View</td><td>Add/Remove to my PPT</td></tr>';
			$sql = "SELECT * FROM PPT WHERE author = 1";
			$sth = $db->prepare($sql);
			$sth->execute();
			while($row = $sth->fetchObject()){
				echo '<tr><td>'.$row->name.'</td>';
				echo '<td><img src="http://140.113.140.27:81/HCI_project/PDF/'.$row->name.'/'.$row->name.'-0.jpg" height="50"></td>';
				echo '<td><a href="view_ppt.php?ppt_name='.$row->name.'" class="button">View</a></td>';
				$sql1 = "SELECT * FROM ACCOUNT_PPT WHERE account_id = ? AND ppt_id = ?";
				$sth1 = $db->prepare($sql1);
				$sth1->execute(array($id, $row->id));
				$row1 = $sth1->fetchObject();
				if($row1!=null) echo '<td><a href="remove_ppt_from_account_access.php?ppt_id='.$row->id.'" class="button">Remove</a></td></tr>';
				else echo '<td><a href="add_ppt_to_account_access.php?ppt_id='.$row->id.'" class="button">Add</a></td></tr>';
			}
			echo '</table><br><br><br>';
			if($authority=="teacher"){
				echo '<div align="center">';
				echo '<ss class="font-style">Edit Your PPT</ss>&nbsp;&nbsp;&nbsp;';
				echo '<a href="upload_ppt.php" class="button">Upload PPT</a>';
				echo '</div><br><br>';
				echo '<table class = "CSSTableGenerator" align="center" valign="middle">';
				echo '<tr><td>Name</td><td>Preview</td><td>Author</td><td>Edit</td><td>Delete</td></tr>';
				$sql = "SELECT * FROM PPT WHERE teacher_id = ?";
				$sth = $db->prepare($sql);
				$sth->execute(array($id));
				while($row = $sth->fetchObject()){
					echo '<tr><td>'.$row->name.'</td>';
					echo '<td><img src="http://140.113.140.27:81/HCI_project/PDF/'.$row->name.'/'.$row->name.'-0.jpg" height="50"></td>';
					if($row->author==0) echo '<td>Not author yet!</td>';
					if($row->author==1) echo '<td>Already authored!</td>';
					echo '<td><a href="edit_ppt.php?ppt_name='.$row->name.'" class="button">Edit</a></td>';
					echo '<td><a href="delete_ppt.php?ppt_id='.$row->id.'" class="button">Delete</a></td>';
					echo '</tr>';
				}
				echo '</table>';
				
			}
		?>
	</body>	
</html>
