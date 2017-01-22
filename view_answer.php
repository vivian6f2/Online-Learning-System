<!-- http://140.113.140.27:81/HCI_project/view_answer.php?ppt_name=CaoBei&account_ppt_id=3&page=0 -->
<?php 
	session_save_path("./session");
	session_start(); 
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require_once("connect.php");
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
	$ppt_name = $_GET['ppt_name'];
	$account_ppt_id = $_GET['account_ppt_id'];
	if($_GET['page']) $page=$_GET['page'];
	else $page = 0;
	$replay = $_GET['replay'];
	$size = getimagesize("http://140.113.140.27:81/HCI_project/PDF/".$ppt_name."/".$ppt_name."-".$page.".jpg");
	$movement = array();

	$account = $_SESSION['account'];
	$id = $_SESSION['id'];
	$authority = $_SESSION['authority'];
	
	$sql = "SELECT * FROM ACCOUNT_PPT WHERE id = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($account_ppt_id));
	$row = $sth->fetchObject();
	$account_id= $row->account_id;
	$ppt_id = $row->ppt_id;
	
	$sql = "SELECT * FROM PPT_MOVE WHERE account_ppt_id = ? AND page = ? ORDER BY time ASC";
	$sth = $db->prepare($sql);
	$sth->execute(array($account_ppt_id, $page));
	$row = $sth->fetchObject();
	$i=0;
	while($row!=null){
		array_push($movement,$row);
		$row = $sth->fetchObject();
	}
?>
<html>
	<head>
		<title>線上教學系統</title>
		<style type="text/css">
			.myblock {background-color:#FF00FF;height:50px;width:50px; }
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
				width:100%;
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
			}
			.CSSTableGenerator tr:first-child td{
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
			}
			.CSSTableGenerator tr:first-child:hover td{
				background:-o-linear-gradient(bottom, #A3D3BB 5%, #A3D3BB 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #629096), color-stop(1, #629096) );
				background:-moz-linear-gradient( center top, #A3D3BB 5%, #A3D3BB 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#A3D3BB", endColorstr="#A3D3BB");	background: -o-linear-gradient(top,#629096,629096);
			
				background-color:#A3D3BB;
			}
			.CSSTableGenerator tr:first-child td:first-child{
				border-width:0px 0px 1px 0px;
			}
			.CSSTableGenerator tr:first-child td:last-child{
				border-width:0px 0px 1px 1px;
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
		<script type="text/javascript">
		var minutes = 1000*60;
		var hours = minutes*60;
		var days = hours*24;
		var years = days*365;
		var m, c;
		var time;
		var id=0;
		var p=0;
		var color = 'rgb(0,0,0)';
		var first_start;
		var playing=false;
		
		function init(account_ppt_id,page){
			m=document.getElementById("m");
			c=m.getContext("2d");
			first_start=true;
			c.lineWidth = 3;
			id = account_ppt_id;
			p = page;
			var d = new Date();
			time = d.getTime();
			playing=false;
		}
		
		function start(move){
			if(playing==false){
				playing=true;
				var m1;
				c.clearRect(0,0,m.width,m.height);
				for(m1=0;m1<move.length;m1++){
					if(move[m1].mode==2){
						draw(move[m1].color,move[m1].X,move[m1].Y,move[m1].time,move[m1-1].mode,move[m1+1].mode);
					}
				}
				playing_stop(move[move.length-1].time);
			}
		}
		function playing_stop(t){
			setTimeout(function(){playing=false;},t);
		}
		
		function draw(color,X,Y,t,pre_mode,next_mode){
			if(pre_mode==1){
				setTimeout(function(){c.strokeStyle = color;}, t);
				if(color=='rgba(0,0,0,1)'){
					setTimeout(function(){c.globalCompositeOperation = 'destination-out';}, t);
					setTimeout(function(){c.lineWidth = 7;}, t);
				}
				else{
					setTimeout(function(){c.globalCompositeOperation = 'source-over';}, t);
					setTimeout(function(){c.lineWidth = 3;}, t);
				}
				setTimeout(function(){c.moveTo(X-1,Y-1);}, t);
				setTimeout(function(){c.beginPath();}, t);
			}
			setTimeout(function(){c.lineTo(X,Y);}, t);
			setTimeout(function(){c.stroke();}, t);
			if(next_mode==3) setTimeout(function(){c.closePath();}, t);
		}
		
		</script>
	</head>
	<body bgcolor="#E8FBFD" onload="init(<?php echo $account_ppt_id.','.$page; ?>)">
		<?php
			
			if($id==null || $account==null )
			{
				echo '<script>alert("You cannot read this page.")</script>';
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
				<aa class="back"><a href="ppt_gallery.php?ppt_name=<?php echo $ppt_name;?>&ppt_id=<?php echo $ppt_id;?>&page=<?php echo $page;?>" class="button">Back</a></aa>
				<table width="100%" height="15%">
				<tr><td align="center" valign="bottom">
		<?php		echo '<ss class = "font-style-title">'.$ppt_name.'</ss>';
				echo '</td></tr>';
				echo '</table><br><br><br>';

				$sql = "SELECT * FROM PPT_QUESTION WHERE ppt_id = ? AND page = ?";
				$sth = $db->prepare($sql);
				$sth->execute(array($ppt_id,$page));
				$row = $sth->fetchObject();
				$question = $row->question;

				$sql1 = "SELECT * FROM ACCOUNT_PPT WHERE id = ?";
				$sth1 = $db->prepare($sql1);
				$sth1->execute(array($account_ppt_id));
				$row1 = $sth1->fetchObject();
				$answer_person_id = $row1->account_id;

				$sql1 = "SELECT * FROM ACCOUNT WHERE id = ?";
				$sth1 = $db->prepare($sql1);
				$sth1->execute(array($answer_person_id));
				$row1 = $sth1->fetchObject();
				$answer_person_name = $row1->name;
				
				echo '<div align="center" valign="middle">';
				echo '<ss class="font-style-session"><pre>'.$question.'</pre></ss>';
				echo '</div><br>';
				echo '<div align="center" valign="middle">';
				echo '<ss class="font-style-session">Answered by '.$answer_person_name.'</ss>';
				echo '</div><br>';
				echo '<div align="center" valign="middle">';
				echo '<ss class="font-style-session">Please click ppt to display.</ss>';
				echo '</div><br>';
		?>
				
				<div align="center" valign="middle">
				<div style="width:<?php echo $size[0];?>px; height:<?php echo $size[1];?>px; border-style: solid; border-width: 1px; 
					background-image:url(<?php echo 'http://140.113.140.27:81/HCI_project/PDF/'.$ppt_name.'/'.$ppt_name.'-'.$page.'.jpg';?>);
					background-repeat:no-repeat;"  onmousedown='start(<?php echo json_encode($movement); ?>)'>
					<canvas id="m" width="<?php echo $size[0];?>" height="<?php echo $size[1];?>"></canvas>
				</div>
				</div><br><br><br>

				<div align="center" valign="middle">
				<form name="ADD" method="POST" action="add_response_access.php<?php echo '?account_ppt_id='.$account_ppt_id.'&page='.$page.'&account_id='.$id.'&ppt_name='.$ppt_name; ?>">
					<ss class="font-style">Comment</ss><br><br>
					<textarea name="response" style="width:600px;height:100px;"></textarea><br><br>
					<input type="submit" name="button" value="Send" class="button"/>
				</form>
				</div><br><br><br>

		<?php
				echo '<table class = "CSSTableGenerator" align="center" valign="middle">';
				echo '<tr><td>Name</td><td>Comment</td><td>Edit</td><td>Delete</td></tr>';
				$sql = "SELECT * FROM PPT_RESPONSE WHERE account_ppt_id = ? AND page = ? ORDER BY id";
				$sth = $db->prepare($sql);
				$sth->execute(array($account_ppt_id,$page));
				while($row = $sth->fetchObject()){
					$sql = "SELECT * FROM ACCOUNT WHERE id = ?";
					$sth_1 = $db->prepare($sql);
					$sth_1->execute(array($row->account_id));
					$row_1 = $sth_1->fetchObject();
					echo '<tr><td>'.$row_1->name.'</td><td><pre>'.$row->response.'</pre></td>';
					if($row->account_id==$id) echo '<td><a href="edit_response.php?ppt_name='.$ppt_name.'&account_ppt_id='.$account_ppt_id.'&page='.$page.'&account_id='.$id.'&response_id='.$row->id.'" class="button">Edit</a></td>';
					else echo '<td></td>';
					if($row->account_id==$id) echo '<td><a href="delete_response_access.php?ppt_name='.$ppt_name.'&account_ppt_id='.$account_ppt_id.'&page='.$page.'&account_id='.$id.'&response_id='.$row->id.'" class="button">Delete</a></td></tr>';
					else echo '<td></td></tr>';
				}
				echo '</table>';
				
			}
		?>
	</body>
</html>
