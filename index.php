

<?php include "inc/header.php";?>
<?php include "inc/slider.php";?>	


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<!----pagination ----->
			<?php
				$per_page = 6;
				if(isset($_GET['page'])){
					$page = $_GET['page'];
				}else{
					$page = 1; 
				}
				$start_from = ($page-1) * $per_page;
			?>
			<!----pagination ----->
			<div class="samepost clear">

				<?php 
				$query = "SELECT * FROM tbl_post ORDER BY id DESC limit $start_from , $per_page";
				$post  = $db->select($query);
				if($post){

					while ($result = $post->fetch_assoc()){?>

			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
				 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
				<p><?php echo $fm->textShorten($result['body']);?></p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>
			</div>
		
	<?php }?>
	<!-----pagination ------>
	<?php
	$query = "SELECT* FROM tbl_post";
	$result = $db->select($query);
	$total_row = mysqli_num_rows($result);
	$total_pages = ceil($total_row/$per_page);


	 echo "<span class = 'pagination' ><a href = 'index.php?page=1'>".'First Page'."</a>";

	 	for($i = 1; $i<=$total_pages; $i++){
	 		echo "<a href = 'index.php?page=".$i."'>".$i."</a>";
	 	}
	 echo "<a href = 'index.php?page=$total_pages'>".'Last Page'."</a></span>"?>

	<!-----pagination ------>
<?php } else{header("Location:404.php");}?>
	</div>
</div>

<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>

<style>
/*----pagination ----*/
.pagination{ display: block; font-size: 20px; margin-top: 10px; text-align: center;padding: 10px;  }
.pagination a{
	background: #e6af4b none scroll 0 0;
	border: 1px solid #a7700c;
	border-radius: 3px;
	color :#333;
	margin-left: 2px;
	padding: 2px 10px;
	text-decoration: none;
}
.pagination a:hover{
	background: #be8723 none repeat scroll 0 0 ;
	color:#fff;
}
</style>