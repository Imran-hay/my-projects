  <?php

  session_start();

  $res = "";
$value = $_SESSION['name'];

$sql = "SELECT * from resturant where username='$value'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $res = $row['Rname'];
    break;
    
  }
} 
$count = 0;
$sql2 = "SELECT * from orders where resturant='$res' AND state= -1";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result2)) {
    $count++;
    
  }
} 
  
  


  ?>
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">HES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="display.php">menu</a>
          </li>
       
          <li class="nav-item">
            <form method="POST"   action="<?php echo $_SERVER["PHP_SELF"];?>" name="order2">
          <button type="button" class="btn btn-secondary position-relative"  name="order" >
  Orders
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?php echo $count?>
    <span class="visually-hidden">unseen</span>
  </span>
</button>
</form>
  
          </li>

         
        </ul>
        <div class="d-flex">
            <button class="btn btn-outline-primary ">Account</button>
            
        </div>

       <form class="d-flex" method="POST" action="../index.php" name="logout">
         
          <button class="btn btn-outline-danger ms-4" name="log_out">Logout</button>
        </form>
         
      
       
      </div>
    </div>
  </nav>
</header>