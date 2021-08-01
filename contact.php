<?php include "inc/header.php";?>

		<?php
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$firstname 	= $fm->validation($_POST['firstname']);
				$lastname 	= $fm->validation($_POST['lastname']);
				$email 		= $fm->validation($_POST['email']);
				$body 		= $fm->validation($_POST['body']);

				$firstname 	= mysqli_real_escape_string($db->link, $firstname);
				$lastname 	= mysqli_real_escape_string($db->link, $lastname);
				$email 		= mysqli_real_escape_string($db->link, $email);
				$body 		= mysqli_real_escape_string($db->link, $body);
				

				$errorf = "";
				$errorl = "";
				$errore = "";
				$errorb = "";

				if(empty($firstname)){
					$errorf = "First Name Must not be Empty !";
				}
				if(empty($lastname)){
					$errorl = "Last Name Must  not be Empty !";
				}
				if(empty($email)){
					$errore = "E-mailMust not be Empty !";
				}
				if(empty($body)){
					$errorb = "Body Must not be Empty !";
				}else{
					$query = "INSERT INTO tbl_contact(firstname,lastname,email,body) VALUES('$firstname','$lastname','$email','$body')";
                     $inserted_rows = $db->insert($query);
                         if ($inserted_rows) {
                            $msg = "Package Successfully Sent. Please Wait For Admin Approval";
                                }else {
                                 $error = "Package Not Sent to Admin";
                                }
				}

			}


		?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php 
					/*if (isset($error)){
						echo "<span style='color:red;'>$error</span>";
					}if (isset($msg)){
						echo "<span style='color:green;'>$msg</span>";
					}*/
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name"/>
					<?php
						if(isset($errorf)){
							echo "<span class= 'cursorerroe'>$errorf</span>";
						}
					?>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name"/>
					<?php
						if(isset($errorl)){
							echo "<span class= 'cursorerroe'>$errorl</span>";
						}
					?>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address" />
					<?php
						if(isset($errore)){
							echo "<span class= 'cursorerroe'>$errore</span>";
						}
					?>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name ="body"></textarea>
					<?php
						if(isset($errorb)){
							echo "<span class= 'cursorerroe'>$errorb</span>";
						}
					?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>


<?php include "inc/sidebar.php";?>

<?php include "inc/footer.php";?>
	
<style>
	.cursorerroe{
		color:red;
		float: left;
	}

</style>