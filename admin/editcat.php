<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php'?>

<?php 
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
        echo "<script>window.location = 'catlist.php';</script>";
        //header ("Location:catlist.php");

    }else{
         $catid = $_GET['catid'];
    }
?>


        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Add New Country</h2>
               <div class="block copyblock"> 
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                            $name = $fm->validation($_POST['name']);
                            $name = mysqli_real_escape_string($db->link, $name);
                                if(empty($name)){
                                        echo "<span class = 'error'>Field Must not be Empty !</span>";
                                }else{
                                    $query = "UPDATE tbl_category
                                                SET 
                                                name = '$name'
                                                WHERE 
                                                id = '$catid'
                                    ";
                                    $catinsert = $db->update($query);
                                    if($catinsert){
                                        echo "<span class = 'success'>Country Updated Successfully !!</span>";
                                    }else{
                                        echo "<span class = 'error'>Country Not Updated !!</span>";
                                    }

                                }
                    }

                ?>
            <?php 

                $query = "SELECT * FROM tbl_category WHERE id = '$catid' ";
                $category = $db->select($query);
                    while($result = $category->fetch_assoc()){
            ?>
                 <form action = "" method ="POST">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" name = "name" value = "<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

                <?php }?>
                </div>
            </div>
        </div>
       

<?php include 'inc/footer.php'?>