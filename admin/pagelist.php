
<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
 				

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Page List</h2>
                <?php
                	if(isset($_GET['delpageid'])){
                			$delpageid = $_GET['delpageid'];
                			$delquery = "DELETE FROM tbl_pages WHERE id = '$delpageid' ";
                			$delpage = $db->delete($delquery);

                			 if($delpage){
                                        echo "<span class = 'success'>Page Deleted Successfully !!</span>";
                                    }else{
                                        echo "<span class = 'error'>Page Not Deleted !!</span>";
                                    }
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Title</th>
							<th>Body</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query = "SELECT* FROM tbl_pages order by id desc";
							$category = $db->select($query);
							if($category){
								$i=0;
								while($result = $category->fetch_assoc()){
								$i++;
									?>
								
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['title'];?></td>
							<td><?php echo $fm->textShorten($result['body'],100);?></td>
							<td>
								<a href="viewpaget.php?viewpageid=<?php echo $result['id'];?>">View</a> ||
								<a href="editpage.php?editpageid=<?php echo $result['id'];?>">Edit</a> ||
							 	<a onclick = "return confirm('Are You Sure To Delete !!')" href=?delpageid=<?php echo $result['id'];?>">Delete</a>

							</td>
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