

<?php include "inc/header.php";?>

<?php
		$title  = mysqli_real_escape_string($db->link, $_GET['pageviewid']);
    if (!isset($title)  || $title  == NULL) {
        echo "<script>window.location = 'index.php';</script>";
        //header("Location:catlist.php");
    }else{
        $pageviewid = $_GET['pageviewid'];
    }
?>
	
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

			
			<div class="about">
				<?php 
					$query = "SELECT* FROM tbl_pages WHERE id = '$pageviewid' ";
					$getPagedata = $db->select($query);
					if($getPagedata){
						while($result = $getPagedata->fetch_assoc()){

				?>
				
				<h2><?php echo $result['title'];?></h2>
				<p><?php echo $result['body'];?></p>
			
			
			</div>


		</div>
<?php }}else { header("Location :404.php");}?>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>