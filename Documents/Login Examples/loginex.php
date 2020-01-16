<html>
<head>
<title> Login Test </title>
<script>
function validation() {
// VALIDATION CODE HERE!
if (document.getElementById("username").value ==''){
	alert("You must include a username.");
	return false;
}
if (document.getElementById("password").value ==''){
	alert("You must include a password.");
	return false;
}
if (document.getElementById("password").value.length < 5){
	alert("You must include at least 5 characters for your password.");
	return false;
}
}
</script>
</head>
<body>
<form action="loginvars.php" method="POST" onsubmit="return validation();">
<p> USERNAME: <input type="text" name="username" id="username"/></p>
<p> PASSWORD: <input type="password" name="password" id="password"/></p>
<input type="submit" value="SUBMIT"  />
</form>

</body>