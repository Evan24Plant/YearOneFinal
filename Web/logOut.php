<?php
include('header.php');

echo '<article><div class="textBack" ><p id="logOut">';
session_start();
session_destroy();
unset($_COOKIE['TempGameID']);
setcookie("TempGameID", 1, time() - 3600);
echo "<p>You have successfully logged out.</p>";
echo '  <a href="index.php" id="loginRedirect"></a>
                            <script type="text/javascript">
                                setTimeout(SubmitLogin, 2000);
                                function SubmitLogin(){
                                    document.getElementById(\'loginRedirect\').click();
                                }
                            </script>
        ';

echo '</p></article></div>';


include('footer.php');
?>