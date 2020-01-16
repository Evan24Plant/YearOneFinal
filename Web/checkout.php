<?php
    include('header.php');
?>

    <article>
        <div class="textBack" align="left" style="..." >
            <h1>Checkout</h1><br><br><br><hr name="productLine" style="background-image: -webkit-linear-gradient(left, black, #8c8b8b, black)"><br>

<?php
	$userId = $_SESSION['user_id'];
	
	if (!isset($_POST['pagenum'])) {
		echo '
			<form action="checkout.php" method="POST" onsubmit="return validation();">
				<p>Page: <input type="text" name="pagenum" required /></p>
				<input type="hidden" name="gameArray" value="'.$_POST['gameArray'] .'"/>
				<input type="submit" value="Submit" />
			</form>
		';
	}

	//page 1 billing info
	if($_POST['pagenum'] == 1){
        //print_r($_POST['gameArray']);
        //if this needs to be done, passing the post gameArray needs to be done with for loop input echo, see line 133 in cart.php
        //$gameArray = $_POST['gameArray'];

        //takes the total passed from POST
        $total = $_POST['total'];
        //echo '<br>' . $total;


        //Check to see if user has a saved address
        $userAddressCheck = "SELECT * FROM address_book WHERE user_id = '$userId'";
        $userAddressQuery = mysqli_query($link, $userAddressCheck);

        // Set the preset info
        if (mysqli_num_rows($userAddressQuery) == 1) { // User has saved address
            $userAddressInfo = mysqli_fetch_row($userAddressQuery);
            $addressPlaceholder = $userAddressInfo[2];
            $postalPlaceholder = $userAddressInfo[6];
            $provincePlaceholder = $userAddressInfo[4];
            $cityPlaceholder = $userAddressInfo[3];
            $countryPlaceholder = $userAddressInfo[5];
        } else { // User does not have saved address
            $addressPlaceholder = "";
            $postalPlaceholder = "";
            $provincePlaceholder = "";
            $cityPlaceholder = "";
            $countryPlaceholder = "";
        }

        // Build the form, and preset it with user's info
        echo '<h2>Please Fill out Shipping Information:</h2>
            <form action="checkout.php" method="POST" onsubmit="return validation();">
                <p>Address: <input type="text" name="address" id="address" value="'. $addressPlaceholder .'" pattern="\d+[ ](?:[A-Za-z0-9.-]+[ ]?)+(?:[Aa]venue|[Ll]ane|[Rr]oad|[Bb]oulevard|[Dd]rive|[Ss]treet|[Aa]ve|[Dd]r|[Rr]d|[Bb]lvd|[Ll]n|[Ss]t)\.?" required /></p>
                <p>City: <input type="text" name="city" id="city" value="'. $cityPlaceholder .'" required /></p>
                <p>Province: <input type="text" name="province" id="province" value="' . $provincePlaceholder .' " required /></p>
                <p>Country: <input type="text" name="country" id="country" value="'. $countryPlaceholder .'" required /></p>
                <p>Postal Code: <input type="text" name="postal" id="postal" value="'. $postalPlaceholder .' " required /></p>
                <input type="hidden" name="pagenum" value="2"/>
                
                <input type="hidden" name="total" value="'. $total .'"/>
                <input type="submit" value="Submit" />
            </form>
        ';
	}

	//page 2 payment
	elseif($_POST['pagenum'] == 2){
		//takes the total passed from POST
		$total = str_replace('.', '', $_POST['total']);
		$pricetotal = $total / 100;
		
		$address = $_POST['address'];
		$postal = $_POST['postal'];
		$province = $_POST['province'];
		$city = $_POST['city'];
		$country = $_POST['country'];
		
		$addressQuery = "SELECT * FROM address_book WHERE user_id = '$userId'";
		$addressResult = @mysqli_query($link, $addressQuery);
		
		//If no address for user, insert the one entered
		if(mysqli_num_rows($addressResult) == 0){
			$addressInsert = "INSERT INTO address_book (user_id, address, city, prov_state, country, post_code) VALUES ('$userId', '$address', '$city', '$province', '$country', '$postal')";
			@mysqli_query($link, $addressInsert);
			
		}else{//if user has a address, update with new one entered
			$addressUpdate = "UPDATE address_book set user_id='$userId', address='$address', city='$city', prov_state='$province', country='$country', post_code='$postal' WHERE user_id = '$userId'"; 
			@mysqli_query($link, $addressUpdate);
		}
		
		require_once('./config.php');
		echo '<h2>Please confirm your order</h2>
            <br>
            <h3>Shipping address:</h3>
            <p><b>Address:</b> ' . $address .'</p>
            <p><b>City:</b> ' . $city . '</p>
            <p><b>Province:</b> ' . $province . '</p>
            <p><b>Country:</b> ' . $country . ' </p>
            <p><b>Postal Code:</b> ' . $postal . '</p>
            
            <br>
            <h3>Your Order:</h3><hr>
		';
		//used to query the users cart table in DB to populate the cart
		//use to get which game_id(s) and their quantities from shopping cart to store in variables based on userId
		$getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
		$result = mysqli_query($link, $getCartQuery);
		if ($result) {
			$row_count = mysqli_num_rows($result);
			//print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
			$count = 0;
     
            while ($row = mysqli_fetch_array($result)) {
                $currGameId = $row['game_id'];
                //checks if the game already has a cookie assigned to it
                $quantity = $row['quantity'];

                //displays the contents of your cart
                $price = $row['price'];
                echo '<form method ="POST" action='.'"'.'cart.php?removeId='.$currGameId.'"><div id="cartDiv">' .
                    '<img class =' . '"' . 'cartImg' . '"' . 'src =' . '"' . $row['image'] . '">'.
                    '<p class="">' . $row['name'] . '</p>' .
                    '<span class="">Console: ' . $row['console_name'] . '<br>' .'</span>' .
                    '<p class="checkoutQuantity"> Quantity: ' . $quantity .'<p><br>'.
                    '<br><br><br><br><br><div class="checkoutPrice" id=' .'"' . 'price'. $currGameId .'"'.'>Price: $'. $price*$quantity .
                    '</div></form><br><br>
                ';

                //fancy line between products
                echo '<hr name = "productLine">';

            }
		}
		echo '<p class="checkoutTotal"> Total Price: $'. $pricetotal .'</p><br><br><br>';
	    echo '<form action="checkout.php" method="post" style="float:right">
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
              data-key="' . $stripe['publishable_key'] . '"
              data-description="Game(s) purchase"
              data-amount="'. $total . '"
              data-locale="auto"></script>
            <input type="hidden" name="pagenum" value="3"/>
            <input type="hidden" name="total" value="'. $total .'"/>
            <input type="hidden" name="oAddress" value="'. $address .'"/>
            <input type="hidden" name="oPostal" value="'. $postal .'"/>
            <input type="hidden" name="oProvince" value="'. $province .'"/>
            <input type="hidden" name="oCity" value="'. $city .'"/>
            <input type="hidden" name="oCountry" value="'. $country .'"/>
            <input type="hidden" name="oPrice" value="'. $pricetotal .'"/>
	        </form></div>
	    ';
		
	}

    // page 3 confirmation & order save
	else{
		$total = $_POST['total'];

	    print_r($_POST['gameArray']);
		
		require_once('./config.php');
	
		$token = $_POST['stripeToken'];
		$email = $_POST['stripeEmail'];
		
		$customer = \Stripe\Customer::create(array(
		'email' => $email,
		'source' => $token
		));
		
		$charge = \Stripe\Charge::create(array(
			'customer' => $customer->id,
			'amount'   => $total,
			'currency' => 'cad'
			));
		
		//Save order to order history and reciept
		$total = $total / 100;
		$orderQuery = "INSERT INTO orders(user_id, total) VALUES ('$userId', '$total')";
		@mysqli_query($link, $orderQuery);
		
		$orderIDQuery = "SELECT LAST_INSERT_ID()";
		$orderIDResult = mysqli_query($link, $orderIDQuery);
		$orderIDRow = mysqli_fetch_row($orderIDResult);
		$orderID = $orderIDRow[0];
		
		$getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
		$result = mysqli_query($link, $getCartQuery);
		if ($result)   {
			$row_count = mysqli_num_rows($result);
			//print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';
     
		while ($row = mysqli_fetch_array($result)) {
			
			$currGameId = $row['game_id'];
			$quantity = $row['quantity'];
			$price = $row['price'];
			$image = $row['image'];
			$gamename = $row['name'];
			$consolename = $row['console_name'];
			$description = nl2br(addslashes($row['description']));

			$receiptQuery = "INSERT INTO receipt (receipt_id, game_id, quantity, name, description, image, price, console_name) 
		                    VALUES ('$orderID', '$currGameId', '$quantity', '$gamename', '$description', '$image', '$price', '$consolename')";

			mysqli_query($link, $receiptQuery);
		}
		}
		//Save order receipt to an HTML file
		if(is_writable('receipts')){
			
			$file = "receipts/$orderID.html";
			
			$oAddress = $_POST['oAddress'];
			$oPostal = $_POST['oPostal'];
			$oProvince = $_POST['oProvince'];
			$oCity = $_POST['oCity'];
			$oCountry = $_POST['oCountry'];
			
			$data = "
				<html>
				<head>
				<meta charset=\"utf-8\">
				<link rel='stylesheet' href='../default.css'>
				<title> Receipt </title>
				
				</head>
				<body>
					<article>
					<div class=\"textBack\" align=\"left\" style=\"...\" >
						<h1>Order No. $orderID</h1>
						<br><br><br><br>
						<p>Thank you for ordering from BiFrost! Here is your detailed order info: </p>
						<br>
						<h2>Shipping to this address:</h2>
						<p><b>Address: </b>$oAddress</p>
						<p><b>City: </b>$oCity</p>
						<p><b>Province: </b>$oProvince</p>
						<p><b>Country: </b>$oCountry</p>
						<p><b>Postal Code: </b>$oPostal</p>
					    <br>
						<h2>Games you ordered:</h2>
			";
			file_put_contents($file, $data);
			
			$getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
			$result = mysqli_query($link, $getCartQuery);
			if ($result)   {
				$row_count = mysqli_num_rows($result);
		 
			while ($row = mysqli_fetch_array($result)) {
				//checks if the game already has a cookie assigned to it
				$quantity = $row['quantity'];

				//displays the contents of your cart
				$price = $row['price'];
				$gamedata = '    <div style="float: left;"><p class="">' . $row['name'] . '</p>
                    ' . '<span class="">' . $row['console_name'] . '<br></span></div>
                    ' . '<div style="float: right;"><p class=""> Quantity: ' . $quantity .'<p>
                    ' . '<p>Price: $'. $price*$quantity . '</p></div><br><br><br><br><br>
                    ' . '<hr name = "productLine">
                ';
				file_put_contents($file, $gamedata, FILE_APPEND);
			}
			}
			$oPrice = $_POST['oPrice'];
			$dataEnd ='<p class="checkoutTotal"> Order Total: $'. $oPrice .'</p><br><br>
			</div>
			</body>
			</html>';
			
			file_put_contents($file, $dataEnd, FILE_APPEND);
		}
        // Save order receipt to a txt file
        if(is_writable('receipts')){

            $file = "receipts/$orderID.txt";

            $oAddress = $_POST['oAddress'];
            $oPostal = $_POST['oPostal'];
            $oProvince = $_POST['oProvince'];
            $oCity = $_POST['oCity'];
            $oCountry = $_POST['oCountry'];

            $data = "
Order No. $orderID


Thank you for ordering from BiFrost! Here is your detailed order info: 


Shipping to this address:
-------------------------

$oAddress
$oCity, $oProvince
$oCountry
$oPostal



Games you ordered:
-------------------------

";
            file_put_contents($file, $data);

            $getCartQuery = 'SELECT * FROM shopping_cart inner join games using (game_id) where user_id = ' . '"' . $userId . '"';
            $result = mysqli_query($link, $getCartQuery);
            if ($result)   {
                $row_count = mysqli_num_rows($result);

                while ($row = mysqli_fetch_array($result)) {
                    //checks if the game already has a cookie assigned to it
                    $quantity = $row['quantity'];

                    //displays the contents of your cart
                    $price = $row['price'];
                    $gamedata = '
' . $row['name'] . '
Quantity: ' . $quantity . '
' . $row['console_name'] . '
Price: $'. $price*$quantity . '

';
                    file_put_contents($file, $gamedata, FILE_APPEND);
                }
            }
            $oPrice = $_POST['oPrice'];
            $dataEnd ='


Order Total: $'. $oPrice .'
';

            file_put_contents($file, $dataEnd, FILE_APPEND);
        }

        echo '<h2>Thank you for your order!</h2>';
        echo '<p>Order #' . $orderID . ' has been placed.';
        echo '<p><a href="receipts/' . $orderID . '.html" target="_blank">View Receipt</a></p>';
        echo '<h3>Your order will be shipped as soon as possible!</h3>';
		
		//payment complete, clear cart
		include ('connectionSQL.php');
		$clearCartQuery = 'DELETE FROM shopping_cart WHERE user_id ='. '"' . $userId . '"';
		@mysqli_query($link, $clearCartQuery);
	
	}
?>
        	</div>
    </article>

<?php
include('footer.php');
?>