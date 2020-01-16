<?php
//this php is run server side and called from ajax inside of a JS funtion popup.php
include('connectionSQL.php');

	$userId = mysqli_real_escape_string($link, $_POST['id']);
    $policy = mysqli_real_escape_string($link, $_POST['policy']);

	$updatePolicyQuery = 'UPDATE users set priv_policy=' . $policy . ' where user_id ='.$userId;

	@mysqli_query($link, $updatePolicyQuery);
	
	//make sure to close the link for server scripts!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	mysqli_close($link);
	//echo $updatePolicyQuery;
	


?>