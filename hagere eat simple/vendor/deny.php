<?php require_once "config.php";


  $x=$_GET['deny_id'];
  $sql = "UPDATE orders SET state=4, visible=0 WHERE id='$x' and state = 1";
  $query=mysqli_query($conn,"SELECT * FROM orders WHERE id='$x'");
  $row=mysqli_fetch_assoc($query);
  $client=$row['cust_username'];
  $amount=$row['total'];
  $query4=mysqli_query($conn,"SELECT * FROM customer WHERE username='$client'");
  $row2=mysqli_fetch_assoc($query4);
  $wallet=$row2['wallet'];
  $wallet+=$amount;
  $query2=mysqli_query($conn,"INSERT INTO notifications(username,info,order_id) VALUES ('$client','Your Order Has been denied, Your balance has been refunded',$x)");
  $query3=mysqli_query($conn,"UPDATE customer SET wallet=$wallet WHERE username='$client'");
if (mysqli_query($conn, $sql)) {

    header('location:orders.php');

} else {

}



  

