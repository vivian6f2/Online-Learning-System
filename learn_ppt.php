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
	if($_GET['page']) $page=$_GET['page'];
	else $page = 0;
	$redo = $_GET['redo'];
	$size = getimagesize("http://140.113.140.27:81/HCI_project/PDF/".$ppt_name."/".$ppt_name."-".$page.".jpg");

	$account = $_SESSION['account'];
	$id = $_SESSION['id'];
	$authority = $_SESSION['authority'];
	
	$sql = "SELECT * FROM PPT WHERE name = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($ppt_name));
	$row = $sth->fetchObject();
	$ppt_id= $row->id;
	$sql = "SELECT * FROM ACCOUNT_PPT WHERE account_id = ? AND ppt_id = ?";
	$sth = $db->prepare($sql);
	$sth->execute(array($id,$ppt_id));
	$row = $sth->fetchObject();
	$account_ppt_id = $row->id;
	
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
				margin:0px;padding:0px;
				width:100%;
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
		var start_draw;
		var draw;
		var m, c;
		var time;
		var id=0;
		var p=0;
		var color = 'rgb(0,0,0)';
		var first_start;

		var mouseEventTypes = {
			touchstart : "mousedown",
			touchmove : "mousemove",
			touchend : "mouseup"
		};

		for (originalType in mouseEventTypes) {
			document.addEventListener(originalType, function(originalEvent) {
				event = document.createEvent("MouseEvents");
				touch = originalEvent.changedTouches[0];
				event.initMouseEvent(mouseEventTypes[originalEvent.type], true, true,
				window, 0, touch.screenX, touch.screenY, touch.clientX,
				touch.clientY, touch.ctrlKey, touch.altKey, touch.shiftKey,
				touch.metaKey, 0, null);
				originalEvent.target.dispatchEvent(event);
			});
		} 
		

		function init(account_ppt_id,page){
			m=document.getElementById("m");
			c=m.getContext("2d");
			start_draw=false;
			first_start=true;
			c.lineWidth = 3;
			id = account_ppt_id;
			p = page;
			var d = new Date();
			time = d.getTime();
		}
		function md(){
			if(start_draw){
				
				c.moveTo(event.offsetX, event.offsetY);
				draw=true;
				c.beginPath();

				var d = new Date();
				var t = d.getTime()-time;
				//push into json array
				var jsonArg = {};
				jsonArg.account_ppt_id=id;
				jsonArg.page=p;
				jsonArg.mode=1;
				jsonArg.X=event.offsetX;
				jsonArg.Y=event.offsetY;
				jsonArg.color=color;
				jsonArg.time=t;
				//pluginArrayArg.push(jsonArg);
				
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
					}
				}
			
				var list = JSON.stringify(jsonArg);
				xmlhttp.open("GET", "add_ppt_move_access.php?list="+list, true);
				xmlhttp.send();
			}
		}
		function mv(){
			if(draw){
				c.lineTo(event.offsetX,event.offsetY);
				c.stroke();
				
				var d = new Date();
				var t = d.getTime()-time;
				//push into json array
				var jsonArg = {};
				jsonArg.account_ppt_id=id;
				jsonArg.page=p;
				jsonArg.mode=2;
				jsonArg.X=event.offsetX;
				jsonArg.Y=event.offsetY;
				jsonArg.color=color;
				jsonArg.time=t;
				//pluginArrayArg.push(jsonArg);
				
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
					}
				}
			
				var list = JSON.stringify(jsonArg);
				xmlhttp.open("GET", "add_ppt_move_access.php?list="+list, true);
				xmlhttp.send();
			}
		}
		function mup(){
			draw=false;
			c.closePath();
			
			var d = new Date();
			var t = d.getTime()-time;
			var jsonArg = {};
			jsonArg.account_ppt_id=id;
			jsonArg.page=p;
			jsonArg.mode=3;
			jsonArg.X=event.offsetX;
			jsonArg.Y=event.offsetY;
			jsonArg.color=color;
			jsonArg.time=t;
			//pluginArrayArg.push(jsonArg);
			
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				}
			}
			
			var list = JSON.stringify(jsonArg);
			xmlhttp.open("GET", "add_ppt_move_access.php?list="+list, true);
			xmlhttp.send();
			
			var img = m.toDataURL("image/png");
			var xmlhttp2 = new XMLHttpRequest();
			xmlhttp2.onreadystatechange = function() {
				if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp2.responseText;
				}
			}
			
			xmlhttp2.open("POST", "save_result.php", true);
			xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp2.send("img="+img+"&account_ppt_id="+id+"&page="+p);
		}
		function start(){
			if(first_start==true){
				first_start=false;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
					}
				}
			
				
				xmlhttp.open("GET", "delete_ppt_move.php?account_ppt_id="+id+"&page="+p, true);
				xmlhttp.send();
			}
			start_draw=true;
			time = d.getTime();
		}
		function store(){
			start_draw=false;
			var img = m.toDataURL("image/png");
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				}
			}
			
			xmlhttp.open("POST", "save_result.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("img="+img+"&account_ppt_id="+id+"&page="+p);
		}
		function click_1(){
			c.globalCompositeOperation = 'source-over';
			c.lineWidth = 3;
			c.strokeStyle = 'rgb(0,0,0)';
			color = 'rgb(0,0,0)';}
		function click_2(){
			c.globalCompositeOperation = 'source-over';
			c.lineWidth = 3;
			c.strokeStyle = 'rgb(0,0,255)';
			color = 'rgb(0,0,255)';}
		function click_3(){
			c.globalCompositeOperation = 'source-over';
			c.lineWidth = 3;
			c.strokeStyle = 'rgb(0,255,255)';
			color = 'rgb(0,255,255)';}
		function click_4(){
			c.globalCompositeOperation = 'source-over';
			c.lineWidth = 3;
			c.strokeStyle = 'rgb(0,255,0)';
			color = 'rgb(0,255,0)';}
		function click_5(){
			c.globalCompositeOperation = 'source-over';
			c.lineWidth = 3;
			c.strokeStyle = 'rgb(255,255,0)';
			color = 'rgb(255,255,0)';}
		function click_6(){
			c.globalCompositeOperation = 'source-over';
			c.lineWidth = 3;
			c.strokeStyle = 'rgb(255,0,0)';
			color = 'rgb(255,0,0)';}
		function click_7(){
			c.globalCompositeOperation = 'source-over';
			c.lineWidth = 3;
			c.strokeStyle = 'rgb(255,0,255)';
			color = 'rgb(255,0,255)';}
		function click_8(){ 
			c.globalCompositeOperation = 'destination-out';
			c.lineWidth = 7;
			c.strokeStyle = 'rgba(0,0,0,1)';
			color = 'rgba(0,0,0,1)';}
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
				<aa class="back"><a href="home.php" class="button">Back</a></aa>
				<table width="100%" height="15%">
				<tr><td align="center" valign="bottom">
		<?php		echo '<ss class = "font-style-title">'.$ppt_name.'</ss>';
				echo '</td></tr>';
				echo '</table><br><br>';

				$sql = "SELECT * FROM PPT_QUESTION WHERE ppt_id = ? AND page = ?";
				$sth = $db->prepare($sql);
				$sth->execute(array($ppt_id,$page));
				$row = $sth->fetchObject();
				$question = $row->question;
				
				echo '<div align="center" valign="middle">';
				echo '<ss class="font-style-session"><pre>'.$question.'</pre></ss>';
				echo '</div>';

				if($question!=NULL){
					$redo_true = 'true';
					echo '<div align="center" valign="middle">';
					echo '<a href="learn_ppt.php?ppt_name='.$ppt_name.'&page='.$page.'&redo='.$redo_true.'"> <img src="http://140.113.140.27:81/HCI_project/PIC/redo.jpg"></a>';
					echo '</div><br><br>';
					if($redo=='true'){
						//redo
						//show ppt page = $page
						echo '<table width="100%"><tr>';
						if($page!=0) echo '<td width="10%" align="center"><a href="learn_ppt.php?ppt_name='.$ppt_name.'&page='.($page-1).'" class="button">Previous</a></td>';
						else echo '<td width="10%" align="center"></td>';
						echo '<td width="80%" align="center">';
		?>
						<div align="center" width="100%">
							<table width="40%"><tr>
								<td><div class='myblock' style=' 
									background-image:url("http://140.113.140.27:81/HCI_project/PIC/start.jpg"); background-repeat:no-repeat;'
									onmousedown="start()">
								</div></td>
								<td><div class='myblock' style='
									background-image:url("http://140.113.140.27:81/HCI_project/PIC/store.jpg"); background-repeat:no-repeat;'
									onmousedown="store()">
								</div></td>
								<td><div class='myblock' style='background-color:#000000;'
									onmousedown="click_1()">
								</div></td>
								<td><div class='myblock' style='background-color:#0000FF;'
									onmousedown="click_2()">
								</div></td>
								<td><div class='myblock' style='background-color:#00FFFF;'
									onmousedown="click_3()">
								</div></td>
								<td><div class='myblock' style='background-color:#00FF00;'
									onmousedown="click_4()">
								</div></td>
								<td><div class='myblock' style='background-color:#FFFF00;'
									onmousedown="click_5()">
								</div></td>
								<td><div class='myblock' style='background-color:#FF0000;'
									onmousedown="click_6()">
								</div></td>
								<td><div class='myblock' style='background-color:#FF00FF;'
									onmousedown="click_7()">
								</div></td>
								<td><div class='myblock' style='
									background-image:url("http://140.113.140.27:81/HCI_project/PIC/eraser.jpg"); background-repeat:no-repeat;'
									onmousedown="click_8()">
								</div></td>
							</tr></table>
						</div><br><br><br><br>
						<div style="width:<?php echo $size[0];?>px; height:<?php echo $size[1];?>px; border-style: solid; border-width: 1px; 
							background-image:url(<?php echo 'http://140.113.140.27:81/HCI_project/PDF/'.$ppt_name.'/'.$ppt_name.'-'.$page.'.jpg';?>); background-repeat:no-repeat;
							"
							onmousedown="md()" onmousemove="mv()" onmouseup="mup()" onmousewheel="return false">
							<canvas id="m" width="<?php echo $size[0];?>" height="<?php echo $size[1];?>"></canvas>
						</div>
						<div style='position:absolute;top:600px;left:0px'>
						</div>
		<?php
						echo '</td>';
						if(file_exists('./PDF/'.$ppt_name.'/'.$ppt_name.'-'.($page+1).'.jpg')) echo '<td width="10%" align="center"><a href="learn_ppt.php?ppt_name='.$ppt_name.'&page='.($page+1).'" class="button">Next</a></td>';
						else echo '<td width="10%" align="center"></td>';
						echo '</tr>';
					}
					else{
						//not redo check if already answer
						$sql = "SELECT * FROM PPT_MOVE WHERE account_ppt_id = ? AND page = ?";
						$sth = $db->prepare($sql);
						$sth->execute(array($account_ppt_id,$page));
						$row = $sth->fetchObject();
						if($row!=NULL){
							//already answer
							echo '<table width="100%"><tr>';
							if($page!=0) echo '<td width="10%" align="center"><a href="learn_ppt.php?ppt_name='.$ppt_name.'&page='.($page-1).'" class="button">Previous</a></td>';
							else echo '<td width="10%" align="center"></td>';
							echo '<td width="80%" align="center"><img src="http://140.113.140.27:81/HCI_project/PDF/'.$ppt_name.'/'.$account_ppt_id.'/'.$page.'.png" width="80%"></td>';
							if(file_exists('./PDF/'.$ppt_name.'/'.$ppt_name.'-'.($page+1).'.jpg')) echo '<td width="10%" align="center"><a href="learn_ppt.php?ppt_name='.$ppt_name.'&page='.($page+1).'" class="button">Next</a></td>';
							else echo '<td width="10%" align="center"></td>';
							echo '</tr>';
						}
						else{
							//not answer yet
							echo '<table width="100%"><tr>';
							if($page!=0) echo '<td width="10%" align="center"><a href="learn_ppt.php?ppt_name='.$ppt_name.'&page='.($page-1).'" class="button">Previous</a></td>';
							else echo '<td width="10%" align="center"></td>';
							echo '<td width="80%" align="center">';
		?>
							<div align="center" width="100%">
								<table width="40%"><tr>
									<td><div class='myblock' style=' 
										background-image:url("http://140.113.140.27:81/HCI_project/PIC/start.jpg"); background-repeat:no-repeat;'
										onmousedown="start()">
									</div></td>
									<td><div class='myblock' style='
										background-image:url("http://140.113.140.27:81/HCI_project/PIC/store.jpg"); background-repeat:no-repeat;'
										onmousedown="store()">
									</div></td>
									<td><div class='myblock' style='background-color:#000000;'
										onmousedown="click_1()">
									</div></td>
									<td><div class='myblock' style='background-color:#0000FF;'
										onmousedown="click_2()">
									</div></td>
									<td><div class='myblock' style='background-color:#00FFFF;'
										onmousedown="click_3()">
									</div></td>
									<td><div class='myblock' style='background-color:#00FF00;'
										onmousedown="click_4()">
									</div></td>
									<td><div class='myblock' style='background-color:#FFFF00;'
										onmousedown="click_5()">
									</div></td>
									<td><div class='myblock' style='background-color:#FF0000;'
										onmousedown="click_6()">
									</div></td>
									<td><div class='myblock' style='background-color:#FF00FF;'
										onmousedown="click_7()">
									</div></td>
									<td><div class='myblock' style='
										background-image:url("http://140.113.140.27:81/HCI_project/PIC/eraser.jpg"); background-repeat:no-repeat;'
										onmousedown="click_8()">
									</div></td>
								</tr></table>
							</div><br><br><br><br>
							<div style="width:<?php echo $size[0];?>px; height:<?php echo $size[1];?>px; border-style: solid; border-width: 1px; 
								background-image:url(<?php echo 'http://140.113.140.27:81/HCI_project/PDF/'.$ppt_name.'/'.$ppt_name.'-'.$page.'.jpg';?>); background-repeat:no-repeat;
								"
								onmousedown="md()" onmousemove="mv()" onmouseup="mup()" onmousewheel="return false">
								<canvas id="m" width="<?php echo $size[0];?>" height="<?php echo $size[1];?>"></canvas>
							</div>
							<div style='position:absolute;top:600px;left:0px'>
							</div>
		<?php
							echo '</td>';
							if(file_exists('./PDF/'.$ppt_name.'/'.$ppt_name.'-'.($page+1).'.jpg')) echo '<td width="10%" align="center"><a href="learn_ppt.php?ppt_name='.$ppt_name.'&page='.($page+1).'" class="button">Next</a></td>';
							else echo '<td width="10%" align="center"></td>';
							echo '</tr>';
						}
					}
				}
				else{
					echo '<table width="100%"><tr>';
					if($page!=0) echo '<td width="10%" align="center"><a href="learn_ppt.php?ppt_name='.$ppt_name.'&page='.($page-1).'" class="button">Previous</a></td>';
					else echo '<td width="10%" align="center"></td>';
					echo '<td width="80%" align="center"><img src="http://140.113.140.27:81/HCI_project/PDF/'.$ppt_name.'/'.$ppt_name.'-'.$page.'.jpg" width="80%"></td>';
					if(file_exists('./PDF/'.$ppt_name.'/'.$ppt_name.'-'.($page+1).'.jpg')) echo '<td width="10%" align="center"><a href="learn_ppt.php?ppt_name='.$ppt_name.'&page='.($page+1).'" class="button">Next</a></td>';
					else echo '<td width="10%" align="center"></td>';
					echo '</tr>';
				}
			}
		?>
	</body>	
</html>
