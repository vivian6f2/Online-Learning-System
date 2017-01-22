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
	$size = getimagesize("http://140.113.140.27:81/HCI_project/PDF/".$ppt_name."/".$ppt_name."-".$page.".jpg");

	//$account = $_SESSION['account'];
	$id = 1;
	//$authority = $_SESSION['authority'];
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
		<title>Project</title>
		<style>
		.myblock {background-color:#FF00FF;height:50px;width:50px; }
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
		var color = 'rgb(0,0,0)';
		//var pluginArrayArg = [];
		//var jsonArg = {};
		//var jsonArg1 = {};
		
		function init(account_ppt_id){
			m=document.getElementById("m");
			c=m.getContext("2d");
			start_draw=false;
			c.lineWidth = 3;
			id = account_ppt_id;
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
		}
		function start(){
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
			
			xmlhttp.open("POST", "test_image.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("img="+img);
		}
		function click_1(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = 'rgb(0,0,0)';
			color = 'rgb(0,0,0)';}
		function click_2(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = 'rgb(0,0,255)';
			color = 'rgb(0,0,255)';}
		function click_3(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = 'rgb(0,255,255)';
			color = 'rgb(0,255,255)';}
		function click_4(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = 'rgb(0,255,0)';
			color = 'rgb(0,255,0)';}
		function click_5(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = 'rgb(255,255,0)';
			color = 'rgb(255,255,0)';}
		function click_6(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = 'rgb(255,0,0)';
			color = 'rgb(255,0,0)';}
		function click_7(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = 'rgb(255,0,255)';
			color = 'rgb(255,0,255)';}
		function click_8(){ 
			c.globalCompositeOperation = 'destination-out';
			c.strokeStyle = 'rgba(0,0,0,1)';
			color = 'rgba(0,0,0, 1)';}
		</script>
	</head>
	<body onload="init(<?php echo $account_ppt_id; ?>)">
		<div class='myblock' style='position:absolute;top:0px;left:0px; 
			background-image:url("http://140.113.140.27:81/HCI_project/PIC/start.jpg"); background-repeat:no-repeat;'
			onmousedown="start()">
		</div>
		<div class='myblock' style='position:absolute;top:0px;left:50px; 
			background-image:url("http://140.113.140.27:81/HCI_project/PIC/store.jpg"); background-repeat:no-repeat;'
			onmousedown="store()">
		</div>
		<div class='myblock' style='position:absolute;top:0px;left:100px; background-color:#000000;'
			onmousedown="click_1()">
		</div>
		<div class='myblock' style='position:absolute;top:0px;left:150px; background-color:#0000FF;'
			onmousedown="click_2()">
		</div>
		<div class='myblock' style='position:absolute;top:0px;left:200px; background-color:#00FFFF;'
			onmousedown="click_3()">
		</div>
		<div class='myblock' style='position:absolute;top:0px;left:250px; background-color:#00FF00;'
			onmousedown="click_4()">
		</div>
		<div class='myblock' style='position:absolute;top:0px;left:300px; background-color:#FFFF00;'
			onmousedown="click_5()">
		</div>
		<div class='myblock' style='position:absolute;top:0px;left:350px; background-color:#FF0000;'
			onmousedown="click_6()">
		</div>
		<div class='myblock' style='position:absolute;top:0px;left:400px; background-color:#FF00FF;'
			onmousedown="click_7()">
		</div>
		<div class='myblock' style='position:absolute;top:0px;left:450px; 
			background-image:url("http://140.113.140.27:81/HCI_project/PIC/eraser.jpg"); background-repeat:no-repeat;'
			onmousedown="click_8()">
		</div>
		<div style="width:<?php echo $size[0];?>px; height:<?php echo $size[1];?>px; border-style: solid; border-width: 1px; 
			background-image:url(<?php echo 'http://140.113.140.27:81/HCI_project/PDF/'.$ppt_name.'/'.$ppt_name.'-'.$page.'.jpg';?>); background-repeat:no-repeat;
			position:absolute; top:50px; left:0px;"
			onmousedown="md()" onmousemove="mv()" onmouseup="mup()">
			<canvas id="m" width=<?php echo $size[0];?> height=<?php echo $size[1];?>></canvas>
		</div>
		<div style='position:absolute;top:600px;left:0px'>
		<p>State: <span id="txtHint"></span></p>
		</div>
	</body>
</html>
