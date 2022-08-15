<?php 
 include_once ('../login.php');
 session_start();
?>
<?php
$connection;


if(isset ($_POST ["import"] )){
    
$fi1eName = $_FILES["file" ][ "tmp_name"];

if($_FILES["file"][ "size"]>500){
    echo("<script>alert('bla')</script>");
$file = fopen( $fi1eName,'r');
$value = $_SESSION['rname'];

while(($column = fgetcsv($file , 1000 , ","))!==false){
 $sql ="INSERT INTO menu(id , food, photo, price,ingredients,catagory,rname,active) values('" .$column[0]."','".$column[1]."','".$column[2]."','".$column[3]."','".$column[4]."','".$column[5]."','".$value."','".$column[7]."')";
 $result =   $connection->query($sql);
if( !empty($result) ) {
echo "CSV Data Imported into the database"; }
else
echo "Problem in importing csv";}}}
header("location: ../../display.php")
;
?>