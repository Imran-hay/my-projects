<?php require_once "config.php";
require_once "display.php";

//echo("<meta http-equiv='refresh' content='1'>");
//header_remove();

$uri = $_SERVER['REQUEST_URI'];
$components = parse_url($uri);
parse_str($components['query'], $results);


foreach($results as $x => $x_value) {
   // echo $x ;
   
  }

  $y = str_replace("_"," ", $x);



  
$sql = "SELECT active FROM menu where food = '$y'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $active2 = intval($row['active']) ;
  }
} else {
  
}


if($active2 == -1)

    $sql3 = "UPDATE menu SET active=1 WHERE food='$y'";
    $active = "Active";

if (mysqli_query($conn, $sql3)) {

  ?>
  <script type="text/javascript">
  window.location.href = 'http://localhost/HES/vendor/display.php';
  </script>
  <?php

  

  //echo("<meta http-equiv='refresh' content='0'>");
 // header('Location :display.php');
  //header('Cache-Control: no-store, no-cache, must-revalidate');
  //header('Refresh:0');

  // check if the session has been created

  
} else {
  
}





















?>