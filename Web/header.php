<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="default.css">
<title>BiFrost Games</title>
<style>
	
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
function myFunction() {
	var x = document.getElementById("myTopnav");
	if (x.className === "topnav") {
		x.className += " responsive";
	} else {
		x.className = "topnav";
	}
}
function openNav() {
    document.getElementById("mySidenav").style.width = "17vmax";
    document.getElementById("openNavigation").style.visibility = "hidden";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("openNavigation").style.visibility = "visible";
}

 $(document).on('scroll',function(){
     if ($(document).scrollTop() > 243) {
         $('.openNavigation').addClass('fixed');
         console.log("fixed");
     } else {
         $('.openNavigation').removeClass('fixed');
         console.log("not fixed");
     }
  
  });
</script>


</head>

<body>

<header><a href="index.php"><img id="banner" src="BiFrostBanner.gif" alt="BiFrost Games"/></a></header>

<hr>
<nav>
	
<ul id="mySidenav" class="sidenav">
	<!--add class="viewing" to <a> tag to select page being viewed-->
	<li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></li>
	<li><a href="products.php" title="Browse products" >Shop</a></li>	
	
	
	<!-- Persistant login -->
	<?php
	session_start();
	include ('connectionSQL.php');
	
	
	if (isset($_SESSION['user_id'])) {
	    // print_r($_SESSION);
	    $user = $_SESSION['user_id'];
	    $role = $_SESSION['admin'];
	    //echo "<p>User:  $user <br/> Role: $role</p>";
		if ($_SESSION['admin'] == 1){
			print "<li><a href='addProducts.php' title='Add more products' >Add Product</a></li>";
		}//END OF ADMIN CHECK
		print "<li><a href='cart.php' title='View your cart' >My Cart</a></li>
				<li><a href='orderHistory.php' title='View your order history'>Order History</a></li>
				<li><a href='logOut.php' class='logout' >Log Out</a></li>";
	} 
	else {
		print "<li><a href='login.php' title='Login' id='login' >Log In</a></li>";
	} //END of SESSION==TRUE
	?>
	<!-- END of Persistant login -->
	<li class="icon"><a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">&#9776;</a></li>
</ul>
</nav>
<?php
if (isset($_SESSION['user_id'])) {
	echo "<nav><div style='padding-right: 35px'><ul align='right' class='box-shadow: -8px 12px 15px #C2C2C2'><li><a href='logOut.php' id='logout' class='loginButton' style='padding: 10px' >Log Out</a></li></ul></div>";	
}
else {
	echo "<nav><div style='padding-right: 35px'><ul align='right' class='box-shadow: -8px 12px 15px #C2C2C2'><li><a href='login.php' class='loginButton' id='login' style='padding: 10px' >Log In</a></li></ul></div>";
}
	echo "<a class='openNavigation'><span id = 'openNavigation' class='openNavigation' onClick='openNav()'>&#9776;</span></a></nav>";



?>




