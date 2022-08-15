<?php
  if (!isset($_SESSION)) 
    {session_start();}

require_once '../config/connection.php';
$uname=$_SESSION['uname'];
$sql=mysqli_query($con, "SELECT * FROM notifications WHERE username='$uname'");
$num=mysqli_num_rows($sql);
echo $num;
                
?>