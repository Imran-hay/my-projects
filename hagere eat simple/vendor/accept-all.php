<?php require_once "config.php";
require_once "orders.php";

//echo("<meta http-equiv='refresh' content='1'>");









  $sql = "UPDATE orders SET state=2 where state= 1 and resturant='$res'";

if (mysqli_query($conn, $sql)) {



} else {

}



  


