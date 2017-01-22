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
		var d = new Date();
		var time;
		
		var list = [];

		function init(){
			m=document.getElementById("m");
			c=m.getContext("2d");
			start_draw=false;
			c.lineWidth = 3;
		}
		function md(){
			if(start_draw){
				c.moveTo(event.offsetX, event.offsetY);
				draw=true;
				c.beginPath();
				var t = d.getTime()-time;
				
				list.push({ mode: 1, X: event.offsetX, Y: event.offsetY, color: c.strokeStyle, time: t});
				
				//<?php
				//	$sql = "INSERT INTO PPT_MOVE(account_ppt_id,mode,X,Y,color,time) VALUES(?,1,".event.offsetX.",500,'#000000',123)";
				//	$sth = $db->prepare($sql);
				//	$sth->execute(array($account_ppt_id));
				//?>
			}
		}
		function mv(){
			if(draw){
				c.lineTo(event.offsetX,event.offsetY);
				c.stroke();
				var t = d.getTime()-time;
				
			}
		}
		function mup(){
			draw=false;
			c.closePath();
			var t = d.getTime()-time;
						
		}
		function start(){
			start_draw=true;
			time = d.getTime();
		}
		function store(){
			start_draw=false;
			post(<?php echo $account_ppt_id; ?>, list);
		}
		function click_1(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = "rgb(0,0,0)";}
		function click_2(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = "rgb(0,0,255)";}
		function click_3(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = "rgb(0,255,255)";}
		function click_4(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = "rgb(0,255,0)";}
		function click_5(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = "rgb(255,255,0)";}
		function click_6(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = "rgb(255,0,0)";}
		function click_7(){
			c.globalCompositeOperation = 'source-over';
			c.strokeStyle = "rgb(255,0,255)";}
		function click_8(){ 
			c.globalCompositeOperation = 'destination-out';
			c.strokeStyle = 'rgba(0,0,0,1)';}
			
		function post(account_ppt_id, list, method) {
			method = method || "post";
			
			var form = document.createElement("form");
			form.setAttribute("method", method);
			form.setAttribute("action", "http://140.113.140.27:81/HCI_project/post_test.php");
		
			for(var key in list) {
				if(list.hasOwnProperty(key)) {
					var hiddenField = document.createElement("input");
					hiddenField.setAttribute("type", "hidden");
					hiddenField.setAttribute("time", list[key].time);
					hiddenField.setAttribute("X", list[key].X);
					hiddenField.setAttribute("Y", list[key].Y);
					hiddenField.setAttribute("mode", list[key].mode);
					hiddenField.setAttribute("color", list[key].color);
					hiddenField.setAttribute("account_ppt_id", account_ppt_id);
		
					form.appendChild(hiddenField);
				}
			}
		
			document.body.appendChild(form);
			form.submit();
		}
		</script>
	</head>
	<body onload="init()">
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
	
	
	</body>
</html>
