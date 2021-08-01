<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<?php 
    if(!isset($_GET['userid']) || $_GET['userid'] == NULL){
        echo "<script>window.location = 'userlist.php';</script>";
        //header ("Location:catlist.php");

    }else{
         $userid = $_GET['userid'];
    }
?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>View Message</h2>
                         <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                         echo "<script>window.location = 'userlist.php';</script>";
                    }?>
                <div class="block"> 
                <?php 

                $query = "SELECT * FROM tbl_user WHERE id = '$userid' ";
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
                                <input type="text" readonly value = "<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Role</label>
                            </td>
                            <td>
                                <input type="text" readonly value = "<?php
                                if($result['role']== '0'){
                                        echo "Super Admin";
                                    }elseif ($result['role']== '1') {
                                        echo "Admin";
                                    }elseif ($result['role']== '2') {
                                        echo "Manager (Package)";
                                    }elseif ($result['role']== '3') {
                                        echo "Sales Executive (Package)";
                                    }?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input type="email" readonly  value = "<?php echo $result['username'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" readonly value = "<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce"><?php echo $result['details'];?></textarea>
                            </td>
                       </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
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

