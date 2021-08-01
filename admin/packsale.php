<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Add New Package Sale</h2>
                         <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                            $fname      = $fm->validation($_POST['fname']);
                            $lname      = $fm->validation($_POST['lname']);
                            $mobile     = $fm->validation($_POST['mobile']);
                            $email      = $fm->validation($_POST['email']);
                            $ptitle     = $fm->validation($_POST['ptitle']);
                            $cat        = $fm->validation($_POST['cat']);
                            $pacdetails = $fm->validation($_POST['pacdetails']);
                            $author     = $fm->validation($_POST['author']);
                            $ref        = $fm->validation($_POST['ref']);
                            $mycomm     = $fm->validation($_POST['mycomm']);

                            $fname      = mysqli_real_escape_string($db->link, $fname);
                            $lname      = mysqli_real_escape_string($db->link, $lname);
                            $mobile     = mysqli_real_escape_string($db->link, $mobile);
                            $email      = mysqli_real_escape_string($db->link, $email);
                            $ptitle     = mysqli_real_escape_string($db->link, $ptitle);
                            $cat        = mysqli_real_escape_string($db->link, $cat);
                            $pacdetails = mysqli_real_escape_string($db->link, $pacdetails);
                            $author     = mysqli_real_escape_string($db->link, $author);
                            $ref        = mysqli_real_escape_string($db->link, $ref);
                            $mycomm     = mysqli_real_escape_string($db->link, $mycomm);

                    $query = "INSERT INTO sell_package(fname,lname,mobile,email,ptitle,cat,pacdetails,author,ref,mycomm) 
                    VALUES('$fname','$lname','$mobile','$email','$ptitle','$cat','$pacdetails','$author','$ref','$mycomm')";
                        $inserted_rows = $db->insert($query);
                         if ($inserted_rows) {
                          echo "<span class='success'>Package Sent Successfully To Admin Approval.Please Wait...</span>";
                              }else { echo "<span class='error'>Package Not Created !</span>"; }
                                }?>
                <div class="block">               
                 <form action="" method="POST">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>First Name</label>
                            </td>
                            <td>
                                <input type="text" required name = "fname" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Last Name</label>
                            </td>
                            <td>
                                <input type="text" required name = "lname" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Mobile</label>
                            </td>
                            <td>
                                <input type="text" required name = "mobile" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" required name = "email" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Package Title</label>
                            </td>
                            <td>
                                <input type="text" required name = "ptitle" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option >Select category</option>
                                        <?php 
                                            $query = "SELECT* FROM tbl_category";
                                                $category = $db->select($query);
                                                if($category){
                                                    while($result = $category->fetch_assoc()){

                                        ?>
                                    <option value="<?php echo $result['id'];?>"><?php echo $result['name'];?></option>
                                <?php }} ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Package Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name = "pacdetails"></textarea>
                            </td>
                       </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name = "author" placeholder="Enter Author..." class="medium" />
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label>Reference</label>
                            </td>
                            <td>
                                <input type="text" name = "ref" placeholder="Enter Author..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>My omments</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name = "mycomm"></textarea>
                            </td>
                       </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Sale" />
                            </td>
                        </tr>
                    </table>
                    </form>
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

