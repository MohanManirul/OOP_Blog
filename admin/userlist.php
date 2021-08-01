
<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>

<?php
    
    if(!Session::get('userRole') == '0'){
      echo "<script>window.location = 'index.php';</script>";
 }?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <?php
                	if(isset($_GET['delid'])){
                			$delid = $_GET['delid'];
                			$delquery = "DELETE FROM tbl_user WHERE id = '$delid' ";
                			$delcat = $db->delete($delquery);

                			 if($delcat){
                                        echo "<span class = 'success'>User Deleted Successfully !!</span>";
                                    }else{
                                        echo "<span class = 'error'>User Not Deleted !!</span>";
                                    }
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Role</th>
							<th>Email</th>
							<th>Details</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query = "SELECT* FROM tbl_user order by role asc";
							$category = $db->select($query);
							if($category){
								$i=0;
								while($result = $category->fetch_assoc()){
								$i++;
									?>
								
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['username'];?></td>
							<td>
								<?php
								if($result['role']== '0'){
										echo "Super Admin";
									}elseif ($result['role']== '1') {
										echo "Admin";
									}elseif ($result['role']== '2') {
										echo "Manager (Package)";
									}elseif ($result['role']== '3') {
										echo "Sales Executive (Package)";
									}?>
							</td>
							<td><?php echo $result['email'];?></td>
							<td><?php echo $result['details'];?></td>

							<td>
								<a href="viewprofile.php?userid=<?php echo $result['id'];?>">View</a> ||
							 	<a onclick = "return confirm('Are You Sure To Delete !!')" href=?delid=<?php echo $result['id'];?>">Delete</a>

							</td>
								}
						</tr> 
					<?php }}?>
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