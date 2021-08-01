
<?php include "inc/header.php";?>

<?php 
	$postid  = mysqli_real_escape_string($db->link, $_GET['id']);
	if(!isset($postid) || $postid == NULL ){
		header("Location:404.php");
	}else{
		$id = $_GET['id'];
	}

?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php 

					$query = "SELECT * FROM tbl_post WHERE id ='$id' ";
					$post_details = $db->select($query);
					if($post_details){
						while($result = $post_details->fetch_assoc()){

				?>
				<h2><?php echo $result['title'];?></h2>
				<h4><?php echo $fm->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
				<img src="admin/<?php echo $result['image'];?>" alt="MyImage"/>
				<p><?php echo $result['body'];?></p>
			
				
				<div class="relatedpost clear">
					<h2>Related Post</h2>
					<?php 
						$catid = $result['cat'];

					$related_query = "SELECT * FROM tbl_post WHERE cat ='$catid' ORDER BY rand()  limit 6 ";
					$related_post_details = $db->select($related_query);
					if($related_post_details){
						while($rresult = $related_post_details->fetch_assoc()){

				?>
				
				<a href="post.php?id=<?php echo $rresult['id'];?>"><h6><a href="post.php?id=<?php echo $rresult['id'];?>"><?php echo $rresult['title'];?></a></h6><p>price 20000tk</p><img src="admin/<?php echo $rresult['image'];?>" alt="post image"/></a>
				
				<?php }}else{echo " No Related Post Available";}?>
				</div>

				<?php }}else{header("Location:404.php");}?>
			</div>

		</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>