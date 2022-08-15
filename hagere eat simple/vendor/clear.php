<?php require_once "config.php";
require_once "orders.php";

//echo("<meta http-equiv='refresh' content='1'>");


$uri = $_SERVER['REQUEST_URI'];
$components = parse_url($uri);
parse_str($components['query'], $results);


foreach($results as $x => $x_value) {
   // echo $x ;
   
  }



  echo "<h1>$x</h1>";

  $sql = "UPDATE orders SET visible=0 WHERE id='$x' and resturant='$res'";

if (mysqli_query($conn, $sql)) {

    header('location:orders.php');

} else {

}



  

