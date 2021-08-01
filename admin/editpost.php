<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<!---Receive Postid  From add post  page ------>
<?php
    if (!isset($_GET['editpostid'])  || $_GET['editpostid']  == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
        //header("Location:catlist.php");
    }else{
        $editpostid = $_GET['editpostid'];
    }
?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Add New Package</h2>
                <!---receiving form data and send into dtabase---->
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $title = $_POST['title'];        
                        $title = $fm->validation($_POST['title']);
                        $title = mysqli_real_escape_string($db->link, $title);
                        
                        $cat = $_POST['cat'];        
                        $cat = $fm->validation($_POST['cat']);
                        $cat = mysqli_real_escape_string($db->link, $cat);
                        
                        $body = $_POST['body'];        
                        $body = mysqli_real_escape_string($db->link, $body);
                        
                        $tags = $_POST['tags'];        
                        $tags = $fm->validation($_POST['tags']);
                        $tags = mysqli_real_escape_string($db->link, $tags);

                        $author = $_POST['author'];        
                        $author = $fm->validation($_POST['author']);
                        $author = mysqli_real_escape_string($db->link, $author);

                        $userid = $_POST['userid'];        
                        $userid = $fm->validation($_POST['userid']);
                        $userid = mysqli_real_escape_string($db->link, $userid);

                       //---image validation---
                        $permited  = array('jpg', 'jpeg', 'png', 'gif');
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_temp = $_FILES['image']['tmp_name'];

                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                        $uploaded_image = "upload/".$unique_image;
                    
                    if($title == "" || $cat == "" || $body == "" || $tags == "" || $author == ""){
                            echo "<span class = 'error'>Field Must Not be Empty !</span>";
                        }else{ 
                        if(!empty($file_name)){


                        if ($file_size >1048567) {
                             echo "<span class='error'>Image Size should be less then 1MB!
                             </span>";
                            
                            } elseif (in_array($file_ext, $permited) === false) {
                             echo "<span class='error'>You can upload only:-"
                             .implode(', ', $permited)."</span>";
                            
                            
                            } else{

                                move_uploaded_file($file_temp, $uploaded_image);
                                $query = "UPDATE tbl_post
                                            SET
                                            cat = '$cat',
                                            title = '$title',
                                            body = '$body',
                                            image = '$uploaded_image',
                                            author = '$author',
                                            tags = '$tags',
                                            userid = '$userid'
                                            WHERE id = '$editpostid' ";


                                $updated_row = $db->update($query);
                                if ($updated_row) {
                                 echo "<span class='success'>Package updated Successfully.
                                 </span>";
                                }else {
                                 echo "<span class='error'>Package Not updated !</span>";
                                }
                            }
                        }else{
                             $query = "UPDATE tbl_post
                                            SET
                                            cat = '$cat',
                                            title = '$title',
                                            body = '$body',
                                            author = '$author',
                                            tags = '$tags',
                                            userid = '$userid'
                                            WHERE id = '$editpostid' ";


                                $updated_row = $db->update($query);
                                if ($updated_row) {
                                 echo "<span class='success'>Package updated Successfully.
                                 </span>";
                                }else {
                                 echo "<span class='error'>Package Not updated !</span>";
                                }
                        }
                    }
                }

                ?>



                <div class="block"> 
                <?php
                 $query = "SELECT * FROM tbl_post WHERE id = '$editpostid' order by id desc ";
                 $getpost = $db->select($query);
                 if($getpost){
                    while ($postresult = $getpost->fetch_assoc()) {
               


                ?>              
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Package Title</label>
                            </td>
                            <td>
                                <input type="text" name = 'title' value = "<?php echo $postresult['title'];?>"class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Country</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Country </option>

                                    <?php 
                                        $query = "SELECT * FROM tbl_category";
                                        $getpost = $db->select($query);
                                        if($getpost){
                                            while($result = $getpost->fetch_assoc()){
                                    ?>
                                    <option 
                                        <?php 
                                        if($postresult['cat'] == $result['id']){?>
                                            selected = "selected"
                                            
                                        <?php } // end country option if loop  

                                        ?> value="<?php echo $result['id'];?>"><?php echo $result['name'];?>
                                            
                                        </option>

                                <?php }}?><!----end if & while loop---->
                                </select>
                            </td>
                        </tr>
                  
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>

                                <input type="file" name = 'image' /><br/>
                                <img src = "<?php echo $postresult['image']?>" height = "150px" width = "250px" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Pakage Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name ='body'>
                                    <?php echo $postresult['body'];?>

                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name = 'tags' value = "<?php echo $postresult['tags'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name = 'author' value = "<?php echo $postresult['author'];?>"class="medium" />
                                <input type="text" name = 'userid' value = "<?php echo Session::get('userId')?>"class="medium" />
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


