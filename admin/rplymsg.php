<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<?php 
    if(!isset($_GET['rplymsgid']) || $_GET['rplymsgid'] == NULL){
        echo "<script>window.location = 'inbox.php';</script>";
        //header ("Location:catlist.php");

    }else{
         $rplymsgid = $_GET['rplymsgid'];
    }
?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>View Message</h2>
                             <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                            $toEmail      = $fm->validation($_POST['toEmail']);
                            $fromEmail      = $fm->validation($_POST['fromEmail']);
                            $subject     = $fm->validation($_POST['subject']);
                            $message      = $fm->validation($_POST['message']);

                            $toEmail      = mysqli_real_escape_string($db->link, $toEmail);
                            $fromEmail      = mysqli_real_escape_string($db->link, $fromEmail);
                            $subject     = mysqli_real_escape_string($db->link, $subject);
                            $message      = mysqli_real_escape_string($db->link, $message);

                            $sendmail = mail($toEmail,$subject,$message,$fromEmail);
                            if($sendmail){
                                echo "<span class = 'success'>Mail Sent Successfully...</span>";
                            }else{
                                echo "<span class = 'error'>Something Went wrong...</span>";
                            }
                            

                    $query = "INSERT INTO sell_package(toEmail,fromEmail,subject,message) 
                                VALUES('$toEmail','$fromEmail','$subject','$message')";
                        $inserted_rows = $db->insert($query);
                         if ($inserted_rows) {
                          echo "<span class='success'>Package Created Successfully.</span>";
                              }else { echo "<span class='error'>Package Not Created !</span>"; }
                                }?>

                <div class="block"> 
                <?php 

                $query = "SELECT * FROM sell_package WHERE id = '$rplymsgid' ";
                $category = $db->select($query);
                    while($result = $category->fetch_assoc()){
            ?>              
                 <form action="" method="POST">
                    <table class="form">

                        <tr>
                            <td>
                                <label>To Email</label>
                            </td>
                            <td>
                                <input type="email" readonly="readonly" name = "toEmail"  value = "<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>



                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="email" name = "fromEmail" placeholder="Enter Your Email" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name = "subject" placeholder="Enter Your Email" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Package Title</label>
                            </td>
                            <td>
                                <input type="text" readonly value = "<?php echo $result['ptitle'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>

                            <td>
                                <input type="text" readonly value = "<?php echo $result['cat'];?>"medium" />
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
                                <input type="text" readonly value = "<?php echo $result['author'];?>"medium" />
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label>Reference</label>
                            </td>
                            <td>
                                <input type="text" readonly value = "<?php echo $result['ref'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>My omments</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message"></textarea>
                            </td>
                       </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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

