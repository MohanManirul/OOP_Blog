<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Add New Page</h2>
                         <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                            $title = $fm->validation($_POST['title']);
                            $body = $fm->validation($_POST['body']);
                           
                            $title = mysqli_real_escape_string($db->link, $title);
                            $body = mysqli_real_escape_string($db->link, $body);
                        
                           if(empty($title) ||empty($body) ){
                                        echo "<span class = 'error'>Field Must not be Empty !</span>";
                                }else{
                                    $query = "INSERT INTO tbl_pages (title,body) VALUES('$title','$body') ";
                                    $pageinsert = $db->insert($query);
                                    if($pageinsert){
                                        echo "<span class = 'success'>Page Created Successfully !!</span>";
                                    }else{
                                        echo "<span class = 'error'>Page Not Created !!</span>";
                                    }

                                }
                     }
                     ?>
                <div class="block">               
                 <form action="addpage.php?page=<??>" method="POST">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name = "title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name = "body"></textarea>
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

