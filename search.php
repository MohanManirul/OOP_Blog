
<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>
 <!-----receiving id from sidebar page-------->
	<?php
		if(!isset($_POST['search']) || $_POST['search'] == NULL ){
		header("Location:index.php");
	}else{
		$search = $_POST['search'];

	} 
	?>
<!-----receiving id from sidebar page-------->


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
				<!-- query for post , read  data from table tbl_post------>

				<?php  
					$query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
					$post = $db->select($query);
					if($post){
							while($result = $post->fetch_assoc()){

				?>
				<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
				 <a href="#"><img src="admin/upload/<?php echo $result['image'];?>" alt="post image"/></a>
				<p><?php echo $fm->textShorten($result['body']);?></p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>
			</div><?php } }else{
					?><p>Your Search Query Not Found !!..Please Search Again With Related Keywords</p><?php
			}?>


		</div>

<?php include "inc/sidebar.php";?>

<?php include "inc/footer.php";?>