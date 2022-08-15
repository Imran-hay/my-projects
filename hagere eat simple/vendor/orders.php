<?php require_once "config.php";

session_start();

if($_SESSION['state']!=1)
    {
      header("Location:../index.php");
    }
$value = $_SESSION['name'];
$res = "";

$sql = "SELECT * from resturant where username='$value'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $res = $row['Rname'];
    break;
    
  }
} 

$sql2 = "SELECT * from orders join customer on orders.cust_username=customer.username  where orders.resturant='$res' and orders.visible = 1 ";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {

  // output data of each row
  echo "<h1 class='badge bg-primary text-wrap text-center m-3' style='width: 40rem height:30px;'>Orders</h1>";
 echo "<table class='table table-info table-striped m-8'>";
 echo "<thead>";
 echo "<tr>";
echo "<td>customer</td>";
echo "<td>phone</td>";
echo "<td>order</td>";
echo "<td>total amount</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>Status</td>";
//echo "</tr>";
//echo "</thead>";
$foods2 = array();
$amount2 = array();
$total= "";
$total2= array();
for($s = 0 ; $s<1000 ; $s++)
{
  $total2[$s] = "";
}
$tot = array();
$tot2 = array();
for($q = 0 ; $q<1000 ; $q++)
{
  $tot[$q] = 0;
}
for($w = 0 ; $w<1000 ; $w++)
{
  $tot2[$w] = 0;

}

$del = 15;
$foods3 = array();
$i = 0;
  while($row = mysqli_fetch_assoc($result2)) {

    $foods = explode (",", $row['food']); 
    $amount = explode (",", $row['amount']); 

    for($j = 0; $j< count($foods); $j++)
    {
        $foods2[$j] = intval($foods[$j]);
        $amount2[$j] = intval($amount[$j]);
    }
   
    echo "<br>";
    for($k = 0, $a = 0; $k< count($foods2),$a< count($amount2); $k++ ,$a++)
    {
        $sql3 = "SELECT food,price FROM menu WHERE id='$foods2[$k]'";
      $result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3) > 0) {
  // output data of each row
  while($row3 = mysqli_fetch_assoc($result3)) {

    $foods3[$k] = $row3['food'];
    $tot[$k] = intval($row3['price']);

   
    //echo "<h1>$row3[food]</h1>";
     //$total.= $amount[$k] .$foods3[$k] ;

     
      $total2[$i] .= $amount2[$a] ." ".  $foods3[$k] . ", ";
      $tot2[$i] += intval($amount2[$k])* $tot[$k];   
    
  }
   
  
    
  } 
  //$total.= $amount[$j] .$row2['food'] ;
    
  //$total2[$c] = $amount[$j] .$row2['food'];

  
  
  
 
} 

echo "<tr>";
echo "<td>$row[fname]</td>";
echo "<td>$row[phone]</td>";
 echo "<td>$total2[$i]</td>";
 $final = $row['total'];

echo "<td>$final</td>";
echo "<td><form method='GET' action='accept.php'><button class='btn btn-outline-primary'  name='$row[id]'>Accept</button></form></td>";
echo "<td><form method='GET' action='ready.php'><button class='btn btn-outline-success'  name='$row[id]'>Ready</button></form></td>";
echo "<td><form method='GET' action='deny.php'><input type='hidden' name='deny_id' value='$row[id]'><button class='btn btn-outline-danger' name='deny'  >Deny</button></form></td>";
echo "<td><form method='GET' action='clear.php'><button class='btn btn-outline-warning' name='$row[id]'>Clear</button></form></td>";
    if($row['state'] == 1)
    {
      echo "<td>Queueing</td>";
    }

    if($row['state'] == 2)
    {
      echo "<td>Getting Prepared</td>";

    }

    if($row['state'] == 3)
    {
      echo "<td>Waiting for Delivery</td>";

    }

    if($row['state'] == 4)
    {
      echo "<td>Rejected</td>";

    }
     if($row['state'] == 5)
    {
      echo "<td>Delivered</td>";

    }

 

echo "<tr>";

$i++;
    

    
        

    }

 
  


    
  echo "</table>"; 
    


   }

   else{
     echo "<h1>NO orders</h1>";
   }

   



  


  echo "<div class='row g-3'>";
  echo   "<form method = 'GET' action='accept-all.php'><button class='w-80 btn btn-success btn-lg m-2 col' type='submit'>Accept All</button></form>";

  echo   "<form method = 'GET' action='clear-all.php'><button class='w-80 btn btn-warning btn-lg m-2 col' type='submit'>Clear All</button></form>";
  echo "</div>"



 








?>


<html>
    
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
 <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>Hagere Hub</title>
<link href="../library/assets/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">


<button class="w-100 btn btn-success btn-lg m-2" type="submit" name="back" onclick="Redirect()">Back to Home</button>


<script>
  function Redirect() {
               window.location = "http://localhost/HES/vendor/home.php";
            }  
</script>

</body>



</html>
