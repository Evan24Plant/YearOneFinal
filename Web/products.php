<?php
    include('header.php');

?>
	
<div class="clearfix">
    <div>
<article>
	
	
	<nav class="console">
<ul style="box-shadow: -6px 10px 12px #C2C2C2; margin-bottom: 10px; margin-right: 3.5vw">
    <?php
    $console = @$_GET['console'];
    $_SESSION['theconsole'] = $console;

	echo '<li><a href = "products.php?console=All" style = "cursor: pointer" class="'; 
    if(!isset($_SESSION['theconsole']) || $_SESSION['theconsole'] == "All"){
            echo "viewing";
        }
         echo '">All</a></li>
	<li><a href = "products.php?console=Nintendo Switch" style = "cursor: pointer" class="';
    if($_SESSION['theconsole'] == "Nintendo Switch"){
            echo "viewing";
        }
         echo '">Nintendo Switch</a></li>
	<li><a href = "products.php?console=PS4" style = "cursor: pointer" class="';
    if($_SESSION['theconsole'] == "PS4"){
            echo "viewing";
        }
         echo '">PlayStation 4</a></li>
	<li><a href = "products.php?console=PC" style = "cursor: pointer" class="'; 
    if($_SESSION['theconsole'] == "PC"){
            echo "viewing";
        }
         echo '">PC</a></li>
	<li><a href = "products.php?console=XB1" style = "cursor: pointer" class="';
    if($_SESSION['theconsole'] == "XB1"){
            echo "viewing";
        }
         echo '">Xbox One</a></li>';
?>
</ul>
</nav>
<?php
    //used to determine the console query
    

    // Generates the redirect URL to use if the user tries to buy an item
    if (isset($_SESSION['user_id'])) { // User signed in -> cart
        $cartURL = 'cart.php?gameId=';
    } else { // User not signed in -> login
        $cartURL = 'login.php?gameId=';
    }
?>
<br><br><br>
<?php
//makes the console selection persistant between category selections
if(isset($_SESSION['theconsole'])){

	$passedConsole = $_SESSION['theconsole'];
	$formUrl = "products.php?console=".$passedConsole;

}
else{
	$formUrl = "products.php";
}
echo '<form class = "genreSelect" action="'.$formUrl.'" method="Post" style = "float:right">';
?>
<select name = "theGenre" class="dropdown">
<option value = "All">All</option>

<?php 
    //used to get the genres from DB
	include ('connectionSQL.php');
	$genreQuery = "select * from genres order by genre_id";
	$genreList = mysqli_query($link, $genreQuery);
    if($genreList){
        $genreRows = mysqli_num_rows($genreList);
        print $genreRows;
        while($genre = mysqli_fetch_array($genreList)) {
            print '<option value =' . '"' . $genre['genre_id'] . '">' . $genre['genre_id'] . '</option>';
        }
        print '<input name=' . '"' . 'theconsole' . '"' . 'type=' . "'" . 'hidden' . "'" . 'value = ' . "'" . $console . "'" . '>';
    }

    if(isset($_POST['submitQ'])){

        $selectedGenre = $_POST['theGenre'];
        $console = $_POST['theconsole'];
    }
?>
</select>

<input type = "submit" class="greyBackButtons" style="margin-left: 10px;" name ="submitQ" value="Search"/>

</form>
<br>



<?php
    if(($console == "" || $console == "All")){
        if($selectedGenre == "" || $selectedGenre == "All") {
            //none selected
            $query = "select * from games order by name, console_name";
            
        }
        else {
            //genre selected only
            $query = "select * from games inner join game_genres using(game_id) where genre_id ='$selectedGenre' order by name, console_name";
            
        }
    }
    else {
        if($selectedGenre == "" || $selectedGenre == "All") {
        //console only selected
        $query = "select * from games where console_name like '$console' order by name, console_name";
        
    }
        else {
            //both selected
            $query = "select * from games inner join game_genres using(game_id) where genre_id ='$selectedGenre' AND console_name ='$console' order by name, console_name";
            
        }

    }

    //print "the console: " . $console . '<br>';
    //print "the genre: " . $selectedGenre . '<br>';
    //print "the query: " . $query . '<br>';
?>

<div class="textBack" align="left" style="float:left" >
<?php
echo '<h1 style="font-size: 28px">Games ';if(!isset($console) || $console == All){$console = "";}else{$console = "- ".$console;}echo $console .'</h1>';
?>
<br><br><br><hr name="productLine" style="background-image: -webkit-linear-gradient(left, black, #8c8b8b, black)">
<div class="flex-container">
<?php header('charset=utf-8');
    include ('connectionSQL.php');



    $result = mysqli_query($link, $query);
    if ($result)   {
        $row_count = mysqli_num_rows($result);
        //print 'Retreived '. $row_count . ' rows from the <b> games </b> table<BR><BR>';

        while ($row = mysqli_fetch_array($result)) {
            $gameId = $row['game_id'];
            //print $row['name'] . '<br>' .
             print '<div class="clearfix">' . '' .
             '<span class="consoleName">' . $row['console_name'] . '' .'</span>'.
             '<a href="product.php?gameId='.$gameId .'" class=""><img class ="images" src ="' . $row['image'] . '"></a>'.
             '<a href="product.php?gameId='.$gameId .'" class="cost"><p class="gameName">' . $row['name'] . '</p></a>' .
              
             '<a href="'. $cartURL . $row['game_id'] . '" class="cost"><p class="price">$'. $row['price'] .'<img src="cart.png" class="cart"></p></a></div>';
            
        }
    }
?>
<br>
<br>
<br>
<br>
<br>
</div>
</div>
<br>
<br>
<br>
<br>

	

</article>
</div>
</div>
<?php
    include('footer.php');
	
?>
