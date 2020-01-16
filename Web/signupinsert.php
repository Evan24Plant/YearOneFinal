<?php
    session_start();
    //header for webpage
	include('header.php');
    include('connectionSQL.php');
	
	echo "<article>";
    echo "<div class=\"textBack\" align=\"left\" style=\"float:left\">";
    //echo "<h1>Registration</h1><br><br><br>";
	//Checking to see if method being used is POST
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//Retrieve values through post and save them to variables
		$fname = strip_tags($_POST['fname']);
		$lname = strip_tags($_POST['lname']);
		$email = strip_tags($_POST['email']);
		$pass = sha1($_POST['pass']);
		//Query to see if email submitted exists
		$emailcheckquery = "SELECT * FROM users WHERE email = '$email'";
		$emailcheck = mysqli_num_rows(@mysqli_query($link, $emailcheckquery));
		//if email exists, return an error stating the email is already registered
		if($emailcheck > 0){
			echo '<p style="color: red;">Sorry! This email is already in use!<br> <a href="signup.php"> Please try again</a></p>';
			
		}else{
			//queries to insert the values into the database and make an account
			$adduserquery = "INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$pass')";
			@mysqli_query($link, $adduserquery);
			$emailcheck = mysqli_num_rows(@mysqli_query($link, $emailcheckquery));
			//If insert was successful, it will return 1 row, tell user sign up was successful
			if ($emailcheck == 1) {
				echo "Sign up successful! Logging you in now....";
				//Go to login.php and automatically log in the user 
				echo '<form action="login.php" method="POST" id="signupRedirect">
						<input type="hidden" name="email" value="' . $email . '">
						<input type="hidden" name="pass" value="' . $_POST['pass'] . '">
						<input type="hidden" name="send_page" value="signup.php">
						
						</form>
						<script type="text/javascript">
							setTimeout(SubmitLogin, 3000);
							function SubmitLogin(){
								document.getElementById(\'signupRedirect\').submit();
							}
						</script>';
			}else{
				//if the rows returned isn't 1, then that means a error has occurred with the SQL query, tell the user what the error is.
				echo "Sign up failed! Please contact the ADMIN with this error : SQL FAILED INSERT!";
			}
		}
	}
	echo "</div>";
    echo "</article>";
	
	?>
<?php
//Footer for webpage
include('footer.php');
	
?>