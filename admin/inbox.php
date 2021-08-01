<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox
                		  <?php 
                            $query = "SELECT* FROM sell_package  WHERE status = '0' order by id desc";
                            $totalPackage = $db->select($query);
                            if($totalPackage){
                                $count = mysqli_num_rows($totalPackage);
                                echo "(".$count.")";
                         }else{
                            echo "( 0 )";
                         }?>
                </h2>


  <?php 
	if(isset($_GET['seenid'])){
		$seenid = $_GET['seenid'];
		 	$query = "UPDATE sell_package
              SET 
              	status = '1'
              WHERE  id = '$seenid'
            ";
            $catinsert = $db->update($query);
              if($catinsert){echo "<span class = 'success'>Message Sent in The Seen Box !!</span>";
                 }else{ echo "<span class = 'error'>Something Wrong!!</span>"; }
		}?>




  <!---package query --->         
 <?php 
	if(isset($_GET['querysellid'])){
		$querysellid = $_GET['querysellid'];
		 	$query = "UPDATE query_package
              SET 
              	status = '1'
              WHERE  id = '$querysellid'
            ";
            $catinsert = $db->update($query);
              if($catinsert){echo "<span class = 'success'>Message SentTo Admin Approval. Please Wait!!</span>";
                 }else{ echo "<span class = 'error'>Something Wrong!!</span>"; }
		}?>  




            <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width = "5%">Serial No.</th>
							<th width = "15%">Name</th>
							<th width = "10%">Mobile</th>
							<th width = "10%">Country</th>
							<th width = "25%">Package</th>
							<th width = "20%">Date</th>
							<th width = "25%">Action</th>
						</tr>
					</thead>

					<tbody>
						<?php 
							$query = "SELECT* FROM sell_package  WHERE status = '0' order by id desc";
							$getPackage = $db->select($query);
							if($getPackage){
								$i=0;
								while($result = $getPackage->fetch_assoc()){
								$i++;
									?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['fname']." ". $result['lname'];?></td>
							<th><?php echo $result['mobile'];?></th>
							<th><?php echo $result['cat'];?></th>
							<th><?php echo $fm->textShorten($result['pacdetails'],50);?></th>
							<th><?php echo $fm->formatDate($result['date']);?></th>
							<td>
								<a href="viewmsg.php?vmsgid=<?php echo $result['id'];?>">View</a> ||
								<a href="rplymsg.php?rplymsgid=<?php echo $result['id'];?>">Reply</a> ||
							 	<a  onclick = "return confirm('Are You Sure To Move This Message into Inbox !!')" href="?seenid=<?php echo $result['id'];?>">Seen</a>
							 </td>
						</tr>
					<?php }}?>
					</tbody>
				</table>
               </div>
            </div>
        </div>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sell Package
                	<?php 
                            $query = "SELECT* FROM sell_package  WHERE status = '1' order by id desc";
                            $totalPackage = $db->select($query);
                            if($totalPackage){
                                $count = mysqli_num_rows($totalPackage);
                                echo "(".$count.")";
                         }else{
                            echo "( 0 )";
                         }?>
                </h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width = "5%">Serial No.</th>
							<th width = "15%">Name</th>
							<th width = "10%">Mobile</th>
							<th width = "10%">Country</th>
							<th width = "25%">Package</th>
							<th width = "20%">Date</th>
							<th width = "25%">Action</th>
						</tr>
					</thead>
						<tbody>
						<?php 
							$query = "SELECT* FROM sell_package WHERE status = '1'  order by id desc";
							$getPackage = $db->select($query);
							if($getPackage){
								$i=0;
								while($result = $getPackage->fetch_assoc()){
								$i++;
									?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['fname']." ". $result['lname'];?></td>
							<th><?php echo $result['mobile'];?></th>
							<th><?php echo $result['cat'];?></th>
							<th><?php echo $fm->textShorten($result['pacdetails'],50);?></th>
							<th><?php echo $fm->formatDate($result['date']);?></th>
							<td>
								<a href="viewmsg.php?vmsgid=<?php echo $result['id'];?>">View</a>
							 </td>
						</tr>
					<?php }}?>
					</tbody>
				</table>
               </div>
            </div>
        </div>


<div class="grid_10">
            <div class="box round first grid">
                <h2>Query Package
                	<?php 
                            $query = "SELECT* FROM query_package  WHERE status = '3' order by id desc";
                            $totalPackage = $db->select($query);
                            if($totalPackage){
                                $count = mysqli_num_rows($totalPackage);
                                echo "(".$count.")";
                         }else{
                            echo "( 0 )";
                         }?>

                </h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width = "5%">Serial No.</th>
							<th width = "15%">Name</th>
							<th width = "10%">Mobile</th>
							<th width = "10%">Country</th>
							<th width = "20%">Package</th>
							<th width = "20%">Date</th>
							<th width = "30%">Action</th>
						</tr>
					</thead>
						<tbody>
						<?php 
							$query = "SELECT* FROM query_package WHERE status = '3'  order by id desc";
							$getPackage = $db->select($query);
							if($getPackage){
								$i=0;
								while($result = $getPackage->fetch_assoc()){
								$i++;
									?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['fname']." ". $result['lname'];?></td>
							<th><?php echo $result['mobile'];?></th>
							<th><?php echo $result['cat'];?></th>
							<th><?php echo $fm->textShorten($result['pacdetails'],50);?></th>
							<th><?php echo $fm->formatDate($result['date']);?></th>
							<td>
								
								<a href="viewquery.php?vqueid=<?php echo $result['id'];?>">View</a> ||
								
							 	<a  onclick = "return confirm('Are You Sure To Move This Message to Admin Inbox !!')" href="?querysellid=<?php echo $result['id'];?>">Process to Sell</a>

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