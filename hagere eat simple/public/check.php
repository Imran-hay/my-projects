<?php
if (!isset($_SESSION)) 
    {session_start();}
    require_once('../config/connection.php');

    $value=$_GET['value'];
    $count=$_GET['amount'];
    $total=$_GET['total'];
    $loc=$_GET['loc'];
    $uname=$_SESSION['uname'];
    $rname=$_SESSION['menu'];
    $query="SELECT * FROM customer WHERE username='$uname'";
    $query_run=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($query_run);
    if($row['wallet']<$total)
    {
        echo 'Not Enough Money';
    }
    else
    {
    $new_balance=$row['wallet']-$total;
    $query2="UPDATE customer SET wallet=$new_balance WHERE username='$uname'";
    $query2_run=mysqli_query($con,$query2);
    $sql=$con->prepare("INSERT INTO orders (cust_username,location,food,amount,resturant,state,total,date,visible) VALUES (?,?,?,?,?,1,?,now(),1)");
    $sql->bind_param('sssssd',$uname,$loc,$value,$count,$rname,$total);
    $sql->execute();
    echo 'Successfully purchased, You can download receipt after the completion of order'; 
    }
    
?>