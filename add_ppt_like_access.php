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
<?php
    $account = $_SESSION['account'];
    $id = $_SESSION['id'];
    $authority = $_SESSION['authority'];
    
    $account_ppt_id=$_GET['account_ppt_id'];
    $page=$_GET['page'];
    $ppt_name=$_GET['ppt_name'];
    $ppt_id=$_GET['ppt_id'];
    /*check if ppt_likes exist*/
    $sql = "SELECT * FROM PPT_LIKE WHERE account_ppt_id = ? AND page = ? AND account_id = ?";
    $sth = $db->prepare($sql);
    $sth->execute(array($account_ppt_id,$page,$id));
    $row = $sth->fetchObject();
    if($row!=NULL){
        /*delete like*/
        $sql = "DELETE FROM PPT_LIKE WHERE account_ppt_id = ? AND page = ? AND account_id = ?";
        $sth = $db->prepare($sql);
        if($sth->execute(array($account_ppt_id,$page,$id))===TRUE){
            //echo '<script> confirm("Unlike!"); </script>';
            echo '<meta http-equiv="refresh" content="0;url=ppt_gallery.php?ppt_name='.$ppt_name.'&ppt_id='.$ppt_id.'&page='.$page.'"/>';
        }
        else{
            echo '<script> confirm("Unlike Failed!"); </script>';
            echo '<meta http-equiv="refresh" content="0;url=ppt_gallery.php?ppt_name='.$ppt_name.'&ppt_id='.$ppt_id.'&page='.$page.'"/>';
        }
    }
    else{
        /*insert into ppt_likes*/
        $sql = "INSERT INTO PPT_LIKE (id, account_ppt_id, page, account_id)
                VALUES (NULL, ?, ?, ?) ON DUPLICATE KEY UPDATE id=id";
        $sth = $db->prepare($sql);
        if($sth->execute(array($account_ppt_id,$page,$id))===TRUE){
            echo '<meta http-equiv="refresh" content="0;url=ppt_gallery.php?ppt_name='.$ppt_name.'&ppt_id='.$ppt_id.'&page='.$page.'"/>';
        }
        else{
            echo '<script> confirm("Like Failed!"); </script>';
            echo '<meta http-equiv="refresh" content="0;url=ppt_gallery.php?ppt_name='.$ppt_name.'&ppt_id='.$ppt_id.'&page='.$page.'"/>';
        }
    }
?>
