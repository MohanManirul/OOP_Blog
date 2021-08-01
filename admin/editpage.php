<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<!---Receive Postid  From add post  page ------>
<?php
    if (!isset($_GET['editpageid'])  || $_GET['editpageid']  == NULL) {
        echo "<script>window.location = 'pagelist.php';</script>";
        //header("Location:catlist.php");
    }else{
        $editpageid = $_GET['editpageid'];
    }
?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Edit Page</h2>
                <!---receiving form data and send into dtabase---->
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $title = $_POST['title'];        
                        $title = $fm->validation($_POST['title']);
                        $title = mysqli_real_escape_string($db->link, $title);
                        
                        $body = $_POST['body']; 
                        $body = $fm->validation($_POST['body']);       
                        $body = mysqli_real_escape_string($db->link, $body);
                        
                  
                    
                    if($title == "" || $body == ""){
                            echo "<span class = 'error'>Field Must Not be Empty !</span>";
                        }else{
                             $query = "UPDATE tbl_pages
                                            SET
                                            title = '$title',
                                            body = '$body'
                                            WHERE id = '$editpageid' ";


                                $updated_row = $db->update($query);
                                if ($updated_row) {
                                 echo "<span class='success'>Page updated Successfully.
                                 </span>";
                                }else {
                                 echo "<span class='error'>Page Not updated !</span>";
                                }
                        }
                    }
             

                ?>



                <div class="block"> 
                <?php
                 $query = "SELECT * FROM tbl_pages WHERE id = '$editpageid' order by id desc ";
                 $getpageDetails = $db->select($query);
                 if($getpageDetails){
                    while ($pageresult = $getpageDetails->fetch_assoc()) {
               


                ?>              
                 <form action="" method="POST">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name = 'title' value = "<?php echo $pageresult['title'];?>"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Page Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name ='body'>
                                    <?php echo $pageresult['body'];?>

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


