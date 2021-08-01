<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Package List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="2%">Sl</th>
							<th width="10%">Title</th>
							<th width="5%">Country</th>
							<th width="30%">Package</th>
							<th width="10%">Image</th>
							<th width="15%">Author</th>
							<th width="2%">UserId</th>
							<th width="10%">Tags</th>
							<th width="18%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query 	= "SELECT  tbl_post.*, tbl_category.name FROM tbl_post
										INNER JOIN tbl_category
										ON tbl_post.cat = tbl_category.id
										ORDER BY tbl_post.title DESC ";
							$post 	= $db->select($query);
							if($post){
								$i = 0;
								while($result = $post->fetch_assoc()){
									$i++;
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><a  href="editpost.php?editpostid=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></td>
							<td><?php echo $result['name'];?></td>
							<td><?php echo $fm->textShorten($result['body'],100);?></td>
							<td><img src = "<?php echo $result['image'];?>" height ="50px"; width = "100px"></td>
							<td><?php echo $result['author'];?></td>
							<td><?php echo $result['userid'];?></td>
							<td><?php echo $fm->textShorten($result['tags'],20);?></td>
							<td>
								<a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">view</a>

						|| <?php if(Session::get('userId') == $result['userid'] ||   Session::get('userRole') == '0'){?>
							<a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a>

						|| 

						<a onclick = "return confirm('Are You Sure Delete !')" href="delpost.php?deletepostid=<?php echo $result['id']; ?>">Delete</a>

								 	<?php
								 }?>
							

								</td>
						</tr>
					<?php }} ?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
<?php include 'inc/footer.php'?>