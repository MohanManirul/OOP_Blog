<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
        <div class="grid_10">
         
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                    <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                               
                        $copyright = $fm->validation($_POST['copyright']);
                        $copyright = mysqli_real_escape_string($db->link, $copyright);

                      
                    
                    if($copyright == ""){
                            echo "<span class = 'error'>Field Must Not be Empty !</span>";
                        }else{
                             $query = "UPDATE tbl_copyright
                                            SET
                                            copyright = '$copyright'
                                            WHERE id = '1' ";


                                $updated_row = $db->update($query);
                                if ($updated_row) {
                                 echo "<span class='success'>Copyright updated Successfully.
                                 </span>";
                                }else {
                                 echo "<span class='error'>opyright Not updated !</span>";
                                }
                        }
                    }

                ?>
                <div class="block copyblock"> 
                    <?php 

                        $query = "SELECT* FROM tbl_copyright WHERE id = '1' ";
                        $getCopyright = $db->select($query);
                        if($getCopyright){
                            while($result = $getCopyright->fetch_assoc()){
                    

                         ?>
                 <form action = "" method = "POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['copyright'];?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php }}?>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include 'inc/footer.php'?>