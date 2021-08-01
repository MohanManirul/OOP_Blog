<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php'?>
        <div class="grid_10">
        <?php
        if(!Session::get('userRole') == '0'){
            echo "<script>window.location = 'index.php';</script>";
        }
        ?>
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                            $name   = $fm->validation($_POST['name']);
                            $username   = $fm->validation($_POST['username']);
                            $password   = $fm->validation(md5($_POST['password']));
                            $email      = $fm->validation($_POST['email']);
                            $details      = $fm->validation($_POST['details']);
                            $role       = $fm->validation($_POST['role']);

                            $name   = mysqli_real_escape_string($db->link, $name);
                            $username   = mysqli_real_escape_string($db->link, $username);
                            $password   = mysqli_real_escape_string($db->link, $password);
                            $email      = mysqli_real_escape_string($db->link, $email);
                            $details      = mysqli_real_escape_string($db->link, $details);
                            $role       = mysqli_real_escape_string($db->link, $role);

                                if(empty($username)||empty($password)||empty($email)||empty($role)){
                                        echo "<span class = 'error'>Field Must not be Empty !</span>";
                                }else{
                                    $mailquery = "SELECT* FROM tbl_user where email = '$email' limit 1";
                                    $mailcheck = $db->select($mailquery);
                                    if($mailcheck!= false){
                                        echo "<span class = 'error'>Email Already Exist !</span>";
                                    }else{
                                    $query = "INSERT INTO tbl_user (name,username,password,email,details,role) VALUES('$name''$username','$password','$email','$details',$role') ";
                                    $catinsert = $db->insert($query);
                                    if($catinsert){
                                        echo "<span class = 'success'>User Created Successfully !!</span>";
                                    }else{
                                        echo "<span class = 'error'>User Not Created !!</span>";
                                    }

                                }
                    }
                }

                ?>
                 <form action = "" method ="POST">
                    <table class="form"> 
                    <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name = "name" placeholder="Enter Your Name..." class="medium" />
                            </td>
                        </tr>                   
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name = "username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="password" name = "password" placeholder="Enter Your Password..." class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" name = "email" placeholder="Enter Your Valid Email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name = "details"></textarea>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <select id = "select" name="role">
                                    <option>Select User</option>
                                    <option value = '0'>Super Admin</option>
                                    <option value = '1'>Admin</option>
                                    <option value = '2'>Manager (Package)</option>
                                    <option value = '3'>Sales Executive (Package)</option>
                                </select>
                            </td>

                        </tr>
                        <tr> <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create User" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
       

<?php include 'inc/footer.php'?>

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