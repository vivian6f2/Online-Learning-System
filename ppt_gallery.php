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
			.font-style-session-small {
				font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif;
				color: #629096;
				font-size: 18;
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
	</head>
	<body bgcolor="#E8FBFD">
		<?php
			$ppt_name = $_GET['ppt_name'];
			$ppt_id = $_GET['ppt_id'];
			$page = $_GET['page'];
			
			if($page==NULL){
				//find the first question
				$sql = "SELECT * FROM PPT_QUESTION WHERE ppt_id = ? ORDER BY page";
				$sth = $db->prepare($sql);
				$sth->execute(array($ppt_id));
				$row = $sth->fetchObject();
				$page = $row->page;
				$question = $row->question;
			}
			else{
				//already know which page
				$sql = "SELECT * FROM PPT_QUESTION WHERE ppt_id = ? AND page = ?";
				$sth = $db->prepare($sql);
				$sth->execute(array($ppt_id,$page));
				$row = $sth->fetchObject();
				$question = $row->question;
			}
			/*find previous question and next question*/
			$sql = "SELECT * FROM PPT_QUESTION WHERE ppt_id = ? AND page < ? ORDER BY page  DESC";
			$sth = $db->prepare($sql);
			$sth->execute(array($ppt_id,$page));
			$row = $sth->fetchObject();
			$previous_page = $row->page;
			
			$sql = "SELECT * FROM PPT_QUESTION WHERE ppt_id = ? AND page > ? ORDER BY page";
			$sth = $db->prepare($sql);
			$sth->execute(array($ppt_id,$page));
			$row = $sth->fetchObject();
			$next_page = $row->page;
			
			$account = $_SESSION['account'];
			$id = $_SESSION['id'];
			$authority = $_SESSION['authority'];
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
				echo '</table><br><br><br>';

				$temp_page = $page+1;
				echo '<table width="100%">';
				echo '<tr><td align="center" valign="bottom">';
				echo '<ss class="font-style-session">Question on page '.$temp_page.'</ss>';
				echo '</td></tr>';
				echo '</table><br>';
				echo '<div align="center" valign="middle">';
				echo '<ss class="font-style-session"><pre>'.$question.'</pre></ss>';
				echo '</div><br>';

				//show ppt page = $page
				echo '<table width="100%"><tr>';
				echo '<td width="10%" align="center">';
				if($previous_page!=NULL) echo '<a href="ppt_gallery.php?ppt_name='.$ppt_name.'&ppt_id='.$ppt_id.'&page='.$previous_page.'" class="button">Previous Question</a></td>';
				echo '<td width="80%" align="center">';
				echo '<table><tr>';
				
				//find all the student who want to learn this ppt
				$sql = "SELECT * FROM ACCOUNT_PPT WHERE ppt_id = ? ORDER BY account_id";
				$sth = $db->prepare($sql);
				$sth->execute(array($ppt_id));
				$i = 0;
				
				while($row = $sth->fetchObject()){
					//check if this student has answer the question
					$sql = "SELECT * FROM PPT_MOVE WHERE account_ppt_id = ? AND page = ?";
					$sth_1 = $db->prepare($sql);
					$sth_1->execute(array($row->id,$page));
					$row_1 = $sth_1->fetchObject();
					if($row_1==NULL){
						//not answer
                       				$sql = "SELECT * FROM ACCOUNT WHERE id = ?";
						$sth_2 = $db->prepare($sql);
						$sth_2->execute(array($row->account_id));
						$row_2 = $sth_2->fetchObject();
						echo '<td width="30%" align="center">';
						echo '<ss class="font-style-session">'.$row_2->name.'</ss><br><br>';
                        			echo '<img src="http://140.113.140.27:81/HCI_project/PDF/'.$ppt_name.'/'.$ppt_name.'-'.$page.'.jpg" width="80%">';
						echo '<br><br><br><br><br><br><br><br>';
                        			echo '</td>';
					}
					else{
						//answer!
                        			$sql = "SELECT * FROM ACCOUNT WHERE id = ?";
                        			$sth_2 = $db->prepare($sql);
                       			 	$sth_2->execute(array($row->account_id));
                       				$row_2 = $sth_2->fetchObject();
                        			echo '<td width="30%" align="center">';
                       			 	echo '<ss class="font-style-session">'.$row_2->name.'</ss><br><br>';
                        			echo '<img src="http://140.113.140.27:81/HCI_project/PDF/'.$ppt_name.'/'.$row->id.'/'.$page.'.png" width="80%"><br><br>';
                        			echo '<a href="view_answer.php?ppt_name='.$ppt_name.'&account_ppt_id='.$row->id.'&page='.$page.'" class="button">View</a>&nbsp;&nbsp;';
                        
						$sql = "SELECT * FROM PPT_LIKE WHERE account_ppt_id = ? AND page = ? AND account_id = ?";
						$sth_4 = $db->prepare($sql);
						$sth_4->execute(array($row->id,$page,$id));
						$row_4 = $sth_4->fetchObject();

						if($row_4==NULL) echo '<a href="add_ppt_like_access.php?account_ppt_id='.$row->id.'&page='.$page.'&ppt_name='.$ppt_name.'&ppt_id='.$ppt_id.'" class="button">Like!</a>';
						else echo '<a href="add_ppt_like_access.php?account_ppt_id='.$row->id.'&page='.$page.'&ppt_name='.$ppt_name.'&ppt_id='.$ppt_id.'" class="button">Unlike!</a>';
                       			 	$sql = "SELECT COUNT(*) FROM PPT_LIKE WHERE account_ppt_id = ? AND page = ?";
                       			 	$sth_3 = $db->prepare($sql);
                        			$sth_3->execute(array($row->id,$page));
                        			$row_3 = $sth_3->fetch(PDO::FETCH_NUM);
						echo '<br><br>';
                                                                                                                                                   
                       				echo '<ss class="font-style-session-small">'.$row_3[0].' likes</ss>';

						$sql = "SELECT COUNT(*) FROM PPT_RESPONSE WHERE account_ppt_id = ? AND page = ?";
						$sth_4 = $db->prepare($sql);
						$sth_4->execute(array($row->id,$page));
						$row_4 = $sth_4->fetch(PDO::FETCH_NUM);                        
                       				echo '<ss class="font-style-session-small">'.$row_4[0].' responses</ss>';
						echo '<br><br><br>';
						echo '</td>';
					}
					$i = $i + 1;
					if($i == 3){
						echo '</tr><tr>';
						$i = 0;
					}
				}
				echo '</tr></table>';
				echo '</td>';
				echo '<td width="10%" align="center">';
				if($next_page) echo '<a href="ppt_gallery.php?ppt_name='.$ppt_name.'&ppt_id='.$ppt_id.'&page='.$next_page.'" class="button">Next Question</a>';
				echo '</td></tr></table>';
				
			}
		?>
	</body>	
</html>
