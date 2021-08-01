
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
    if (!isset($_GET['delsliderid'])  || $_GET['delsliderid']  == NULL) {
        echo "<script>window.location = 'sliderlist.php';</script>";
        //header("Location:catlist.php");
    }else{
        $delsliderid = $_GET['delsliderid'];

        $query = "SELECT* FROM tbl_slider WHERE id = '$delsliderid' ";
    	$getSlider = $db->select($query);
    	if($getSlider){
    		while($delimg = $getSlider->fetch_assoc()){
    				$dellink = $delimg['image'];
    				unlink ($dellink);
    		}
    	}
    	$delquery = "DELETE from tbl_slider where id = '$delsliderid' ";
    	$delSlider = $db->delete($delquery);
    	if($delSlider){
    		echo "<script>alert('Slider Deleted Successfully...')</script>";
    		echo "<script>window.location = 'sliderlist.php';</script>";

    	}else{
    		echo "<script>alert('Slider Not Deleted')</script>";
    		echo "<script>window.location = 'sliderlist.php';</script>";
    	}
    }
?>

