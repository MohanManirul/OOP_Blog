<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<style>
    .leftside{
        float: left;
        width: 70%;
    }
    .rightside{
        float: left;
        width: 20%;
    }
     .rightside img{
        height:160px;
        width:170px;
     }
</style>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Update title & Slogan with Logo</h2>
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                               
                        $title = $fm->validation($_POST['title']);
                        $title = mysqli_real_escape_string($db->link, $title);
                        
                           
                        $slogan = $fm->validation($_POST['slogan']);
                        $slogan = mysqli_real_escape_string($db->link, $slogan);

                       //---image validation---
                        $permited  = array('png');
                        $file_name = $_FILES['logo']['name'];
                        $file_size = $_FILES['logo']['size'];
                        $file_temp = $_FILES['logo']['tmp_name'];

                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $same_image = 'logo'.'.'.$file_ext;
                        $uploaded_image = "upload/".$same_image;
                    
                    if($title == "" || $slogan == ""){
                            echo "<span class = 'error'>Field Must Not be Empty !</span>";
                        }else{ 
                        if(!empty($file_name)){


                        if ($file_size >1048567) {
                             echo "<span class='error'>Image Size should be less then 1MB!
                             </span>";
                            
                            } elseif (in_array($file_ext, $permited) == false) {
                             echo "<span class='error'>You can upload only:-"
                             .implode(', ', $permited)."</span>";
                            
                            
                            } else{

                                move_uploaded_file($file_temp, $uploaded_image);
                                $query = "UPDATE tbl_title
                                            SET
                                            title = '$title',
                                            slogan = '$slogan',
                                            logo = '$uploaded_image'

                                            WHERE id = '1' ";


                                $updated_row = $db->update($query);
                                if ($updated_row) {
                                 echo "<span class='success'>Title ,Slogan & Logo updated Successfully.
                                 </span>";
                                }else {
                                 echo "<span class='error'>Title ,Slogan & Logo Not updated !</span>";
                                }
                            }
                        }else{
                             $query = "UPDATE tbl_title
                                            SET
                                            title = '$title',
                                            slogan = '$slogan'
                                            WHERE id = '1' ";


                                $updated_row = $db->update($query);
                                if ($updated_row) {
                                 echo "<span class='success'>Title ,Slogan & Logo updated Successfully.
                                 </span>";
                                }else {
                                 echo "<span class='error'>Title ,Slogan & Logo Not updated !</span>";
                                }
                        }
                    }
                }

                ?>
                 <?php
                    $query = "SELECT* FROM tbl_title WHERE id = '1' ";
                    $blog_title = $db->select($query);
                    if($blog_title){
                        while($result = $blog_title->fetch_assoc()){

                ?> 
                <div class="block"> 
               
                <div class = "leftside">            
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name = "title" value="<?php echo $result['title'];?>" class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Slogan</label>
                            </td>
                            <td>
                                <input type="text" name = "slogan" value="<?php echo $result['slogan'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>

                                <input type="file" name = "logo" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="rightside">
                    
                    <img src = "<?php echo $result['logo'];?>" height ="10px"; width = "100px" alt= "Logo"/>
                   
                </div>
                </div>
            <?php }}?>
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

