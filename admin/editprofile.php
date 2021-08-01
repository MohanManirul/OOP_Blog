<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    $userid     = Session::get('userId');
    $userrole   = Session::get('userRole');
?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update Profile</h2>
                <!---receiving form data and send into dtabase---->
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                               
                        $name       = $fm->validation($_POST['name']);
                        $role       = $fm->validation($_POST['role']);
                        $username   = $fm->validation($_POST['username']);
                        $email      = $fm->validation($_POST['email']);
                        $details    = $fm->validation($_POST['details']);

                        $name      = mysqli_real_escape_string($db->link, $name);
                        $role      = mysqli_real_escape_string($db->link, $role);
                        $username      = mysqli_real_escape_string($db->link, $username);
                        $email      = mysqli_real_escape_string($db->link, $email);
                        $details      = mysqli_real_escape_string($db->link, $details);
                     
                        
                     

                             $query = "UPDATE tbl_user
                                            SET
                                            name        = '$name',
                                            role        = '$role',
                                            username    = '$username',
                                            email       = '$email',
                                            details     = '$details'
                                            WHERE id = '$userid'";


                                $updated_row = $db->update($query);
                                if ($updated_row) {
                                 echo "<span class='success'>User Profile updated Successfully.
                                 </span>";
                                }else {
                                 echo "<span class='error'>User Profile Not updated !</span>";
                                }
                        }
                
                ?>



                <div class="block"> 
                <?php
                 $query = "SELECT * FROM tbl_user WHERE id = '$userid' AND role ='$userrole'  ";
                 $getuser = $db->select($query);
                 if($getuser){
                    while ($result = $getuser->fetch_assoc()) {
               


                ?>              
                 <form action="" method="POST">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name = 'name' value = "<?php echo $result['name'];?>"class="medium" />
                            </td>
                        </tr>

                          <tr>
                            <td>
                                <label>Role</label>
                            </td>
                            <td>
                                <input type="text" readonly="readonly" name = 'role' value = "<?php
                                if($result['role']== '0'){
                                        echo "Super Admin";
                                    }elseif ($result['role']== '1') {
                                        echo "Admin";
                                    }elseif ($result['role']== '2') {
                                        echo "Manager (Package)";
                                    }elseif ($result['role']== '3') {
                                        echo "Sales Executive (Package)";
                                    }?>"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input type="text" name = 'username' value = "<?php echo $result['username'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name = 'email' value = "<?php echo $result['email'];?>"class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name ='details'>
                                    <?php echo $result['details'];?>

                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
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


