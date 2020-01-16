<?php
//this php is run server side from ajax inside JS function cart.php
session_start();
include('connectionSQL.php');
if(isset($_POST['quantity'])){
	$userId = $_SESSION['user_id'];
	$gameId = mysqli_real_escape_string($link, $_POST['gameId']);
	$quantity = mysqli_real_escape_string($link, $_POST['quantity']);

	$quantityQuery = 'UPDATE shopping_cart set quantity=' . $quantity .   ' where game_id ='. $gameId .  ' and user_id=' . $userId;

	@mysqli_query($link, $quantityQuery);

	//make sure to close the link for server scripts!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	mysqli_close($link);
	//echo "done";
}


?>