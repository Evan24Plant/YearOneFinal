<br>
<br>


<footer>
<?php
include('popup.php');
date_default_timezone_set('America/Vancouver');
print date('Y-m-d H:i:s');
echo '<br><a href="javascript:void(0);" style="font-size:15px;" onclick="openTOS('. $_SESSION['user_id'] .')">Terms of Service</a>'
?>

<p>Copyright Antimony Technologies &copy; 2018</p>
</footer>

</body>
</html>
