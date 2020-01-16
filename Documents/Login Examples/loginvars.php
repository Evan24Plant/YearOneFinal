<html>
<head>
<title> Login Test </title>
</head>
<body>
<?php 
session_start();
$username = $_POST['username'];
$password = $_POST['password'];


echo "$username and $password";
include('mysqli_connect.php');

$query = "INSERT INTO users2 (username, password, comments) VALUES ('$username', '$password', 'Well hello there')";

$row = @mysqli_query($dbc, $query);

/* if (mysqli_num_rows($row)==1) {
	echo "You have logged in successfully!";
	$_SESSION['username']=$row['username'];
}else {
	echo "<h4>Invalid Login credentials. Please <a href='loginex.php'>TRY AGAIN</a></h4>";
}
*/
?>

</body>
</html>