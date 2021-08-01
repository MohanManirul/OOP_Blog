<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<!---Receive Postid  From add post  page ------>
<?php
    if (!isset($_GET['viewpostid'])  || $_GET['viewpostid']  == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
        //header("Location:catlist.php");
    }else{
        $viewpostid = $_GET['viewpostid'];
    }
?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Add New Package</h2>
                <!---receiving form data and send into dtabase---->
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        echo "<script>window.location = 'postlist.php';</script>";

                       
                }

                ?>



                <div class="block"> 
                <?php
                 $query = "SELECT * FROM tbl_post WHERE id = '$viewpostid' order by id desc ";
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
                                <input type="text" readonly="readonly" name = 'title' value = "<?php echo $postresult['title'];?>"class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Country</label>
                            </td>
                            <td>
                                <select id="select" readonly="readonly" name="cat">
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

                                <input type="file" readonly="readonly"  name = 'image' /><br/>
                                <img src = "<?php echo $postresult['image']?>" height = "150px" width = "250px" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Pakage Details</label>
                            </td>
                            <td>
                                <textarea  readonly="readonly"  class="tinymce" name ='body'>
                                    <?php echo $postresult['body'];?>

                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text"  readonly="readonly" name = 'tags' value = "<?php echo $postresult['tags'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name = 'author' value = "<?php echo $postresult['author'];?>"class="medium" />
                                <input type="hidden" name = 'userid' value = "<?php echo Session::get('userId')?>"class="medium" />
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


