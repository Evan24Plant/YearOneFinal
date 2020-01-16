<?php
include('header.php');

?>

<article>
<form action="products.php">
<input type="submit" class="greyBackButtons" style="margin-top: 10px" value="<  Back to Shopping" />
</form>

<div class="textBack" align="left" style="float:top" >

<p>
<?php header('charset=utf-8');

	if (isset($_SESSION['user_id'])) { // User signed in -> cart
        $cartURL = 'cart.php?gameId=';
    } else { // User not signed in -> login
        $cartURL = 'login.php?gameId=';
    }

    include ('connectionSQL.php');
 
    $gameId = $_GET['gameId'];
    $query = "select * from games where game_id = ". $gameId;
    $result = mysqli_query($link, $query);
    if ($result)   {
        $row_count = mysqli_num_rows($result);
        //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';

        while ($row = mysqli_fetch_array($result)) {

            //print $row['name'] . '<br>' .
            print '<div class="clearfix">' . '<br>' .
                '<img class ="images" src ="' . $row['image'] . '">'.
                '<p class="gameNameProduct">' . $row['name'] . '</p><br>' .
                '<span class="consoleName">' . $row['console_name'] . '<br>' .'</span><br>'.
                '<br>' . $row['description'] . '<br><br><br><br>'.
                '<a href="'. $cartURL . $row['game_id'] . '" class="cost"><p class="price2" style="width: 50%">$'. $row['price'] .'<img src="cart.png" class="cart"></p></a></div><br><br>
            ';

            if ($row['youtube_link'] != "") {
                $youtubeLink = $row['youtube_link'];
                echo '<div class="flex-container"><iframe style="margin-bottom:40px; align-self:center; width:60vw; height:37.5vw;" id="ytplayer" type="text/html" width="640" height="360" src="https://www.youtube.com/embed/' . $youtubeLink . '?autoplay=1&origin=http://example.com" frameborder="0"></iframe></div>
                ';
            }
        }
    }
?>


</p>

</div>
<form action="products.php">
<input type="submit" class="greyBackButtons" style="margin-top: 10px" value="<  Back to Shopping" />
</form>
</article>
<br>
<br>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>



</article>

<?php
include "footer.php";
?>
