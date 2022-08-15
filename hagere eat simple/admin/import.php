<?php

session_start();
include("../config/connection.php");
 if($_SESSION['state']!=3)
    {
      header("Location:../index.php");
    }

if(isset ($_POST ["order"] )){
    
$fi1eName = $_FILES["file" ][ "tmp_name"];

$file = fopen( $fi1eName,'r');
while(($column = fgetcsv($file , 1000 , ","))!==false){
 $sql ="INSERT INTO orders values('" .$column[0]."','".$column[1]."','".$column[2]."','".$column[3]."','".$column[4]."','".$column[5]."','".$column[6]."','".$column[7]."','".$column[8]."','".$column[9]."','".$column[10]."','".$column[11]."')";
 $result = mysqli_query($con,$sql);
if( !empty($result) ) {
echo "CSV Data Imported into the database"; }
else
echo "Problem in importing csv";}
header("Location:index.php");
}

if(isset ($_POST ["customer"] )){
    
$fi1eName = $_FILES["file" ][ "tmp_name"];

$file = fopen( $fi1eName,'r');
while(($column = fgetcsv($file , 1000 , ","))!==false){
 $sql ="INSERT INTO customer values('" .$column[0]."','".$column[1]."','".$column[2]."','".$column[3]."','".$column[4]."','".$column[5]."','".$column[6]."','".$column[7]."','".$column[8]."','".$column[9]."')";
 $result = mysqli_query($con,$sql);
if( !empty($result) ) {
echo "CSV Data Imported into the database"; }
else
echo "Problem in importing csv";}
header("Location:index.php");
}

if(isset ($_POST ["resturant"] )){
$fi1eName = $_FILES["file" ][ "tmp_name"];
$file = fopen( $fi1eName,'r');
while(($column = fgetcsv($file , 1000 , ","))!==false){
 $sql ="INSERT INTO resturant values('" .$column[0]."','".$column[1]."','".$column[2]."','".$column[3]."','".$column[4]."','".$column[5]."')";
 $result = mysqli_query($con,$sql);
if( !empty($result) ) {
echo "CSV Data Imported into the database"; }
else
echo "Problem in importing csv";}
header("Location:index.php");
}

?>

<html>
<head>
<!--    style-->
<link rel="stylesheet" href="../resources/css/edit.css" />
    

<!--    title-->

   <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>Hagere Hub</title>
</head>
<body style="background: #efefef">
<h2>Import to Database</h2>
<!--php starts here-->

<!--            form starts-->
 <form action="" method="post" enctype = "multipart/form-data">
        
        <h4 style="display: inline-block;">Import CSV to Vendor</h4><input type="file"  name="file"  ><br><br> 
       <a style="text-decoration: none;color: coral" href="index.php">CANCEL</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <button style="color: green; outline: none; border: none; background: none; cursor: pointer;" type="submit" name="resturant" onclick="return confirm('Are you sure you want to import?');" >Import Vendors</button>
</form>
<br><br>
 <form action="" method="post" enctype = "multipart/form-data">
        
        <h4 style="display: inline-block;">Import CSV to Customer</h4><input type="file"  name="file"  ><br><br> 
       <a style="text-decoration: none;color: coral" href="index.php">CANCEL</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <button style="color: green; outline: none; border: none; background: none; cursor: pointer;" type="submit" name="customer" onclick="return confirm('Are you sure you want to import?');" >Import Customers</button>
</form>
<br><br>
 <form action="" method="post" enctype = "multipart/form-data">
        
        <h4 style="display: inline-block;">Import CSV to Order</h4><input type="file"  name="file"  ><br><br> 
       <a style="text-decoration: none;color: coral" href="index.php">CANCEL</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <button style="color: green; outline: none; border: none; background: none; cursor: pointer;" type="submit" name="order" onclick="return confirm('Are you sure you want to import?');" >Import Orders</button>
</form>
<br><br>
<!--        php ends-->


</body>
</html>