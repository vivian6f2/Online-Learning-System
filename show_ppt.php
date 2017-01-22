<?php 
	//session_save_path("./session");
	//session_start(); 
?>
<?php
	//require_once("connect.php");
	//$db->exec('SET CHARACTER SET utf8');
	//$db->query("SET NAMES utf8");
	//header("Content-Type:text/html; charset=utf-8");
?>
<?php
	//system("ls");
	//converts ppt to pdf
	//system("libreoffice --headless --convert-to pdf /var/www/html/HCI_project/PDF/CaoBei.pptx");
	//system('/usr/bin/openoffice.org -f pdf /var/www/html/HCI_project/PDF/CaoBei.pptx --outdir /var/www/html/HCI_project/PDF');
	//create a file
	system("mkdir ./PDF/CaoBei");
	system("chmod 777 ./PDF/CaoBei");
	//convert pdf to jpg
	system("convert /var/www/html/HCI_project/PDF/CaoBei.pdf /var/www/html/HCI_project/PDF/CaoBei/CaoBei.jpg");
	system("chmod 777 ./PDF/CaoBei/*.jpg");
	//print 'done';
?>
