<?php 
 include_once ('../login.php');
 session_start();
?>
<?php
$connection;
 
if(isset ($_POST[ "export" ] ) ){
    $value = $_SESSION['rname'];
header( 'Content-Type: text/csv; charset=utf-8' ) ;
header( 'Content-Disposition: attachment; filename=FOOD_MENU.csv' ) ;
$output = fopen( "php://output", "w" );
fputcsv($output, array( 'ID' ,' FOOD ','PHOTO',' PRICE ','INGREDIENTS ','CATEGORY','Rname' ,'ACTIVE'));
$sql = "SELECT * from menu where rname= '$value'";
$result = $connection->query($sql);
if ($result){  
    while($row = $result->fetch((PDO::FETCH_ASSOC))){
fputcsv($output, $row) ;
}fclose($output);
}
}