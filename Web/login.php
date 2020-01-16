<?php
    if (isset($_GET['gameId'])) {
		//print_r($_GET['gameId']);
	    setcookie("TempGameID", $_GET['gameId']);
    }

    if (isset($_POST['send_page'])) {
        $sendPage = $_POST['send_page'];
    }

    function buildForm($message = '') {
        echo '
                <form action="login.php" method="POST" >
                    <p>Email: <input type="email" name="email" id="email" size="25" value="';
                        if(isset($_POST['email'])){ echo "$semail"; }else{ echo ""; }
                        echo '" autofocus required /></p>
                    <p>Password: <input type="password" name="pass" required /></p>
                    <input type="submit" value="Submit" />
                </form>
                ' . $message . '
            </div>
            <div id="signup" align="left">
                <h1>Sign Up</h1><br><br><br><hr name="productLine" style="background-image: -webkit-linear-gradient(left, black, #8c8b8b, black)"><br>
                    <p>Don\'t have an account? <a href="signup.php">Sign up here!</a></p>
            </div>            
        ';
    }

    // Redirect the user to the next page.
    function loginRedirect ($url = 'index.php', $message, $timeout = 3000) { // $timeout is in milliseconds

        echo "<p>$message</p>";

        echo "<a href='$url' id='loginRedirect'></a>
                <script type='text/javascript'>
                    setTimeout(SubmitLogin,$timeout);
                    function SubmitLogin(){
                        document.getElementById('loginRedirect').click();
                    }
                </script>
        ";
    }

    include('header.php');
    include('popup.php');

	echo '<article>
				<div class="textBack" align="center" style="float:left" >
					<div id="loginBox" align="left">
						<h1>Log In</h1><br><br><br><hr name="productLine" style="background-image: -webkit-linear-gradient(left, black, #8c8b8b, black)"><br>';

	if (isset($_POST['email'])) { // Login submitted
        // Set the submitted login info
        $semail = strip_tags($_POST['email']);
        $spass = sha1($_POST['pass']);

        // Retrieve the user info based on login data
        $userquery = "SELECT * FROM users WHERE email = '$semail'";
        $userinforesult = @mysqli_query($link, $userquery);

        // Check if the login exists, then handle the login request
        if (mysqli_num_rows($userinforesult) == 1) { // User exists
            // Retrieve the user's stored info
            $userinfo = mysqli_fetch_row($userinforesult);
            $uID = $userinfo[0];
            $ufname = $userinfo[1];
            $ulname = $userinfo[2];
            $uemail = $userinfo[3];
            $upass = $userinfo[4];
            $urole = $userinfo[5];
            $upriv = $userinfo[6];

            // Check the submitted password, then handle it
            if (($spass == $upass) && ($upriv == 1)) { // Valid password & Privacy Policy accepted
                // Set the user's session info
                $_SESSION['user_id'] = $uID;
                $_SESSION['admin'] = $urole;

                // Update user info with login time
                $loginquery = "UPDATE users SET last_login=DEFAULT WHERE user_id='" . $uID . "'";
                $loginresult = @mysqli_query($link, $loginquery);

                // Determine the final redirect URL
                if (isset($_COOKIE['TempGameID'])) {
                    $loginURL = 'cart.php?gameId=' . $_COOKIE['TempGameID'];
                } else {
                    $loginURL = 'products.php';
                }

                // Determine redirect message & delay based on sending page
                if ($sendPage == 'signup.php' || $sendPage == 'popup.php') {
                    $redirectMessage = '';
                    $redirectDelay = 0;
                } else {
                    $redirectMessage = 'Hello ' . $ufname . '! You have successfully logged in.';
                    $redirectDelay = 2000;
                }

                loginRedirect($loginURL, $redirectMessage, $redirectDelay);
            } else if ($spass != $upass) { // Invalid password
                buildForm('<p style=\'color: red;\'>Invalid email or password. Please try again.</p>');
            } else { // Valid password, but Privacy Policy not accepted
                // Update user info with login time
                $loginquery = "UPDATE users SET last_login=DEFAULT WHERE user_id='" . $uID . "'";
                $loginresult = @mysqli_query($link, $loginquery);

                //use this to update policy inside js agreeTOS function
                echo "<div id='thankyou'><p>You must accept the new <a href=\"javascript:void(0);\" style=\"font-size:15px;\" onclick=\"openTOS($uID)\">Privacy Policy</a> to log in.</p></div>";
            }
        } else { // User does not exist
            buildForm('<p style=\'color: red;\'>Invalid email or password. Please try again.</p>');
        }
		echo '</div>';
    } else {
        buildForm();
    }
	
	echo'			
				</div>
			</article>';
	
    include "footer.php";
?>