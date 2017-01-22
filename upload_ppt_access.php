<?php
	session_save_path("./session");
	session_start();
?>
<?php
	require_once("connect.php");
	$db->exec('SET CHARACTER SET utf8');
	$db->query("SET NAMES utf8");
?>
<?php
	$account = $_SESSION['account'];
	$id = $_SESSION['id'];
	$authority = $_SESSION['authority'];
	/*get ppt data*/
	$filename=$_FILES['ppt']['name'];
	$tmpname=$_FILES['ppt']['tmp_name'];
	$filetype=$_FILES['ppt']['type'];
	$filesize=$_FILES['ppt']['size'];    
	
	$space = ' ';
	$pos = strpos($filename, $space);
	
	if($pos === false){
	
		$temp=explode(".",$filename);
		$usename = $temp[0];
		/*create file*/
		if(is_dir("./PDF/".$usename."")){
			//pdf already exist
			echo '<script> confirm("This PPT already exist, please change a name!"); </script>';
			echo '<meta http-equiv="refresh" content="0;url=upload_ppt.php"/>'; 
		}
		else{
			//pdf is not exist
			system("mkdir ./PDF/".$usename);
			system("chmod 777 ./PDF/".$usename);
	
			$uploaddir = './PDF/'.$usename.'/';
			$uploadfile = $uploaddir.basename($filename);
			$pdf_format = 'application/pdf';
			if($filetype!=$pdf_format&&$tmpname!=NULL){
				echo '<script> confirm("Please upload in pdf form!"); </script>';
				echo '<meta http-equiv="refresh" content="0;url=upload_ppt.php"/>'; 
			}
			else{
				if($tmpname!=NULL){
					if(move_uploaded_file($tmpname, $uploadfile)){ //iconv("utf-8","big5",$uploadfile))){
							system("chmod 777 ./PDF/".$usename."/".$filename);
							$sql = "INSERT INTO PPT(id, name, teacher_id, author) VALUES (NULL, ?, ?, 0)";
							$sth=$db->prepare($sql);
							if($sth->execute(array($usename,$id))===TRUE){
								/*conver into jpg*/
								system("convert /var/www/html/HCI_project/PDF/".$usename."/".$filename." /var/www/html/HCI_project/PDF/".$usename."/".$usename.".jpg");
								system("chmod 777 ./PDF/".$usename."/*.jpg");
								
								echo '<script> confirm("Upload succeed!"); </script>';
								echo '<meta http-equiv="refresh" content="0;url=home.php" />';
							}
							else{
								echo '<script> confirm("Upload failed!1"); </script>';
								echo '<meta http-equiv="refresh" content="0;url=home.php"/>'; 
							} 
						
					}
					else{
						echo '<script> confirm("Upload failed!2"); </script>';
						echo '<meta http-equiv="refresh" content="0;url=upload_ppt.php"/>'; 
					} 
				}
				else{
					echo '<script> confirm("Upload failed!(tmpname==NULL)"); </script>';
					echo '<meta http-equiv="refresh" content="0;url=upload_ppt.php"/>'; 
				} 
			}
		}
	}
	else{
		echo '<script> confirm("You cannot have space in your pdf name!"); </script>';
		echo '<meta http-equiv="refresh" content="0;url=upload_ppt.php"/>';
		
	}
?>
