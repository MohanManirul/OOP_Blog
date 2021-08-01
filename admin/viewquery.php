<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<?php 
    if(!isset($_GET['vqueid']) || $_GET['vqueid'] == NULL){
        echo "<script>window.location = 'inbox.php';</script>";
        //header ("Location:catlist.php");

    }else{
         $vqueid = $_GET['vqueid'];
    }
?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>View Message</h2>
                         <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                         echo "<script>window.location = 'inbox.php';</script>";
                    }?>
                <div class="block"> 
                <?php 

                $query = "SELECT * FROM query_package WHERE id = '$vqueid' ";
                $category = $db->select($query);
                    while($result = $category->fetch_assoc()){
            ?>              
                 <form action="" method="POST">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text"  value = "<?php echo $result['fname']. " " .$result['lname'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Mobile</label>
                            </td>
                            <td>
                                <input type="text"  value = "<?php echo $result['mobile'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email"   value = "<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Package Title</label>
                            </td>
                            <td>
                                <input type="text"  value = "<?php echo $result['ptitle'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>

                            <td>
                                <input type="text"  value = "<?php echo $result['cat'];?>"medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Package Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce"><?php echo $result['pacdetails'];?></textarea>
                            </td>
                       </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text"  value = "<?php echo $result['author'];?>"medium" />
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label>Reference</label>
                            </td>
                            <td>
                                <input type="text"  value = "<?php echo $result['ref'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>My omments</label>
                            </td>
                            <td>
                                <textarea class="tinymce"><?php echo $result['mycomm'];?></textarea>
                            </td>
                       </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Query" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php }?>
                </div>
            </div>
        </div>

          <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>


<?php include 'inc/footer.php'?>

