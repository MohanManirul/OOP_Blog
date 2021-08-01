<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">Sl</th>
							<th width="50%">Slider Title</th>
							<th width="10%">Slider Image</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query 	= "SELECT * FROM tbl_slider";
							$slider 	= $db->select($query);
							if($slider){
								$i = 0;
								while($result = $slider->fetch_assoc()){
									$i++;
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><a  href="editslider.php?sliderid=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></td>
							<td><img src = "<?php echo $result['image'];?>" height ="50px"; width = "100px"></td>
							<td>
								<?php if(Session::get('userRole') == '0'){?>
							<a href="editslider.php?sliderid=<?php echo $result['id']; ?>">Edit</a>

						|| 

						<a onclick = "return confirm('Are You Sure Delete !')" href="delslider.php?delsliderid=<?php echo $result['id']; ?>">Delete</a>

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