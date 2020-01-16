<?php
include('header.php');
include('popup.php');

?>

<script>
	function validation(){
		 var pass = document.getElementById("pass").value;
		 var cpass = document.getElementById("cpass").value;
		 
		if(cpass != pass ){
			alert("Your passwords do not match!!");
			return false;
		}else{
			return true;
		}
	}
</script>
	
<article>
<div class="textBack" align="left" style="..." >
	<h1>Registration</h1><br><br><br><hr name="productLine" style="background-image: -webkit-linear-gradient(left, black, #8c8b8b, black)"><br>
	<form action="signupinsert.php" method="POST" onsubmit="return validation();">
	    <p>First Name: <input type="text" name="fname" id="fname" required /></p>
	    <p>Last Name: <input type="text" name="lname" id="lname" required /></p>
	    <p>Email: <input type="email" name="email" id="email" required /></p>
	    <p>Password: <input type="password" name="pass" id="pass" required /></p>
	    <p>Confirm Password: <input type="password" name="cpass" id="cpass" required /></p>
        <p><input type="checkbox" name="priv_policy" id="priv_policy" required />I have read & accepted the <a href="javascript:void(0);" style="font-size:15px;" onclick="openTOS()">Privacy Policy.</a></p>
	    <input type="submit" value="Submit" />
	</form>
</div>
</article>

<?php
include('footer.php');
?>