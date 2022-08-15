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

if($_SERVER["REQUEST_METHOD"] == "GET" ) 
{
 if(isset($_GET['name']))
 {
   $food =  $_GET['name'];
   $_SESSION['food'] = $food;
 }
}
$active = "";
$sql9 = "SELECT * from menu where rname='$res'";
$result9 = mysqli_query($conn, $sql9);
if (mysqli_num_rows($result9) > 0) {
//$sql2 = "SELECT distinct menu.food, price from menu JOIN r_menu on menu.food = r_menu.food JOIN catagory on menu.food = catagory.food where r_menu.r_name = '$value' AND catagory.catagory1='food' AND catagory.catagory2='breakfast'"; 
$sql2 = "SELECT food,price,active FROM menu WHERE rname='$res' && catagory LIKE '%break%'";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {

  // output data of each row
  //echo "<h1 class='badge bg-primary text-wrap text-center m-3' style='width: 30rem height:30px;'>Breakfast</h1>";

  echo '<button class="w-100 btn btn-success btn-lg m-2" type="submit" name="back" onclick="Redirect()">Back to Home</button>';
  echo "<h1><span class='badge bg-primary'>Breakfast</span></h1>";
 echo "<table class='table table-info table-striped m-8'>";
 echo "<thead>";
 echo "<tr>";
echo "<td>Food</td>";
echo "<td>price</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>State</td>";
echo "</tr>";
echo "</thead>";
  while($row = mysqli_fetch_assoc($result2)) {
   for($i = 0 ; $i < count($row)-2 ; $i++)
   {
       echo "<tr>";
       echo "<td>$row[food]</td>";
       echo "<td>$row[price]</td>";

       $x = $row['food'];
       
       echo "<td><form method='POST' action='update.php?name=$row[food]'><button class='btn btn-outline-primary' name='$row[food]'>Update</button></form></td>";
       echo "<td><form method='GET' action='requests.php'><button class='btn btn-outline-success' name='$row[food]'>Activate</button></form></td>";
       echo "<td><form method='GET' action='requests2.php'><button class='btn btn-outline-danger' name='$row[food]'>Deactivate</button></form></td>";
       if($row['active'] == 1)
       {
         $active = "Active";
         echo "<td><h5><span class='badge bg-success'>Active</span></span></h5></td>";
         
    
       }
       if($row['active'] == -1)
       {
        $active = "Inactive";

        echo "<td><h5><span class='badge bg-danger'>Inactive</span></span></h5></td>";
       }


   }


  }

  echo "</table>";
} 

else {
  echo "<br>";
  echo "<h3></h3>no breakfast  items</h3>";
}



$sql3 = "SELECT food,price,active from menu where rname='$res' && catagory LIKE '%lun%'";
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3) > 0) {

  // output data of each row
  echo "<h1><span class='badge bg-primary'>Lunch</span></h1>";
  echo "<table class='table table-info table-striped m-8'>";
  echo "<thead>";
  echo "<tr>";
 echo "<td>Food</td>";
 echo "<td>price</td>";
 echo "<td></td>";
 echo "<td></td>";
 echo "<td></td>";
 echo "<td>State</td>";
 echo "</tr>";
 echo "</thead>";
   while($row = mysqli_fetch_assoc($result3)) {
    for($i = 0 ; $i < count($row)-2 ; $i++)
    {
        echo "<tr>";
        echo "<td>$row[food]</td>";
        echo "<td>$row[price]</td>";
 
        $x = $row['food'];
        
        echo "<td><form method='POST' action='update.php?name=$row[food]'><button class='btn btn-outline-primary' name='$row[food]'>Update</button></form></td>";
        echo "<td><form method='GET' action='requests.php'><button class='btn btn-outline-success' name='$row[food]'>Activate</button></form></td>";
        echo "<td><form method='GET' action='requests2.php'><button class='btn btn-outline-danger' name='$row[food]'>Deactivate</button></form></td>";
        if($row['active'] == 1)
        {
          $active = "Active";
          echo "<td><h5><span class='badge bg-success'>Active</span></span></h5></td>";
          
     
        }
        if($row['active'] == -1)
        {
         $active = "Inactive";
 
         echo "<td><h5><span class='badge bg-danger'>Inactive</span></span></h5></td>";
        }
    }
   }
 
   echo "</table>";
 }

else {
  echo "<br>";
  echo "<h3></h3>no lunch  items</h3>";
}

$sql4 = "SELECT food,price,active from menu where rname='$res' && catagory LIKE '%din%'";
$result4 = mysqli_query($conn, $sql4);

if (mysqli_num_rows($result4) > 0) {

  // output data of each row
  echo "<h1><span class='badge bg-primary'>Dinner</span></h1>";
  echo "<table class='table table-info table-striped m-8'>";
  echo "<thead>";
  echo "<tr>";
 echo "<td>Food</td>";
 echo "<td>price</td>";
 echo "<td></td>";
 echo "<td></td>";
 echo "<td></td>";
 echo "<td>State</td>";
 echo "</tr>";
 echo "</thead>";
 
 
 
 
 
   while($row = mysqli_fetch_assoc($result4)) {
    for($i = 0 ; $i < count($row)-2 ; $i++)
    {
        echo "<tr>";
        echo "<td>$row[food]</td>";
        echo "<td>$row[price]</td>";
 
        $x = $row['food'];
        
        echo "<td><form method='POST' action='update.php?name=$row[food]'><button class='btn btn-outline-primary' name='$row[food]'>Update</button></form></td>";
        echo "<td><form method='GET' action='requests.php'><button class='btn btn-outline-success' name='$row[food]'>Activate</button></form></td>";
        echo "<td><form method='GET' action='requests2.php'><button class='btn btn-outline-danger' name='$row[food]'>Deactivate</button></form></td>";
        if($row['active'] == 1)
        {
          $active = "Active";
          echo "<td><h5><span class='badge bg-success'>Active</span></span></h5></td>";
          
     
        }
        if($row['active'] == -1)
        {
         $active = "Inactive";
 
         echo "<td><h5><span class='badge bg-danger'>Inactive</span></span></h5></td>";
        }
 
 
    }
 
 
   }
 
   echo "</table>";
 
  
 }

else {
  echo "<br>";
  echo "<h3></h3>no dinner  items</h3>";
}


$sql5 = "SELECT food,price,active from menu where rname='$res' && catagory LIKE '%drink%'";
$result5 = mysqli_query($conn, $sql5);

if (mysqli_num_rows($result5) > 0) {

  // output data of each row
  echo "<h1><span class='badge bg-primary'>Drinks</span></h1>";
  echo "<table class='table table-info table-striped m-8'>";
  echo "<thead>";
  echo "<tr>";
 echo "<td>Food</td>";
 echo "<td>price</td>";
 echo "<td></td>";
 echo "<td></td>";
 echo "<td></td>";
 echo "<td>State</td>";
 echo "</tr>";
 echo "</thead>";
   while($row = mysqli_fetch_assoc($result5)) {
    for($i = 0 ; $i < count($row)-2 ; $i++)
    {
        echo "<tr>";
        echo "<td>$row[food]</td>";
        echo "<td>$row[price]</td>";
 
        $x = $row['food'];
        
        echo "<td><form method='POST' action='update.php?name=$row[food]'><button class='btn btn-outline-primary' name='$row[food]'>Update</button></form></td>";
        echo "<td><form method='GET' action='requests.php'><button class='btn btn-outline-success' name='$row[food]'>Activate</button></form></td>";
        echo "<td><form method='GET' action='requests2.php'><button class='btn btn-outline-danger' name='$row[food]'>Deactivate</button></form></td>";
        if($row['active'] == 1)
        {
          $active = "Active";
          echo "<td><h5><span class='badge bg-success'>Active</span></span></h5></td>";
          
     
        }
        if($row['active'] == -1)
        {
         $active = "Inactive";
 
         echo "<td><h5><span class='badge bg-danger'>Inactive</span></span></h5></td>";
        }
 
 
    }
 
 
   }
 
   echo "</table>";
 
  
 }

else {
  echo "<br>";
  echo "<h1></h3>No Drink Items</h1>";
}


}

else{

  echo "<br>";
  echo "<h1></h3>No Items in menu</h1>";

}




if(isset($_POST['back']))
{
  ?>
<script type="text/javascript">
window.location.href = 'http://localhost/project/resources/vendor/home.php';
</script>
<?php
}


?>
<html>
    
<head>

<link href="../library/assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="display.css" rel="stylesheet">
 <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>Hagere Hub</title>
</head>

<body class="bg-light">




<hr class="my-4">
</form>

<form method="POST" action="./reports/html/export.php">

<button class="w-100 btn btn-primary btn-lg m-2" type="submit" name="export" >Export</button>


</form>

<form method="POST" action="./reports/html/import.php" enctype="multipart/form-data">

<input class="file" type = "file"  name = "file"  id ="photo" required>
<button class="w-100 btn btn-primary btn-lg m-2" type="submit" name="import" >Import</button>


</form>

<hr class="my-4">










<script>
  function change()
  {
    const c = document.getElementById('c').value;
    window.alert(c);
  }

  function myFunction() {
  location.replace("http://localhost/HES/vendor/home.php");
}

function Redirect() {
               window.location = "http://localhost/HES/vendor/home.php";
            }  



</script>



</body>



</html>