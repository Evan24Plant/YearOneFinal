<?php
include('header.php');

?>

<br>

<article>
<form action="products.php">
<input type="submit" class="greyBackButtons" style="margin-bottom: 10px" value="<  Back to Shopping" />
</form>
<div class="textBack" align="left" style="float:top; padding-bottom: 50px" >

<h1 style="padding-left: 50px; padding-right: 50px;">Cart</h1>
<br>
<br>
<br>
<hr name="productLine" style="background-image: -webkit-linear-gradient(left, black, #8c8b8b, black)"><br>

<?php 
include('connectionSQL.php');
$userId = $_SESSION['user_id'];

//checks if user selected clear cart and runs the query
if(isset($_GET['clearCart'])){
	$clearCartQuery = 'DELETE FROM shopping_cart WHERE user_id ='. '"' . $userId . '"';
	@mysqli_query($link, $clearCartQuery);
}

//checks if a game was removed and removes from DB
if(isset($_GET['removeId'])) {
	$gameId = $_GET['removeId'];
	//remove from DB here
	$removeCartQuery = 'DELETE FROM shopping_cart WHERE  user_id = ' . '"' . $userId . '"' . ' and game_id = ' . '"' . $gameId . '"';
	@mysqli_query($link, $removeCartQuery);
	//remove cookie that is associated with gameId here
	/*if(isset($_COOKIE[$gameId])){
			unset($_COOKIE[$gameId]);
     		setcookie($gameId,1, time() - 3600);
     	}*/
}

//checks if a game was added to cart and adds to DB
if(isset($_GET['gameId'])) {
	$gameIdPassed = $_GET['gameId'];
	//runs query to check if the game is already present
	$getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
    $result = mysqli_query($link, $getCartQuery);
    $quantityDefault = 1;
 	if ($result)   {
     	while ($row = mysqli_fetch_array($result)) {
     		//copies a unique price for this game to be passed to JS function addQ()
     		
     		//checks if the game is already present here and returns a bool to be used in JS function addQ()
        	 if($gameIdPassed==$row['game_id']){
        	 	$duplicate = true; 
        	 	$priceDuplicate = $row['price'];
        	 	$quantityDefault = $quantityDefault + 1;
  			}
		}		
	}		
	//finally adds the game to the cart
	$addToCartQuery = "INSERT INTO shopping_cart (user_id, game_id, quantity) VALUES ('$userId', '$gameIdPassed', '$quantityDefault')";
	@mysqli_query($link, $addToCartQuery);
}

//used to query the users cart table in DB to populate the cart
//use to get which game_id(s) and theyre quantities from shopping cart to store in variables based on userId
$getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
$result = mysqli_query($link, $getCartQuery);
if ($result)   {
    $row_count = mysqli_num_rows($result);
    //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
    $count = 0;
    while ($row = mysqli_fetch_array($result)) {
        //print $row['name'] . '<br>' .
        //print_r($_COOKIE[$currGameId]);
        $currGameId = $row['game_id'];
        //checks if the game already has a cookie assigned to it
        $quantity = $row['quantity'];

        //displays the contents of your cart
        $price = $row['price'];
        print '<div style="margin-bottom:200px"><form method ="POST" action=' . '"' . 'cart.php?removeId=' . $currGameId . '"><div id="cartDiv">' .
        	'<input class="rButton" type="submit" value="X" id=' . '"' . 'remove' . $currGameId . '"' . '><br><br>' .
        	
        	'<div style="float:right">'.
            '<a href="product.php?gameId='.$currGameId .'" class="" style="text-decoration: none"><img class =' . '"' . 'cartImg' . '"' . 'src =' . '"' . $row['image'] . '"><a/><br>'.
            '<div><div class="gamePrice" id=' . '"' . 'price' . $currGameId . '"' . '>$' . $price * $quantity . '</div>' . 
            '<input class="qButton"  type="button" value="-" onclick=' . '"' . 'remQ(' . $currGameId . ',' . $price . ')"' . '>' .
            '<input class="quantity" id=' . '"' . 'quantity' . $currGameId . '"' . '  type="textbox" value=' . $quantity . ' disabled>' .
            '<input class="qButton" type="button" value="+" onclick=' . '"' . 'addQ(' . $currGameId . ',' . $price . ')"' . '></div>' .

            '</div>' .
            '<a href="product.php?gameId='.$currGameId .'" class="" style="text-decoration: none"><div class="cartGameName">' . $row['name'] . '</div></a><br>' .
            '<div class="cartCname">' . $row['console_name']  . '</div><br>' .
            
            '</form></div></div>';

        //fancy line between products
        echo '<hr name = "productLine">';
        $totalPrice = $totalPrice + $price;
        //assigns an array of all the game ids to identify for JS function calcTotal()
        $gameArray[$count] = $row['game_id'];
        $count = $count + 1;

    }
}

$_GET['count'] = $count;

//keeps db quantity upto date when user leaves the cart
$userId = $_SESSION['user_id'];
/*foreach ($gameArray as $gameId) {
 	//echo 'Game Id: '.$gameId . ' ';
 	if(isset($_COOKIE[$gameId])){
 		//$quantity = $_COOKIE[$gameId];
 		//echo 'Quantity: '.$quantity. '<br> ';
 	}
 	else{
 		$quantity = 1;
 	}
$quantityQuery = 'UPDATE shopping_cart set quantity=' . $quantity .   ' where game_id ='. $gameId .  ' and user_id=' . $userId;
//echo '<br>Query: ' . $quantityQuery . '<br>';
@mysqli_query($link, $quantityQuery);
} */
//echo json_encode($gameArray);
?>
<form method="POST" action="cart.php?clearCart=1">

<input type="submit" value="Clear Cart" id="clearCart" />
</form>

<form method ="POST" action= "checkout.php" >
<?php

//add in hidden forms to hold the gameId and values of each quantity field
//or assign $_POST variables dynamically inside ^ form !!!!!!!!!!!!!!!!!!!!!
for ($i=0; $i < count($gameArray); $i++) { 
	echo '<input type="hidden" name="gameArray[]" value="'.$gameArray[$i].'">
			
	';
}
echo '<input type="hidden" name="total" id="passTotalCheckout">';
echo '<input type="hidden" name="pagenum" value="1">';
?>

<div id="total" style=float:right;></div>
<p id="subtotal">Subtotal: </p><br><br>
<input type="submit" id= "checkOutButton" name= "checkout" value="Checkout" style="float: right;">
</form>


<script>
//to change the quantity and prices displayed, also save quantity to cookie
	function addQ(count,price) {
		//gets current quantity from form
		var quantity = document.getElementById('quantity'+ count).value;
		quantity++;
		//assigns form new incremented quantity
		document.getElementById('quantity'+count).value = quantity;
		document.getElementById('price' + count).innerHTML = "$" + (price * quantity).toFixed(2);
		 //calls to calculate the total on button press
		 calcTotal(<?php echo json_encode($gameArray); ?>);
		 //array that is to be passed to ajax
		 var passThis = {
		 		gameId: count,
		 		quantity: quantity
		 	};

		 //call to ajax to run server side php	
		 $.ajax({
         type: "POST",
         url: "updateQ.php",
         data: passThis,
         success: function(msg){
                     console.log( "Data Saved: " + msg );
                  }
    });
		 
	}
	
	function remQ(count,price) {
		//gets current quantity from form
		var quantity = document.getElementById('quantity'+ count).value;
		quantity--;
		//clicks the remove button for the item if it changes to zero quantity
		if(quantity == 0){
			document.getElementById('remove' + count).click();
		}
		//assigns form new incremented quantity
		document.getElementById('quantity'+count).value = quantity;
		document.getElementById('price' + count).innerHTML = "$" + (price * quantity).toFixed(2);
		 //calls to calculate the total on button press
		 calcTotal(<?php echo json_encode($gameArray); ?>);
		 //array to be passed to ajax
		 var passThis = {
		 		gameId: count,
		 		quantity: quantity
		 	};
		 //ajax call to run server side script
		 $.ajax({
         type: "POST",
         url: "updateQ.php",
         data: passThis,
         success: function(msg){
                     console.log( "Data Saved: " + msg );
                  }
    });

	}
	function getQuantity(gameId){
		var quantity = document.getElementById('quantity'+ gameId).value;
		return quantity;
	}
//used to calculate and update the total price
	function calcTotal(gameArray){
		//console.log(gameArray[0]);
		var total = 0;
		//loops through the gameIds and gets each price field and adds them up
		for (var i = 0; i < gameArray.length; i++) {
			//gets the price from DOM
			var price = document.getElementById('price' + gameArray[i]).innerHTML;
			//cleans off the $ sign
			price = price.replace(/[^0-9.]/g,'');
			console.log(price);
			//adds up total
			total = total + Number(price);
		}
		//assigns total Price
		document.getElementById('total').innerHTML = "$" + total.toFixed(2);
		//assigns to hidden input to POST value to checkout
		document.getElementById('passTotalCheckout').value = total.toFixed(2);
	}
	//calls to calculate the total on page load
	calcTotal(<?php echo json_encode($gameArray); ?>);
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">


</script>


<?php  
//checks if a duplicate occured on this load
if($duplicate == true){
		//runs the JS addQ() function with the duplicates gameId and price
     	echo '<script>addQ('.$gameIdPassed.','.$priceDuplicate.')</script>';	
     	}
?>


</div>
<form action="products.php">
<input type="submit" class="greyBackButtons" style="margin-top: 10px" value="<  Back to Shopping" />
</form>
</article>




<?php
include "footer.php";
?>
