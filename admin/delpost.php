
<?php
    include '../lib/session.php';
    Session::checkSession();

?>
<?php include "../lib/Database.php";?>
<?php include "../helpers/format.php";?>
<?php include "../config/config.php";?>

<?php
    $db = new Database();
?>

<?php
    if (!isset($_GET['delpostid'])  || $_GET['delpostid']  == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
        //header("Location:catlist.php");
    }else{
        $delpostid = $_GET['delpostid'];

        $query = "SELECT* FROM tbl_post WHERE id = '$delpostid' ";
    	$getData = $db->select($query);
    	if($getData){
    		while($delimg = $getData->fetch_assoc()){
    				$dellink = $delimg['image'];
    				unlink ($dellink);
    		}
    	}
    	$delquery = "DELETE from tbl_post where id = '$delpostid' ";
    	$delData = $db->delete($delquery);
    	if($delData){
    		echo "<script>alert('Data Deleted Successfully...')</script>";
    		echo "<script>window.location = 'postlist.php';</script>";

    	}else{
    		echo "<script>alert('Data Not Deleted')</script>";
    		echo "<script>window.location = 'postlist.php';</script>";
    	}
    }
?>

