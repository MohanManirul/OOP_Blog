				<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Countries (143)</h2>
					<?php 
					$query = "SELECT * FROM tbl_category";
					$Category = $db->select($query);
					if($Category){
							while($result = $Category->fetch_assoc()){

				?>
					<ul>
						<li><a href="posts.php?category=<?php echo $result['id'];?>"><?php echo $result['name'];?> ( 4 )</a></li>  
					<?php } }else{
						?><li>No country Created</li> <?php
					
					}?>

					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest Packages</h2>
				<?php 

					$query = "SELECT * FROM tbl_post limit 0,5 ";
					$post_details = $db->select($query);
					if($post_details){
						while($result = $post_details->fetch_assoc()){

				?>
					<div class="popular clear">
						<h4><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h4>
						<a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
						<p><?php echo $fm->textShorten($result['body'],100);?></p>	
					</div>
					<?php }} else{header("Location:404.php");}?>
			</div>
			
		</div>